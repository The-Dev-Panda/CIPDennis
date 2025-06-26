<?php
require_once 'db_connect.php';

$exam_date = $_GET['exam_date'];
$user = $_GET['user'];
$score = $_GET['score'];
$remark = $_GET['remark'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Exam Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
    <div class="container mt-5">
        <div class="card shadow mx-auto" style="max-width: 600px;">
            <div class="card-header bg-dark text-white text-center">
                <h4>Exam Record Details</h4>
            </div>
            <div class="card-body">
                <p><strong>Exam Date:</strong> <?php print $exam_date; ?></p>
                <p><strong>User:</strong> <?php print $user; ?></p>
                <p><strong>Score:</strong> <?php print $score; ?></p>
                <p><strong>Remark:</strong> <?php print $remark; ?></p>
            </div>
            <div class="card-footer text-center">
                <a href="search.php" class="btn btn-secondary">Back to Records</a>
            </div>
        </div>
    </div>
</body>
</html>
