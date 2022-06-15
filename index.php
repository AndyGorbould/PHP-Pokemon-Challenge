<?php
print_r("I selected ID#: " . $_POST['name']); // shows user's input after submitted

$url = 'https://pokeapi.co/api/v2/pokemon/' . $_POST['name'];
$result = file_get_contents($url); // fetch json
$pokemonData = json_decode($result, true); // decode json


        $pokemonImage = ($pokemonData["sprites"]["front_default"]); // fetch image url from JSON
        $pokemonName = ($pokemonData["name"]); // fetch name from JSON
        $pokemonMoves = ($pokemonData["moves"]);

                // $movesArr = array("");
                
                // for ($i=0; $i < 10; $i++) { 
                //     array_push($movesArr, $pokemonMoves[$i]["move"]);
                //     print_r("<p>All Moves: " . $movesArr[$i]["name"] .  "</p>");
                // }
                    //    $pokemonMovesSingle = ($pokemonMoves[0]["move"]["name"]);



// SPECIES
$urlSpecies = ($pokemonData["species"]["url"]); // fetch species api
$resultSpecies = file_get_contents($urlSpecies);
$pokemonDataSpecies = json_decode($resultSpecies, true);


// EVOLUTION
$urlSpeciesEvo = ($pokemonDataSpecies["evolution_chain"]["url"]); // fetch evo api
$resultSpeciesEvo = file_get_contents($urlSpeciesEvo);
$pokemonDataSpeciesEvo = json_decode($resultSpeciesEvo, true);


// EVOLUTION if-loop
function evolutionList() {

$evoList = array("");
$evoID = array("");
if (count($pokemonDataSpeciesEvo["chain"]["evolves_to"]) === 0) {
    array_push($evoList, $pokemonDataSpeciesEvo["chain"]["species"]["name"]);
    array_push($evoID, $pokemonDataSpeciesEvo["chain"]["species"]["id"]);
    // check if 2nd
    if (count($pokemonDataSpeciesEvo["chain"][0]["evolves_to"]) !== undefined) {
        array_push($evoList, $pokemonDataSpeciesEvo["chain"][0]["evolves_to"]["species"]["name"]);
        array_push($evoID, $pokemonDataSpeciesEvo["chain"][0]["evolves_to"]["species"]["url"]);
        }
        // check if 3rd
        if (count($pokemonDataSpeciesEvo["chain"][0]["evolves_to"][0]["evolves_to"]) !== undefined) {
            array_push($evoList, $pokemonDataSpeciesEvo["chain"][0]["evolves_to"][0]["evolves_to"]["species"]["name"]);
            array_push($evoID, $pokemonDataSpeciesEvo["chain"][0]["evolves_to"][0]["evolves_to"]["species"]["url"]);
            }

}
return $evoList;
}







print_r("<img src=" . $pokemonImage .  ">"); // image URL inserted
print_r("<h1>This wee hing is called " . ucwords($pokemonName) .  "</h1>");
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
        Select<input type="submit" id="btnNumbInput" value="submit">
    </form>


    <!-- <h2 style="color: red;"> <?php echo $evoList; ?> evo</h2>
    <h2 style="color: red;"> <?php echo $evoList[1]; ?> evo</h2>
    <h2 style="color: red;"> <?php echo $evoList[2]; ?> evo</h2> -->
    

    <!-- Printing moves from API to HTML :) -->
    <ul>Moves:
        <?php
        $movesArr = array("");
                    
                    for ($i=1; $i < 10; $i++) { 
                        array_push($movesArr, $pokemonMoves[$i]["move"]);
                        print_r("<li>" . $movesArr[$i]["name"] .  "</li>");
                    }
        ?>
    </ul>
    <!-- ^^^^^^ -->


</body>

</html>