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
            model: $('#model-filter').val()
        };

        console.log(formData);
        validate(formData);

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
                        title: 'Item ID',
                        sortable: true
                    }, {
                        field: 'cc',
                        title: 'Course Name'
                    }, {
                        field: 'bb',
                        title: 'QUARTER'
                    }, {
                        field: 'dd',
                        title: 'year'
                    }],
                    data: data
                });
            })
            .fail(function (data) {
            });
        event.preventDefault();

    });

});

//Check if prices are not Numbers
function validate(formData) {
    let valid = true;
    if (isNaN(formData["MaxPrice"]) || isNaN(formData["MinPrice"])) {
        alert("Please Enter a valid Price");
        valid = false;
    }
    return valid
}
