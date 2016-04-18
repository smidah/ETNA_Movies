<?php

function idstud($collection, $argv)
{
    
    $stud = $collection->findOne(array('login' => $argv[2]));
    $id_stud = $stud['_id'];
    return $id_stud;
}

function idmov($collection2, $argv)
{
    $movie = $collection2->findOne(array('imbd_code' => $argv[3]));
    $id_movie = $movie['_id'];
    return $id_movie;
}

function verif_loc($collection, $collection2, $argv)
{
    // $res = true;
    if ($user = $collection->findOne(array('login' => $argv[2])))
        {
            if($movie = $collection2->findOne(array('imbd_code' => $argv[3])))
            {
                $res = $movie;
            }
            else
                {
                    echo "Ce film n'existe pas. \n";
                    $res =  false;
                }
        }
    else
        {
            echo "Login inexistant \n";
            $res = false;
        }
        return $res;
}

?>