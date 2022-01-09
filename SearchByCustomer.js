$(document).ready(function () {
    $("form").submit(function (event) {
        $(".form-group").removeClass("has-error");
        $(".help-block").remove();
        var formData = {
            Fname: $("#Fname").val(),
            Lname: $("#Lname").val(),
            email: $("#email").val(),
            phone: $("#phone").val(),
            street: $("#street").val(),
            city: $("#city").val(),
            country: $("#country").val(),
        };

        console.log(formData);

        validate(formData);
        $.ajax({
            type: "POST",
            url: "SearchByCustomer.php",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (data) {
            console.log(data);
            if (!data.success) { // Error
                console.log(data);

            } else { // Success
                //$("form").html('<script></script>'+'<div class="alert alert-success">' + data.message + "</div>");
                //window.location.href = 'Renting.php';
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