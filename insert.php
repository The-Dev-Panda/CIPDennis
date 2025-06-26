<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSERT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

</head>
<body>
    <form action="insert.php" method="get">
        <div class="container text-center ">
            <div class="row ">
                <div class="col">
                    User
                </div>
                <div class="col">
                    <input type=text name=user required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    Score
                </div>
                <div class="col">
                    <input type=number name=score required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type=submit value='Insert Record' name="btnInsert">
                </div>
                <div class="col">
                    <input type=reset value='Clear Now'>
                </div>
            </div>
        </div>
    </form>
    <?php

    include("db_connect.php");
    if(!empty($_GET['btnInsert'])){
        $user=$_GET['user'];
        $read="SELECT user from exam where (user='$user')";
        $readresult=mysqli_query($con, $read);
        $count=mysqli_num_rows($readresult);
        if($count==0)
        {
            $score=$_GET['score'];
        if($score<=10){
            $exam_date=date('Y-m-d');
        if($score>=5){
            $remark="Passed";
        }
        else{
            $remark="Failed";
        }
        
        $insert="INSERT into exam(exam_date,user,score, remark) values ('$exam_date','$user','$score','$remark')";
        mysqli_query($con,$insert);
        print"Record Saved.";
        }
        else{
            print"Scores are 1-10";
        }
    }
    else
    print"Username is taken";
        }
        
    ?>
    <p><a href="result.php">View all Record/s</a></p>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

</body>
</html><!DOCTYPE html>
