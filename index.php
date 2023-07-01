<?php
    unset($_SESSION['data']);
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Import Data CSV</title>

        <link rel="stylesheet" href="assets/css/bootstrap.css">
    </head>
    <body>

        <div class="container mt-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <h5 class="card-header">Import CSV</h5>
                        <div class="card-body">
                            <p class="card-text alert alert-info">Choose your csv file, and upload here.</p>
                            <hr>

                            <form action="show.php" method="post" enctype="multipart/form-data">
                                Choose File CSV:
                                <input class="form-control" type="file" name="csv" accept=".csv">
                                <hr>

                                <input class="btn btn-primary" type="submit" name="submit" value="upload csv">
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="assets/js/bootstrap.js"></script>
    </body>
</html>