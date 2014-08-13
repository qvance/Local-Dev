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

<legend>Update</legend>
<fieldset>
<form method = "post" action = "">

<?php if (isset($_SESSION['ErrorText'])) { echo '<p>'.$_SESSION["ErrorText"].'</p>'; unset($_SESSION['ErrorText']); } ?>

<p>
<label for="SerialNumber">Serial Number</label>
<input type="text" name="SerialNumber" id="SerialNumber">
<input type="submit" name="AssetSearch" value="Search" class="search">
</p>
<p>
<label for="ModelNumber">Model Number</label>
<input type="text" name="ModelNumber" id="ModelNumber">
<input type="submit" name="ModelSearch" value="Search" class="search">
</p>
</fieldset>
</form>

<?php

if (isset($_POST['AssetSearch'])) {
	
	$assetcollection = $db->Assets;
	$serialnumber = $_POST['SerialNumber'];
	$_SESSION['Asset'] = $assetcollection->findOne(array("SerialNumber" => "$serialnumber"));
	header("Location: http://localhost/~quentinvance/UpdateAsset.php");
}


if (isset($_POST['ModelSearch'])) {
	
	$modelcollection = $db->Models;
	$modelnumber = $_POST['ModelNumber'];
	$_SESSION['Model'] = $modelcollection->findOne(array("ModelNumber" => "$modelnumber"));
	header("Location: http://localhost/~quentinvance/UpdateModel.php");
}

?>

</div>
</div>

<div class = "footercleared"></div>
<div id = "footer"></div>

</body>
</html>
