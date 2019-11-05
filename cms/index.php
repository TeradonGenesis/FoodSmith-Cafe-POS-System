<!DOCTYPE html>
<html lang="en">
<?php require_once('../connection/connection.php'); ?>
<?php include('server.php') ?>

<head>
    <?php include 'head.php'?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-col-lg-12">


                <div class="row mt-5">
                    <div class="col-12 col-sm-12 col-md-12 col-col-lg-12">

                        <h1 class="text-center" id="title">Admin Log In</h1>
                    </div>
                </div>


                <div class="row text-center">
                    <div class="col-12 col-sm-8 col-md-6 col-col-lg-6 offset-sm-3 offset-md-3 offset-lg-3 ">

                        <div class="card gradeContainer rounded border">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <img class="portrait" src="../images/manager-icon.png" alt="manager" width="30%">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-10 col-md-10 col-lg-10 offset-sm-1 offset-md-1 offset-lg-1">
                                        <form action="index.php" method="POST">
                                           <?php include('errors.php'); ?>
                                            <div class="row text-center">
                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-4">
                                                    <input id="signin-username" class="form-control" type="text" name="username" placeholder="Name" value="">
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-4">
                                                    <input id="signin-password" class="form-control" type="password" name="password" placeholder="Password" value="">
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-4 mb-3">
                                                    <button type="submit" value="login_user" class="btn btn-primary enbtn btn-block" name="login_user">SUBMIT</button>
                                                </div>
                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-4 mb-3">
                                                    <p class="forgotten-password">Forgot password? <span class="hyperlink"><a href=#>Click here</a></span></p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'?>
</body>

</html>
