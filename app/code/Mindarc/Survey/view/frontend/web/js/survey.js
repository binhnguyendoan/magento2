require(['jquery'], function ($) {
    $(document).ready(function () {
        $('#submit-survey').on('click', function (event) {
            event.preventDefault();
            var name = $('#name').val();
            var email = $('#email').val();
            var phone_number = $('#phone_number').val();
            var subject = $('#subject').val();
            var message = $('#message').val();
            
            var isValid = true;
            var errorMessage = '';

            if (!name) {
                isValid = false;
                errorMessage += '<p>Name is required.</p>';
            }
            if (!email) {
                isValid = false;
                errorMessage += '<p>Email is required.</p>';
            }
            if (!phone_number) {
                isValid = false;
                errorMessage += '<p>Phone number is required.</p>';
            }
            if (!subject) {
                isValid = false;
                errorMessage += '<p>Subject is required.</p>';
            }
            if (!message) {
                isValid = false;
                errorMessage += '<p>Message is required.</p>';
            }
            if (!isValid) {
                $('#response-message').html(errorMessage);
                return;
            }

            var formData = {
                form_key: window.FORM_KEY,
                name: name,
                email: email,
                phone_number: phone_number,
                subject: subject,
                message: message,
            };
            $.ajax({
                url: 'submit',
                type: 'POST',
                data: formData,
                success: function (response) {
                    $('#response-message').html('<p>Survey submitted successfully!</p>');
                    console.log(response);
                },
                error: function (xhr, status, error) {
                    $('#response-message').html('<p>Error: ' + error + '</p>');
                    console.error('Error:', error);
                },
            });
        });
    });
});
