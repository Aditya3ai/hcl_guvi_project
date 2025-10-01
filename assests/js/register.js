$(document).ready(function() {
    $("#registerForm").submit(function(e) {
        e.preventDefault();

        let data = $("#registerForm").serialize();

        $.ajax({
            url: "php/register.php", // path from register.html
            type: "POST",
            data: data,
            dataType: "json",
            success: function(response) {
                if(response.status === "success"){
                    $("#msg").html('<div class="alert alert-success">'+response.message+'</div>');
                    $("#registerForm")[0].reset();
                } else {
                    $("#msg").html('<div class="alert alert-danger">'+response.message+'</div>');
                }
            },
            error: function(xhr) {
                console.log("AJAX Error:", xhr.responseText);
                $("#msg").html('<div class="alert alert-danger">AJAX Error! Check console.</div>');
            }
        });
    });
});
