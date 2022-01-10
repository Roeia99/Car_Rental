$(document).ready(function () {

    price = $("#price_day").text();
    var PickupDate =$("#pickupDate").text();
    var ReturnDate =$("#returnDate").text();
    // console.log(document.getElementById("price_day").text());
    //
    d = PickupDate.split("/")
    var d1 = new Date(d[2], d[1], d[0], 11, 0, 0, 0);
    o = ReturnDate.split("/");
    var d2 = new Date(o[2], o[1], o[0],11, 0, 0, 0);
    console.log(d2);
    var diff = d2.getTime() - d1.getTime();
    var daydiff = diff / (1000 * 60 * 60 * 24);
    document.getElementById("Pay_Date").innerHTML = PickupDate;
    totalPrice = daydiff * price;
    document.getElementById("Total_Price").innerHTML = totalPrice;
    
    date1 = d1.toISOString().slice(0, 19).replace('T', ' ');
    date2 = d2.toISOString().slice(0, 19).replace('T', ' ');
    console.log(date1);
    console.log(date2);

    var res_data = {
        customer_id : "1",
        car_id :$("#carId").text(),
        PickupDate:date1,
        ReturnDate:date2
    };
    console.log(res_data);

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
    $('#confirm').click(function () {
        $.ajax({
            type: "POST",
            url: "ConfirmRentingSQL.php",
            data: res_data,
            dataType: "json",
            encode: true,
        }).done(function (data) {
            // console.log(data);
            if (!data.success) { // Error
                console.log(data);
                alert("CAR already reserved");

                // console.log(data);

            } else { // Success
                alert("CAR RESERVED SUCCSESFULLY");
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
           })
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