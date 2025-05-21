<?php
$mensagemErro = '';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "utilizadores";

// Conexão
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

if (isset($_GET['email']) && isset($_GET['password'])) {
    $email = $_GET['email'];
    $password = $_GET['password'];

    // Consultar a db
    $query = "SELECT * FROM utilizadores WHERE email = '$email' AND pass = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        setcookie("user", $email, time() + 3600, "/");
        header("Location: index.html");
        exit();
    } else {
        $mensagemErro = "Login inválido, registe a sua conta.";
    }
}

if (isset($_COOKIE["user"])) {
    header("Location: index.html");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-image: url(f/background.png);
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        h2 {
            text-align: center;
            color: #00d2be;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="email"],
        input[type="password"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #00d2be;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #008f99;
        }

        .link {
            text-align: center;
            color: #00d2be;
            text-decoration: none;
        }

        .link:hover {
            text-decoration: underline;
        }

        img {
            width: 100px;
            margin: 20px auto;
            display: block;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <iframe src="header.php" frameborder="0" style="width: 100%; height: 101.5px"></iframe>
    <div class="container">
        <h2>Login</h2>
        <img src="f/mercedeslogo.png" alt="Mercedes Logo" />

        <?php if (!empty($mensagemErro)): ?>
            <p class="error-message"><?php echo htmlspecialchars($mensagemErro); ?></p>
        <?php endif; ?>

        <form action="" method="GET">
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Senha" required />
            <button type="submit">Entrar</button>
        </form>
        <p style="text-align: center; margin-top: 10px">
            Não tem uma conta? <a href="registo.php" class="link">Registre-se</a>
        </p>
    </div>
</body>

</html>