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

        <!--
        <article class="container__film">
            <h2>Film</h2>
            <p>Name</p>
            <p>Year Produced:</p>
            <p>Genre</p>
            <p>Roles</p>
        </article>
        -->

            <?php
            $result_films =  getAllFilmsWithoutRoles('collectors_db');
//            var_dump($result_films);
//            echo displayFilmsWithoutRoles($result_films);

            $result_roles =  getAllRolesForFilms('collectors_db');
            echo displayFilmsAndRoles($result_films, $result_roles);

            ?>

    </section>
    <section class="layout__collections">
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

<?php
//                echo $result[$key]['type'];
//echo $result[$key][$value];
//                echo '<br>key: ' . $key . '<br>val: ' . $value;
//echo $result[$key]['id'];
//                echo $result[$key]['year_produced'];

//echo $key . " : " . $value . "<br>";
//                $result->fetch();

?>