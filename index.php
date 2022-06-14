<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX Pokédex</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="everything">

        <img class="logo" src="./img/pokemon_logo.webp" alt="Pokémon">


        <!-- user input text boxes -->
        <input class="input" id="userNumbInput" type="text" maxlength="12" placeholder="NAME or ID (1-898)">
        <button class="input" id="btnNumbInput">Select</button>


        <!-- display name -->
        <div clas="info" id="nameDisplay">

        </div>




        <div class="info">
            <!-- <p>This has been heavily modified from https://www.youtube.com/watch?v=XL68br6JyYs </p> -->
        </div>

        <!-- test button -->
        <!-- <button type="button" onclick="loadDoc()">Change Content</button> -->


    </div>

    <!-- PHP Script -->
    <?php
    // button
    $dom = new DOMDocument;
    $run = $dom->getElementById("btnNumbInput");

    function userNumberInputFunc()
    {
        // number (user)
        $userNumbInputVal = $dom->getElementById("userNumbInput");

        $i = (int)readline($userNumbInputVal);
        getPokemon($i);
    };

    $selectedDisplay = $dom->getElementById("nameDisplay");
    $pokemons_number = 20;
    $colors = array(
        "fire:" => '#FDDFDF',
        "grass:" => '#DEFDE0',
        "electric:" => '#FCF7DE',
        "water:" => '#DEF3FD',
        "ground:" => '#f4e7da',
        "rock:" => '#d5d5d4',
        "fairy:" => '#fceaff',
        "poison:" => '#98d7a5',
        "bug:" => '#f8d5a3',
        "dragon:" => '#97b3e6',
        "psychic:" => '#eaeda1',
        "flying:" => '#F5F5F5',
        "fighting:" => '#E6E0D4',
        "normal:" => '#F5F5F5',
    );




    // getPokemon = 

    // $url = 'https://pokeapi.co/api/v2/pokemon/' . $id . '';
    $url = 'https://pokeapi.co/api/v2/pokemon/1';

    $result = file_get_contents($url);
    $pokemonData = json_decode($result, true);

    // $speciesUrl = ($pokemonData['species']['url']);
    $speciesUrl = ($pokemonData["species"]["url"]);


    var_dump($speciesUrl);








    ?>
</body>

</html>