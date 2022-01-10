$(document).ready(function () {

    $('#infoTable').on('click', 'tbody tr', function (event) {
        $(this).addClass('highlight').siblings().removeClass('highlight');
        console.log(this);
        $("td", this).each(function (j) {
            console.log(j);
        });
    });

    $("#filter-form").submit(function (event) {
        $(".help-block").remove();
		start_date = $('#StartDate').val();
		end_date = $('#EndDate').val();
		d = start_date.split("/")
    var d1 = new Date(d[2], d[1], d[0], 0, 0, 0, 0);
    o = end_date.split("/");
    var d2 = new Date(o[2], o[1], o[0], 0, 0, 0, 0);
    console.log(d2);
	date1 = d1.toISOString().slice(0, 19).replace('T', ' ');
    date2 = d2.toISOString().slice(0, 19).replace('T', ' ');
    console.log(date1);
    console.log(date2);
        const formData = {
            year: $('#year-filter').val(),
            color: $('#color-filter').val(),
            model: $('#model-filter').val(),
            status: $('#status-filter').val(),
            louza : $('#CarID').val(),
			start : date1,
			end : date2,
        };
	
        console.log(formData);
        //validate(formData);

        $.ajax({
            type: "POST",
            url: 'filterBycar.php',
            data: formData,
            dataType: "json",
            encode: true,
        })
            .done(function (data) {
                // console.log(data);
                $('#infoTable').bootstrapTable({
                    toggle: true,
                    pagination: true,
                    striped: true,
                    pageSize: 10,
                    clickToSelect: true,
                    columns: [{
                        field: 'rid',
                        title: 'res_ID'
                        
                    },{
                        field: 'cid',
                        title: 'customer_ID'
                        
                    },{
                        field: 'id',
                        title: 'Car_ID'
                        
                    },{
                        field: 'pick',
                        title: 'pickup_Date'
                        
                    },{
                        field: 'return',
                        title: 'return_Date'
                        
                    },{
                        field: 'm',
                        title: 'model'
                    }, {
                        field: 'y',
                        title: 'year'
                    }, {
                        field: 'c',
                        title: 'color'
                    },{
                        field: 's',
                        title: 'status'
                    },{
                        field: 'o',
                        title: 'office_id'
                    },{
                        field: 'p',
                        title: 'price/day'
                    },{
                        field: 'res',
                        title: 'res_Date'
                    }],
                    data: data
                });
            })
            .fail(function (data) {
            });
        event.preventDefault();

    });

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