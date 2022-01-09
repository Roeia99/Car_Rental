$(document).ready(function () {
    $("form").submit(function (event) {
        $(".form-group").removeClass("has-error");
        $(".help-block").remove();

        var formData = {
            CarID: $("#CarID").val(),
            Status: $("#Status").val(),
        };

        validate(formData);
        console.log(formData["CarID"]);

        $.ajax({
            type: "POST",
            url: "UpdateStatus.php",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (data) {
            console.log(data);
            if (!data.success) { // Error
                alert(data.message);
            } else { // Success
                alert(data.message);
            }
        })
            .fail(function (jqXHR, exception) {
                // Our error logic here
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                alert(msg);
                $('#post').html(msg);
            }

            );
        event.preventDefault();

    });

});


function validate(formData){
    let valid = true;
    if (formData["CarID"] === '' || formData["Status"] === ''){
        alert("Please Enter Car's Full Information");
        valid = false;
    }
    else if (isNaN(formData["CarID"]) ){
        alert("Please Enter a Valid Car ID");
        valid = false;
    }

    else if ((formData["Status"] != "active" && formData["Status"] != "out of service")){
        alert("Please Enter a Valid Status ( active or out of service)");
        valid = false;
    }

    return valid
}