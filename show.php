<?php
    session_start();
    include('import.php');
    $import = new Import();
    $import->setTempData($_FILES['csv']);
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
                        <div class="card-body">
                            <h5 class="card-title">View Data | <a class="btn btn-danger" href="./">Back</a> <a class="btn btn-success" href="process.php">Start Import</a> </h5>
                            <hr>
                            
                            <div class="table-responsive">
                                <table class="table">
                                    <?php echo $import->showData($_FILES['csv']); ?>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="assets/js/bootstrap.js"></script>
    </body>
</html>