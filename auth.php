<?php
session_start();
require_once("connect.php");

if (isset ($_POST['login']))
{
  $login=$_POST['login'];
  $pwd=$_POST['pwd'];
  $query="select * from user where login='{$login}' and pwd='{$pwd}'";
  $result=$mysqli->query($query);
  if($result->num_rows>0)
  {
    $row=$result->fetch_assoc();
    $_SESSION['user_id']=$row['user_id'];
    $_SESSION['login']=$row['login'];
    ?>
    <script>
      alert ("Вы успешно авторизировались");
    </script>
    <?php
  }
  else
  {
    ?>
    <script>
      alert ("Введенные данные пользователя не найдены");
    </script>
    <?php
  }
}

require_once("assets/header.php");
?>

<div>
  <form action="#" method="post">
    <p>Логин <input type="text" name="login"></p>
    <p>Пароль <input type="password" name="pwd"></p>
    <p><input type="submit" value="Вход" class="btn"></p>
  </form>
</div>

<?php
require_once("assets/footer.php");
?>