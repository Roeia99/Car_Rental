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
            year: $('#year-filter').val(),
            color: $('#color-filter').val(),
            model: $('#model-filter').val(),
            status: $('#status-filter').val(),
            louza : $('#CarID').val(),
			start : $('#StartDate').val(),
			end : $('#EndDate').val(),
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

 