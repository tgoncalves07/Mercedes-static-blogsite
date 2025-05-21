<!DOCTYPE html>
<html lang="pt">
<meta charset="UTF-8" />
<title>Minha Conta</title>
<style>
  h2 {
    color: #00d2be;
    text-align: center;
    margin-bottom: 30px;
    margin-top: 0px;
    font-size: 2.5em;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
  }

  ul {
    list-style-type: none;
    padding: 0;
  }

  li {
    margin-bottom: 20px;
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 15px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s;
  }

  li:hover {
    transform: scale(1.02);
  }

  .ano {
    font-weight: bold;
    font-size: 1.5em;
    color: #00d2be;
    margin-bottom: 10px;
  }

  section {
    padding: 50px;
    padding-top: 0px;
  }

  form {
    margin-top: 10px;
  }

  input[type="text"],
  input[type="email"],
  input[type="password"] {
    padding: 5px;
    margin: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
  }

  input[type="submit"] {
    padding: 5px 15px;
    background-color: #00d2be;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  input[type="submit"]:hover {
    background-color: #00b3a1;
  }
</style>
<link rel="stylesheet" href="style.css">
</head>

<body>
  <iframe src="header.php" frameborder="0" style="width: 100%"></iframe>
  <section>
    <h2>Minha Conta</h2>
    <ul>
      <?php
      $mensagemErro = '';
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "utilizadores";
      $conn = mysqli_connect($servername, $username, $password, $dbname);
      if ($conn->connect_error) {
        die("Conexão falhou: " . mysqli_connect_error());
        ;
      }

      if (isset($_GET['delete'])) {
        $email = $conn->real_escape_string($_GET['delete']);
        $conn->query("DELETE FROM utilizadores WHERE email = '$email'");
        echo "<p>Registo eliminado com sucesso!</p>";
      }

      if (isset($_POST['update'])) {
        $nome = $conn->real_escape_string($_POST['nome']); //real_escape_string (escapa os caracteres especiais)
        $email = $conn->real_escape_string($_POST['email']);
        $pass = $conn->real_escape_string($_POST['pass']);
        $email_original = $conn->real_escape_string($_POST['email_original']);
        $conn->query("UPDATE utilizadores SET nome='$nome', email='$email', pass='$pass' WHERE email='$email_original'"); // NOME, EMAIL, PASS
        echo "<p>Registo atualizado com sucesso!</p>";
      }

      $result = $conn->query("SELECT * FROM utilizadores");
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<li>";
          echo "<div class='ano'>" . $row['nome'] . "</div>";
          echo "<div>Email: " . $row['email'] . "</div>";
          echo "<div>Senha: " . $row['pass'] . "</div>";
          echo "<form method='POST'>";
          echo "<br>Nome:";
          echo "<input type='hidden' name='email_original' value='" . $row['email'] . "'>";
          echo "<input type='text' name='nome' value='" . $row['nome'] . "' required>";
          echo "Email:";
          echo "<input type='email' name='email' value='" . $row['email'] . "' required>";
          echo "Password:";
          echo "<input type='text' name='pass' value='" . $row['pass'] . "' required>";
          echo "<br>";
          echo "<input type='submit' name='update' value='Atualizar'>";
          echo "</form>";
          echo "<form method='GET' onsubmit=\"return confirm('Tem a certeza que deseja eliminar?');\">";
          echo "<input type='hidden' name='delete' value='" . $row['email'] . "'>";
          echo "<input type='submit' value='Eliminar'>";
          echo "</form>";
          echo "</li>";
        }
      } else {
        echo "<li>Nenhum utilizador encontrado.</li>";
      }

      $conn->close();
      ?>
    </ul>
  </section>
</body>

</html>