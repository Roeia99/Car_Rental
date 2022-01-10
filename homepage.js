$(document).ready(function () {
    $("form").submit(function (event) {
        $(".form-group").removeClass("has-error");
        $(".help-block").remove();

        var formData = {
            email: $("#email").val(),
            password: $("#password").val(),
        };
        console.log(formData);

        if (!validate(formData))
            return;
        else
            $.ajax({
                type: "POST",
                url: "homepage.php",
                data: formData,
                dataType: "json",
                encode: true,
            })
                .done(function (data) {
                    console.log(data);
                    if (data.admin) {
                        $("form").html('<script></script>' + '<div class="alert alert-success">' + data.message + "</div>");
                        window.location.href = 'AdminFirstPage.html';
                    }
                    if (data.customer) {
                        $("form").html('<script></script>' + '<div class="alert alert-success">' + data.message + "</div>");
                        window.location.href = 'Renting.php';
                    }
                    alert(data.message);

                })
                .fail(function (data) {
                    console.log("FAIL !")
                    // $("#message-group").html('<div class="alert alert-danger">Could not reach server, please try again later.</div>');
                });
        event.preventDefault();

    });

});

function validate(formData) {
    let valid = true;
    if (formData["email"] === '') {
        alert("Please Enter your Email");
        valid = false;
    }
    if (formData["password"] === '') {
        alert("Please Enter your Password");
        valid = false;
    }
    return valid
}
