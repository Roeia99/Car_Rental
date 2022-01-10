$(document).ready(function () {

    $('#infoTable').on('click', 'tbody tr', function (event) {
        $(this).addClass('highlight').siblings().removeClass('highlight');
        console.log(this);
        $("td", this).each(function (j) {
            console.log(j);
        });
    });

    $("#search").click(function (event) {
        $(".help-block").remove();
        $sdata={
            date :$("#date").val()
        };
        
        $.ajax({
            type: "POST",
            url: 'StatusOnSpecificDay.php',
            data: $sdata,
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
                        title: 'CAR_ID',
                        sortable: true
                    }, {
                        field: 'status',
                        title: 'STATUS'
                    }, {
                        field: 'date',
                        title: 'DATE'
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

