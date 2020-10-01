<?php
require ('functions.php');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Collectors App</title>
    <link href="normalize.css" type="text/css" rel="stylesheet">
    <link href="collection_style.css" type="text/css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<header>
    <h1>Collection of Short Films I've Worked On</h1>
</header>
<main>
    <div></div>
    <section class="layout__collections">
            <?php
            $db_name = 'collectors_db';
            $db = getDBConnection($db_name);
            $result_films =  getAllFilmsWithoutRoles($db);
            $result_film_roles =  getAllRolesForFilms($db);
            echo displayFilmsAndRoles($result_films, $result_film_roles);
            ?>
    </section>
</main>
<footer>
    <p>&copy Davin Hayden 2020</p>
</footer>
</body>
</html>