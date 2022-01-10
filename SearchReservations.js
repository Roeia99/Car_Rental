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
        const formData = {
            Sdate: $("#Sdate").val(),
            Edate: $("#Edate").val(),
        };

        console.log(formData);

        $.ajax({
            type: "POST",
            url: 'SearchReservations.php',
            data: formData,
            dataType: "json",
            encode: true,
        })
            .done(function (data) {
                console.log(data);
                $('#infoTable').bootstrapTable({
                    toggle: true,
                    pagination: true,
                    striped: true,
                    pageSize: 10,
                    clickToSelect: true,
                    columns: [{
                        field: 'id',
                        title: 'Reservation ID',
                        sortable: true
                    }, {
                        field: 'cid',
                        title: 'Customer ID'
                    }, {
                        field: 'fn',
                        title: 'First Name'
                    }, {
                        field: 'ln',
                        title: 'Last Name'
                    }, {
                        field: 'e',
                        title: 'Email'
                    }, {
                        field: 'phn',
                        title: 'Phone No'
                    }, {
                        field: 'st',
                        title: 'Street_name'
                    }, {
                        field: 'ct',
                        title: 'City'
                    }, {
                        field: 'ctr',
                        title: 'country'
                    }, {
                        field: 'carid',
                        title: 'car_id'
                    }, {
                        field: 'm',
                        title: 'Model'
                    }, {
                        field: 'y',
                        title: 'Year'
                    }, {
                        field: 'c',
                        title: 'Color'
                    }, {
                        field: 's',
                        title: 'Status'
                    }, {
                        field: 'o',
                        title: 'Office ID'
                    }, {
                        field: 'p',
                        title: 'price/day'
                    }
                    ],
                    data: data
                });
            })
            .fail(function (jqXHR, exception) {
                console.log("Fail");
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
            });
        event.preventDefault();

    });

});

