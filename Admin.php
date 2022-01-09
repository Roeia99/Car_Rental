<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Page</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
            integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT"
            crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.19.1/dist/themes/bootstrap-table/bootstrap-table.min.js"></script>

    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="Admin.js"></script>

</head>

<body>
<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card" style="width: 80rem;height: 43rem;">
            <!-- Header -->
            <div class="card-header">
                <h3>Admin</h3>
            </div>
            <div class="card-body">
                <form id="filter-form" action="AdminSearch.php" method="POST">
                    <div id="Dropdown-group" class="form-group">
                        <div class="row">
                            <!--Search Col-->
                            <div class="col-sm-3">
                                <div class="card-header">
                                    <h4>Search by </h4>
                                </div>
                                <div class="mt-2 remember">
                                    <label for="CarInformation" style="font-size: 17px">
                                        Car Information:</label>
                                </div>
<!--                                Car id-->
                                <div class="input-group form-group" style="width: 18rem;">
                                    <input
                                            id="CarID"
                                            type="text"
                                            class="form-control input-sm"
                                            placeholder="Plate ID">
                                </div>
                                <!-- Model Dropdown Box -->
                                <div class="form-group" >
                                    <select class="custom-select mr-sm-2"
                                            id="model-filter"
                                            style="width: 18rem;">
                                        <option selected>(Model)</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <!-- Year Dropdown Box -->
                                <div class="form-group">
                                    <select class="custom-select mr-sm-2"
                                            id="year-filter"
                                            style="width: 18rem;">
                                        <option selected>(Year)</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <!-- Color Dropdown Box -->
                                <div class="form-group">
                                    <select class="custom-select mr-sm-2"
                                            id="color-filter"
                                            style="width: 18rem;">
                                        <option selected>(Color)</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <!-- Country Dropdown Box -->
                                <div class="form-group">
                                    <select class="custom-select mr-sm-2"
                                            id="country-filter"
                                            style="width: 18rem;">
                                        <option selected>(Country)</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <!-- Reservation Period-->
                                <div class="row">
                                    <div class="mt-2 remember">
                                        <label for="ReservationDate" style="font-size: 17px">
                                            Reservation Date:</label>
                                    </div>
                                    <!-- Start Date-->
                                    <div class="col">
                                        <div class="input-group form-group" style="width: 8rem;" >
                                            <input
                                                    id="StartDate"
                                                    type="text"
                                                    class="form-control input-sm"
                                                    placeholder="Start date">
                                        </div>
                                    </div>
                                    <!--End Date-->
                                    <div class="col">
                                        <div class="input-group form-group" style="width: 8rem;">
                                            <input id="EndDate" type="text" class="form-control"
                                                   placeholder="End date">
                                        </div>
                                    </div>
                                    <!--Customer-->
                                    <div class="mt-2 remember">
                                        <label for="CustomerInformation" style="font-size: 17px">
                                            Customer :</label>
                                    </div>
                                    <!--First Name-->
                                    <div class="input-group form-group" style="width: 310px;">
                                        <input
                                                id="Fname"
                                                type="text"
                                                class="form-control input-sm"
                                                placeholder="First name">
                                    </div>
                                    <!--Last Name-->
                                    <div class="input-group form-group" style="width: 310px;">
                                        <input
                                                id="Lname"
                                                type="text"
                                                class="form-control input-sm"
                                                placeholder="Last name">
                                    </div>
                                    <!--Email-->
                                    <div class="input-group form-group" style="width: 310px;">
                                        <input
                                                id="email"
                                                type="text"
                                                class="form-control"
                                                placeholder="email@example.com">
                                    </div>
                                    <!--State of Car on specific Date-->
                                    <div class="mt-2 remember">
                                        <label for="StateDate" style="font-size: 17px">
                                            Car State on a specific Date :</label>
                                    </div>
                                    <!--Date-->
                                    <div class="input-group form-group" style="width: 310px;">
                                        <input
                                                id="StateDate"
                                                type="text"
                                                class="form-control input-sm"
                                                placeholder="Date">
                                    </div>

                                </div>
                                <div class="mt-2 form-group">
                                    <input type="submit" value="Search" class="btn float-right login_btn">
                                </div>
                            </div>
                            <!-- Results Col -->
                            <div class="col">
                                <div class="card text-white bg-primary mb-4"
                                     style="width: 55rem;height: 30rem;overflow: auto;">
                                    <div class="card-body text-white">
                                        <div class="container-fluid">
                                            <table id="infoTable"
                                                   class="text-white table table-fixed table-condensed">
                                                <thead>
                                                <tr>
                                                    <th class="col-xs-3">car ID</th>
                                                    <th class="col-xs-3">Model</th>
                                                    <th class="col-xs-6">Year</th>
                                                    <th class="col-xs-6">Color</th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 form-group">
                                    <input type="submit" value="Show more Information" style="width: 250px" class="btn float-right login_btn">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-left links">
                    <a href="homepage.html">Sign Out</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>