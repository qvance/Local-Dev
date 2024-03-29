<!DOCTYPE html>

<?php
require_once('mongodb_config.php');
session_start();
?>

<html>

<head>
<link type = 'text/css' rel = 'stylesheet' href = 'Inventory.css' />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css" />
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
<script type='text/javascript' src="LeSigh.js"></script>

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
<li><a href="http://localhost/~quentinvanceHome.php">Home</a></li>
<li><a href="http://localhost/~quentinvanceAssetEntry.php">Asset Entry</a></li>
<li><a href="http://localhost/~quentinvanceModelEntry.php">Model Entry</a></li>
<li><a href="#">Search</a></li>
<li class = "active"><a href="http://localhost/~quentinvanceUpdateSearch.php">Update Entry</a></li>
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
	$('input[id=SerNumber]').focus();
});
</script>
<?php

if (isset($_SESSION['Asset'])) {
/*	Examples of changing Mongo document fields into strings - find returns an iterative array, findOne returns the actual document
	$recordId = (string) $-Name of variable which holds the Mongo document-["_id"];
	$recordId = "{$doc['_id']}"; */
	$sid = "{$_SESSION['Asset']["_id"]}";
	$sn = "{$_SESSION['Asset']['Serial Number']}";
	$mn = "{$_SESSION['Asset']['Model Number']}";
	$mna = "{$_SESSION['Asset']['Model Name']}";
	$man = "{$_SESSION['Asset']['Manufacturer']}";
	$ty = "{$_SESSION['Asset']['Type']}";
	$pr = "{$_SESSION['Asset']['Processor']}";
	$mem = "{$_SESSION['Asset']['Memory']}";
	$gph = "{$_SESSION['Asset']['Graphics']}";
	$ops = "{$_SESSION['Asset']['OS']}";
	$anam = "{$_SESSION['Asset']['Asset Name']}";
	$locale = "{$_SESSION['Asset']['Location']}";
	$priu = "{$_SESSION['Asset']['Primary User']}";
	$stat = "{$_SESSION['Asset']['Status']}";

} else {

	echo "<script type = text/javascript> alert ('That is an invalid serial number. Please try again.'); </script>";
	$_SESSION['ErrorText'] = "Invalid serial number. Please try again.";
	header("Location: http://localhost/~quentinvance/UpdateSearch.php");


}

?>
<legend>Model Entry</legend>

<form method = "post" action = "">
<fieldset>

<p>
<h4><strong>Select fields to update:</strong></h4>


<input type="checkbox" name="upsernum" class="fieldcheck" id="upsernum">
<label for="ModelNumber">Serial Number</label>
<input type="text" name="SerialNumber" id="SerNumber" disabled <?php echo 'value = "'.$sn.'">'; ?>
</p>

<p id = "Modeled">
<input type="checkbox" name="upmodnum" class="fieldcheck" id="upmodnum">
<label for="ModelNumber">Model Number</label>
<select name="ModelNumber" id = "ModNumber">

<?php

$collection = $db->Models;
$models = $collection->find();

 foreach($models as $mnli) {
	echo '<option value ="'.$mnli["Model Number"].'" data-modelname ="'.$mnli["Model Name"].'" data-manufacturer ="'.$mnli["Manufacturer"].'" data-type ="'.$mnli["Type"].'" data-processor ="'.$mnli["Processor"].'" data-memory ="'.$mnli["Memory"].'">'.$mnli["Model Number"].'</option>';

}
	echo '<option selected="selected" value ="'.$mn.'">'.$mn.'</option>';
?>

</select>
</p>
<p>
<input type="checkbox" name="upmodnam" class="fieldcheck" id="upmodnam">
<label for="ModelName">Model Name</label>
<input type="text" name="ModelName" id="ModName" <?php echo 'value = "'.$mna.'">'; ?>
</p>

<p>
<input type="checkbox" name="upmodman" class="fieldcheck" id="upmodman">
<label for="Manufacturer">Manufacturer</label>
<input type="text" name="Manufacturer" disabled id="ModManu" <?php echo 'value = "'.$man.'">'; ?>
</p>

<p>
<input type="checkbox" name="upmodtype" class="fieldcheck" id="upmodtype">
<label for="Type">Type</label>
<input type="text" name="Type" disabled id="ModTypical" <?php echo 'value = "'.$ty.'">'; ?>
</p>

<p>
<input type="checkbox" name="upmodproc" class="fieldcheck" id="upmodproc">
<label for="Processor">Processor</label>
<input type="text" name="Processor" disabled id="ModProc" <?php echo 'value = "'.$pr.'">'; ?>
</p>

<p>
<input type="checkbox" name="upmodmem" class="fieldcheck" id="upmodmem">
<label for="Memory">Memory(GB)</label>
<input type="text" name="Memory" disabled id="ModMem" <?php echo 'value = "'.$mem.'">'; ?>
</p>

<p>
<input type="checkbox" name="upmodgraph" class="fieldcheck">
<label for= "Graphics">Graphics Card</label>
<select name = "Graphics" id = "ModGraph" disabled>
<option value = 1>"Yes"</option>
<option value = 0>"No"</option>
</select>
</p>

<p>
<input type="checkbox" name="upmodos" class="fieldcheck">
<label for="OS">OS</label>
<select name= "OS" id = "ModOS" disabled> <script type = text/javascript> var
<option value = "Windows 8 Pro">Windows 8 Professional</option>
<option value = "Windows 8">Windows 8</option>
<option value = "Windows 7 Pro">Windows 7 Professional</option>
<option value = "Windows 7">Windows 7</option>
<option value = "Windows Server 2012 R2">Windows Server 2012 R2</option>
<option value = "Windows Server 2012">Windows Server 2012</option>
<option value = "Windows Server 2008 R2">Windows Server 2008 R2</option>
<option value = "Windows Server 2008">Windows Server 2008</option>
<option value = "VMWare ESXi 5">VMWare ESXi 5.1</option>
<option value = "Windows XP">Windows XP Professional</option>
<option value = "Windows Server 2003">Windows Server 2003</option>
<option value = "Windows Server 2000">Windows Server 2000</option>
</select>
</p>

<p>
<input type="checkbox" name="upmodan" class="fieldcheck">
<label for="AN">Asset Name</label>
<input type="text" name="ModAN" disabled <?php echo 'value = "'.$anam.'">'; ?>
</p>

<p>
<input type="checkbox" name="upmodloc" class="fieldcheck">
<label for="Location">Location</label>
<select name = "Location" id = "ModLoc" disabled>
<option value = "Corp">Corporate</option>
<option value = "Colo">Sungard</option>
<option value = "OTS">OTS - Stow</option>
<option value = "RSOH">RS Occupational Health</option>
<option value = "US">University Services</option>
<option value = "CA9GT">BASC - Benicia</option>
<option value = "LA329">GCSC - Broussard</option>
<option value = "TX399">GCSC - Deer Park</option>
<option value = "TXA48">GCSC - Nederland</option>
<option value = "LA32N">GCSC - Norco</option>
<option value = "TXA50">GCSC - Texas City</option>
<option value = "WA744">NWSC - Anacortes</option>
<option value = "TX271">STSC - Alice</option>
<option value = "TXAOV">STSC - Kenedy</option>
<option value = "TXAQV">STSC - Pleasanton</option>
</select>
</p>

<p>
<input type="checkbox" name="upmodprim" class="fieldcheck">
<label for="Primary">Primary User</label>
<input type="text" name="Primary" id="ModPrim" disabled <?php echo 'value = "'.$priu.'">'; ?>
</p>

<p>
<input type="checkbox" name="upmodstat" class="fieldcheck">
<label for = "Stat1">Status</label>
<select name = "Status" id = "ModStat1" disabled>
<option value = "Backstock">Backstocked</option>
<option value = "Ready">Ready for Deployment</option>
<option value = "Deployed">Deployed</option>
<option value = "Awaiting Repair">Awaiting Repair</option>
</select>
</p>
<p>
<p>
<input type="submit" name="Update" value="Update">
</p>
</p>

</fieldset>
</form>

<?php

$collection=$db->Assets;

if (isset($_POST['Update'])) {


$serialnumber = $_POST['SerialNumber'];
$modelnumber = $_POST['ModelNumber'];
$modelname = $_POST['ModelName'];
$manufacturer = $_POST['Manufacturer'];
$type = $_POST['Type'];
$processor = $_POST['Processor'];
$memory = $_POST['Memory'];
$graphics = $_POST['Graphics'];
$operatingsystem = $_POST['OS'];
$assetnumber = $_POST['AN'];
$location = $_POST['Location'];
$primary = $_POST['Primary'];
$status = $_POST['Status'];

$asset = array(
	'SerialNumber' => $serialnumber,
	'ModelNumber' => $modelnumber,
	'ModelName' => $modelname,
	'Manufacturer' => $manufacturer,
	'Type' => $type,
	'Processor' => $processor,
	'Memory' => $memory,
	'Graphics' => $graphics,
	'OS' => $operatingsystem,
	'AN' => $assetnumber,
	'Location' => $location,
	'Primary' => $primary,
	'Status' => $status,
);


$assetcount = 0;
$emptyasset = array();

foreach ($asset as $note => $info) {

if (empty($info) != 1) {
 
 $modelcount ++;

}

else {

	array_push($emptyassets, $note);

}

}
 
if (count($asset) == $assetcount) {

/* db.collection.update({"find parameters"},{$set {"Fields to update"}}) */
	$updateddata = array('$set' => array($asset));
	$collection->update(array("_id" => $sid), ($updateddata));
	echo "The record has been updated.";
	unset ($serialnumber, $modelnumber, $modelname, $manufacturer, $type, $processor, $memory, $graphics, $operatingsystem, $assetnumber, $location, $primary, $status);


} 

else {

	echo "Please fill in all fields before clicking on 'Submit', namely " . join(", ", $emptyassets) . ".";

}

}


?>

</div>
</div>

<div class = "footercleared"></div>
<div id = "footer"></div>

</body>
</html>