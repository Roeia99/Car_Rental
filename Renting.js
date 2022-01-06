$(document).ready(function () {
    $("form").submit(function (event) {
        $(".help-block").remove();
        var formData = {
            email: $("#email").val(),
            password: $("#password").val(),
        };
        validate(formData);
        $.ajax({
            type: "POST",
            url: "homepage.php",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (data) {
            console.log(data);
            if (!data.success) { // Error

                if (data.errors.email) { // If email already exists
                    $("#email-group").addClass("has-error");
                    $("#email-group").append('<div class="help-block">' + data.errors.email + "</div>");
                }

            } else { // Success
                $("form").html('<script></script>'+'<div class="alert alert-success">' + data.message + "</div>");
                window.location.href = '/Registration_and_Login/Welcome_page.php';
            }
        })
            .fail(function (data) {
                // $("#message-group").html('<div class="alert alert-danger">Could not reach server, please try again later.</div>');
            });
        event.preventDefault();

    });

});

function validate(formData){
    let valid = true;
    if (formData["email"] === ''){
        alert("Please Enter your Email");
        valid = false;
    }
    if (formData["password"] === ''){
        alert("Please Enter your Password");
        valid = false;
    }
    return valid
}
