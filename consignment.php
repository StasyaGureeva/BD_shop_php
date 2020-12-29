<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Поставки</title>
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
		
				<div class="collapse navbar-collapse navbar-ex1-collapse" >
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
	$consignments = getAllConsignments($db);?>
	


<script>
/*Скрипт отслеживания изменения селекта*/
function select_change()
{
	var rows = document.getElementsByClassName("table table-bordered");

	let select = document.querySelector('#category1');
	for (var i = 0; i < document.getElementById("tab").rows.length; i++) {
		if (i != 0)
			(document.getElementById("tab").rows[i]).style.display = "none";
	}

	for (var i = 0; i < document.getElementById("tab").rows.length; i++) {
		if ((document.getElementById("tab").rows[i].cells[1].innerHTML).includes($('select option:selected' ).text()))
			(document.getElementById("tab").rows[i]).style.display = "";
		}
			
	for (var i = 0; i < document.getElementById("tab").rows.length && select.selectedIndex == 0; i++) {
		(document.getElementById("tab").rows[i]).style.display = "";
		}
}
</script>


		<select ONCHANGE = "javascript:select_change();" style="margin: 0px 0px 0px 100px;  font-size: 15px; position: absolute; top: 95px; width:260px; height: 45px;" ONCHANGE = "javascript:select_change();" name="category1" method="POST" class="form-control" id="category1">
		<?php
			$shops = getAllWorkers($db);
			?><option value="">Выбрать сотрудника..</option>;<?php
			foreach ($shops as $key => $value) {

				echo "<option value=".$value['worker_id'].">".$value['worker_name']."</option>";	
	
			}?>
			</select>
				

			<table class="table table-bordered" name = "table" id = "tab" style="margin-top: 40px;" >
				<tr>
					<th>Дата принятия партии</th>
					<th>Сотрудник</th>
					<th>Товар</th>
					<th>Количество единиц продукции</th>
				</tr>
				
				<?php foreach ($consignments as $consignment) { 
					  ?>
				<tr>
					<td><?php echo $consignment['date_of_production']; ?></a></td>
					<td><?php echo $consignment['worker_name']; ?></td>
					<td><?php echo $consignment['name']; ?></td>
					<td><?php echo $consignment['count']; ?></td>
				</tr>		
				<?php  } ?>
			</table>
			
	

	
	</div>

</body>
</html>