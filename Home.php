<!DOCTYPE html>

<?php
require_once('mongodb_config.php'); 
?>

<html>

<head>
<link type = 'text/css' rel = 'stylesheet' href = 'Inventory.css' />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<title>DISA Inventory Home</title>

</head>

<body>
<div id="holding">
<div id="header">

<h2>DISA Inventory</h2>

<div class="wrapper">
<div class="trial">
<div class="container">
<ul class="menu" rel="sam1">
<li class = "active"><a href="http://localhost/~quentinvance/Home.php">Home</a></li>
<li><a href="http://localhost/~quentinvance/AssetEntry.php">Asset Entry</a></li>
<li><a href="http://localhost/~quentinvance/ModelEntry.php">Model Entry</a></li>
<li><a href="#">Search</a></li>
<li><a href="http://localhost/~quentinvance/UpdateSearch.php">Update Entry</a></li>
<li><a href="#">Miscellanea</a></li>
</ul>

</div>
</div>
</div>
</div>

		<div id="left">
		<img src="http://cuteoverload.files.wordpress.com/2009/07/george-4.jpg"/>
		<p>How to properly handle inventory.</p>

		</div>


		<div id="right">
<table id = "StockCount">
<thead>
	<tr>
	<th colspan="3" id= "Title">Current Assets by Model</th>
	</tr>
	<tr>
	<th id = "Col1">Model Number</th>
	<th id = "Col2">Model Name</th>
	<th id = "Col3">Count</th>
	</tr>
</thead>
<tbody>
<?php
$Assets = $db->Assets;
$Model = $db->Models;
$models = $Model->find();

foreach ($models as $fancy => $ids) {

		
		$temp = $Assets->find(array("Model Number" => $ids["Model Number"]));
		$tempcount = $temp->count();
		echo "<tr>";
		echo '<td>'.$ids["Model Number"].'</td>';
		echo '<td>'.$ids["Model Name"].'</td>';
		echo "<td align = center>$tempcount</td>";
		echo "</tr>";
		}

?>
</tbody>
</table>

<table id = "DispositionCount">
<thead>
	<tr>
	<th colspan="6" id= "Title">Current Disposition of Assets by Model</th>
	</tr>
	<tr>
	<th id = "Col1">Model Number</th>
	<th id = "Col2">Model Name</th>
	<th id = "Col3">Backstock</th>
	<th id = "Col4">Ready for Deployment</th>
	<th id = "Col5">Deployed</th>
	<th id = "Col6">Awaiting Repairs</th>
	</tr>
</thead>
<tbody>
<?php
foreach ($models as $fancy => $ids) {

		
		$backstock = $Assets->find(array("Model Number" => $ids["Model Number"], "Status" => "Backstock"));
		$backcount = $backstock->count();
		$readystock = $Assets->find(array("Model Number" => $ids["Model Number"], "Status" => "Ready"));
		$readycount = $readystock->count();
		$deployedstock = $Assets->find(array("Model Number" => $ids["Model Number"], "Status" => "Deployed"));
		$deployedcount = $deployedstock->count();
		$repairstock = $Assets->find(array("Model Number" => $ids["Model Number"], "Status" => "Awaiting Repair"));
		$repaircount = $repairstock->count();
		echo "<tr>";
		echo '<td>'.$ids["Model Number"].'</td>';
		echo '<td>'.$ids["Model Name"].'</td>';
		echo "<td>$backcount</td>";
		echo "<td>$readycount</td>";
		echo "<td>$deployedcount</td>";
		echo "<td>$repaircount</td>";
		echo "</tr>";
		}
?>
</tbody>
</table>
</div>
</div>

<div class = "footercleared"></div>
<div id="footer">
		
</div>

</body>
</html>








