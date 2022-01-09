$(document).ready(function () {
    var formData = {
        PickupDate: $("#PickupDate").val(),
        ReturnDate: $("#ReturnDate").val(),
    };
    var y = document.getElementById("model");
        y.innerHTML = "7mada ana hena";
    $.ajax({
        type: "GET",
        url: "ConfirmRenting.php",
        dataType: "json",
        encode: true,
    }).done(function (data) {
        console.log("7madaaaaaaaa");
        console.log(data);
    }) .fail(function(data) {
        alert( data );
      });


    $('#done').click(function () {
        formData = {
            PickupDate: $("#PickupDate").val(),
            ReturnDate: $("#ReturnDate").val(),
        };
        validatedate(formData["PickupDate"]);
        validatedate(formData["ReturnDate"]);
        var x = document.getElementById("Pay_Date");
        x.innerHTML = formData["PickupDate"];
        console.log(x);
        

    });
    //     $("form").submit(function (event) { 
});

//Check if the date is valid
function validatedate(dateString) {
    let dateformat = /^(0?[1-9]|1[0-2])[\/](0?[1-9]|[1-2][0-9]|3[01])[\/]\d{4}$/;

    // Match the date format through regular expression
    if (dateString.match(dateformat)) {
        let operator = dateString.split('/');

        // Extract the string into month, date and year
        let datepart = [];
        if (operator.length > 1) {
            pdatepart = dateString.split('/');
        }
        let month = parseInt(datepart[0]);
        let day = parseInt(datepart[1]);
        let year = parseInt(datepart[2]);

        // Create list of days of a month
        let ListofDays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        if (month == 1 || month > 2) {
            if (day > ListofDays[month - 1]) {
                ///This check is for Confirming that the date is not out of its range
                return false;
            }
        } else if (month == 2) {
            let leapYear = false;
            if ((!(year % 4) && year % 100) || !(year % 400)) {
                leapYear = true;
            }
            if ((leapYear == false) && (day >= 29)) {
                return false;
            } else
                if ((leapYear == true) && (day > 29)) {
                    alert('Invalid date format!');
                    return false;
                }
        }
    } else {
        alert("Invalid date format!");
        return false;
    }
    return true;
}