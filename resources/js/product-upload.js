// Initialize variables to track file selection
let imageFileSelected = false;
let audioFileSelected = false;
let imageResumable, audioResumable;

function enableSubmitButton() {
    if (imageFileSelected && audioFileSelected) {
        $('#submitButton').removeAttr('disabled').removeClass('bg-gray-500 cursor-not-allowed').addClass('bg-blue-500 hover:bg-blue-600');
    }
}

// Image file selection
$('#imageButton').on('click', function () {
    let imageInput = $('<input type="file" accept="image/*" style="display: none;">');
    imageInput.trigger('click');

    imageInput.on('change', function () {
        let file = this.files[0];
        if (file) {
            $('#imageButton').text(file.name); // Set the file name as button text
            imageFileSelected = true;
            enableSubmitButton();
            setupImageResumable(file);
        }
    });
});

// Audio file selection
$('#audioButton').on('click', function () {
    let audioInput = $('<input type="file" accept="audio/mp3" style="display: none;">');
    audioInput.trigger('click');

    audioInput.on('change', function () {
        let file = this.files[0];
        if (file) {
            $('#audioButton').text(file.name); // Set the file name as button text
            audioFileSelected = true;
            enableSubmitButton();
            setupAudioResumable(file);
        }
    });
});

// Function to initialize Resumable.js for image files
function setupImageResumable(file) {
    imageResumable = new Resumable({
        target: uploadRoutes.uploadUrl,
        query: {_token: uploadRoutes.csrfToken, type: 'image'},
        fileType: ['jpeg', 'png', 'jpg', 'gif'],
        headers: { 'Accept': 'application/json' },
        testChunks: false,
        throttleProgressCallbacks: 1,
    });

    imageResumable.addFile(file);

    imageResumable.on('fileProgress', function (file) {
        let progress = Math.floor(file.progress() * 100);
        updateProgress('.image-progress', progress);
    });

    imageResumable.on('fileSuccess', function (file, response) {
        response = JSON.parse(response);
        $('#imageFilePath').val(response.path); // Set the uploaded image path
        hideProgress('.image-progress');
    });

    imageResumable.on('fileError', function (file, response) {
        console.log('Image file upload error:', response);
        showErrorMessage('Error while uploading the image file.');
        hideProgress('.image-progress');
    });
}

// Function to initialize Resumable.js for audio files
function setupAudioResumable(file) {
    audioResumable = new Resumable({
        target: uploadRoutes.uploadUrl,
        query: {_token: uploadRoutes.csrfToken, type: 'audio'},
        fileType: ['mp3'],
        headers: { 'Accept': 'application/json' },
        testChunks: false,
        throttleProgressCallbacks: 1,
    });

    audioResumable.addFile(file);

    audioResumable.on('fileProgress', function (file) {
        let progress = Math.floor(file.progress() * 100);
        updateProgress('.audio-progress', progress);
    });

    audioResumable.on('fileSuccess', function (file, response) {
        response = JSON.parse(response);
        $('#audioFilePath').val(response.path); // Set the uploaded audio path
        hideProgress('.audio-progress');
    });

    audioResumable.on('fileError', function (file, response) {
        console.log('Audio file upload error:', response);
        showErrorMessage('Error while uploading the audio file.');
        hideProgress('.audio-progress');
    });
}

// Update the progress bar
function updateProgress(selector, value) {
    let progress = $(selector);
    progress.find('.progress-bar').css('width', `${value}%`);
    progress.find('.progress-bar').html(`${value}%`);
    progress.removeClass('hidden');
}

// Hide the progress bar
function hideProgress(selector) {
    $(selector).addClass('hidden');
}

// Submit the form after uploading both files
$('#productForm').on('submit', function (e) {
    e.preventDefault();

    if (imageResumable && audioResumable) {
        // Start uploading image
        imageResumable.upload();

        // Once image is uploaded, start uploading audio
        imageResumable.on('fileSuccess', function () {
            audioResumable.upload();

            // Once audio is uploaded, submit the form
            audioResumable.on('fileSuccess', function () {
                let formData = new FormData($('#productForm')[0]);
                $.ajax({
                    url: $('#productForm').attr('action'),
                    type: $('#productForm').attr('method'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log(response.message);
                        if (response.redirect) {
                            // Redirect to the product page
                            window.location.href = response.redirect;
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log('Form submission error:', xhr.responseText);
                    }
                });
            });
        });
    }
});

// Function to show success message
function showSuccessMessage(message) {
    $('#message').removeClass('text-red-500 hidden').addClass('text-green-500').html(message);
}

// Function to show error message
function showErrorMessage(message) {
    $('#message').removeClass('text-green-500 hidden').addClass('text-red-500').html(message);
}
