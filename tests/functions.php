<?php
// require the file to be tested - require functions not index!
require '../functions.php';
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Error;

class Functions extends TestCase
{
    //dont forget im commenting out the ID sometimes!
    //displayFilmsAndRoles($result_films, $result_film_roles);
    public function testSuccess1_displayFilmsAndRoles()
    {
//        $inputFilms = [ "id"=>  1, "title" => "The Arms Dealer", "year_produced" =>  "2018-10-01", "type"=>  "horror" ];
        //this needs to be an array of arrays! otherweise -
//        1) Test_index::testSuccess1_displayFilmsAndRoles
        //Illegal string offset 'title' - code expected a nested array but i was sending it a normal array

//        ["id"]=> string(1) "2" ["title"]=> string(29) "Buddy's Budget Hitman Service" ["year_produced"]=> string(10) "2019-08-20" ["type"]=> string(5) "drama"

        $inputFilms = [
            [ 'id'=>  1, 'title' => 'The Arms Dealer', 'year_produced' =>  '2018-10-01', 'type' => 'horror' ],
            [ 'id'=>  2, 'title' => 'Buddy\'s Budget Hitman Service', 'year_produced' =>  '2019-08-20', 'type' => 'drama' ]
        ];
        $inputFilmRoles = [
            ["film-id"=> "1", "name"=>  "producer", "id"=> 1],
            ["film-id"=> "1", "name"=>  "writer", "id"=> 2],
            ["film-id"=> "1", "name"=>  "camera operator", "id"=> 6]
        ];
//        $expectedOutput = "<article class=\"container__film\"><h2>Film: The Arms Dealer</h2><p>Year Produced: 2018-10-01</p><p>Genre: horror</p><p>My Roles: </p><ul><li>producer</li><li>writer</li><li>camera operator</li></ul></article>";
        $expectedOutput = "<article class=\"container__film\"><h2>Film: The Arms Dealer</h2><p>ID: 1</p><p>Year Produced: 2018-10-01</p><p>Genre: horror</p><p>My Roles: </p><ul><li>producer</li><li>writer</li><li>camera operator</li></ul></article><article class=\"container__film\"><h2>Film: Buddy's Budget Hitman Service</h2><p>ID: 2</p><p>Year Produced: 2019-08-20</p><p>Genre: drama</p><p>My Roles: </p><ul></ul></article>";

        var_dump($inputFilms);
        $result = displayFilmsAndRoles($inputFilms, $inputFilmRoles);
        $this->assertEquals($expectedOutput, $result);
    }


// TEST w all correct data but no title eg field is empty , display  nothing  - need 1 failure fo each required field if field is empty or doesnt exist , sep tests eg if title is null, then show nothign for that one film instead of null
    public function testFailure1_displayFilmsAndRolesTitle()
    {
        //query actually gets everyting except  the titles - although it doesnt  actually output anything to html page - why?
        $inputFilms = [
            [ 'id'=>  1, 'titles' => 'The Arms Dealer', 'year_produced' =>  '2018-10-01', 'type' => 'horror' ],
            [ 'id'=>  2, 'titles' => 'Buddy\'s Budget Hitman Service', 'year_produced' =>  '2019-08-20', 'type' => 'drama' ]
        ];
        $inputFilmRoles = [
            ["film-id"=> "1", "name"=>  "producer", "id"=> 1],
            ["film-id"=> "1", "name"=>  "writer", "id"=> 2],
            ["film-id"=> "1", "name"=>  "camera operator", "id"=> 6]
        ];
        $expectedOutput = "<article class=\"container__film\"><h2>Film: </h2><p>ID: 1</p><p>Year Produced: 2018-10-01</p><p>Genre: horror</p><p>My Roles: </p><ul><li>producer</li><li>writer</li><li>camera operator</li></ul></article><article class=\"container__film\"><h2>Film: </h2><p>ID: 2</p><p>Year Produced: 2019-08-20</p><p>Genre: drama</p><p>My Roles: </p><ul></ul></article>";
        var_dump($inputFilms);
        $result = displayFilmsAndRoles($inputFilms, $inputFilmRoles);
        $this->assertEquals($expectedOutput, $result);
    }

    public function testMalformed_displayFilmsAndRolesTitle()
    {
        //query actually gets everyting except  the titles - although it doesnt  actually output anything to html page - why?
        $inputFilms = 'my new film';
        $inputFilmRoles = [
            ["film-id"=> "1", "name"=>  "producer", "id"=> 1],
            ["film-id"=> "1", "name"=>  "writer", "id"=> 2],
            ["film-id"=> "1", "name"=>  "camera operator", "id"=> 6]
        ];
//        $expectedOutput = "<article class=\"container__film\"><h2>Film: </h2><p>ID: 1</p><p>Year Produced: 2018-10-01</p><p>Genre: horror</p><p>My Roles: </p><ul><li>producer</li><li>writer</li><li>camera operator</li></ul></article><article class=\"container__film\"><h2>Film: </h2><p>ID: 2</p><p>Year Produced: 2019-08-20</p><p>Genre: drama</p><p>My Roles: </p><ul></ul></article>";
        $this->expectException(TypeError::class);
        $result = displayFilmsAndRoles($inputFilms, $inputFilmRoles);

//        echo '<br><br>Malformed $inputFilms';
//        var_dump($inputFilms);
//        $result = displayFilmsAndRoles($inputFilms, $inputFilmRoles);
//        echo '<br><br>Malformed $result';
//        var_dump($result);
//        $this->assertEquals($expectedOutput, $result);
    }

/*
 *
 * array(7) { [0]=> array(3) { ["film-id"]=> string(1) "1" ["name"]=> string(8) "producer" ["id"]=> string(1) "1" } [1]=> array(3) { ["film-id"]=> string(1) "1" ["name"]=> string(6) "writer" ["id"]=> string(1) "2" } [2]=> array(3) { ["film-id"]=> string(1) "1" ["name"]=> string(15) "camera operator" ["id"]=> string(1) "6" } [3]=> array(3) { ["film-id"]=> string(1) "2" ["name"]=> string(8) "producer" ["id"]=> string(1) "1" } [4]=> array(3) { ["film-id"]=> string(1) "2" ["name"]=> string(9) "co-writer" ["id"]=> string(1) "3" } [5]=> array(3) { ["film-id"]=> string(1) "2" ["name"]=> string(8) "first AD" ["id"]=> string(1) "7" } [6]=> array(3) { ["film-id"]=> string(1) "3" ["name"]=> string(9) "co-writer" ["id"]=> string(1) "3" } }
 */

//functions  to test for  Colletors App
//$result_films =  getAllFilmsWithoutRoles($db_name);
//$result_film_roles =  getAllRolesForFilms($db_name);
//echo displayFilmsAndRoles($result_films, $result_film_roles);

    // try one with assert contains key?

}

//<article class="container__film"><h2>Film: The Arms Dealer</h2><p>Year Produced: 2018-10-01</p><p>Genre: horror</p><p>My Roles: </p><ul><li>producer</li><li>writer</li><li>camera operator</li></ul></article>

/*
 *
 *
 * result_films
array(3) { [0]=> array(4) { ["id"]=> string(1) "1" ["title"]=> string(15) "The Arms Dealer" ["year_produced"]=> string(10) "2018-10-01" ["type"]=> string(6) "horror" } [1]=> array(4) { ["id"]=> string(1) "2" ["title"]=> string(29) "Buddy's Budget Hitman Service" ["year_produced"]=> string(10) "2019-08-20" ["type"]=> string(5) "drama" } [2]=> array(4) { ["id"]=> string(1) "3" ["title"]=> string(7) "Clap On" ["year_produced"]=> string(10) "2020-05-09" ["type"]=> string(6) "comedy" } }

result_film_roles
array(7) { [0]=> array(3) { ["film-id"]=> string(1) "1" ["name"]=> string(8) "producer" ["id"]=> string(1) "1" } [1]=> array(3) { ["film-id"]=> string(1) "1" ["name"]=> string(6) "writer" ["id"]=> string(1) "2" } [2]=> array(3) { ["film-id"]=> string(1) "1" ["name"]=> string(15) "camera operator" ["id"]=> string(1) "6" } [3]=> array(3) { ["film-id"]=> string(1) "2" ["name"]=> string(8) "producer" ["id"]=> string(1) "1" } [4]=> array(3) { ["film-id"]=> string(1) "2" ["name"]=> string(9) "co-writer" ["id"]=> string(1) "3" } [5]=> array(3) { ["film-id"]=> string(1) "2" ["name"]=> string(8) "first AD" ["id"]=> string(1) "7" } [6]=> array(3) { ["film-id"]=> string(1) "3" ["name"]=> string(9) "co-writer" ["id"]=> string(1) "3" } }
 *
 */
