<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/////////////////////////////////////
var_dump($_POST);
if (isset($_POST["name"])) {
    print_r("I selected ID#: " . $_POST["name"] . ""); // shows user's input after submitted
} else {
    echo "helllloo";
    $_POST["name"] = "100";
}

$url = 'https://pokeapi.co/api/v2/pokemon/' . $_POST["name"];
$result = file_get_contents($url); // fetch json
$pokemonData = json_decode($result, true); // decode json


$pokemonImage = ($pokemonData["sprites"]["front_default"]); // fetch image url from JSON
$pokemonName = ($pokemonData["name"]); // fetch name from JSON
$pokemonMoves = ($pokemonData["moves"]);



// SPECIES
$urlSpecies = ($pokemonData["species"]["url"]); // fetch species api
$resultSpecies = file_get_contents($urlSpecies);
$pokemonDataSpecies = json_decode($resultSpecies, true);



// EVOLUTION
$urlSpeciesEvo = ($pokemonDataSpecies["evolution_chain"]["url"]); // fetch evo api
$resultSpeciesEvo = file_get_contents($urlSpeciesEvo);
$pokemonDataSpeciesEvo = json_decode($resultSpeciesEvo, true);
$evoList = array("");
$evoID = array("");
if (count($pokemonDataSpeciesEvo["chain"]["evolves_to"]) == 0) {
    array_push($evoList, $pokemonDataSpeciesEvo["chain"]["species"]["name"]);
    array_push($evoID, $pokemonDataSpeciesEvo["chain"]["species"]["id"]);
    echo "first if passed";
    // check if 2nd
} else {
    if (isset($pokemonDataSpeciesEvo["chain"][0]["evolves_to"])) {
        array_push($evoList, $pokemonDataSpeciesEvo["chain"][0]["evolves_to"]["species"]["name"]);
        array_push($evoID, $pokemonDataSpeciesEvo["chain"][0]["evolves_to"]["species"]["url"]);
        echo "2nd if passed";
    }
    // check if 3rd
    if (isset($pokemonDataSpeciesEvo["chain"][0]["evolves_to"][0]["evolves_to"])) {
        array_push($evoList, $pokemonDataSpeciesEvo["chain"][0]["evolves_to"][0]["evolves_to"]["species"]["name"]);
        array_push($evoID, $pokemonDataSpeciesEvo["chain"][0]["evolves_to"][0]["evolves_to"]["species"]["url"]);
        echo "3rd if passed";
    }
}




print_r("<img src=" . $pokemonImage .  ">"); // image URL inserted
print_r("<h3>This wee hing is called:<h2>" . ucwords($pokemonName) .  "</h2></h3>");
// print_r("<h1>Moves: " . $pokemonMovesSingle .  "</h1>");
// echo $pokemonMovesSingle;

// abilities:
// $pokemonData["abilities"]["ability"][0]





?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Pokemon Challenge</title>
</head>

<body>

    <form action="" method="post">
        NAME or ID (1-898): <input class="input" id="userNumbInput" type="text" maxlength="12" name="name" value="">
        <br>
        <input type="submit" id="btnNumbInput" value="submit">
    </form>



    <!-- Printing moves from API to HTML :) -->
    <ul>Moves:
        <?php
        $movesArr = array("");

        for ($i = 1; $i < 10; $i++) {
            array_push($movesArr, $pokemonMoves[$i]["move"]["name"]);
            print_r("<li>" . $movesArr[$i] .  "</li>");
        }
        ?>
    </ul>
    <!-- ^^^^^^ -->

    <h2>Evolutions</h2>
    <?php var_dump($evoList); ?>






    <!-- TIME & DATE (for fun) -->
    <?php
    echo "<h3>Today is " . date("H:i:s d/m/Y") . "</h3>";
    ?>


</body>

</html>