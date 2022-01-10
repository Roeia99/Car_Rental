<!DOCTYPE html>
<html lang="en">

<head>
    <title>searchBycar</title>

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
    <script src="searchBycar.js"></script>

</head>

<body>
<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card" style="width: 90rem;height: 40rem;">
			 <!-- Header -->
            <div class="card-header">
                <h3>Admin</h3>
            </div>
            <div class="card-body">
                <form id="filter-form" action="filterBycar.php" method="POST">
                    <div id="Dropdown-group" class="form-group">
                        <div class="row">
                            <!--Search Col-->
                            <div class="col-sm-3">
                                <div class="card-header">
                                    <h4>Search by Car Specs</h4>
                                </div>
					            <!-- Model Dropdown Box -->
                                <div class="form-group" >
                                    <select class="custom-select mr-sm-2"
                                            id="model-filter"
                                            style="width: 18rem;">
                                        <option value = "" selected>(Model)</option>
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
                                        <option value = "" selected>(Year)</option>
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
                                        <option value = "" selected>(Color)</option>
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
                                        <option value = "" selected>(Country)</option>
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
								 <!-- status Dropdown Box -->
                                <div class="form-group">
                                    <select class="custom-select mr-sm-2"
                                            id="status-filter"
                                            style="width: 18rem;">
                                        <option value= ""selected>(status)</option>
										<option>active</option> 
										<option>out of service</option> 
                                    </select>
									</div>
                                <div class="card-header">
                                    <h4>Duration</h4>
                                </div>
									<div class="input-group form-group" style="width: 18rem;">
                                    <input
                                            id="StartDate"
                                            type="text"
                                            class="form-control input-sm"
                                            placeholder="YYYY-MM-DD(From)">
                                </div>
								<div class="input-group form-group" style="width: 18rem;">
                                    <input
                                            id="EndDate"
                                            type="text"
                                            class="form-control input-sm"
                                            placeholder="YYYY-MM-DD(To)">
                                </div>
						
								
								<!--Search Col-->
                            
                                <div class="card-header">
                                    <h4>Search for a specific car: </h4>
              
								</div>
								<div class="input-group form-group" style="width: 18rem;">
                                    <input
                                            id="CarID"
                                            type="text"
                                            class="form-control input-sm"
                                            placeholder="Plate ID">
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
                                                    <th class="col-xs-3">Res ID</th>
													<th class="col-xs-3">Customer ID</th>
													<th class="col-xs-3">pickDate</th>
													<th class="col-xs-3">ReturnDate</th>
													<th class="col-xs-3">Car ID</th>
                                                    <th class="col-xs-3">Model</th>
                                                    <th class="col-xs-6">Year</th>
                                                    <th class="col-xs-6">Color</th>
													<th class="col-xs-6">Status</th>
													<th class="col-xs-6">office-ID</th>
													<th class="col-xs-6">Price/Day</th>
													
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                                    <div class="d-flex  justify-content-left links">
                                        <a href="homepage.html">Sign Out</a>
                                    </div>
                    </div>
                </form>
            </div>
