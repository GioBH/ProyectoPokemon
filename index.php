<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon List</title> 
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #f03939;
            text-align: center;
        }

        #pokemon-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        div {
            margin-bottom: 10px;
        }

        a {
            display: block;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
        }
        
        a:hover {
            background-color: #45a049;
        }

        p {
            text-align: center;
            margin-top: 20px;
        }
        a.register-link {
            color: #f2f2f2;
            max-width: 120px;
            margin: 20px auto;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
        a.register-link:hover {
            color: #f2f2f2;
            max-width: 200px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Lista de Pokemon</h1>
    <div id="pokemon-container">

         <?php
      
        $dsn = 'mysql:host=localhost;dbname=bd_pokemon';
        $username = 'root';
        $db_password = '';
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
            $pdo = new PDO($dsn, $username, $db_password, $options);
        } catch (PDOException $e) {
            echo 'Error de conexión: ' . $e->getMessage();
        }

        function fetchPokemonList() {
            $url = 'https://pokeapi.co/api/v2/pokemon/';
            $response = file_get_contents($url);
            $data = json_decode($response, true);
            return $data['results'];
        }

        $listaPokemon = fetchPokemonList();
        foreach ($listaPokemon as $pokemon) {
            $name = $pokemon['name'];
            echo "<div><a href='abilities.php?name=$name'>$name</a></div>";
        }
        ?>  
    </div>

    <p>¿No tienes una cuenta? <a class="register-link" href="register.php">Regístrate aquí</a></p>

</body>
</html>
