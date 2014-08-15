<!DOCTYPE html>

<?php
require_once('mongodb_config.php');
session_start();


$collection=$db->Models;


if(isset($_SESSION['Model'])) {

/*	Examples of changing Mongo document fields into strings - find returns an iterative array, findOne returns the actual document
	$recordId = (string) $-Name of variable which holds the Mongo document-["_id"];
	$recordId = "{$doc['_id']}"; */
	$modid = "{$_SESSION['Model']['_id']}";
	$recordId = array('_id' => new MongoID($modid));
	$mn = "{$_SESSION['Model']['Model Number']}";
	$mna = "{$_SESSION['Model']['Model Name']}";
	$man = "{$_SESSION['Model']['Manufacturer']}";
	$ty = "{$_SESSION['Model']['Type']}";
	$pr = "{$_SESSION['Model']['Processor']}";
	$mem ="{$_SESSION['Model']['Memory']}";
	$ch = "{$_SESSION['Model']['Check64']}";

} else {

	echo "<script type = text/javascript> alert ('That is an invalid model number. Please try again.'); </script>";
	$_SESSION['ErrorText'] = "Invalid model number. Please try again.";
	header("Location: http://localhost/~quentinvance/UpdateSearch.php");
}

if (isset($_POST['Update'])) {

	$model = array();

if (isset($_POST['ModelNumber'])) {

	$modelnumber = $_POST['ModelNumber'];
	$model['Model Number'] = $modelnumber;

}

if (isset($_POST['ModelName'])) {

	$modelname = $_POST['ModelName'];
	$model['Model Name'] = $modelname;

}

if (isset($_POST['Manufacturer'])) /* && (!strlen(trim($_POST['Manufacturer'])))) */ {

	$manufacturer = $_POST['Manufacturer'];
	$model['Manufacturer'] = $manufacturer;
	
}

if (isset($_POST['Type'])) {

	$type = $_POST['Type'];
	$model['Type'] = $type;

}

if (isset($_POST['Processor'])) {

	$processor = $_POST['Processor'];
	$model['Processor'] = $processor; 
	
}

if (isset($_POST['Memory'])) {

	$memory = $_POST['Memory'];
	$model['Memory'] = $memory;
	
}

/*	((!strlen(trim($_POST['Manufacturer']))) &&

 $modelunchecked = array(
	'Model Number' => $modelnumber,
	'Model Name' => $modelname,
	'Manufacturer' => $manufacturer,
	'Type' => $type,
	'Processor' => $processor,
	'Memory' => $memory,
	); */

/* $model = (array_filter($modelunchecked)); */


if (isset($_POST['Ch64'])) {		
		
		if (($ch == 1) && (is_null($_POST['Check64']))) {

		$check64 = False;
		$model['Check64'] = $check64;
		$update = array('$set' => $model);
		$collection->update($recordId,$update);
		$_SESSION['sysmessage'] = "$mn has been updated.";
		header("Location: http://localhost/~quentinvance/UpdateSearch.php");

	} elseif ((empty($ch) == true) && ($_POST['Check64'] == "True")) {
	
		$check64 = True;
		$model['Check64'] = $check64;
		$update = array('$set' => $model);
		$collection->update($recordId,$update);
		$_SESSION['sysmessage'] = "$mn has been updated.";
		header("Location: http://localhost/~quentinvance/UpdateSearch.php");

	} else {
	
		$update = array('$set' => $model);
		$collection->update($recordId,$update);
		$_SESSION['sysmessage'] = "$mn has been updated.";
		header("Location: http://localhost/~quentinvance/UpdateSearch.php");
		
		}
		
} else {

		$update = array('$set' => $model);
		$collection->update($recordId,$update);
		$_SESSION['sysmessage'] = "$mn has been updated.";
		header("Location: http://localhost/~quentinvance/UpdateSearch.php");
	
}

}

?>

<html>

<head>
<link type = 'text/css' rel = 'stylesheet' href = 'Inventory.css' />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css" />
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
<script type = "text/javascript" src = "Update.js"></script>

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
<li><a href="http://localhost/~quentinvance/ModelEntry.php">Model Entry</a></li>
<li><a href="#">Search</a></li>
<li class = "active"><a href="http://localhost/~quentinvance/UpdateSearch.php">Update Entry</a></li>
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

<?php if (isset($sysmessage)) {print '<p>'.$sysmessage.'</p>';} ?> 

<fieldset>

<form method = "post" action = "">

<p>
<h4><strong>Select fields to update:</strong></h4>
</p>
<!-- <?php var_dump($modid); ?> -->
<p>
<input type="checkbox" name="Number" class="fieldcheck">
<label for="ModelNumber">Model Number</label>
<input type="text" name="ModelNumber" id="ModNumber" disabled="disabled" <?php echo 'value = "'.$mn.'">'; ?>
</p>

<p>
<input type="checkbox" name="Name" class="fieldcheck">
<label for="ModelName">Model Name</label>
<input type="text" name="ModelName" id="ModName" disabled <?php echo 'value = "'.$mna.'">'; ?>
</p>

<p>
<input type="checkbox" name="Manufacturer" class="fieldcheck">
<label for="Manufacturer">Manufacturer</label>
<input type="text" name="Manufacturer" id="ModManufacturer" disabled <?php echo 'value = "'.$man.'">'; ?>
</p>

<p>
<input type="checkbox" name="Type" class="fieldcheck">
<label for="Type">Type</label>
<input type="text" name="Type" id = "ModType" disabled <?php echo 'value = "'.$ty.'">'; ?>
</p>

<p>
<input type="checkbox" name="Processor" class="fieldcheck">
<label for="Processor">Processor</label>
<input type="text" name="Processor" id="ModProcessor" disabled <?php echo 'value = "'.$pr.'">'; ?>
</p>

<p>
<input type="checkbox" name="Memory" class="fieldcheck">
<label for="Memory">Memory(GB)</label>
<input type="text" name="Memory" id="ModMemory" disabled <?php echo 'value = "'.$mem.'">'; ?>
</p>

<p>
<input type="checkbox" name="Ch64" id="Ch64" class="fieldcheck" value="True">
<label for="Check64">64-bit Capable</label>
<input type="checkbox" name="Check64" id="ModCh64" value="True" disabled class="datacheck" <?php if ($ch === "1") {echo 'checked = "checked">';} ?> 
</p>
<p>
<p>
<input type="submit" name="Update" value="Update">
</p>
</p>

</fieldset>
</form>



</div>
</div>

<div class = "footercleared"></div>
<div id = "footer"></div>

</body>
</html>