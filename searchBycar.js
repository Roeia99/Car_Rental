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
            MinPrice: $("#MinPrice").val(),
            MaxPrice: $("#MaxPrice").val(),
            year: $('#year-filter').val(),
            color: $('#color-filter').val(),
            country: $('#country-filter').val(),
            model: $('#model-filter').val(),
			louza : $('#CarID').val(),
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
                        field: 'id',
                        title: 'Car_ID'
                        
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
                    }],
                    data: data
                });
            })
            .fail(function (data) {
            });
        event.preventDefault();

    });

});
