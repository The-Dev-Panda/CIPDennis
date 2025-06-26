<?php
include("db_connect.php");

$query = "SELECT remark, COUNT(remark) AS remark_count FROM exam GROUP BY remark;";
$result = mysqli_query($con, $query);

while ($rec = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $count = $rec['remark_count'];
    $rem = $rec['remark'];
    echo "<p>$rem: $count</p>";
}
?>
