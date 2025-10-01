$(document).ready(function() {
    // Fetch profile data on page load
    $.ajax({
        url: 'php/profile.php',
        type: 'GET',
        dataType: 'json',
        success: function(res) {
            if(res.status === 'success'){
                $('#username').val(res.data.username);
                $('#age').val(res.data.age || '');
                $('#dob').val(res.data.dob || '');
                $('#contact').val(res.data.contact || '');
                $('#displayPic').attr('src', res.data.profilePic || 'uploads/default.png');
            } else {
                alert('You are not logged in.');
                window.location.href = 'login.html';
            }
        },
        error: function(xhr){
            console.log(xhr.responseText);
            alert('Server error!');
        }
    });

    // Update profile
    $('#updateProfile').on('click', function() {
        let formData = $('#profileForm').serialize(); // no file upload for now

        $.ajax({
            url: 'php/profile.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                if(res.status === 'success'){
                    alert('Profile updated!');
                } else {
                    alert(res.message);
                }
            },
            error: function(xhr){
                console.log(xhr.responseText);
                alert('Server error!');
            }
        });
    });

    // Logout
    $('#logoutBtn').on('click', function() {
        $.ajax({
            url: 'php/logout.php',
            type: 'POST',
            success: function() {
                window.location.href = 'login.html';
            }
        });
    });
});
