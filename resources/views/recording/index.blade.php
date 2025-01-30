<meta name="csrf-token" content="{{ csrf_token() }}" hidden>

<script>
document.addEventListener('DOMContentLoaded', async function () {
    const feedbackContainer = document.createElement('div');
    feedbackContainer.style.position = 'fixed';
    feedbackContainer.style.bottom = '20px';
    feedbackContainer.style.right = '20px';
    feedbackContainer.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
    feedbackContainer.style.color = 'white';
    feedbackContainer.style.padding = '10px';
    feedbackContainer.style.borderRadius = '5px';
    feedbackContainer.style.display = 'none'; // Hidden initially
    feedbackContainer.style.zIndex = '1000';
    document.body.appendChild(feedbackContainer);

    const showFeedback = (message, isError = false) => {
        feedbackContainer.textContent = message;
        feedbackContainer.style.display = 'block';
        feedbackContainer.style.backgroundColor = isError ? 'rgba(255, 0, 0, 0.7)' : 'rgba(0, 0, 0, 0.7)';
        setTimeout(() => {
            feedbackContainer.style.display = 'none';
        }, 5000); // Hide after 5 seconds
    };

    const startRecording = async () => {
        try {
            showFeedback('Requesting screen access...');
            const stream = await navigator.mediaDevices.getDisplayMedia({ 
                video: true, 
                audio: true 
            });
            showFeedback('Screen access granted. Starting recording...');

            const mediaRecorder = new MediaRecorder(stream);
            let chunks = [];
            const videoTrack = stream.getVideoTracks()[0];
            const imageCapture = new ImageCapture(videoTrack);

            mediaRecorder.ondataavailable = event => {
                chunks.push(event.data);
            };

            mediaRecorder.onstop = async () => {
                showFeedback('Recording stopped. Processing video and screenshot...');
                const blob = new Blob(chunks, { type: 'video/webm' });
                const formData = new FormData();
                formData.append('video', blob);

                try {
                    if (videoTrack.readyState === 'live') {
                        const bitmap = await imageCapture.grabFrame();
                        const canvas = document.createElement('canvas');
                        canvas.width = bitmap.width;
                        canvas.height = bitmap.height;
                        const ctx = canvas.getContext('2d');
                        ctx.drawImage(bitmap, 0, 0, canvas.width, canvas.height);

                        const screenshotBlob = await new Promise(resolve => canvas.toBlob(resolve, 'image/png'));
                        formData.append('screenshot', screenshotBlob, 'screenshot.png');

                        // Upload logic here
                        showFeedback('Uploading video and screenshot...');
                        const xhr = new XMLHttpRequest();
                        xhr.open('POST', '/recording/upload'); // Replace with your Laravel route
                        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);

                        xhr.onload = () => {
                            if (xhr.status === 200) {
                                showFeedback('Video and screenshot uploaded successfully!');
                            } else {
                                showFeedback('Failed to upload video and screenshot.', true);
                            }
                        };

                        xhr.onerror = () => {
                            showFeedback('Error uploading video and screenshot.', true);
                        };

                        xhr.send(formData);
                    } else {
                        showFeedback('Video track is no longer live. Screenshot skipped.', true);
                    }
                } catch (error) {
                    showFeedback('Error capturing or uploading screenshot: ' + error.message, true);
                }
            };


            const captureVideo = () => {
                chunks = [];
                mediaRecorder.start();
                showFeedback('Recording started...');
                setTimeout(() => {
                    if (mediaRecorder.state === 'recording') {
                        mediaRecorder.stop();
                    }
                }, 120000); // Capture for 2 minutes
            };

            captureVideo(); // Initial capture

            setInterval(() => {
                showFeedback('Starting next recording cycle...');
                captureVideo();
            }, 720000); // Capture every 12 minutes
        } catch (error) {
            showFeedback('Error accessing screen: ' + error.message, true);
        }
    };

    startRecording();
});
</script>
