import './bootstrap';
import { Device } from '@twilio/voice-sdk';


document.addEventListener("DOMContentLoaded", async () => {
    const callButton = document.getElementById("callButton");
    const hangupButton = document.getElementById("hangupButton");
    const phoneInput = document.getElementById("phoneInput");
    const logBox = document.getElementById("logOutput");

    let device = null;
    let activeCall = null;
    let callStartTime, callEndTime;

    function log(msg) {
        const p = document.createElement("div");
        p.textContent = msg;
        p.className = "mb-1 text-muted small";
        logBox.appendChild(p);
        logBox.scrollTop = logBox.scrollHeight;
        console.log(msg);
    }

    // 🔁 Refresh token before expiry (~every 50 minutes)
    async function refreshToken() {
        try {
            const res = await fetch("/twilio/token");
            const data = await res.json();
            await device.updateToken(data.token);
            log("🔄 Twilio token refreshed");
        } catch (err) {
            log("❌ Token refresh failed: " + err.message);
        }
    }

    async function initTwilio() {
        try {
            const res = await fetch("/twilio/token");
            const data = await res.json();

            device = new Device(data.token, { logLevel: "info" });

            device.on("registered", () => log("📞 Twilio device ready"));
            device.on("error", (err) => log("❌ Error: " + err.message));
            device.on("incoming", (call) => {
                log("📥 Incoming call from " + call.parameters.From);
                // call.accept(); // uncomment to auto-answer
            });
            device.on("tokenWillExpire", refreshToken);

            await device.register();
            log("✅ Twilio device registered");

            // refresh token periodically (55 min)
            setInterval(refreshToken, 55 * 60 * 1000);
        } catch (err) {
            log("❌ Failed to init Twilio: " + err.message);
        }
    }

    callButton?.addEventListener("click", async () => {
        const number = phoneInput.value.trim();
        if (!number) return alert("Enter a number to call.");
        if (!device) return alert("Twilio not initialized yet.");

        log(`📲 Calling ${number}...`);
        callStartTime = new Date();

        try {
            activeCall = await device.connect({ params: { To: number } });

            activeCall.on("accept", () => log("✅ Call connected"));
            activeCall.on("disconnect", async () => {
                log("📴 Call ended");
                callEndTime = new Date();

                const totalMinutes =
                    Math.round((callEndTime - callStartTime) / 6000) / 10;
                const csrfToken = document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content");

                await fetch("/twilio/log-call-end", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify({
                        number,
                        call_start: callStartTime.toISOString(),
                        call_end: callEndTime.toISOString(),
                        total_minutes: totalMinutes,
                    }),
                });
            });
        } catch (err) {
            log("❌ Call failed: " + err.message);
        }
    });

    hangupButton?.addEventListener("click", async () => {
        if (activeCall) {
            log("🛑 Hanging up...");
            await activeCall.disconnect();
            activeCall = null;
        }
    });

    await initTwilio();
});
