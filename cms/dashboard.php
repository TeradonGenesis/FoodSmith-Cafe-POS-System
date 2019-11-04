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
        <pigeon-chart query="SELECT relyear, tmdb_score FROM movie ORDER BY relyear LIMIT 20" title="Top 10 Movies with Highest TMDB Score" subtitle="Year 1953 to Year 2016" type="spline" axisy-title="TMDB Score" show-legend="bottom" show-data-label="true" zoom-type="xy">Placeholder for generic chart</pigeon-chart>

        <pigeon-chart query="SELECT relyear, RATINGCODE, min(runtime), avg(runtime), max(runtime)
							 FROM movie
							 WHERE relyear = 1967
							 GROUP BY relyear, RATINGCODE" title="Stock Quotes For DiGi" subtitle="Comparison between open, high, low and close price" type="column" axis-y-title="Stock Quotes" axis-x-title="Date" show-data-label="false" show-legend="left" zoom-type="y">Placeholder for generic chart</pigeon-chart>

        <pigeon-chart query="SELECT school, COUNT(school) AS Total
							 FROM student
							 GROUP BY school" title="Students from Swinburne, UCTS and Sunway Group By Gender" subtitle="BICT and CS Students" type="pie" axis-y-title="Count" axis-x-title="Gender" show-data-label="false" show-legend="top" zoom-type="xy">Placeholder for generic chart</pigeon-chart>

        <pigeon-chart query="SELECT name, val FROM web_marketing" title="Web Marketing" type="bar" axis-y-title="Value" axis-x-title="Category" show-data-label="false" show-legend="right" zoom-type="x">Placeholder for generic chart</pigeon-chart>

        <pigeon-chart query="SELECT relyear, count(relyear)
 FROM movie
 GROUP BY relyear" title="Total Number of Movies" subtitle="Since 1953-2016" Axisx-title="Year" Axisy-title="Count" show-data-label="true" type="spline"></pigeon-chart>

        <pigeon-chart query="SELECT relyear, min(runtime) 'Min. Duration',
avg(runtime) 'Avg. Duration',
max(runtime) 'Max. Duration'
FROM movie
GROUP BY relyear" title="Total Number of Movies" subtitle="Since 1953-2016" Axisx-title="Year" Axisy-title="Count" show-data-label="true" type="spline"></pigeon-chart>

        <pigeon-chart query="SELECT ratingcode, count(ratingcode)
FROM movie
GROUP BY ratingcode" title="Total Number of Movie by Rating" type="pie" axisy-title="Movie Count" show-legend="true" data-data-label="true">
        </pigeon-chart>


    </div>

    <?php include 'footer.php'?>
</body>

</html>
