<?php

function 	genre_aff($collection2, $argv, $verif)
{
	$count = 0;
	$movies = $collection2->find();
	foreach($movies as $all)
	{
		foreach ($all['genres'] as $key)
		{
			if ($key == $argv[3])
			{
				echo "title: " . $all['title'] . "\n";
				echo "Year: " . $all['year'] . "\n";
				echo "genres: " . implode(",", $all['genres']) . "\n";
				echo "Directors: " . implode(",", $all['directors']) . "\n";
				echo "Rate: " . $all['rate'] . "\n";
				echo "stock: " . $all['stock'] . "\n";
				echo "Imbdcode: " . $all['imbd_code'] . "\n\n";
				$count++;
				$verif++;
			}
		}
	}
	echo "*$count*\n";
}

function 	genre($collection2, $argv, $argc)
{
	$verif = 0;

	if ($argc == 4 && isset($argv[2]) && isset($argv[3]))
		genre_aff($collection2, $argv, $verif);
	if ($verif == 0 && $argc == 4)
			echo "Ce genre n'existe pas\n";
	else
		echo "Il faut specifier le genre\n";
}

function 	year($collection2, $argv, $argc)
{
	if (is_numeric($argv[3]))
	{
		$donnees = array(strtolower($argv[2]) => floatval($argv[3]));
		$movies = $collection2->find($donnees);
	}
	else
		$movies = false;

	return $movies;
}

function 	rate($collection2, $argv, $argc)
{
	if (is_numeric($argv[3]))
	{
		$rate = floatval($argv[3]);
		$donnees = array(strtolower($argv[2]) => array(
						'$gte' => $rate, '$lt' => $rate+1));
		$movies = $collection2->find($donnees);
	}
	else
		$movies = false;
	

	return $movies;
}


?>