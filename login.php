<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        p {
            text-align: center;
            color: #555;
        }

        a {
            color: #4caf50;
        }
        
        a:hover {
            color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Iniciar Sesion</h1>
    <form action="login.php" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>

    <p>¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a></p>
   
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
        $email = $_POST['email'];
        $password = $_POST['password'];

        try {
            $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email, $password]);
            $user = $stmt->fetch();

            if ($user) {
                session_start();
                $_SESSION['user'] = $user;
                header('Location: abilities.php');
                exit;
            } else {
                echo 'Datos no validos.';
            }
        } catch (PDOException $e) {
            echo 'Error al iniciar sesión: ' . $e->getMessage();
        }
    }
    ?>
</body>
</html>
