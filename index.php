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
    <h1>Collection of  Short Films I've Worked On</h1>
</header>
<main>
    <div></div>
    <section class="layout__collections">
            <?php
            $db_name = 'collectors_db';
//            echo '<br><br>NEW<br>';
            $db = getDBConnection($db_name);
//            echo '<br><br>';
//            var_dump($db);

            echo '<br><br>';
            $result_films =  getAllFilmsWithoutRoles($db);
//            echo '<br><br>result_films<br>';
//            var_dump($result_films);

            echo '<br><br>';
            $result_film_roles =  getAllRolesForFilms($db);
//            echo '<br><br>result_film_roles<br>';
//            var_dump($result_film_roles);

            echo '<br><br>';
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