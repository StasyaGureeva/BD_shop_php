<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Товары</title>
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
   
   .dontshow {
    display:none;
}
.main {
    width: 25%;
    margin-left: 1110px;
	 margin-bottom: 30px;
	  margin-top: 0px;
	  
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
	
	 <label style="margin: 0px 0px 40px 1260px;   font-size: 17px;" type="text">Пользователь: </label>

	 
  <?php 
  if (isset($_GET['login']))
  {
$var = $_GET['login'];
echo $var;
  }
  else header("location:config.php");

 	
?>

  
	<div id="content">
		<div class="container-fluid">
			<?php include 'db.php'; ?>
			<?php include 'api.php'; ?>
	

	 
	  <button id="Info" class="btn btn-default"  style="margin-bottom:50px;margin-left:100px;">Показать информацию по статистике товаров</button>
			<form id = "statistics" name = "statistics" action="" method="POST" role="form" style="display: none; margin-top: 20px; margin-left:100px;">
		
			<div class="form-group-special">
				<label for=""> <?php 		

$fullPrice = getFullPriceOfProducts($db);
 echo "Полная цена всех товаров: ";
  echo array_shift($fullPrice);
    echo "<br/><br/><br/>";
  
$weightMax = productsMaxWeight($db);
 echo "Максимальный вес товара: ";
  echo array_shift($weightMax);
  
  
   echo "<br/><br/><br/>Топ 3 - самые дорогие товары: ";
   
   
   $expensiveProducts = productsPriceTop3ByExpensive($db);
   
   	foreach ($expensiveProducts as $key => $value) {

			 echo "<font color=blue size=3pt><option value=".$value['product_id'].">".$value['name'].", ".$value['price']." руб.</option></font>";		
		}	
					
   
    echo "<br/><br/>Топ 3 - самые дешевые товары: ";
	
	
	  $cheapProducts = productsPriceTop3ByCheap($db);
   
   	foreach ($cheapProducts as $key => $value) {

			 echo "<font color=blue size=3pt><option value=".$value['product_id'].">".$value['name'].", ".$value['price']." руб.</option></font>";		
		}	
	
	
	echo "<br/><br/>";
	
		
$numbers= getNumberOfProductsInCategories($db);	

	
?></label>  
<table class="table table-bordered" name = "table" id = "tab" style="width: 250px;"">
				<tr>
					<th>Категория</th>
					<th>Количество товара</th>
					
				</tr>
				<?php foreach ($numbers as $number) { ?>
					<tr>
			

								<td><?php echo $number['category_name']; ?></td>
								<td><?php echo $number['cn']; ?></td>
					

					
					</tr>
						
				<?php  } ?>
			</table>
	  
			</div>
				<button id="hideInfo" class="btn btn-default" style="margin-bottom:50px;margin-top:40px; margin-left:40px;">Скрыть подробную информацию</button>
			</form>
	
	

 
	<form action="" method="POST" style="margin-top: 20px; margin-left:150px;"">
		
		<?php echo "<br/><br/>Цена в диапазоне"; ?>
			<div class="form-group">
			<?php echo "<br/> от " ?>
				<input type="number" style = "width: 60px;" id="bottomBorder" name="bottomBorder" placeholder=<?php if (isset($_POST['bottomBorder']) &&  $_POST['bottomBorder'] >= 0) echo $_POST['bottomBorder']; else echo 0; ?>>	
				<?php echo " до " ?>
				<input type="number" style = "width: 60px;" id="topBorder" name="topBorder" placeholder=<?php if (isset($_POST['topBorder']) &&  $_POST['topBorder'] > 0) echo $_POST['topBorder']; else echo 0; ?>>
			</div>

			<button  name = "setButton" type="submit" class="btn btn-default" style="margin-left:40px;margin-bottom:40px;">Применить</button>
		</form>

  

			<?php
		
			if(isset($_POST['setButton']) && isset($_POST['topBorder']) && isset($_POST['bottomBorder']) && $_POST['topBorder'] > 0 && $_POST['bottomBorder'] >= 0) 
					$products = productsWithPriceInRange($db, $_POST['bottomBorder'], $_POST['topBorder']);
				
	


	else $products = getAllProducts($db);				?>


<a href="products.php?login=admin">Полный список товаров</a>
			<table class="table table-bordered" name = "table" id = "tab">
				<tr>
					<th>Товар</th>
					<th>Категория</th>
					<th>Цена</th>
					<th>Вес</th>
					<th>Срок годности</th>
					<th></th>
				</tr>
				<?php foreach ($products as $product) { 
					  ?>
					<tr>

					<td><a href="edit.php?login=admin&id=<?php echo $product['product_id'];?>"><?php echo $product['name']; ?></a></td>
				

								<td><?php echo $product['category_name']; ?></td>
								<td><?php echo $product['price']; ?></td>
								<td><?php echo $product['weight']; ?></td>
								<td><?php echo $product['shelf_life']; ?></td>

						<td><a class="btn btn-danger" href="delete.php?login=admin&id=<?php echo $product['product_id'];?>">Удалить</a></td>
					
					</tr>
						
				<?php  } ?>
			</table>



			<button id="addButton" class="btn btn-default"  style="margin-bottom:50px;">Добавить</button>
			<form action="" method="POST" role="form" style="display: none; margin-top: 20px;"">
		
			<div class="form-group">
				<label for="">Введите данные</label>
				<input type="text" class="form-control" style = "width: 480px;" id="name" name="name" placeholder="Название товара">
				<input type="number" step="0.0001" class="form-control" style = "width: 480px;" id="price" name="price" placeholder="Цена">
				<input type="number" step="0.0001" class="form-control" style = "width: 480px;" id="weight" name="weight" placeholder="Вес">
				<input type="number" step="0.0001" class="form-control" style = "width: 480px;" id="shelf_life" name="shelf_life" placeholder="Срок годности">
			</div>

	<script>

</script>

			<div class="form-group">
				<select ONCHANGE = "javascript:select_change();" style = "width: 400px;" name="category" method="POST" class="form-control" id="category" >
				<?php
					$categories = getAllCategories($db);
					foreach ($categories as $key => $value) {

						echo "<option value=".$value['category.id'].">".$value['category_name']."</option>";	
	
					}	
					

				?>
				</select>
			</div>

			<button  name = "butt" type="submit" class="btn btn-default" style="margin-bottom:50px;">Добавить к данным</button>
				<button id="hideButton" class="btn btn-default" style="margin-bottom:50px;">Скрыть панель ввода</button>
		</form>
		</div>




    	<script>
function select_change()
{
	let select = document.querySelector('#category');
		//alert(select.selectedIndex + 1);
		 document.cookie = ("height=") + escape(select.selectedIndex + 1);
	//return (select.selectedIndex + 1);
}
</script>
 
<script>select_change();</script>
<?php

			if(isset($_POST['butt']) ) {
				
				$name = $_POST['name'];
				$price = $_POST['price'];	
				$weight = $_POST['weight'];
				$shelf_life = $_POST['shelf_life'];	
			
	
			
	echo "<script>(window.location.href='products.php')()</script>";
				$categoryId=$_COOKIE["height"];

				
					
				addProduct($db, $name, $categoryId, $price, $weight, $shelf_life );

			}
			
	
		?>
	
	</div>

	<script>
		$("#addButton").click(function(){
			$("form").slideDown();
			$(this).hide();
			
		});
			$("#hideButton").click(function(){
			$("form").slideUp();
		});
		
		$("#Info").click(function(){
			$("form").slideDown();
			$(this).hide();
			
		});
			$("#hideInfo").click(function(){
			$("form").slideUp();
		});
		
		
	</script>
	
</body>
</html>