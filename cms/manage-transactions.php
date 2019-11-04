<!DOCTYPE html>
<html lang="en">
<?php require_once('../connection/connection.php'); ?>

<head>
    <?php include 'head.php'?>
    <?php 
        $showTransactions = show($connection,"transaction_listing","trans_id != ''","trans_id");
        $connection->close();
    ?>
</head>

<body>

    <div class="wrapper">
        <?php include 'sidepanel.php'?>
        <div id="content">

            <?php include 'nav.php'?>

            <form method="post" action="export.php">
                <input type="submit" name="export" value="CSV Export" class="btn btn-success"/>
            </form>
            <div class="table-container">
                <div class="row mt-5">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-8 tab-pane active" id="display">
                        <table class="table table-borded table-striped" id="categoryTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="col-1">Transaction ID</th>
                                    <th class="col-5">Total Price</th>
                                    <th class="col-5">Date</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach($showTransactions as $showTransaction) { ?>
                                <tr>
                                    <td class="col-1"><?php echo $showTransaction['trans_id']?></td>
                                    <td class="col-5"><?php echo $showTransaction['total_price']?></td>
                                    <td class="col-5"><?php echo $showTransaction['created_on']?></td>
                                </tr>
                                <?php } ?>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php include 'footer.php'?>
    <script src="../js/manage-category.js"></script>
</body>

</html>
