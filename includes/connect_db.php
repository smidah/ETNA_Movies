<?php 
	$c = new MongoClient();
	$db = $c->db_etna;
	$collection = $db->createCollection('students');
	$collection2 = $db->createCollection('movies');
	
	// $doc = array(
	// 	"name" => "Dupon");
	// $collection->insert($doc);
?>