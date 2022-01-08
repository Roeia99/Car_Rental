$(document).ready(function () {
    $("form").submit(function (event) {
        $(".form-group").removeClass("has-error");
        $(".help-block").remove();
        var formData = {
            Fname: $("#Fname").val(),
            Lname: $("#Lname").val(),
            email: $("#email").val(),
            password: $("#password").val(),
            password2: $("#password2").val(),
            phone: $("#phone").val(),
            street: $("#street").val(),
            city: $("#city").val(),
            country: $("#country").val(),
        };
        validate(formData);
        $.ajax({
                type: "POST",
                url: "SignUp.php",
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
                    window.location.href = '/Car_Rental/Renting.html';
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
    if (formData["Fname"] === '' || formData["Lname"] === '' ){
        alert("Please Enter your Full Name");
        valid = false;
    }
    if (formData["email"] === ''){
        alert("Please Enter your Email");
        valid = false;
    }
    if (formData["password"] === ''){
        alert("Please Enter your Password");
        valid = false;
    }
    if (formData["password2"] === '' || formData["password2"].localeCompare(formData["password"]) ){
        alert("Please Confirm your Password");
        valid = false;
    }
    if (formData["phone"] === '' || isNaN(formData["phone"])){
        alert("Please Enter your Correct Phone Number");
        valid = false;
    }
    if (formData["street"] === '' || formData["city"] === '' || formData["country"] === '' ){
        alert("Please Enter your Full Address");
        valid = false;
    }
    return valid
}
