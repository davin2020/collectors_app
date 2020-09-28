<?php

function getAllFilms():  array {
    $db = new PDO('mysql:host=db;dbname=collectors_db','root', 'password');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $query = $db->prepare('select `films`.`id`, `title`, `year_produced`, `type` from `films` 
join `genre`
on `films`.`genre` = `genre`.`id`' );
    $query->execute();

//INSERT INTO persons (first_name, last_name, email)
//VALUES (:first_name, :last_name, :email);

    $result = $query->fetchAll();
    return $result;
}


function getAllFilmsWithoutRoles(string $db_name):  array {
    $dsn = 'mysql:host=db;dbname=' . $db_name;
    $db = new PDO($dsn,'root', 'password');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $query = $db->prepare('select `films`.`id`, `title`, `year_produced`, `type` from `films` 
join `genre`
on `films`.`genre` = `genre`.`id`' );
    $query->execute();

    $result = $query->fetchAll();
    return $result;
}

function getAllRolesForFilms(string $db_name):  array {
    $dsn = 'mysql:host=db;dbname=' . $db_name;
    $db = new PDO($dsn,'root', 'password');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $query = $db->prepare('select `films`.`id` as `film-id`, `name`, `roles`.`id` from `films` 
join `film_roles`
on `films`.`id` = `film_roles`.`film_id` 
join `roles`
on `roles`.`id` = `film_roles`.`role_id`' );
    $query->execute();

    $result = $query->fetchAll();
    return $result;

}

function displayFilmsWithoutRoles($result): string{
    $film_results = "";
    foreach($result as $key => $value) {
        $film_results .= '<article class="container__film">';
        $film_results .= '<br><br>';
        $film_results .= '<h2>Film: ' . $result[$key]['title'] . '</h2>' ;
        $film_results .= '<p>ID: ' . $result[$key]['id'] . '</p>';
        $film_results .= '<p>Year Produced: ' .  $result[$key]['year_produced'] . '</p>';
        $film_results .= '<p>Genre: ' . $result[$key]['type'] . '</p>';
        $film_results .= '<br><br>';
        $film_results .= '</article>';
    }
    return $film_results;
}

function displayFilmsAndRoles($result_films, $result_roles): string{
    $film_results = "";
    foreach($result_films as $key => $value) {
        $film_results .= '<article class="container__film">';
        $film_results .= '<br><br>';
        $film_results .= '<h2>Film: ' . $result_films[$key]['title'] . '</h2>' ;
        $film_results .= '<p>ID: ' . $result_films[$key]['id'] . '</p>';
        $film_results .= '<p>Year Produced: ' .  $result_films[$key]['year_produced'] . '</p>';
        $film_results .= '<p>Genre: ' . $result_films[$key]['type'] . '</p>';
        $film_results .= '<p>My Roles: </p>';
        $film_results .= '<ul>';
        foreach($result_roles as $key_role => $value_role) {
//            $film_results .= $result_roles[$key_role]['film-id'];
            if ($result_films[$key]['id'] == $result_roles[$key_role]['film-id']) {
                $film_results .= '<li>' . $result_roles[$key_role]['name']   . '</li>' ;
            }
        }
        $film_results .= '</ul>';
//        $film_results .= '<br><br>';
        $film_results .= '</article>';
    }
    return $film_results;
}

?>
