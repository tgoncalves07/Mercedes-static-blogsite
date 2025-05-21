<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Header - Mercedes AMG F1</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    .menu-open {
      transform: translateX(0);
      opacity: 1;
    }

    .menu-icon {
      font-size: 30px;
      cursor: pointer;
      transition: transform 0.3s ease;
    }

    .menu-icon:hover {
      transform: scale(1.2);
    }

    h1 {
      font-size: 28px;
      margin: 0;
      color: white;
      transition: color 0.5s ease;
    }

    h1:hover {
      color: black;
    }

    header {
      background-color: #00d2be;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 40px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      border-bottom: 5px solid #ffd700;
      position: relative;
      overflow: hidden;
    }

    nav {
      position: absolute;
      top: 0;
      right: 0;
      background-color: #00d2be;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      border-radius: 5px;
      height: 100%;
      width: 100%;
      transform: translateX(100%);
      opacity: 0;
      transition: transform 0.5s ease, opacity 0.5s ease;
      display: flex;
      justify-content: flex-end;
      align-items: center;
    }

    nav ul {
      display: flex;
      list-style-type: none;
      padding: 0;
      margin: 0;
    }

    nav ul li {
      margin: 0;
      padding: 0 20px;
    }

    nav ul li a {
      text-decoration: none;
      color: black;
      font-size: 18px;
      font-weight: bold;
      background-color: transparent;
      transition: color 0.3s;
    }

    nav ul li a:hover {
      color: rgb(131, 131, 131);
      background-color: transparent;
    }
  </style>
</head>


<body>
  <header>
    <h1>Mercedes-AMG Petronas Formula One Team</h1>
    <span class="menu-icon" id="menuIcon">
      <img src="https://img.icons8.com/ios/50/000000/formula-1.png" alt="Carro F1" />
    </span>

    <nav id="menu">
      <ul>
        <li><a href="index.html" target="contentFrame">Inicio</a></li>
        <li><a href="Historia.html" target="contentFrame">Historia</a></li>
        <li><a href="Equipas.html" target="contentFrame">Equipas</a></li>
        <li><a href="Carros.html" target="contentFrame">Carros</a></li>
        <li><a href="Titulos.html" target="contentFrame">Titulos</a></li>
        <?php
        if (isset($_COOKIE["user"])) {
          echo '<li><a href="account.php" target="contentFrame">Conta</a></li>';
        } else {
          echo '<li><a href="log.php" target="contentFrame">Login</a></li>';
        }
        ?>
      </ul>
    </nav>
  </header>

  <script src="script.js"></script>
</body>

</html>