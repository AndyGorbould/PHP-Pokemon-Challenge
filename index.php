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

    <?php
    print_r("I selected: " . $_POST['name']); // shows user's input after submitted

    $url = 'https://pokeapi.co/api/v2/pokemon/' . $_POST['name'];

    $result = file_get_contents($url);
    $pokemonData = json_decode($result, true);

    // $speciesUrl = ($pokemonData["species"]["url"]);

    $pokemonImage = ($pokemonData["sprites"] ["front_default"]); // fetch image url from JSON
    $pokemonName = ($pokemonData["name"]); // fetch name from JSON

    // var_dump($speciesUrl);
    // var_dump($pokeImage);
    print_r("<img src=" . $pokemonImage .  ">"); // image URL inserted
    print_r("<p>This wee hing is called " . $pokemonName .  "</p>");


    

    ?>


<img src="" alt="">


</body>

</html>