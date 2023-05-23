<!DOCTYPE html>
<html>
<head>
    <title>Trip Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>Trip Form</h1>
        <h2>Welcome!!</h2>

        <?php
        // Check if the user is an admin or a regular user
        $role = 'user'; // Set the default role to user
        if (isset($_GET['role']) && $_GET['role'] === 'admin') {
            $role = 'admin';
        }

        // Connect to the database
        $host = 'localhost';
        $username = 'root'; // Use the default username for XAMPP
        $password = ''; // Use an empty password for XAMPP
        $database = 'country_db';

        $conn = mysqli_connect($host, $username, $password, $database);
        if (!$conn) {
            die('Database connection error: ' . mysqli_connect_error());
        }

        // Fetch country names from the database
        $query = "SELECT iso, nicename FROM country ORDER BY id";
        $result = mysqli_query($conn, $query);
        $countries = mysqli_fetch_all($result, MYSQLI_ASSOC);
        ?>

        <form method="POST" action="success.html">
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter your first name" required>
            </div>

            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your last name" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="">Select your gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="country">Country</label>
                <select class="form-control" id="country" name="country" required>
                    <option value="">Select your country</option>
                    <?php foreach ($countries as $country): ?>
                        <option value="<?php echo $country['iso']; ?>"><?php echo $country['nicename']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="tripDateRange">Trip Date Range</label>
                <div class="input-daterange input-group" id="tripDateRange">
                    <div class="input-group-prepend">
                        <span class="input-group-text">From</span>
                    </div>
                    <input type="text" class="form-control" name="fromDate" placeholder="From Date" required>
                    <div class="input-group-prepend">
                        <span class="input-group-text">To</span>
                    </div>
                    <input type="text" class="form-control" name="toDate" placeholder="To Date" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <script>
            $(document).ready(function() {
                // Initialize datepicker
                $('.input-daterange').datepicker({
                    format: 'dd-mm-yyyy',
                    autoclose: true
                });
            });
        </script>
    </div>
</body>
</html>




    