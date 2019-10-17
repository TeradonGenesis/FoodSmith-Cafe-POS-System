<!DOCTYPE html>
<html lang="en">
<?php require_once('connection/connection.php'); ?>

<head>
    <?php include 'includes/head.inc.php'?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-col-lg-12">


                <div class="row mt-5">
                    <div class="col-12 col-sm-12 col-md-12 col-col-lg-12 mb-4">

                        <h1 class="text-center" id="title">Please Select An Interface</h1>
                    </div>
                </div>


                <div class="row text-center">


                    <div class="col-12 col-sm-4 col-md-4 col-lg-4 text-center ">

                        <div class="card menu">
                            <div class="img-card mb-3">
                                <img src="images/menu.png" alt="menu" />
                            </div>
                            <div class="card-content mb-3">
                                <div class="card-title text-center display-3">
                                   Menu

                                </div>
                            </div>
                            <div class="card-read-more big-button-menu">
                                <a href="foodordercart.php" class="btn btn-block stretched-link text-white font-weight-bold">
                                    For waiters
                                </a>
                            </div>
                        </div>

                    </div>

                    <div class="col-12 col-sm-4 col-md-4 col-lg-4 text-center ">

                        <div class="card menu">
                            <div class="img-card mb-3">
                                <img src="images/menu.png" alt="cashier" />
                            </div>
                            <div class="card-content mb-3">
                                <div class="card-title text-center display-3">
                                    Payment

                                </div>
                            </div>
                            <div class="card-read-more big-button-menu">
                                <a href="tablelisting.php" class="btn btn-block stretched-link text-white font-weight-bold">
                                    For cashiers
                                </a>
                            </div>
                        </div>

                    </div>

                    <div class="col-12 col-sm-4 col-md-4 col-lg-4 text-center ">

                        <div class="card menu">
                            <div class="img-card mb-3">
                                <img src="images/menu.png" alt="kitchen" />
                            </div>
                            <div class="card-content mb-3">
                                <div class="card-title text-center display-3">
                                    Kitchen Inbox

                                </div>
                            </div>
                            <div class="card-read-more big-button-menu">
                                <a href="kitcheninbox.php" class="btn btn-block stretched-link text-white font-weight-bold">
                                    For kitchen staff
                                </a>
                            </div>
                        </div>

                    </div>




                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.inc.php'?>
</body>

</html>
