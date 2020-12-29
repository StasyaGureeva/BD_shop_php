<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Пользователи</title>
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
    background: #bed2f7; /* Цвет фона */
    color: #333;  /* Цвет текста */
   }
   tbody tr:hover {
    background: #535059; /* Цвет фона при наведении */
    color: #fff; /* Цвет текста при наведении */
   }
   .dontshow {
    display:none;
}

/*Оформление поля поиска*/
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
	

  <label style="margin: 0px 0px 0px 1260px;   font-size: 17px;" type="text">Пользователь: </label>
 <?php 
  if (isset($_GET['login1']))
  {
	$var = $_GET['login1'];
	echo $var;
  }
  else header("location:config.php");
?>


	<div id="content">
		<div class="container-fluid">
			<?php include 'db.php'; ?>
			<?php include 'api.php'; ?>
	

			<table style="margin-top: 40px;" name = "table" id = "tab" class="table table-bordered">
				<tr  class='hidethis'>
					<th>Имя пользователя</th>
					<th>Логин</th>
					<th>Пароль</th>
						<th></th>
				</tr>
				
				<?php 				
				$customers = getAllCustomers($db);
				foreach ($customers as $customer) { 
					  ?>
					<tr>

					<td><a href="edit_customer.php?login1=admin&id=<?php echo $customer['customer_id'];?>"><?php echo $customer['customer_name']; ?></a></td>
				
					<td><?php echo $customer['customer_name']; ?></td>
								<td>1234</td>
									<td><a class="btn btn-danger" href="delete_customer.php?login1=admin&customer_id=<?php echo $customer['customer_id'];?>">Удалить</a></td>
					</tr>
						
				<?php  } ?>
			</table>


			<button id="addButton" class="btn btn-default"  style="margin-bottom:50px;">Добавить</button>
			<form action="" method="POST" role="form" style="display: none; margin-top: 20px;"">
		
			<div class="form-group">
				<label for="">Введите данные</label>
				<input type="text" class="form-control" id="customer_name" name="customer_name" style = "width: 480px;" placeholder="Имя">
			</div>

	<?php
			if(isset($_POST['butt']) ) {
				
				$name = $_POST['customer_name'];	
				addCustomer($db, $name);

				echo "<script>(window.location.href='customer.php?login1=admin')()</script>";
			}
	
		?>
			<button  name = "butt" type="submit" class="btn btn-default" style="margin-bottom:50px;">Добавить к данным</button>
				<button id="hideButton" class="btn btn-default" style="margin-bottom:50px;">Скрыть панель ввода</button>
		</form>
		</div>


			<script>
		$("#addButton").click(function(){
			$("form").slideDown();
			$(this).hide();
			
		});
			$("#hideButton").click(function(){
			$("form").slideUp();
		});
		
	</script>	
		

</body>
</html>