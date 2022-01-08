$(document).ready(function () {
    $('#infoTable').on('click', 'tbody tr', function(event) {
        $(this).addClass('highlight').siblings().removeClass('highlight');
    });

    $("#filter-form").submit(function (event) {
        $(".help-block").remove();
        var formData = {
            MinPrice: $("#MinPrice").val(),
            MaxPrice: $("#MaxPrice").val(),
        };
        validate(formData);
        $.ajax({
            type: "POST",
            url: "Renting.php",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (data) {
            console.log(data);
            $('#infoTable').bootstrapTable({

                pagination: true,
                striped: true,
                pageSize: 10,
                clickToSelect: true,
                columns: [{
                    field: 'id',
                    title: 'Item ID',
                    sortable : true
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
                // $("#message-group").html('<div class="alert alert-danger">Could not reach server, please try again later.</div>');
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
