<?php
require_once 'db_connect.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-black bg-gradient">
    <div class="container mt-5">
        <h2 class="text-center mb-4 text-white">List of Records</h2>
        <p class="text-center text-white">Today is <?php print date('F d, Y'); ?></p>
        
        <div class="text-center mb-4">
            <a href="search.php?checkall=yes" class="btn btn-secondary">Check All</a>
            <a href="search.php" class="btn btn-danger">Clear All</a>
            
            <div class="dropdown d-inline-block ms-2">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Sort By
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="search.php?sort=passed">Passed</a></li>
                    <li><a class="dropdown-item" href="search.php?sort=failed">Failed</a></li>
                    <li><a class="dropdown-item" href="search.php?sort=score">Score</a></li>
                </ul>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="search.php" method="get" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search by username">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
        </div>
        
        <form action="delete.php" method="post">
        <div class="table-responsive">
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Exam Date</th>
                        <th>User</th>
                        <th>Score</th>
                        <th>Remark</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php
                    $query = "SELECT * FROM exam";
                    if (!empty($_GET['search'])) {
                        $search = mysqli_real_escape_string($con, $_GET['search']);
                        $query .= " WHERE user LIKE '%$search%'";
                    }
                    
                    if (!empty($_GET['sort'])) {
                        if ($_GET['sort'] == 'passed') {
                            $query .= " ORDER BY remark = 'Passed' DESC";
                        }
                        if ($_GET['sort'] == 'failed') {
                            $query .= " ORDER BY remark = 'Failed' DESC";
                        }
                        if ($_GET['sort'] == 'score') {
                            $query .= " ORDER BY score DESC";
                        }
                    }
                    
                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result) > 0) {
                        $rowCount = 0;
                        while ($rec = mysqli_fetch_assoc($result)) {
                            $rowCount++;
                            $exam_date = $rec['exam_date'];
                            $user = $rec['user'];
                            $score = $rec['score'];
                            $remark = $rec['remark'];
                            
                            if (!empty($_GET['checkall'])) {
                                $checked = 'checked';
                            } else {
                                $checked = '';
                            }
                            
                            print "
                            <tr>
                            <td>
                                <input type='checkbox' name='student[]' value='$user' $checked>
                            </td>
                            <td>$exam_date</td>
                            <td><a href='view.php?exam_date=$exam_date&user=$user&score=$score&remark=$remark'>$user</a></td>
                            <td>$score</td>
                            <td>$remark</td>
                            <td><a href='update.php?exam_date=$exam_date&user=$user&score=$score&remark=$remark'><img src='images/edit.svg' width='30px' style='filter: brightness(0) invert(1);'></a></td>
                            <td><a href='delete.php?user=$user'><img src='images/delete.svg' width='25px' style='filter: brightness(0) invert(1);'></a></td>
                            </tr>";
                        }
                    } else {
                        print "<tr><td colspan='7' class='text-center'>No records found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="text-end text-white me-1">
            Total Rows: <?php echo $rowCount; ?>
        </div>
        <div class="text-start text-white me-1">
            <?php
            $query = "SELECT remark, COUNT(remark) AS remark_count FROM exam GROUP BY remark;";
            $result = mysqli_query($con, $query);
            
            while ($rec = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $count = $rec['remark_count'];
                $rem = $rec['remark'];
                echo "<p>$rem: $count</p>";
            }?>
        </div>
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-danger">Delete Selected</button>
            
        </div>
        </form>
        
        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-primary">Insert Records?</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>