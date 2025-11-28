<div class="row">
    <div class="p-4 border rounded card col-12">
        <div class="card-header">
            <h2 class="Card Header">Outbound Call +</h2>
        </div>
        <div class="card-body">
            <div x-data="phonePad" x-init="init()">
                <div class="row card-body">
                    <div class="col-md-12 col-lg-4">
                        <!-- Phone Number Input -->
                        <h4 class="mb-4">Enter Phone Number</h4>
                        <input type="text" 
                                x-ref="input"
                                x-model="phone"
                                wire:model="phone"
                                id="phoneInput"
                                class="mb-3 text-center form-control form-control-lg"
                                placeholder="+1234567890">

                        @error('phone') <div class="mb-3 text-danger">{{ $message }}</div> @enderror

                        <div class="row">
                            <!-- Call Button -->
                            <div class="col-6">
                                <button type="button" id="callButton"
                                    class="gap-2 mb-3 btn btn-primary btn-lg w-100 d-flex align-items-center justify-content-center">
                                    <i class="bi bi-telephone-fill"></i> Call Now
                                </button>
                            </div>
                            <div class="col-6">
                            <!-- Hangup Button -->
                                <button type="button" id="hangupButton"
                                    class="gap-2 mb-3 btn btn-danger btn-lg w-100 d-flex align-items-center justify-content-center">
                                    <i class="bi bi-phone-fill"></i> Hangup
                                </button>
                            </div>
                        </div>
                        

                        <!-- Toggle Dial Pad -->
                        <button @click="dialpad = !dialpad" class="text-center btn btn-outline-secondary btn-sm">
                            Toggle Dialpad
                        </button>

                        <!-- Dial Pad UI -->
                        <div x-show="dialpad" class="mt-3">
                            <div class="row g-2">
                                @foreach (['1','2','3','4','5','6','7','8','9','*','0','#'] as $key)
                                    <div class="col-4">
                                        <button
                                            @click="press('{{ $key }}')"
                                            :class="activeKey === '{{ $key }}' ? 'btn-dark' : 'btn-outline-dark'"
                                            class="py-3 btn w-100"
                                        >
                                            {{ $key }}
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                        <!-- Call Log -->
                        <h4 class="mb-4">Call Log</h4>
                        {{-- <div id="logOutput" class="mt-3 text-muted small" style="height: 100px; overflow-y: auto; white-space: pre-wrap;"></div> --}}
                        <div id="logOutput" style="height:300px; max-height: 300px; overflow-y: auto;" class="p-2 border rounded bg-light"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4 col-12 card">
            <h5 class="card-header"> </h5>
            <div class="justify-between mx-3 mb-3 row align-items-center">
                <div class="mb-2 col-md-6 col-12 mb-lg-0">
                </div>
                <div class="col-md-6 col-12">
                    <input
                        type="text"
                        class=" form-control"
                        placeholder="Search items..."
                        wire:model.live="search"
                    />
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <!-- Search Bar -->
                
                <table class="table mb-5 table-hover">
                    <thead>
                    <tr>
                        <th>Phone #</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Minutes</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach ($callLogs as $callLog)
                        <tr>
                            <td>{{ $callLog->phone_number}}</td>
                            <td>{{ $callLog->call_start}}</td>
                            <td>{{ $callLog->call_end}}</td>
                            <td>{{ $callLog->total_minutes}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="mt-5 d-flex justify-content-center">
                    {{ $callLogs->links() }}
                </div>
            </div>
    </div>
</div>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('phonePad', () => ({
            dialpad: true,
            phone: '',
            activeKey: '',
            device: null,

            press(num) {
                this.phone += num;
                this.activeKey = num;
                this.$refs.input.focus();
                setTimeout(() => this.activeKey = '', 200);
            },

            handleKey(e) {
                const valid = ['0','1','2','3','4','5','6','7','8','9','*','#'];

                if (!['Backspace', 'ArrowLeft', 'ArrowRight', 'Tab'].includes(e.key) &&
                    !valid.includes(e.key)) {
                    e.preventDefault();
                }

                if (valid.includes(e.key)) {
                    this.press(e.key);
                }
            },
            init() {
                this.$refs.input.focus();
                
            }
        }));
    });
    // document.addEventListener('DOMContentLoaded', () => {
    //     const phoneInput = document.getElementById('phoneInput');
    //     const callButton = document.getElementById('callButton');
    //     const hangupButton = document.getElementById('hangupButton');
    //     const logBox = document.getElementById('logOutput');
    //     var callStartTime;
    //     var callEndTime;

    //     // ✅ Initialize Twilio.Device
    //     fetch('{{ route('twilio.token') }}') // You must return a Twilio access token from this route
    //         .then(res => res.json())
    //         .then(data => {
    //             device = new Twilio.Device(data.token, {
    //                 debug: true
    //             });

    //             device.on('ready', () => log("> 📞 Twilio Device Ready"));
    //             device.on('error', err => log("> ❌ Error: " + err.message));
    //             device.on('connect', conn => log("> ✅ Call Connected"));
    //             device.on('disconnect', () => {
    //                 log("> 📴 Call Ended")
    //                 callEndTime = moment().tz('Asia/Manila');
    //                 const number = phoneInput.value;
    //                 var totalMinutes = Math.round((callEndTime - callStartTime) / 6000) / 10;

    //                 // Laravel CSRF token (ensure this meta tag is in your Blade layout)
    //                 const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    //                 fetch('{{ route('twilio.log-call-end') }}', {
    //                     method: 'POST',
    //                     headers: {
    //                         'Content-Type': 'application/json',
    //                         'X-CSRF-TOKEN': csrfToken
    //                     },
    //                     body: JSON.stringify({
    //                         number: number,
    //                         call_start: callStartTime.format(),
    //                         call_end: callEndTime.format(),
    //                         total_minutes: totalMinutes
    //                     })
    //                 })
    //                 .then(response => response.json())
    //                 .then(data => {
    //                     console.log('✅ Call data saved:', data);
    //                 })
    //                 .catch(error => {
    //                     console.error('❌ Error saving call data:', error);
    //                 });
    //             });
    //         });

    //     // ✅ Call action
    //     callButton.addEventListener('click', () => {
    //         const number = phoneInput.value;
    //         callStartTime = moment().tz('Asia/Manila');
    //         if (!number) return alert("Enter a number to call.");
    //         if (!device) return alert("Twilio not initialized yet.");
    //         log("> 📲 Calling " + number + "...");
    //         device.connect({ To: number });
    //     });

    //     // ✅ Hangup action
    //     hangupButton.addEventListener('click', () => {
    //         if (device) {
    //             log("> 🛑 Hanging up...");
    //             device.disconnectAll();
    //         }
    //     });

    //     // ✅ Log messages
    //     function log(msg) {
    //         const p = document.createElement('div');
    //         p.textContent = msg;
    //         p.className = 'text-muted small mb-1';
    //         p.style.whiteSpace = 'pre-wrap'; // Preserve whitespace
    //         p.style.wordBreak = 'break-word'; // Break long words
    //         p.style.overflowWrap = 'break-word'; // Ensure long words break
    //         p.style.maxWidth = '100%'; // Prevent overflow
    //         p.style.textAlign = 'left'; // Align text to the left
    //         p.style.fontSize = '1.5rem'; // Smaller font size for better readability
    //         p.style.lineHeight = '1.5'; // Increase line height for better readability
    //         p.style.marginBottom = '0.5rem'; // Add some space between log entries
    //         p.style.fontFamily = 'monospace'; // Use monospace font for better alignment
    //         logBox.appendChild(p);
    //         logBox.scrollTop = logBox.scrollHeight;
    //     }

    // });
</script>