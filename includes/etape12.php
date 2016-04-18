<?php

	function 	update_student($argv, $argc, $collection)
	{
		$var_test = false;
		if ($user = $collection->findOne(array('login' => $argv[2])))
		{
			echo "What do you want to update?\n> ";
			$var_read = strtolower(my_readline());
			if ($var_test = verif_update($var_read))
			{
				echo "New $var_read ?\n> ";
				$var_rep = my_readline();
				$collection->update(array(
									  "login" => $argv[2]), array(
									  '$set' => array($var_read => $var_rep)));
				echo "User informations modified !\n";
			}
			else
				echo $var_read . " doesn't exist or not modified\n";
		}
		else
			echo "Login not found !\n";
	}

	function 	verif_update($var_read)
	{
		$var_test = false;
		switch ($var_read) {
			case 'name':
				$var_test = true;
				break;
			case 'phone':
				$var_test = true;
				break;
			case 'age':
				$var_test = true;
				break;
			case 'email':
				$var_read = true;
				break;
		}
		return $var_test;
	}

	function show_student($argv, $argc, $collection)
	{
	if($argc == 3)
	{
		if ($user = $collection->findOne(array('login' => $argv[2])))
			{
				echo "Login : " . $user['login'] . "\n";
				echo "nom   : " . $user['name'] . "\n";
				echo "age   : " . $user['age'] . "\n";
				echo "email : " . $user['email'] . "\n";
				echo "phone : " . $user['phone'] . "\n";
			}
		else
			echo "Login not found !\n";
			}
	else if($argc == 2)
		show_all_student($argv, $argc, $collection);
	else
		echo "Argument problems.";
	}


	function show_all_student($argv, $argc, $collection)
	{
		$count = 0;
		$users = $collection->find();
		foreach($users as $all)
		{
			echo $all['login'] . " ";
			echo $all['name']  . " ";
			echo $all['age']  . " ";
			echo $all['email'] . "\n";
			$count++;
		}
		echo "*$count*\n";
	}
?>
