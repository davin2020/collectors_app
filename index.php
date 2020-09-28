<?php
require ('functions.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Collector's App</title>
    <link href="normalize.css" type="text/css" rel="stylesheet">
    <link href="collection_style.css" type="text/css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

<header>
    <h1>Collectors App</h1>
</header>

<main>
    <div></div>
    <section class="layout__collections">
        <article class="container__film">
            <!--            <article class=" section__box-emphasis">-->
            <h2>Film</h2>
            <p>Name</p>
            <p>Year Produced:</p>
            <p>Genre</p>
            <p>Roles</p>
            <!--                <div>-->
            <!--                    <p class="title-subheading">Web Developer in UK & NZ</p>-->
            <!--                </div>-->
            <!--            </article>-->
        </article>

            <?php
            //            $result =  getAllFilms();
            $result =  getAllFilmsWithoutRoles('collectors_db');
            var_dump($result);
            echo '<br><br>';

            $temp_string = displayFilmsWithoutRoles($result);
            var_dump($temp_string);

//            foreach($result as $key => $value) {
//                echo '<article class="container__film">';
//                echo '<br><br>';
//                echo '<h2>Film: ' . $result[$key]['title'] . '</h2>' ;
//                echo '<p>ID: ' . $result[$key]['id'] . '</p>';
//                echo '<p>Year Produced: ' .  $result[$key]['year_produced'] . '</p>';
//                echo '<p>Genre: ' . $result[$key]['type'] . '</p>';
//                echo '<br><br>';
//                echo '</article>';
//            }
//            var_dump($result);
            ?>


    </section>

    <section class="layout__add-items">
        <a href="change.php">Add Film</a>
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