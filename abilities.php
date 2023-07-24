<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['name'])) {
    header('Location: index.php');
    exit;
}

$pokemonName = $_GET['name'];

function fetchPokemonAbilities($name) {
    $url = "https://pokeapi.co/api/v2/pokemon/$name/";
    $response = file_get_contents($url);
    $data = json_decode($response, true);
    return $data;
}

$pokemonAbilities = fetchPokemonAbilities($pokemonName);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Abilities</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        a {
            color: #4caf50;
            text-decoration: none;
            margin-left: 20px;
        }

        a:hover {
            color: #45a049;
        }

        h1 {
            color: #f03939;
            text-align: center;
        }
       
        .page-title {
            color: #f03939;
            text-align: center;
        }

        #abilities-container {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }

        .pokemon-name {
            color: #4caf50;
        }

        .pokemon-image {
            max-width: 200px;
            margin: 10px auto;
            display: block;
        }

        .pokemon-abilities {
            color: #333;
        }

        
        button[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin: 10px;
        }

        #cerrar-sesion {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            text-align: center;
        }
    </style>

</head>
<body>

    <p><a href="index.php">Regresar</a></p>

        <h1>Habilidades del Pokemon</h1>
    <div id="abilities-container">
        <h2>Nombre: <?php echo $pokemonAbilities['name']; ?></h2>
        <img src="<?php echo $pokemonAbilities['sprites']['front_default']; ?>" width="150" alt="Pokémon Image">
        <p>Habilidades:
        <?php
            foreach ($pokemonAbilities['abilities'] as $abilityData) {
                echo $abilityData['ability']['name'] . ', ';
            }
        ?>
        </p>
    </div>

    <div id="cerrar-sesion">
        <form action="logout.php" method="post">
        <button type="submit">Cerrar sesión</button>
    </form>

    </div>

</body>
</html>
