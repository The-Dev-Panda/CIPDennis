<?php
if (!empty($_POST['student'])) {
    $selected_users = $_POST['student'];
    
    if (empty($_POST['confirm'])) {
        print '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">';
        print '
        <div class="container mt-5">
            <div class="card shadow mx-auto" style="max-width: 500px;">
                <div class="card-body text-center">
                    <h4 class="mb-3">Are you sure you want to delete ' . count($selected_users) . ' selected users?</h4>
                    <form action="delete.php" method="post">
                        <input type="hidden" name="confirm" value="yes">';
        
        foreach ($selected_users as $user) {
            print '<input type="hidden" name="student[]" value="' . htmlspecialchars($user) . '">';
        }
        
        print '        <button type="submit" class="btn btn-danger me-2">Yes, Delete</button>
                        <a href="search.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>';
        exit();
    }

    include("db_connect.php");
    foreach ($selected_users as $user) {
        $user = mysqli_real_escape_string($con, $user);
        $del = "DELETE FROM exam WHERE user='$user'";
        mysqli_query($con, $del);
    }
    header("Location: search.php");
    exit();
}

$rec = $_GET['user'];

if (empty($_GET['confirm'])) {
    print '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">';
    print '
    <div class="container mt-5">
        <div class="card shadow mx-auto" style="max-width: 500px;">
            <div class="card-body text-center">
                <h4 class="mb-3">Are you sure you want to delete this user: <strong>' . $rec . '</strong>?</h4>
                <a href="delete.php?user=' . $rec . '&confirm=yes" class="btn btn-danger me-2">Yes, Delete</a>
                <a href="search.php" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </div>';
    exit();
}

include("db_connect.php");
$del = "DELETE FROM exam WHERE user='$rec'";
mysqli_query($con, $del);
header("Location: search.php");
exit();
?>