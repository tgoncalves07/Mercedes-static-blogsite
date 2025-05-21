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

if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['termos'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verificar o email
    $query = "SELECT * FROM utilizadores WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $mensagemErro = "Este e-mail já está registrado!";
    } else {
        // Inserir
        $insertQuery = "INSERT INTO utilizadores (nome, email, pass) VALUES ('$nome', '$email', '$password')";
        if (mysqli_query($conn, $insertQuery)) {
            header("Location: log.php");
            exit();
        } else {
            $mensagemErro = "Erro ao registrar o utilizador: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registro</title>
    <link rel="stylesheet" href="style.css" />
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

        input[type="text"],
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

        .additional-fields {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .checkbox-container,
        .radio-container {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        input[type="checkbox"],
        input[type="radio"] {
            width: 16px;
            height: 16px;
        }
    </style>
</head>

<body>
    <iframe src="header.php" frameborder="0" style="width: 100%; height: 101.5px"></iframe>
    <div class="container">
        <h2>Registro</h2>
        <img src="f/mercedeslogo.png" alt="Mercedes Logo" />

        <?php if (!empty($mensagemErro)): ?>
            <p class="error-message"><?php echo htmlspecialchars($mensagemErro); ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <input type="text" name="nome" placeholder="Nome" required />
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Senha" required />

            <div class="additional-fields">
                <div class="checkbox-container">
                    <input type="checkbox" id="termos" name="termos" required />
                    <label for="termos">
                        Aceito os <a href="termos.html" target="_blank">termos e condições</a>
                    </label>
                </div>

                <div class="radio-container">
                    <input type="radio" id="basica" name="subscricao" value="basica" required />
                    <label for="basica">Subscrição Básica</label>
                </div>

                <div class="radio-container">
                    <input type="radio" id="premium" name="subscricao" value="premium" />
                    <label for="premium">Subscrição Premium</label>
                </div>
            </div>

            <button type="submit">Registrar</button>
        </form>
        <p style="text-align: center; margin-top: 10px">
            Já tem uma conta? <a href="log.php" class="link">Login</a>
        </p>
    </div>
</body>

</html>