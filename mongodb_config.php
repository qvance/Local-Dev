<?php
// Configuring the connection
$dbhost = 'localhost:27017';
$dbname = 'testdb';

// Connect to database
$m = new MongoClient("mongodb://$dbhost");
$db = $m->$dbname;

/*

// Set Collection
$collection = $db->Assets;

*/

?>