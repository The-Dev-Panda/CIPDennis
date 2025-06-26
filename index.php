<?php
ob_start();
session_start();
require_once 'db_connect.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Enrollment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-black bg-gradient">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8 col-md-6 col-lg-4">
                <div class="card p-4 shadow rounded">
                    <h2 class="text-center mb-4">Student Enrollment</h2>
                    <form action="index.php" method="post">
                        <div class="mb-3">
                            <label for="studentName" class="form-label">Enter Student Name:</label>
                            <input type="text" class="form-control" id="studentName" name="name" required>
                        </div>
                        <div class="d-grid">
                            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                    <?php
                        if (!empty($_POST['submit'])) {
                            $name = mysqli_real_escape_string($con, $_POST['name']);
                            $_SESSION['name'] = $name;
                            $check = "SELECT * FROM exam WHERE user='$name'";
                            $result = mysqli_query($con, $check);
                            if (mysqli_num_rows($result) == 0) {
                                header("Location: q1.php");
                            } else {
                                echo "<p class='text-danger text-center mt-3'>Username is taken. Please choose another.</p>";
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>