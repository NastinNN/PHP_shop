<?php
session_start();
require_once("assets/header.php");
require_once("connect.php");
?>
<div class="cart">
<table class="table" cellpadding="10">
  <?php
 if (isset($_SESSION['cart']))
 {
  $itogo=0;
  echo "<tr><th>Наименование товара<th>Количество<th>Стоимость<th>Удалить</tr>";
   foreach ($_SESSION['cart'] as $articul=>$quantity)
   {
    $query="select articul,naim_tovar,price from tovar where articul='{$articul}'";
    $result=$mysqli->query($query);
    $row=$result->fetch_assoc();
    $sum=$quantity*$row['price'];
    echo "<tr><td>{$row['naim_tovar']}<td>{$quantity}<td>{$sum}";
    echo "<td><form action='#' method='post'>
    <input type='hidden' name='articul' value='{$row['articul']}'>
    <button type='submit' name='delete' class='btn'>Удалить</button>
    </form></tr>";
    $itogo+=$sum;
   }
   if (isset($_POST['delete']))
   {
      unset($_SESSION['cart'][$_POST['articul']]);
      header("Location: cart.php");
   }
 ?>
 <tr><td colspan=2><b>Итоговая сумма вашего заказа</b><td><b><?= $itogo ?></b></tr>
 </table>

 <form action="#" method="post">
  <input type="submit" name="buy" value="Оформить заказ" class="btn">
 </form>
   <?php
   if (isset($_POST['buy'])) 
   {
    if (isset($_SESSION['user_id']))
    {
      $query="select max(order_id) as max_order_id from ordershop";
      $result=$mysqli->query($query);
      $row=$result->fetch_assoc();
      $order_id=$row['max_order_id']+1;

      foreach ($_SESSION['cart'] as $articul=>$quantity)
      {
        $query="insert into ordershop (order_id, articul, user_id, quantity) values ('{$order_id}','{$articul}','{$_SESSION['user_id']}','{$quantity}')";
        $mysqli->query($query);
      }
      if ($mysqli->affected_rows>0)
        {
        unset($_SESSION['cart']);
        ?>
        <!-- <script>
        alert("Заказ успешно оформлен");
        </script> -->
        <?php
        }
        header("Location: cart.php");
    }
    else
    {
      ?>
      <script>
        alert("Для оформления заказа войдите или зарегестрируйтесь");
      </script>

      <a href="auth.php" class="btn-link">Вход</a>
      <a href="reg.php" class="btn-link">Регистрация</a>
      <?php
    }
   }
 }
 else
 {
   echo "Ваша корзина пуста";
 }
 ?>
 </div>
 <?php
  require_once("assets/footer.php");
?>

