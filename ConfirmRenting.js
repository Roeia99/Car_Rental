$(document).ready(function () {
    $("form").submit(function (event) {
        $(".help-block").remove();
        var formData = {
            PickupDate: $("#PickupDate").val(),
            ReturnDate: $("#ReturnDate").val(),
        };
        validatedate(formData["PickupDate"]);
        validatedate(formData["ReturnDate"]);
        $.ajax({
            type: "POST",
            url: "ConfirmRenting.php",
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

//Check if the date is valid
function validatedate(dateString){
    let dateformat = /^(0?[1-9]|1[0-2])[\/](0?[1-9]|[1-2][0-9]|3[01])[\/]\d{4}$/;

    // Match the date format through regular expression
    if(dateString.match(dateformat)){
        let operator = dateString.split('/');

        // Extract the string into month, date and year
        let datepart = [];
        if (operator.length>1){
            pdatepart = dateString.split('/');
        }
        let month= parseInt(datepart[0]);
        let day = parseInt(datepart[1]);
        let year = parseInt(datepart[2]);

        // Create list of days of a month
        let ListofDays = [31,28,31,30,31,30,31,31,30,31,30,31];
        if (month==1 || month>2){
            if (day>ListofDays[month-1]){
                ///This check is for Confirming that the date is not out of its range
                return false;
            }
        }else if (month==2){
            let leapYear = false;
            if ( (!(year % 4) && year % 100) || !(year % 400)) {
                leapYear = true;
            }
            if ((leapYear == false) && (day>=29)){
                return false;
            }else
            if ((leapYear==true) && (day>29)){
                alert('Invalid date format!');
                return false;
            }
        }
    }else{
        alert("Invalid date format!");
        return false;
    }
    return true;
}

