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
        <title>Import Data</title>

        <link rel="stylesheet" href="assets/css/bootstrap.css">
    </head>
    <body>

        <div class="container mt-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Import CSV</h5>
                            <p class="card-text">Choose your csv file, and upload here.</p>

                            <form action="show_data.php" method="post" enctype="multipart/form-data">
                                Choose File CSV:
                                <input class="form-control" type="file" name="csv">
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