<!DOCTYPE html>
<html lang="en">

<head>
    <title>Renting Page</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
    <!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
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
    <script src="Renting.js"></script>

</head>

<body>
<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card" style="width: 60rem;height: 42rem;">
            <!-- Header -->
            <div class="card-header">
                <h3>Rent your car</h3>
            </div>
            <div class="card-body">
                <form id="filter-form" action="filter.php" method="POST">
                    <div id="Dropdown-group" class="form-group">
                        <div class="row">
                            <!--Filters Col-->
                            <div class="col-sm-4">
                                <div class="card-header">
                                    <h3>Filter by</h3>
                                </div>
                                <!-- Model Dropdown Box -->
                                <div class="form-group">
                                    <select class="custom-select mr-sm-2"
                                            id="model-filter"
                                            style="width: 18rem;">
                                        <option selected value="">(Model)</option>
                                        <?php
                                        $connection = mysqli_connect('localhost', 'root', '', 'car_rental_system');
                                        $sql = "SELECT distinct c.model model FROM `car` c ";
                                        $query = mysqli_query($connection, $sql);
                                        while ($row = mysqli_fetch_assoc($query)) {
                                            echo "<option> $row[model] </option>";
                                        }
                                        mysqli_close($connection);
                                        ?>
                                    </select>
                                </div>
                                <!-- Year Dropdown Box -->
                                <div class="form-group">
                                    <select class="custom-select mr-sm-2"
                                            id="year-filter"
                                            style="width: 18rem;">
                                        <option selected value="">(Year)</option>
                                        <?php
                                        $connection = mysqli_connect('localhost', 'root', '', 'car_rental_system');
                                        $sql = "SELECT distinct c.year `year` FROM `car` c ";
                                        $query = mysqli_query($connection, $sql);
                                        while ($row = mysqli_fetch_assoc($query)) {
                                            echo "<option> $row[year] </option>";
                                        }
                                        mysqli_close($connection);
                                        ?>
                                    </select>
                                </div>
                                <!-- Color Dropdown Box -->
                                <div class="form-group">
                                    <select class="custom-select mr-sm-2"
                                            id="color-filter"
                                            style="width: 18rem;">
                                        <option selected value="">(Color)</option>
                                        <?php
                                        $connection = mysqli_connect('localhost', 'root', '', 'car_rental_system');
                                        $sql = "SELECT distinct c.color `color` FROM `car` c ";
                                        $query = mysqli_query($connection, $sql);
                                        while ($row = mysqli_fetch_assoc($query)) {
                                            echo "<option> $row[color] </option>";
                                        }
                                        mysqli_close($connection);
                                        ?>
                                    </select>
                                </div>
                                <!-- Country Dropdown Box -->
                                <div class="form-group">
                                    <select class="custom-select mr-sm-2"
                                            id="country-filter"
                                            style="width: 18rem;">
                                        <option selected value="">(Country)</option>
                                        <?php
                                        $connection = mysqli_connect('localhost', 'root', '', 'car_rental_system');
                                        $sql = "SELECT distinct o.country `country` FROM `car` c NATURAL JOIN office o";
                                        $query = mysqli_query($connection, $sql);
                                        while ($row = mysqli_fetch_assoc($query)) {
                                            echo "<option> $row[country] </option>";
                                        }
                                        mysqli_close($connection);
                                        ?>
                                    </select>
                                </div>
                                <!-- Price Range-->
                                <div class="mt-2 row">
                                    <!-- Min Price-->
                                    <div class="col">
                                        <div class="input-group form-group">
                                            <input id="MinPrice" type="text" class="form-control input-sm"
                                                   placeholder="Min Price">
                                        </div>
                                    </div>
                                    <!--Max Price-->
                                    <div class="col">
                                        <div class="input-group form-group">
                                            <input id="MaxPrice" type="text" class="form-control"
                                                   placeholder="Max Price">
                                        </div>
                                    </div>
                                </div>
                                <!-- Reservation Period-->
                                <div class="row">
                                    <div class="mt-2 remember">
                                        <label for="ReservationDate" style="font-size: 17px">
                                            Reservation Date:</label>
                                    </div>
                                    <!-- Start Date-->
                                    <div class="col">
                                        <div class="input-group form-group" style="width: 8rem;">
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
                                            <input id="EndDate"
                                                   type="text"
                                                   class="form-control"
                                                   placeholder="End date">
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group form-group">
                                    <input id="plate-id" type="text" class="form-control input-sm"
                                           placeholder="Plate ID">
                                </div>
                                <div class="mt-2 form-group">
                                    <input type="submit" value="Filter" class="btn float-right login_btn">
                                </div>
                            </div>
                            <!-- Results Col -->
                            <div class="col">
                                <div class="card text-white bg-primary mb-3"
                                     style="width: 37rem;height: 30rem;overflow: auto;">
                                    <div class="card-body text-white">
                                        <div class="container-fluid">
                                            <table
                                                    data-click-to-select="true"
                                                    data-search="true"
                                                    id="infoTable"
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
                            </div>
                        </div>
                    </div>
                </form>
                <form id="continue-form" action="startReservationSession.php" method="POST">
                    <div class="mt-2 form-group">
                        <input
                                type="submit"
                                id="continue-btn"
                                value="Continue"
                                class="btn pull-right login_btn">
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