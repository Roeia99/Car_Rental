$(document).ready(function () {
    $("form").submit(function (event) {
        $(".help-block").remove();
        var formData = {
            CarID : $("#CarID").val(),
			model : $("#model-filter").val(),
			year  : $ ("#year-filter").val(),
			color : $("#color-filter").val(),
			country : $("#country-filter").val(),
			 
        };
        // if Car ID is not Empty check if it is not a number
        if (isNaN(formData["CarID"])) {
            alert("Please enter a Valid Plate ID");
        }
        // if start date is not Empty
        if (formData["StartDate"] != "") {
            validatedate(formData["StartDate"]);
        }
        // if End date is not Empty
        if (formData["EndDate"] != "") {
            validatedate(formData["EndDate"]);
        }
        // if State date is not Empty
        if (formData["StateDate"]) {
            validatedate(formData["StateDate"]);
        }

        $.ajax({
            type: "POST",
            url: "filterBycar.php",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (data) {
                 console.log(data);
                $('#infoTable').bootstrapTable({
                    toggle: true,
                    pagination: true,
                    striped: true,
                    pageSize: 10,
                    clickToSelect: true,
                    columns: [{
                        field: 'id',
                        title: 'CarID',
                        sortable: true
                    }, {
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
                        field: 'i',
                        title: 'is_reserved'
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