<?php

/**
 * Creates a PDO connection object to the DB Name thats passed in
 */
function getDBConnection(string $db_name): object {
    $dsn = 'mysql:host=db;dbname=' . $db_name;
//    var_dump($dsn);
    $db = new PDO($dsn,'root', 'password');
//    var_dump($db);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $db;
}

/**
 * Function to get all the films in the collection, but none of the associated roles
 * The DB contains a table of films, plus a linked table of multiple roles/jobs that I have undertaken on each file
 */
function getAllFilmsWithoutRoles(object $db):  array
{
    $query = $db->prepare('select `films`.`id`, `title`, `year_produced`, `type` from `films` 
        join `genre`
        on `films`.`genre` = `genre`.`id`' );
    $query->execute();
    $result = $query->fetchAll();
    return $result;
}

/**
 * Function to get all the roles I have done, for each of the films in the collection
 * The DB contains a table of films, plus a linked table of multiple roles/jobs that I have undertaken on each file
 */
function getAllRolesForFilms(object $db):  array
{
    $query = $db->prepare('select `films`.`id` as `film-id`, `name`, `roles`.`id` from `films` 
        join `film_roles`
        on `films`.`id` = `film_roles`.`film_id` 
        join `roles`
        on `roles`.`id` = `film_roles`.`role_id`' );
    $query->execute();
    $result = $query->fetchAll();
    return $result;
}

/**
 * Function to display all the films in the collection, and for each film, display all the roles that I did for that flm
 */
//foreach($array as $values) {
//if(isset($values['year']))


function displayFilmsAndRoles(array $result_films, array $result_roles): string
{
    $film_results = "";
    // show all the films
    //CHECK if keys exist first, then make empty str if dont exist
        foreach ($result_films as $key => $value) { // im not even using the value here
            $film_results .= '<article class="container__film">'
                . '<h2>Film: ' . $result_films[$key]['title'] . '</h2>'
                . '<p>ID: ' . $result_films[$key]['id'] . '</p>'
                . '<p>Year Produced: ' . $result_films[$key]['year_produced'] . '</p>'
                . '<p>Genre: ' . $result_films[$key]['type'] . '</p>'
                . '<p>My Roles: </p>'
                . '<ul>';
            //for each film, shows the roles I did - //CHECK if keys exist first, then make empty str if dont exist
            foreach ($result_roles as $key_role => $value_role) {
                if ($result_films[$key]['id'] == $result_roles[$key_role]['film-id']) {
                    $film_results .= '<li>' . $result_roles[$key_role]['name'] . '</li>';
                }
            }
            $film_results .= '</ul>'
                . '</article>';
        }
    return $film_results;
}

function displayFilmsAndRolesNEW(array $result_films, array $result_roles): string
{
    $film_results = "";
    // show all the films
    //CHECK if keys exist first, then make empty str if dont exist
    if (array_key_exists("id", $result_films)){
        echo 'FOUND ID';
    }
    if(array_key_exists("id", $result_films)
        && array_key_exists("title", $result_films)
        && array_key_exists('year_produced', $result_films)
        && array_key_exists('type', $result_films))
    {
        foreach ($result_films as $key => $value) { // im not even using the value here
            if (array_key_exists("id", $result_films[$key]) ){
                echo 'FOUND ID 22222';
            }
            $film_results .= '<article class="container__film">'
                . '<h2>Film: ' . $result_films[$key]['title'] . '</h2>'
                . '<p>ID: ' . $result_films[$key]['id'] . '</p>'
                . '<p>Year Produced: ' . $result_films[$key]['year_produced'] . '</p>'
                . '<p>Genre: ' . $result_films[$key]['type'] . '</p>'
                . '<p>My Roles: </p>'
                . '<ul>';
            //for each film, shows the roles I did - //CHECK if keys exist first, then make empty str if dont exist
            foreach ($result_roles as $key_role => $value_role) {
                if ($result_films[$key]['id'] == $result_roles[$key_role]['film-id']) {
                    $film_results .= '<li>' . $result_roles[$key_role]['name'] . '</li>';
                }
            }
            $film_results .= '</ul>'
                . '</article>';
        }
    } else { // one  of the film keys is missing, so return empty string
        $film_results = "";
    }
    return $film_results;
}


?>
