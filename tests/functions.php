<?php
require '../functions.php';
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Error;

class Functions extends TestCase
{

    public function testSuccess1_displayFilmsAndRoles()
    {
        $inputFilms = [
            [ 'id'=>  1, 'title' => 'The Arms Dealer', 'year_produced' =>  '2018-10-01', 'type' => 'horror' ],
            [ 'id'=>  2, 'title' => 'Buddy\'s Budget Hitman Service', 'year_produced' =>  '2019-08-20', 'type' => 'drama' ]
        ];
        $inputFilmRoles = [
            ["film-id"=> "1", "name"=>  "producer", "id"=> 1],
            ["film-id"=> "1", "name"=>  "writer", "id"=> 2],
            ["film-id"=> "1", "name"=>  "camera operator", "id"=> 6]
        ];
        $expectedOutput = '<article class="container__film"><h2>Film: The Arms Dealer</h2><p>Year Produced: 2018-10-01</p><p>Genre: horror</p><p>My Roles: </p><ul><li>producer</li><li>writer</li><li>camera operator</li></ul></article><article class="container__film"><h2>Film: Buddy\'s Budget Hitman Service</h2><p>Year Produced: 2019-08-20</p><p>Genre: drama</p><p>My Roles: </p><ul></ul></article>';
        $result = displayFilmsAndRoles($inputFilms, $inputFilmRoles);
        $this->assertEquals($expectedOutput, $result);
    }

    /**
     * Tests for Failure if the required field 'id' is spelled incorrectly ie doesnt exist - if other fields are mis-spelled (eg year or type) then their value is shown as blank, as a film without an id or title should not be shown at all
     */
    public function testFailure1_displayFilmsAndRolesWrongId()
    {
        $inputFilms = [
            [ 'ids'=>  1, 'title' => 'The Arms Dealer', 'year_produced' =>  '2018-10-01', 'type' => 'horror' ],
            [ 'ids'=>  2, 'title' => 'Buddy\'s Budget Hitman Service', 'year_produced' =>  '2019-08-20', 'type' => 'drama' ]
        ];
        $inputFilmRoles = [
            ["film-id"=> "1", "name"=>  "producer", "id"=> 1],
            ["film-id"=> "1", "name"=>  "writer", "id"=> 2],
            ["film-id"=> "1", "name"=>  "camera operator", "id"=> 6]
        ];
        $expectedOutput = '';
        $result = displayFilmsAndRoles($inputFilms, $inputFilmRoles);
        $this->assertEquals($expectedOutput, $result);
    }

    /**
     * Tests for Failure if the required field 'title' is spelled incorrectly ie doesnt exist - if other fields are mis-spelled (eg year or type) then their value is shown as blank, as a film without an id or title should not be shown at all
     */
    public function testFailure1_displayFilmsAndRolesWrongTitle()
    {
        $inputFilms = [
            [ 'id'=>  1, 'titles' => 'The Arms Dealer', 'year_produced' =>  '2018-10-01', 'type' => 'horror' ],
            [ 'id'=>  2, 'titles' => 'Buddy\'s Budget Hitman Service', 'year_produced' =>  '2019-08-20', 'type' => 'drama' ]
        ];
        $inputFilmRoles = [
            ["film-id"=> "1", "name"=>  "producer", "id"=> 1],
            ["film-id"=> "1", "name"=>  "writer", "id"=> 2],
            ["film-id"=> "1", "name"=>  "camera operator", "id"=> 6]
        ];
        $expectedOutput = '';
        $result = displayFilmsAndRoles($inputFilms, $inputFilmRoles);
        $this->assertEquals($expectedOutput, $result);
    }

    /**
     * Tests for Failure if the required field film role 'name' in the linking table is spelled incorrectly
     */
    public function testFailure1_displayFilmsAndRolesWrongRoleName()
    {
        $inputFilms = [
            [ 'id'=>  1, 'title' => 'The Arms Dealer', 'year_produced' =>  '2018-10-01', 'type' => 'horror' ],
            [ 'id'=>  2, 'title' => 'Buddy\'s Budget Hitman Service', 'year_produced' =>  '2019-08-20', 'type' => 'drama' ]
        ];
        $inputFilmRoles = [
            ["film-id"=> "1", "names"=>  "producer", "id"=> 1],
            ["film-id"=> "1", "names"=>  "writer", "id"=> 2],
            ["film-id"=> "1", "names"=>  "camera operator", "id"=> 6]
        ];
       $expectedOutput = '<article class="container__film"><h2>Film: The Arms Dealer</h2><p>Year Produced: 2018-10-01</p><p>Genre: horror</p><p>My Roles: </p><ul></ul></article><article class="container__film"><h2>Film: Buddy\'s Budget Hitman Service</h2><p>Year Produced: 2019-08-20</p><p>Genre: drama</p><p>My Roles: </p><ul></ul></article>';
        $result = displayFilmsAndRoles($inputFilms, $inputFilmRoles);
        $this->assertEquals($expectedOutput, $result);
    }

    /**
     * Tests for Malformed input of string instead of expected array for $inputFilms[]
     */
    public function testMalformed1_displayFilmsAndRoles()
    {
        $inputFilms = 'my new film';
        $inputFilmRoles = [
            ["film-id"=> "1", "name"=>  "producer", "id"=> 1],
            ["film-id"=> "1", "name"=>  "writer", "id"=> 2],
            ["film-id"=> "1", "name"=>  "camera operator", "id"=> 6]
        ];
        $this->expectException(TypeError::class);
        $result = displayFilmsAndRoles($inputFilms, $inputFilmRoles);
    }

    /**
     * Tests for Malformed input of int instead of expected array for $inputFilmRoles[]
     */
    public function testMalformed2_displayFilmsAndRoles()
    {
        $inputFilms = [
            [ 'id'=>  1, 'titles' => 'The Arms Dealer', 'year_produced' =>  '2018-10-01', 'type' => 'horror' ],
            [ 'id'=>  2, 'titles' => 'Buddy\'s Budget Hitman Service', 'year_produced' =>  '2019-08-20', 'type' => 'drama' ]
        ];
        $inputFilmRoles = 222;
        $this->expectException(TypeError::class);
        $result = displayFilmsAndRoles($inputFilms, $inputFilmRoles);
    }

}