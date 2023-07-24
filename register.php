<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        p {
            text-align: left;
            margin-left: 20px;
        }

        a {
            color: #4caf50;
            text-decoration: none;
        }

        a:hover {
            color: #45a049;
        }

        h1 {
            color: #f03939;
            text-align: center;
        }

        form {
            width: 300px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #fff;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 93%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            width: 100%;        
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

    </style>

</head>
<body>

<p><a href="index.php">Regresar</a></p>

    <h1>Registro</h1>
    <form action="register.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Registrar</button>
    </form>

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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        try {
            $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $email, $password]);
            echo 'Registro exitoso. Ahora puedes <a href="login.php">iniciar sesión</a>.';
        } catch (PDOException $e) {
            echo 'Error al registrar el usuario: ' . $e->getMessage();
        }
    }
    ?>
</body>
</html>
