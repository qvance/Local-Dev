<!DOCTYPE html>

<?php 

require_once('mongodb_config.php');

$collection=$db->Assets;

if (isset($_POST['Save'])) {


$serialnumber = $_POST['SerialNumber'];
$modelnumber = $_POST['ModelNumber'];
$modelname = $_POST['ModelName'];
$manufacturer = $_POST['Manufacturer'];
$type = $_POST['Type'];
$processor = $_POST['Processor'];
$memory = $_POST['Memory'];
$graphics = $_POST['Graphics'];
$operatingsystem = $_POST['OS'];
$assetnumber = $_POST['AssetName'];
$location = $_POST['Location'];
$primary = $_POST['Primary'];
$status = $_POST['Status'];

$asset = array(
	'Serial Number' => $serialnumber,
	'Model Number' => $modelnumber,
	'Model Name' => $modelname,
	'Manufacturer' => $manufacturer,
	'Type' => $type,
	'Processor' => $processor,
	'Memory' => $memory,
	'Graphics' => $graphics,
	'OS' => $operatingsystem,
	'Asset Name' => $assetnumber,
	'Location' => $location,
	'Primary User' => $primary,
	'Status' => $status,
);


$verify = $collection->findOne(array("Serial Number" => "$serialnumber"));

if($verify !== NULL) {

$sysmessage = "This asset already has been logged. Please check your information again.";
$jsalert = "<script type = text/javascript> alert ('{$serialnumber} already exists!'); </script>";
	
} else {

$assetcount = 0;
$emptybanners = array();

foreach ($asset as $note => $info) {

if (empty($info) != 1) {
 
 $assetcount ++;

}

else {

	array_push($emptybanners, $note);


}

}
 
if (count($asset) == $assetcount) {

$collection->insert($asset);

$sysmessage = "$serialnumber has been logged.";
unset ($serialnumber, $modelnumber, $modelname, $manufacturer, $type, $processor, $memory, $graphics, $operatingsystem, $assetnumber, $location, $primary, $status);

}

else {

$jsalert =  "<script type = text/javascript> alert ('Please fill in all fields before clicking on Submit.'); </script>";
$sysmessage = "Please fill in the following information: " . join(", ", $emptybanners) . ".";

}

}

}

?>

<html>


<head>
<link type = 'text/css' rel = 'stylesheet' href = 'Inventory.css' />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css" />
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
<script type='text/javascript' src="LeSigh.js"></script>

<title>DISA Inventory - Asset Entry</title>

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
<li class="active"><a href="http://localhost/~quentinvance/AssetEntry.php">Asset Entry</a></li>
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
		
<script type = "text/javascript">
$(document).ready(function() {
	$('input[id=SerNum]').focus();
});
</script>

<legend>Asset Entry</legend>

<?php if (isset($sysmessage)) {print '<p>'.$sysmessage.'</p>';} ?> 

<fieldset>

<form method="post" action="">

<p>
<label for="SerNum">Serial Number</label>
<input type="text" name="SerialNumber" id="SerNum">
</p>

<p id = "Modeled">
<label for="ModNumber">Model Number</label>
<select name="ModelNumber" id = "ModNumber">
<option value="choice">Choose wisely...</option>


<?php

$collection = $db->Models;
$models = $collection->find();

 foreach($models as $mn) {
	echo '<option value ="'.$mn["Model Number"].'" data-modelname ="'.$mn["Model Name"].'" data-manufacturer ="'.$mn["Manufacturer"].'" data-type ="'.$mn["Type"].'" data-processor ="'.$mn["Processor"].'" data-memory ="'.$mn["Memory"].'">'.$mn["Model Number"].'</option>';

}
?>

</select>
</p>

<p>
<label for="ModName">Model Name</label>
<input type="text" name="ModelName" id="ModName">
</p>

<p>
<label for="Manu">Manufacturer</label>
<input type="text" name="Manufacturer" id="Manu">
</p>

<p>
<label for="Typical">Type</label>
<input type="text" name="Type" id="Typical">
</p>

<p>
<label for="Proc">Processor</label>
<input type="text" name="Processor" id="Proc">
</p>

<p>
<label for="Mem">Memory(GB)</label>
<input type="text" name="Memory" id="Mem">
</p>

<p>
<label for= "Graph">Graphics Card</label>
<select name = "Graphics" id = "Graph">
<option value = 1>"Yes"</option>
<option value = 0>"No"</option>
</select>
</p>

<p>
<label for="OS">OS</label>
<select name= "OS" id = "OS">
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
<label for="AN">Asset Name</label>
<input type="text" name="AssetName" id="AN">
</p>

<p>
<label for="Loc">Location</label>
<select name = "Location" id = "Loc">
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
<label for="Prim">Primary User</label>
<input type="text" name="Primary" id="Prim">
</p>

<p>
<label for = "Stat1">Status</label>
<select name = "Status" id = "Stat1">
<option value = "Backstock">Backstocked</option>
<option value = "Ready">Ready for Deployment</option>
<option value = "Deployed">Deployed</option>
<option value = "Awaiting Repair">Awaiting Repair</option>
</select>
</p>

<p>
<input type="submit" name="Save" value="Save">
</p>
</fieldset>
</form>


</div>
</div>

<div class = "footercleared"></div>
<div id="footer">
		
</div>
<?php if (isset($jsalert)) { echo $jsalert; } ?>
</body>

</html>


