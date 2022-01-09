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
        var formData = {
            MinPrice: $("#MinPrice").val(),
            MaxPrice: $("#MaxPrice").val(),
        };

        const selected_year = $('#year-filter').val();
        if (selected_year !== '') {
            formData['year'] = selected_year;
        }

        const selected_color = $('#color-filter').val();
        if (selected_color !== '') {
            formData['color'] = selected_color;
        }

        const selected_country = $('#country-filter').val();
        if (selected_country !== '') {
            formData[''] = selected_country;
        }
        // Get Model
        const selected_model = $('#model-filter').val();
        if (selected_model !== '') {
            formData['model'] = selected_model;
        }

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
