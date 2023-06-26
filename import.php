<?php
    session_start();
    include('function.php');
    $import = new import();
    
    // import data to dabatase
    $import->storeData($_SESSION['data']);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="refresh" content="2; url=/import/" />
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
                            <h5 class="card-title">View Data | <a class="btn btn-primary" href="import.php">Start Import</a> </h5>
                            <hr>
                            
                            <div class="alert alert-success" role="alert">
                                Import complete, you will redirect on 2 second
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="assets/js/bootstrap.js"></script>
    </body>
</html>