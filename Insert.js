$(document).ready(function () {
    $("form").submit(function (event) {
        $(".form-group").removeClass("has-error");
        $(".help-block").remove();

        var formData = {
            CarID: $("#CarID").val(),
            Model: $("#Model").val(),
            Year: $("#Year").val(),
            Color: $("#Color").val(),
            Status: $("#Status").val(),
            Office: $("#Office").val(),
            PricePerDay: $("#PricePerDay").val(),
        };

        validate(formData);

        $.ajax({
            type: "POST",
            url: "Insert.php",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (data) {
            console.log(data);
            if (!data.success) { // Error
                console.log(data);
            } else { // Success

                $("form").html('<script></script>'+'<div class="alert alert-success">' + data.message + "</div>");
                window.location.href = '/Car_Rental/Renting.html';
            }
        })
            .fail(function (data) {
                console.log(data);
                // $("#message-group").html('<div class="alert alert-danger">Could not reach server, please try again later.</div>');
            });
        event.preventDefault();

    });

});

function validate(formData){
    let valid = true;
    if (formData["Model"] === '' || formData["Color"] === ''
        || formData["CarID"] === '' || formData["Year"] === ''
        || formData["Office"] === '' || formData["Status"] === ''
        || formData["PricePerDay"] === ''  ){
        alert("Please Enter Car's Full Information");
        valid = false;
    }
    else if (isNaN(formData["CarID"]) ){
        alert("Please Enter a Valid Car ID");
        valid = false;
    }

    else if (isNaN(formData["Year"]) ){
        alert("Please Enter a Valid Year");
        valid = false;
    }

    else if (isNaN(formData["Office"]) ){
        alert("Please Enter a Valid Office ID");
        valid = false;
    }

    else if ((formData["Status"] != "active" && formData["Status"] != "out of service")){
        alert("Please Enter a Valid Status ( active or out of service)");
        valid = false;
    }

    else if (isNaN(formData["PricePerDay"]) ){
        alert("Please Enter a Valid Price per Day");
        valid = false;
    }

    return valid
}