<?php

function    etape1_verif($argv, $argc)
{
    $pattern = "/^[a-zA-Z]{6}[_][a-zA-Z|0-9]{1}$/";
    if ($argv[1] == 'add_student' || $argv[1] == 'del_student'
     || $argv[1] == 'update_student' || $argv[1] == 'show_student'
     || $argv[1] == 'show_all_student')
    {
        if ($argc == 3)
        {
            if (preg_match_all($pattern, $argv[2]))
                return true;
            else
            {
                echo "Login incorrect \n";
                echo "Il doit etre sous la forme aaaaaa_b \n";
                echo "aaaaa  a_b  ou a : lettre et b : lettre ou chiffre \n";
            }
        }
        else if ($argc == 2 && $argv[1] == 'show_student')
            return true;
        else
            echo "Il n'y a pas le bon nombre d'arguments\n";
    }
    else
        echo "$argv[1]: Commande non trouve\n";
    return false;
}

function    etape2_verif($argv, $argc, $collection2)
{
    $res = false;
    $command = strtolower($argv[1]);
    if ($command == 'movies_storing')
    {
        $command($collection2);
        $res = true;
    }
    else if ($command == 'show_movies')
    {
        $command($argv, $argc, $collection2);
        $res = true;
    }
    return $res;
}

function    etape3_verif($argv, $collection2, $collection, $argc)
{
    $res = false;
    $command = strtolower($argv[1]);
    if ($command == 'rent_movie')
    {
        $command($collection, $collection2, $argv, $argc);
        $res = true;
    }
    else if ($command == 'return_movie')
    {
        $command($collection, $collection2, $argv, $argc);
        $res = true;
    }
    else if ($command == 'show_rented_movies')
    {
        $command($collection2, $argv, $argc);
        $res = true;
    }
    return $res;
}

?>