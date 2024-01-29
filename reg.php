<?php
session_start();
require_once("connect.php");

if (isset ($_POST['login']))
{
  $login=$_POST['login'];
  $pwd=$_POST['pwd'];
  $phone=$_POST['phone'];
  $query="select * from user where login='{$login}'";
  $result=$mysqli->query($query);
  if($result->num_rows>0)
  {
    ?>
    <script>
      alert ('Такой пользователь уже существует, придумайте другой логин');
    </script>
    <?php
  }
  else
  {
    $query="insert into user value (NULL, '{$_POST['login']}', '{$_POST['pwd']}', '{$_POST['phone']}')";
    $mysqli->query($query);
    $_SESSION['user_id']=$mysqli->insert_id;
    header("Location: reg.php");

    $_SESSION['login']=$_POST['login'];
    ?>

    <script>
      alert ('Вы успешно зарегестрировались');
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
    <p>Телефон <input type="tel" name="phone"></p>
    <p><input type="submit" value="Регистрация" class="btn"></p>
  </form>
</div>

<?php
require_once("assets/footer.php");
?>