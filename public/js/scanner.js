navigator.mediaDevices.getUserMedia({ video: true })
    .then(function(stream) {
        var video = document.getElementById('video');
        video.srcObject = stream;
        video.play();

        var codeReader = new ZXing.BrowserQRCodeReader();
        codeReader.decodeFromVideoDevice(undefined, 'video', function(result) {
            console.log('QR code detected: ' + result.text);
            // Send the result.text (QR code data) to your Laravel backend via AJAX
        });
    })
    .catch(function(err) {
        console.error('Error accessing camera:', err);
    });
