<?php

/**
 * Creates a PDO connection object to the DB Name thats passed in
 */
function getDBConnection(string $db_name): pdo {
    $dsn = 'mysql:host=db;dbname=' . $db_name;
    $db = new PDO($dsn,'root', 'password');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $db;
}

/**
 * Function to get all the films in the collection, but none of the associated roles, where the film is not flagged as being deleted
 * The DB contains a table of films, plus a linked table of multiple roles/jobs that I have undertaken on each file
 */
function getAllFilmsWithoutRoles(pdo $db): array
{
    $query = $db->prepare('SELECT `films`.`id`, `title`, `year_produced`, `type` FROM `films` 
        JOIN `genre`
        ON `films`.`genre` = `genre`.`id` 
        WHERE `is_deleted` = false' );
    $query->execute();
    $result = $query->fetchAll();
    return $result;
}

/**
 * Function to get all the roles I have done, for each of the films in the collection, where the film is not flagged as being deleted.
 * The DB contains a table of films, plus a linked table of multiple roles/jobs that I have undertaken on each file
 */
function getAllRolesForFilms(pdo $db): array
{
    $query = $db->prepare('SELECT `films`.`id` AS `film-id`, `name`, `roles`.`id` FROM `films` 
        JOIN `film_roles`
        ON `films`.`id` = `film_roles`.`film_id` 
        JOIN `roles`
        ON `roles`.`id` = `film_roles`.`role_id` 
        WHERE `is_deleted` = false' );
    $query->execute();
    $result = $query->fetchAll();
    return $result;
}

/**
 * Function to display all the films in the collection, and for each film, display all the roles that I did for that film. If film id or title is missing, dont show any details of the film and move onto showing the next film
 */
function displayFilmsAndRoles(array $result_films, array $result_roles): string
{
    $film_results = "";
    //iterate over outer array of films, and show each film
    foreach ($result_films as $film) {
        //check that mandatory fields id (auto-incremented primary key) and title are present & not null...
        if (
            array_key_exists('id', $film) &&
            array_key_exists('title', $film) &&
            ($film['title'] != "")
            ) {
            $film_results .= '<article class="container__film">'
                . '<h2>Film: ' . $film['title'] . '</h2>'
                . '<p>Year Produced: ' . $film['year_produced'] . '</p>'
                . '<p>Genre: ' . $film['type'] . '</p>'
                . '<p>My Roles: </p>'
                . '<ul>';
            // iterate over inner array of film roles...
            foreach ($result_roles as $film_role) {
                // ...and show each film role where the film id matches AND the role name is present
                if ($film['id'] == $film_role['film-id'] && array_key_exists('name', $film_role)) {
                    $film_results .= '<li>' . $film_role['name'] . '</li>';
                }
            }
            $film_results .= '</ul>'
                . '</article>';
        } else { // ...else if a film id or title is missing, skip that film and move onto the next one
            $film_results .= "";
        }
    }
    return $film_results;
}
