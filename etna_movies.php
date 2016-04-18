#!/usr/bin/php
<?php
require_once('includes/connect_db.php');
require_once('includes/etape11.php');
require_once('includes/etape12.php');
require_once('includes/etape21.php');
require_once('includes/etape22.php');
require_once('includes/etape31.php');
require_once('includes/etape32.php');
require_once('includes/etape_verif.php');

function 	my_readline()
{
	$my_var = fopen("php://stdin", "r");
	$chaine = rtrim(fread($my_var, 1024));
	fclose($my_var);
	return $chaine;
}

function 	choice($argv, $argc, $collection, $collection2)
{
	if (etape2_verif($argv, $argc, $collection2));
	else if (etape3_verif($argv, $collection2, $collection , $argc));
	else
	{
		if ($verif = etape1_verif($argv, $argc))
			$argv[1]($argv, $argc, $collection, $collection2);
	}
}

function 	main($argv, $argc, $collection, $collection2)
{ 	
	if ($argc == 1)
		return (0);
	else
		choice($argv, $argc, $collection, $collection2);
}

main($argv, $argc, $collection, $collection2);
?>