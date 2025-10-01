$(document).ready(function() {
    $('#loginBtn').on('click', function() {
        let email = $('#email').val().trim();
        let password = $('#password').val().trim();

        if(email === "" || password === "") {
            $('#msg').html('<div class="alert alert-danger">All fields are required!</div>');
            return;
        }

        $.ajax({
            url: 'php/login.php',
            type: 'POST',
            data: {email: email, password: password},
            dataType: 'json',
            success: function(res) {
                if(res.status === 'success') {
                    // Session is now handled by PHP, no need for localStorage
                    window.location.href = 'profile.html';
                } else {
                    $('#msg').html('<div class="alert alert-danger">'+res.message+'</div>');
                }
            },
            error: function(xhr) {
                console.log('AJAX Error:', xhr.responseText);
                $('#msg').html('<div class="alert alert-danger">Server Error!</div>');
            }
        });
    });
});
