$(document).ready(function () {
    var formData = {
        PickupDate: $("#PickupDate").val(),
        ReturnDate: $("#ReturnDate").val(),
        price: $("#price_day").text(),
    };
    console.log(document.getElementById("price_day"));
    date1 = "22/4/2022";
    d = date1.split("/")
    var d1 = new Date(d[2], d[1], d[0], 0, 0, 0, 0);
    // console.log(d1);
    date2 = "25/5/2022";
    o = date2.split("/");
    var d2 = new Date(o[2], o[1], o[0], 0, 0, 0, 0);
    // console.log(d2);
    var diff = d2.getTime() - d1.getTime();
    var daydiff = diff / (1000 * 60 * 60 * 24);
    // console.log(daydiff);
    document.getElementById("Pay_Date").innerHTML = date1;
    // console.log(formData['price']);
    totalPrice = daydiff * formData['price'];
    document.getElementById("Total_Price").innerHTML = totalPrice;

    $('#done').click(function () {
        formData = {
            PickupDate: $("#PickupDate").val(),
            ReturnDate: $("#ReturnDate").val(),
        };
        validatedate(formData["PickupDate"]);
        validatedate(formData["ReturnDate"]);
        var x = document.getElementById("Pay_Date");
        x.innerHTML = formData["PickupDate"];
        // console.log(x);


    });
    $('#confirm').click(function(){
        $.ajax({
            type: "POST",
            url: "ConfirmRentingSQL.php",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (data) {
            // console.log(data);
            if (!data.success) { // Error
                // console.log(data);

            } else { // Success
                $("form").html('<script></script>'+'<div class="alert alert-success">' + data.message + "</div>");
                window.location.href = 'Renting.php';
            }
        })
            .fail(function (data) {
                // $("#message-group").html('<div class="alert alert-danger">Could not reach server, please try again later.</div>');
            });
        alert("done");
    })
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