<?php
require ('functions.php');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Collection of  Short Films I've Worked On</title>
    <link href="normalize.css" type="text/css" rel="stylesheet">
    <link href="collection_style.css" type="text/css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<header>
    <h1>Collection of  Short Films I've Worked On</h1>
</header>
<main>
    <div></div>
    <section class="layout__collections">
            <?php
            $result_films =  getAllFilmsWithoutRoles('collectors_db');
            $result_film_roles =  getAllRolesForFilms('collectors_db');
            echo displayFilmsAndRoles($result_films, $result_film_roles);
            ?>
    </section>
    <section class="layout__button-area">
        <section class="layout__add-items">
            <div><a href="change.php">Add Film</a></div>
        </section>
    </section>
</main>
<footer>
    <p>&copy Davin Hayden 2020</p>
</footer>
</body>
</html>