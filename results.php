<?php
ob_start();
session_start();
require_once 'db_connect.php'; 

if (!empty($_SESSION['name'])) {
    $name = mysqli_real_escape_string($con, $_SESSION['name']); 
    $display_name = $_SESSION['name']; 
    $exam_date = date('Y-m-d'); 
    $score = 0;
    
    if ($_SESSION['q1'] == 'a') { $score++; }
    if ($_SESSION['q2'] == 'b') { $score++; }
    if ($_SESSION['q3'] == 'b') { $score++; }
    if ($_SESSION['q4'] == 'a') { $score++; }
    if ($_SESSION['q5'] == 'b') { $score++; }
    if ($_SESSION['q6'] == 'b') { $score++; }
    if ($_SESSION['q7'] == 'a') { $score++; }
    if ($_SESSION['q8'] == 'b') { $score++; }
    if ($_SESSION['q9'] == 'a') { $score++; }
    if ($_SESSION['q10'] == 'a') { $score++; }

    $remark = ($score >= 5) ? "Passed" : "Failed";

    $insert = "INSERT INTO exam (exam_date, user, score, remark) VALUES ('$exam_date', '$name', '$score', '$remark')";
    if (!mysqli_query($con, $insert)) {
        error_log("Database insert error: " . mysqli_error($con)); 
    }

    print "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <meta http-equiv='refresh' content='3;url=search.php?search=" . urlencode($display_name) . "'>
        <title>Quiz Result</title>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>
    </head>
    <body class='bg-black bg-gradient'>
        <div class='container text-center mt-5 text-white'>
            <h2 class='mb-4 text-white'>Quiz Result</h2>
            <p class='fw-bold text-white'>User: " . $display_name . "</p>
            <p class='fs-4 text-white'>Your score: <span class='badge bg-primary'>" . $score . "</span> out of 10.</p>";

    if ($score >= 5) { 
        print "<p class='text-success fw-bold'>Passed!</p>";
    } else {
        print "<p class='text-danger fw-bold'>Failed.</p>";
    }

    print "
            <p class='mt-3 text-white'>Redirecting to search results in 3 seconds...</p>
            <a href='index.php' class='btn btn-primary mt-3'>Return to Start</a>
        </div>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'></script>
    </body>
    </html>";

    ob_end_flush();
    session_destroy();
} else {
    print "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Unauthorized Access</title>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>
    </head>
    <body class='bg-warning text-center'>
        <div class='container mt-5'>
            <h2 class='text-danger'>You went too far!</h2>
            <p class='fs-5 text-dark'>Return to Start.</p>
            <a href='index.php' class='btn btn-dark'>Click Here!</a>
        </div>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'></script>
    </body>
    </html>";
}
?>