<?php
session_start();
require_once("assets/header.php");
require_once("connect.php");

$query="select * from tovar";
$result=$mysqli->query($query);
?>
<div class="row-cards">
<?php
while ($row=$result->fetch_assoc())
{
  ?>

<div class="card" style="width: 16rem;">
  <img src="image/<?= $row['articul'] ?>.jpg" class="card__img" alt="...">
  <div class="card__body">
    <h5 class="card__title"><?= $row['naim_tovar']?></h5>
    <h5 class="card__title price"><?= $row['price']?></h5>
    <p class="card__text"><?= $row['description']?></p>
    <form action="#" method="post">
      <input type="hidden" name="articul" value="<?= $row['articul'] ?>">
      <button type="submit" name="add" class="btn btn-primary">В корзину</button>
    </form>
  </div>
</div>

<?php
}
if (isset($_POST['add']))
{
  if (isset($_SESSION['cart'][$_POST['articul']]))
  {
    $_SESSION['cart'][$_POST['articul']]++;
  }
  else
  {
    $_SESSION['cart'][$_POST['articul']]=1;
  }
  ?>
  <script>
    alert("Ваш товар добавлен в корзину");
  </script>
  <?php
}
?>
</div>
<?php
require_once("assets/footer.php");
?>


<!-- http://127.0.0.1:8080/db-cards/index.php -->