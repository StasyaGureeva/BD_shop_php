<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Магазины</title>
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
    background: #afd792; /* Цвет фона */
    color: #333;  /* Цвет текста */
   }
   tbody tr:hover {
    background: #cafcca; /* Цвет фона при наведении */
    color: #fff; /* Цвет текста при наведении */
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
			

	
	 <label style="margin: 0px 0px 40px 1260px;   font-size: 17px;" type="text">Пользователь: </label>
  <?php 
  if (isset($_GET['login1']))
  {
$var = $_GET['login1'];
echo $var;
  }
  else header("location:config.php");
			
					


if (isset($_GET['sort']))
{
	if ($_GET['sort'] == 0)
	 $shops = getAllShopsAscByName($db);
if ($_GET['sort'] == 1)
	 $shops = getAllShopsAscByAddress($db);
 if ($_GET['sort'] == 2)
	 $shops = getAllShopsAscByNumber($db);
}
else $shops = getAllShops($db);	
 

				?>
				
				<div class="sort-bar">
	<div class="sort-bar-title">Сортировать по:</div> 
	<div class="sort-bar-list">

		<a href="shops.php?login1=admin&sort=0">Названию магазина</a>
		<a href="shops.php?login1=admin&sort=1">Адресу</a>
		<a href="shops.php?login1=admin&sort=2">Номеру телефона</a>
	</div> 
 </div> 
				
				


			<table class="table table-bordered">
				<tr>
					<th>Название магазина</th>
					<th>Адрес</th>
					<th>Телефон</th>
	
					<th></th>
				</tr>
				<?php foreach ($shops as $shop) { 
					  ?>
					<tr>

					<td><a href="edit_shop.php?login1=admin&id=<?php echo $shop['shop_id'];?>"><?php echo $shop['shop_name']; ?></a></td>
				

								<td><?php echo $shop['address']; ?></td>
								<td><?php echo $shop['phone_number']; ?></td>

						<td><a class="btn btn-danger" href="delete_shop.php?shop_id=<?php echo $shop['shop_id'];?>">Удалить</a></td>
					
					</tr>
						
				<?php  } ?>
			</table>

			<button id="addButton" class="btn btn-default" style="margin-bottom:50px;">Добавить</button>
			<form action="" method="POST" role="form" style="display: none; margin-top: 20px;"">
		
			<div class="form-group">
				<label for="">Введите данные</label>
				<input type="text" class="form-control" style = "width: 480px;" id="shop_name" name="shop_name" placeholder="Название магазина">
				<input type="text" class="form-control" style = "width: 480px;" id="address" name="address" placeholder="Адрес">
				<input type="text" class="form-control" style = "width: 480px;" id="phone_number" name="phone_number" placeholder="Телефон">
			</div>



			<button  name = "butt" type="submit" class="btn btn-default" style="margin-bottom:50px;">Добавить к данным</button>
				<button id="hideButton" class="btn btn-default" style="margin-bottom:50px;">Скрыть панель ввода</button>
		</form>
		</div>





<?php

			if(isset($_POST['butt']) ) {
				
				$name = $_POST['shop_name'];

				$address = $_POST['address'];	
				$phone_number = $_POST['phone_number'];

			
				
				addShop($db, $name, $address, $phone_number);
echo "<script>(window.location.href='shops.php?login1=admin')()</script>";

			}
	
		?>
	
	</div>

	<footer>
		
	</footer>

	<script>
		$("#addButton").click(function(){
			$("form").slideDown();
			$(this).hide();
			
		});
			$("#hideButton").click(function(){
			$("form").slideUp();
			//$("addButton")attr('disabled', false);
		});
		
	</script>
</body>
</html>