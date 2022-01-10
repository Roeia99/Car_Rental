$(document).ready(function () {
    $('#infoTable').on('click', 'tbody tr ', function (event) {
        $(this).addClass('highlight').siblings().removeClass('highlight');
        console.log(this);
    });

    $("#filter-form").submit(function (event) {

        const formData = {
            MinPrice: $("#MinPrice").val(),
            MaxPrice: $("#MaxPrice").val(),
            year: $('#year-filter').val(),
            color: $('#color-filter').val(),
            country: $('#country-filter').val(),
            model: $('#model-filter').val(),
            StartDate: $('#StartDate').val(),
            EndDate: $('#EndDate').val()
        };

        console.log(formData);
        if (validate(formData))
            $.ajax({
                type: "POST",
                url: 'filter.php',
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
                            field: 'id',
                            title: 'Plate NO.',
                            sortable: true
                        }, {
                            field: 'model',
                            title: 'Model',
                            sortable: true

                        }, {
                            field: 'year',
                            title: 'Year',
                            sortable: true

                        }, {
                            field: 'color',
                            title: 'Color',
                            sortable: true

                        }, {
                            field: 'ppd',
                            title: 'Price/Day',
                            sortable: true
                        }],
                        data: data
                    });
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

        event.preventDefault();
    });


    $("#continue-form").submit(function (event) {
        var reservationData = {
            carID: $('#plate-id').val(),
            pickDate: $('#StartDate').val(),
            endDate: $('#EndDate').val(),
        };

        if (validate(formData))
            $.ajax({
                type: "POST",
                url: 'startReservationSession.php',
                data: reservationData,
                dataType: "json",
                encode: true,
            })
                .done(function (data) {
                    window.location.href = 'ConfirmRenting.php';
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
                });

        event.preventDefault();
    })
});


//Check if prices are not Numbers
function validate(formData) {
    let valid = true;

    if (formData['EndDate'] === '' || formData['StartDate'] === '') {
        alert('Please Insert Dates');
        valid = false;
    }
    if ((isNaN(formData["MaxPrice"]) || isNaN(formData["MinPrice"])) || ((formData["MaxPrice"]) < formData["MinPrice"])) {
        alert("Please Enter a valid Price ranges");
        valid = false;
    }
    return valid
}
