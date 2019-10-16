<!DCOCTYPE html>
    <html lang="en">
    <?php require_once('connection/connection.php'); ?>

    <?php 

        $foods = show($connection, "menu", "food_id != '' AND status = 1", "food_id");
        $categories = show($connection, "food_category", "category_id !=''", "category_id");
        $connection->close();
    ?>

    <head>
        <title>Kitchen Inbox</title>
        <!--Required meta tags-->
        <meta charset="utf-8" />
        <meta name="viewport" href="css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="fontawesome/css/all.min.css" />
        <link rel="stylesheet" href="css/kitcheninbox.css">




    </head>

    <body>
        <div class="container-fluid inboxlayout">
            <!--NavBar area-->
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h1>Kitchen Inbox</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Curry Lamb</h5>
                            <a href="#" class="card-link">Order Done</a>
                            <a href="#" class="card-link">Remove Order</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </body>

    </html>
