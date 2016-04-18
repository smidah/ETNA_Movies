<?php

function 	login_exist($argv, $collection, $argc)
{
	if (etape1_verif($argv, $argc)) 
	{
		if ($donnees = $collection->findOne(array('login' => $argv[2])))
			return true;
		return false;
	}
	return true;
}

function 	add_student($argv, $argc, $collection)
{
		if (($login_exist = login_exist($argv, $collection, $argc)) == false) 
		{
			echo "Name ?\n> ";
			$name = my_readline();
			echo "Age ?\n> ";
			$age = my_readline();
			echo "Email ?\n> ";
			$email = my_readline();
			echo "Phone number ?\n> ";
			$phone = my_readline();
			if ($res = verif_param_add($name, $age, $email, $phone))
			{
				$donnees = array(
					"login" => $argv[2],
					"name" => $name,
					"age" => $age,
					"email" => $email,
					"phone" => $phone,
					"rented_movies" => array());
				$collection->insert($donnees);
				echo "User registered !\n";
			}
		}
}

function 	verif_param_add($name, $age, $email, $phone)
{
	$res = true;
	$pattern_name = "/^[a-zA-Z ]+$/";
	$pattern_email = "/^([a-z0-9_\.-]+\@[\da-z\.-]{3,}\.[a-z\.]{2,6})$/";
	$pattern_phone = "/^[0][1-9][0-9]{8}$/";
	if (!preg_match_all($pattern_name, $name))
	{
		echo "name invalid\n";
		$res = false;
	}
	if (!preg_match_all("/^[0-9][0-9]?$/", $age))
	{
		echo "age invalid\n";
		$res = false;
	}
	if (!preg_match_all($pattern_phone, $phone))
	{
		echo "phone invalid\n";
		$res = false;
	}
	if (!preg_match_all($pattern_email, $email))
	{
		echo "email invalid\n";
		$res = false;
	}
	return $res;
}

function 	del_student($argv, $argc, $collection, $collection2)
{
	if ($user = $collection->findOne(array('login' => $argv[2])))
		{
			echo "Are you sure ?\n> ";
			$var_read = strtolower(my_readline());
			if ($var_read == "yes") 
			{
				clear_rentingstudent($argv, $argc, $collection, $collection2);
		        $collection->remove(array("login"=> $argv[2]));
				echo "User deleted !\n";
			}
			else
				return (0);	
		}
	else
		echo "Login not found !\n";
}

function clear_rentingstudent($argv, $argc, $collection, $collection2)
{
	$id_stud = idstud($collection, $argv);
	$movies_rented = $collection2->find();
	foreach($movies_rented as $all)
	{
		foreach ($all['renting_students'] as $key)
		{
			if ($collection2->update(array('renting_students' => $id_stud),
			 	array('$inc' => array('stock' => 1))));
			if ($collection2->update(array('renting_students' => $id_stud),
				array('$pull' => array('renting_students' => $id_stud))));
		    
		 }
	}

}
?>