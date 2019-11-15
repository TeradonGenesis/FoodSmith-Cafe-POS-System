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
                <input type="submit" name="export" value="CSV Export" class="btn btn-success" />
            </form>


            <div class="table-container">
                <div class="row mt-5">
                    <div class="col-md-12 mb-2">
                        <h5>Search by Day or Month</h5>
                        <div class="input-group">
                            <input type="text" name="day" id="day" placeholder="Day" class="form-control">
                            <input type="text" name="month" id="month" placeholder="Month" class="form-control ml-2 mb-2">
                            <span class="input-group-btn">
                                <button id="search" class="btn btn-success ml-2">SEARCH</button>
                                <button id="reset" class="btn btn-danger ml-2">RESET</button>
                                <button id="newest" class="btn btn-info ml-2">SORT BY NEWEST</button>
                            </span>
                        </div>
                    </div>


                    <div class="col-md-12 tab-pane active" id="display">
                        <table class="table table-borded table-striped" id="transactionTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Total Price</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach($showTransactions as $showTransaction) { ?>
                                <tr>
                                    <td><?php echo $showTransaction['trans_id']?></td>
                                    <td><?php echo $showTransaction['total_price']?></td>
                                    <td>
                                        <?php
    
                                            $date = new DateTime($showTransaction['created_on']);
                                            echo $date->format('d/m/Y');
                                        ?>
                                            
                                    </td>
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
    <script src="../js/manage-transactions.js"></script>
</body>

</html>