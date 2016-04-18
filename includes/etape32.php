<?php

function    rent_movie($collection, $collection2, $argv, $argc)
{
    if($argc == 4)
    {
    if($movie = verif_loc($collection, $collection2, $argv))
        {
            
            rent_movie2($collection, $collection2, $argv, $movie);
            
        } 
    }
    else
         echo "Probleme d'arguments .\n";
}

function rent_movie2($collection, $collection2, $argv, $movie)
{
    $id_mov = idmov($collection2, $argv);
    $id_stud = idstud($collection, $argv);
    if($movie['stock'] >= 1)
            {
                if ($find = $collection->findOne(array('rented_movies' => $id_mov)))
                    echo "Vous avez deja loue le film\n";
                else 
                {
                    $collection->update(array("login" => $argv[2]), array(
                                          '$addToSet' => array('rented_movies' => $id_mov)));

                    $collection2->update(array("imbd_code" => $argv[3]), array(
                                          '$addToSet' => array('renting_students' => $id_stud)));

                    $collection2->update(array("imbd_code" => $argv[3]), array(
                                          '$inc' => array('stock' => -1)));
                    echo "Rented !\n";
                }
            }
            else
                echo "Stock-out !\n";

}
//rent_movie($collection, $collection2, $argv);

function    return_movie($collection, $collection2, $argv, $argc)
{
    if($argc == 4)
    {
        if($movie = verif_loc($collection, $collection2, $argv))
        {
            $id_mov = idmov($collection2, $argv);
            $id_stud = idstud($collection, $argv);

                if ($find = $collection->findOne(array('rented_movies' => $id_mov)))
                {
                    $collection->update(array("login" => $argv[2]), array(
                                          '$pull' => array('rented_movies' => $id_mov)));

                    $collection2->update(array("imbd_code" => $argv[3]), array(
                                          '$pull' => array('renting_students' => $id_stud)));

                    $collection2->update(array("imbd_code" => $argv[3]), array(
                                          '$inc' => array('stock' => 1)));
                    echo "Returned\n";
                }
            else
                echo "Vous n'avez pas loue le film !\n";
        }
    }
    else
        echo "Probleme d'arguments .\n";
}        

function    show_rented_movies($collection2, $argv, $argc)
{
    if($argc == 2)
    {
    $count = 0;
    $movies_rented = $collection2->find();
    foreach($movies_rented as $all)
        {
            foreach ($all['renting_students'] as $key)
            {
                if ($key != "")
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
            }
        }
        echo "*$count*\n";
    }
    else
        echo "Probleme d'arguments .\n";    
}

?>