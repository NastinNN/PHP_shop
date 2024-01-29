<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Мой магазин</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header class="header">
  <div class="container">
    <ul class="nav">
      <div class="nav__left">
        <li class="nav__list">
          <a class="nav__link" href="index.php">Главная</a>
        </li>
      </div>

      <div class="nav__right">
        <li class="nav__list">
          <a class="nav__link" href="cart.php"><img src='../db-cards/image/cart.png' width='40' height='40'></a>
        </li>

        <li class="nav__list">
          <form action="#" method="post">
            <input type="submit" value="Очистить" name="destroy" class="btn">
          </form>
        </li>

        <?php
          if (isset($_SESSION['login']))
          {
            echo "<li class='nav__list'>
                  <a class='nav__user nav__link' href='lk.php'>
                  <img src='../db-cards/image/user.png' width='40' height='40'>
                  {$_SESSION['login']}</a>
                  </li>";
          }
          else {
            echo "<li class='nav__list'>
                <a class='nav__link' href='auth.php'>Вход</a>
                </li>";
            echo '<li class="nav__list">
                <a class="nav__link" href="reg.php">Регистрация</a>
                </li>';
          }
        ?>
      </div>
    </ul>
  </div>

  <?php
  if (isset($_POST['destroy']))
  {
    session_destroy();
    ?>
    <script>
      alert("Корзина очищена");
    </script>
    <?php
  }
  ?>
</header>
<div class="container">