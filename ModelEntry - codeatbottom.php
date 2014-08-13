<!DOCTYPE html>

<?php
require_once('mongodb_config.php'); 
?>

<html>

<head>
<link type = 'text/css' rel = 'stylesheet' href = 'Inventory.css' />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css" />
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>

<title>DISA Model Inventory</title>

</head>

<body>
<div id="holding">
<div id="header">

<h2>DISA Inventory</h2>

<div class="wrapper">
<div class="trial">
<div class="container">
<ul class="menu" rel="sam1">
<li><a href="http://localhost/~quentinvance/Home.php">Home</a></li>
<li><a href="http://localhost/~quentinvance/AssetEntry.php">Asset Entry</a></li>
<li class = "active"><a href="http://localhost/~quentinvance/ModelEntry.php">Model Entry</a></li>
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
		
<script type = "text/javascript">
$(document).ready(function() {
	$('input[id=ModNumber]').focus();
});
</script>

<legend>Model Entry</legend>
<fieldset>
<form method = "post" action = "">
<p>
<label for="ModelNumber">Model Number</label>
<input type="text" name="ModelNumber" id="ModNumber">
</p>
<p>
<label for ="ModelName">Model Name</label>
<input type="text" name="ModelName">
</p>
<p>
<label for="Manufacturer">Manufacturer</label>
<input type="text" name="Manufacturer">
</p>
<p>
<label for="Type">Type</label>
<input type="text" name="Type">
</p>
<p>
<label for="Processor">Processor</label>
<input type="text" name="Processor">
</p>
<p>
<label for="Memory">Memory(GB)</label>
<input type="text" name="Memory">
</p>
<p>
<label for="Check64">64-bit Capable</label>
<input type="checkbox" name="Check64" value="True">
<!-- <input type="radio" name="check64" value="False">No -->
</p>
<p>
<input type="submit" name="Save" value="Save">
</p>
</fieldset>
</form>

<?php

$collection=$db->Models;

if (isset($_POST['Save'])) {


$modelnumber = $_POST['ModelNumber'];
$modelname = $_POST['ModelName'];
$manufacturer = $_POST['Manufacturer'];
$type = $_POST['Type'];
$processor = $_POST['Processor'];
$memory = $_POST['Memory'];

$model = array(
	'ModelNumber' => $modelnumber,
	'ModelName' => $modelname,
	'Manufacturer' => $manufacturer,
	'Type' => $type,
	'Processor' => $processor,
	'Memory' => $memory,
	);

$verify = $collection->findOne(array("ModelNumber" => "$modelnumber"));

if($verify !== NULL) {

	echo "This model already has been logged. Please check your information again.";
	echo "<script type = text/javascript> alert ('{$modelnumber} already exists!'); </script>";

}	else {


$modelcount = 0;
$emptymodels = array();

foreach ($model as $note => $info) {

if (empty($info) != 1) {
 
 $modelcount ++;

}

else {

	array_push($emptymodels, $note);

}

}
 
if (count($model) == $modelcount) {

if (isset($_POST['Check64'])) {

	$check64 = True;
	$model['Check64'] = $check64;
	$collection->insert($model);
	echo "$modelnumber has been logged.";
	unset ($modelnumber, $modelname, $manufacturer, $type, $processor, $memory, $check64);

} else {

	$check64 = False;
	$model['Check64'] = $check64;
	$collection->insert($model);
	echo "$modelnumber has been logged.";
	unset ($modelnumber, $modelname, $manufacturer, $type, $processor, $memory, $check64);

}

} else {

	echo "Please fill in all fields before clicking on 'Submit', namely " . join(", ", $emptymodels) . ".";

}

}

}

?>

</div>
</div>

<div class = "footercleared"></div>
<div id="footer">

</div>

</body>
</html>








