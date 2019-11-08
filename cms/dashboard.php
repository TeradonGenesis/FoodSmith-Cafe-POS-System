<!DOCTYPE html>
<html lang="en" data-ng-app="pigeon-chart" data-ng-cloak>
<?php require_once('../connection/connection.php'); ?>

<head>
    <?php include 'head.php'?>
    <?php
		include "pigeon-chart/php/includes.php"
	?>
</head>

<body>
    <div id="axis">
    </div>
    <div>
        <!--Support multiple charts-->
        <pigeon-chart query="SELECT DATE(created_on), COUNT(trans_id) FROM transaction_listing GROUP BY DATE(created_on) " title="Transaction done for different dates" axis-y-title="Total transaction done daily" subtitle="Cafe Smith Summary" axis-x-title="Date" type="spline" show-data-label="true" zoom-type="xy">Placeholder for generic chart</pigeon-chart>
        
        <pigeon-chart query="SELECT DATE(created_on), SUM(total_price) FROM transaction_listing GROUP BY DATE(created_on)" title="Total Sum of price of Transaction done daily " axis-y-title="Total Price Sum of transaction done daily" axis-x-title="Date" subtitle="Cafe Smith Summary" type="column" show-data-label="true" zoom-type="xy">Placeholder for generic chart</pigeon-chart>

    </div>

    <?php include 'footer.php'?>
</body>

</html>
