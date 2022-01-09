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
            Fname: $("#Fname").val(),
            Lname: $("#Lname").val(),
            email: $("#email").val(),
            phone: $("#phone").val(),
            street: $("#street").val(),
            city: $("#city").val(),
            country: $("#country").val(),
        };

        console.log(formData);
        $.ajax({
            type: "POST",
            url: 'SearchByCustomer.php',
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
                        title: 'Customer ID',
                        sortable: true
                    }, {
                        field: 'fn',
                        title: 'First Name'
                    }, {
                        field: 'ln',
                        title: 'Last Name'
                    }, {
                        field: 'ci',
                        title: 'Plate ID'
                    }, {
                        field: 'm',
                        title: 'model'
                    }, {
                        field: 'pd',
                        title: 'pay_date'
                    }, {
                        field: 'tp',
                        title: 'Payment'
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

