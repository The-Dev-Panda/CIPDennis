<?php
    ob_start();
    session_start();
    if (empty($_SESSION['name'])) {
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question 9</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-black bg-gradient">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8 col-md-6 col-lg-4">
                <div class="card p-4 shadow rounded">
                    <h2 class="text-center mb-4">Question 9</h2>
                    <form action="q9.php" method="post">
                        <p class="mb-3 fw-bold">The shortest war in history was between Britain and Zanzibar and lasted 38 minutes.</p>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" id="true" name="q9" value="a" required>
                            <label class="form-check-label" for="true">True</label>
                        </div>
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="radio" id="false" name="q9" value="b" required>
                            <label class="form-check-label" for="false">False</label>
                        </div>

                        <div class="d-grid">
                            <input type="submit" name="submit" value="Next Question" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

    <?php
        if (!empty($_POST['submit'])) {
            $_SESSION['q9'] = $_POST['q9'];
            header("Location: q10.php");
        }
    ?>
</body>
</html>
