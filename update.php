<?php
include("db_connect.php");

if (!empty($_GET['update'])) {
    $u = $_GET['user'];
    $e = $_GET['exam_date'];
    $s = $_GET['score'];
    if($s<5){
        $r="Failed";
    }
    else
    $r="Passed";
    

    $update = "UPDATE exam SET exam_date='$e', score='$s', remark='$r' WHERE user='$u'";
    mysqli_query($con, $update);

    print "<script>alert('Record Updated');</script>";
    header("Location: search.php");
    exit();
}

$e = $_GET['exam_date'];
$u = $_GET['user'];
$s = $_GET['score'];
$r = $_GET['remark'];

print '
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container mt-5">
    <div class="card shadow mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Update Exam Record</h2>
            <form action="update.php" method="get">
                <div class="mb-3">
                    <label class="form-label">Exam Date</label>
                    <input name="exam_date" value="' . $e . '" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">User</label>
                    <input name="user" value="' . $u . '" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Score</label>
                    <input name="score" value="' . $s . '" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Remark</label>
                    <input name="remark" value="' . $r . '" class="form-control">
                </div>
                <div class="d-grid">
                    <input type="submit" value="Update Now" name="update" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
';
?>
