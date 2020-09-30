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
        on `films`.`genre` = `genre`.`id` 
        where `is_deleted` = false' );
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
        on `roles`.`id` = `film_roles`.`role_id` 
        where `is_deleted` = false' );
    $query->execute();
    $result = $query->fetchAll();
    return $result;
}

/**
 * Function to display all the films in the collection, and for each film, display all the roles that I did for that flm
 */
//foreach($array as $values) {
//if(isset($values['year']))


function displayFilmsAndRolesOLD(array $result_films, array $result_roles): string
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

function displayFilmsAndRoles(array $result_films, array $result_roles): string
{
    $film_results = "";
//    var_dump($result_films);

    //result film is outside array, key value is for elements inside
//    foreach($result_films as $key => $value) {
    //CHECK if keys exist first, then make empty str if dont exist - doesnt work for 2D arrays array_key_exists
    foreach($result_films as $film) {
//        if (array_key_exists('id', $film) && array_key_exists('title', $film) && ($film['title'] != "" ) ) {
//            echo '<br><br>FOUND KEY ID + TITLE using KEY EXISTS ';
//        }

        //does key ie  var exist, rather than is it null?
        //but if its null it returns false & thus doesnt get shown if i break out of loop?
//        if(isset($film['id']) && isset($film['title']) && ($film['title'] != "" )) {

        if (array_key_exists('id', $film) && array_key_exists('title', $film) && ($film['title'] != "" ) ) {
            echo '<br><br>FOUND ID & TITLE';
            $film_results .= '<article class="container__film">';
            // if titles empty it still shows a empty blue box
                    $film_results .= '<h2>Film: ' . $film['title'] . '</h2>' //doesnt show title if null but shows it if its blank
                    . '<p>ID: ' . $film['id'] . '</p>'
                    . '<p>Year Produced: ' . $film['year_produced'] . '</p>'
                    . '<p>Genre: ' . $film['type'] . '</p>'
                    . '<p>My Roles: </p>'
                    . '<ul>';
                    foreach ($result_roles as $film_role) {
                        if ($film['id'] == $film_role['film-id']) {
                            $film_results .= '<li>' . $film_role['name'] . '</li>';
                        }
                    }
                    $film_results .= '</ul>'
                        . '</article>';
        } else { //if a film id or title is missing,skip that film and move onto the next one
            $film_results .= "";
        }
    }
    return $film_results;
}


?>
