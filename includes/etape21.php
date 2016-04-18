<?php

function 	movies_storing($collection2)
{
	$array = null;
	if (($handle = fopen("includes/movies.csv", "r")) !== FALSE)
	{
		while (($data = fgetcsv($handle, 1000, ',')) !== FALSE)
			$array[] = $data;
		for ($i = 3, $count = 0; $i < 852; $i++, $count++) { 
			$genres = explode(",", $array[$i][12]);
			$directors = explode(",", $array[$i][7]);
			$donnees = array(
					"imbd_code" => $array[$i][1],
					"title" => $array[$i][5],
					"year" => intval($array[$i][11]),
					"genres" => $genres,
					"directors" => $directors,
					"rate" => floatval($array[$i][9]),
					"link" => $array[$i][15],
					"renting_students" => array(),
					"stock" => rand(0, 5));
				$collection2->insert($donnees);
		}
		fclose($handle);
		echo "$count movies successfully stored !\n";
	}
}

function 	param_show_movies($collection2, $argv, $argc)
{
	if ($argc == 4 && isset($argv[2]) && isset($argv[3]))
	{
		switch (strtolower($argv[2])) {
			case 'year':
				$movies = year($collection2, $argv, $argc);
				break;
			case 'rate';
				$movies = rate($collection2, $argv, $argc);
				break;
			default:
				$movies = false;
		}
	}
	else if ($argc == 3)
	{
		$movies = $collection2->find();
		if (strtolower($argv[2]) == 'desc')
			$movies->sort(array('title' => -1));
		else
			$movies = false;
	}
		else
			$movies = false;
	return $movies;
}

function 	show_movies($argv, $argc, $collection2)
{
	$count = 0;
	$movies = $collection2->find();
	if ($argv[2] == 'genre')
	{
		genre($collection2, $argv, $argc);
		return 0;
	}
	else if ($argc > 2)
		if(!$movies = param_show_movies($collection2, $argv, $argc))
		{
			echo "Arguments invalid\nEx: etna_movies.php show_movies [genre] [action].\n";
			return 0;
		}
	foreach($movies as $all)
	{
		echo "title: " . $all['title'] . "\n";
		echo "Year: " . $all['year'] . "\n";
		echo "genres: " . implode(",", $all['genres']) . "\n";
		echo "Directors: " . implode(",", $all['directors']) . "\n";
		echo "Rate: " . $all['rate'] . "\n";
		echo "stock: " . $all['stock'] . "\n";
		echo "Imbdcode: " . $all['imbd_code'] . "\n\n";
		$count++;
	}
	echo "*$count*\n";
}

?>