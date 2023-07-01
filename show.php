<?php
    session_start();
    include('import.php');
    $import = new Import();
    $temp = $import->setTempData($_FILES['csv']);
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
                            <h5 class="card-title">View Data</h5>
                            <a class="btn btn-sm btn-danger" href="./">Back</a> 
                            
                            <?php if ($_SESSION['data'] != NULL ) { ?>                       
                            <a class="btn btn-sm btn-success" href="process.php">Start Import</a>
                            <?php } ?>

                            <hr>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered">
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