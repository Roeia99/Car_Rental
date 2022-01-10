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
            office: $('#office-filter').val(),
            price: $('#price-filter').val(),
            status: $('#status-filter').val(),
            louza : $('#CarID').val(),
        };

        console.log(formData);
        //validate(formData);

        $.ajax({
            type: "POST",
            url: 'Advanced_Filter_Car.php',
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
                        title: 'Car_ID'

                    },{
                        field: 'm',
                        title: 'Model'
                    }, {
                        field: 'y',
                        title: 'Year'
                    }, {
                        field: 'c',
                        title: 'Color'
                    },{
                        field: 's',
                        title: 'Status'
                    },{
                        field: 'o',
                        title: 'Office ID'
                    },{
                        field: 'p',
                        title: 'price/day'
                    }],
                    data: data
                });
            })
            .fail(function (data) {
            });
        event.preventDefault();

    });

});
