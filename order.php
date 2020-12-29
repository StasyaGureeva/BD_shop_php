<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Заказы</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script  src="C:/xampp/htdocs/shop/script.js"></script>
<style>
   table {
    width: 100%; /* Ширина таблицы */
    border-collapse: collapse; /* Убираем двойные линии между ячейками */
   }
   td, th {
    padding: 3px; /* Поля вокруг содержимого таблицы */
    border: 1px solid #000; /* Параметры рамки */
   }
   th {
    background: #e0dbd7; /* Цвет фона */
    color: #333;  /* Цвет текста */
   }
   tbody tr:hover {
    background: #535059; /* Цвет фона при наведении */
    color: #fff; /* Цвет текста при наведении */
   }
   .dontshow {
    display:none;
}

/*Стиль для строки поиска*/
.main {
    width: 25%;
    margin-left: 50px;
	 margin-bottom: 40px;
	  margin-top: 20px;
}

.has-search .form-control-feedback {
    right: initial;
    left: 0;
    color: #ccc;
}

.has-search .form-control {
    padding-right: 12px;
    padding-left: 34px;
}
   .sort-bar {
	margin-bottom: 20px;
}
.sort-bar-title {
	display: inline-block;
	margin-right: 10px;
	color: #a7a7a7;
}
.sort-bar-list {
	display: inline-block;
}
.sort-bar-list a {
	color: #000;
	text-decoration: none;
	margin-right: 10px;
	border-bottom: 1px dashed;
}
.sort-bar-list a i {
	font-style: normal;
	font-size: 10px;
	line-height: 14px;
	vertical-align: middle;
}
.sort-bar-list a.active {
	color: #cb11ab;
}

  </style>
</head>
<body>
	<header>
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#"></a>
				</div>
		
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav">
			<li><a href="products.php">Товары</a></li>
						<li><a href="shops.php?login1=admin">Магазины</a></li>
						<li><a href="customer.php?login1=admin">Пользователи</a></li>
						<li><a href="order.php?login1=admin">Заказы</a></li>
						<li><a href="consignment.php?login1=admin">Поставки товаров</a></li>
						<li style=" left:820px; font-size: 17px;">   <a href=\shop/config.php?is_exit=1\>Выйти</a></li>
	
					</ul>
				</div>
			</div>
		</nav>
	</header>
	  



	<div id="content">
		<div class="container-fluid">
			<?php include 'db.php'; ?>
			<?php include 'api.php'; ?>
	
		  
  <label style="margin: 0px 0px 0px 1260px;   font-size: 17px;" type="text">Пользователь: </label>
	  <?php 
  if (isset($_GET['login1']))
  {
$var = $_GET['login1'];
echo $var;
  }
  else header("location:config.php");



      echo "<br/><br/>";

  $date = getOrderWithMaxDate($db);
  echo "Последний заказ был совершен: ";
  echo array_shift($date);
		
      echo "<br/><br/><br/><br/>";
	


				?>
				
				<div class="sort-bar">
	<div class="sort-bar-list">

		<a href="order.php?login1=admin&sort=0">За последние 30 дней</a>
		<a href="order.php?login1=admin&sort=1">За последние 100 дней</a>
		<a href="order.php?login1=admin&sort=2">За все время</a>
	</div> 
 </div> 


	  
  </ul>
</div>
			<table style="margin-left:17px; width: 1500px;" name = "table" id = "tab1" class="table table-bordered">
				<tr  class='hidethis'>
					<th>Покупатель</th>
					<th>Товар в заказе</th>
					<th>Цена в рублях</th>
					<th>Дата и время заказа</th>
					<th>Название магазина</th>
				</tr>

				<?php 
				if (isset($_GET['sort']))
{
	if ($_GET['sort'] == 0)
	 $orders = getOrderBy30days($db);
if ($_GET['sort'] == 1)
	 $orders = getOrderBy100days($db);
 if ($_GET['sort'] == 2)
	 $orders = getAllOrders($db);
}
else $orders = getAllOrders($db);	
				foreach ($orders as $order) { 
					  ?>
					<tr>

						<td><?php echo $order['customer_name']; ?></a></td>
						<td><?php echo $order['name']; ?></td>
						<td><?php echo $order['price']; ?></td>
						<td><?php echo $order['Date_and_time']; ?></td>
						<td><?php echo $order['shop_name']; ?></td>
					</tr>
		<?php   }
   ?>
			</table>

		</form>
		</div>		

</body>
</html>