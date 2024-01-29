<?php
session_start();
require_once("connect.php");
require_once("assets/header.php");
?>

<h2>История заказов</h2>
<div class="history">
  <table class="table" cellpadding="10">
  <?php
  if (isset($_SESSION['user_id']))
  {
   $query="select order_id from ordershop where user_id='{$_SESSION['user_id']}'";
   $result=$mysqli->query($query);
   if ($result->num_rows>0) 
   {
    $summaItogo=0;
    echo "<tr><th>Наименование товара<th>Количество<th>Стоимость<th>";
    $min=99999999999;
    $max=0;
    while ($row=$result->fetch_assoc())
    {
      if($row['order_id']<$min)
        $min=$row['order_id'];
      if($row['order_id']>$max)
        $max=$row['order_id'];
    }

    for($i=$min; $i<=$max; $i++)
    {
      $itogo=0;
      $query="select order_id,naim_tovar,price,quantity from ordershop,tovar where ordershop.articul=tovar.articul and user_id='{$_SESSION['user_id']}' and order_id='{$i}'";
      $result=$mysqli->query($query);
      if ($result->num_rows>0)
      {
      while ($row=$result->fetch_assoc())
      {
          $sum=$row['quantity']*$row['price'];
          echo "<tr><td>{$row['naim_tovar']}<td>{$row['quantity']}<td>{$sum}";
          $itogo+=$sum;
          $summaItogo+=$sum;
      }
      ?>
      <tr><td colspan=2 class="table__border"><b>Итоговая сумма вашего заказа</b><td class="table__border"><b><?= $itogo ?></b></tr>
      <?php
      }
    }  
    ?>
    <tr><td colspan=2><b>Общая сумма всех ваших заказов</b><td><b><?= $summaItogo ?></b></tr>
    </table>
    <?php
   }
   else
   echo "Вы еще не сделали ни одного заказа";
  } 
  else
  echo "Войдите, чтобы увидеть историю ваших заказов";
  ?>
</div>

<?php
  require_once("assets/footer.php");
?>