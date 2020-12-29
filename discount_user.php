<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Скидки</title>
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
						<li><a href="discount_user.php">Скидки</a></li>
						<li><a href="order_user.php?login1=<?php echo $_GET['login']; ?> ">Заказы</a></li>
					
						 <li style=" left:1200px; font-size: 17px;">   <a href=\shop/config.php?is_exit=1\>Выйти</a></li>
	
					</ul>
				</div>
			</div>
		</nav>
	</header>
	  
  <label style="margin: 0px 0px 0px 1260px;   font-size: 17px;" type="text">Пользователь: </label>
  <?php 
  if (isset($_GET['login']))
  {
$var = $_GET['login'];
echo $var;
  }
  else header("location:config.php");
?>
	<div class="main">
	<div class="form-group has-feedback has-search">
    <span class="glyphicon glyphicon-search form-control-feedback"></span>
<input type="text" class="form-control" id="search" name="search" placeholder="Искать скидки по названию товара">
  </div>
  </div>

		

	<div id="content">
		<div class="container-fluid">
			<?php include 'db.php'; ?>
			<?php include 'api.php'; ?>
			
			
	
	<script>
	   let elem = document.querySelector('#search');

elem.addEventListener('input', function() {
var rows = document.getElementsByClassName("table table-bordered");

  var val = document.getElementById('search').value;
	let select = document.querySelector('#category');
for (var i = 0; i < document.getElementById("tab").rows.length; i++) {
 if (i != 0)
(document.getElementById("tab").rows[i]).style.display = "none";
	}

for (var i = 0; i < document.getElementById("tab").rows.length; i++) {
if ( (document.getElementById("tab").rows[i].cells[4].innerHTML).includes(val) && ((document.getElementById("tab").rows[i].cells[6].innerHTML).includes($('select option:selected' ).text()) || select.selectedIndex==0))
    (document.getElementById("tab").rows[i]).style.display = "";
}

});
function select_change()
{
	var rows = document.getElementsByClassName("table table-bordered");

  var val = document.getElementById('search').value;
  
	let select = document.querySelector('#category');
		for (var i = 0; i < document.getElementById("tab").rows.length; i++) {
 if (i != 0)
(document.getElementById("tab").rows[i]).style.display = "none";
	}

for (var i = 0; i < document.getElementById("tab").rows.length; i++) {
	if ( (document.getElementById("tab").rows[i].cells[4].innerHTML).includes(val) && (document.getElementById("tab").rows[i].cells[6].innerHTML).includes($('select option:selected' ).text()))
    (document.getElementById("tab").rows[i]).style.display = "";
}
				for (var i = 0; i < document.getElementById("tab").rows.length && select.selectedIndex == 0; i++) {
					if ( (document.getElementById("tab").rows[i].cells[4].innerHTML).includes(val))
(document.getElementById("tab").rows[i]).style.display = "";
	}

}
	</script>


				<select ONCHANGE = "javascript:select_change();" style="margin: 0px 0px 0px 700px;  font-size: 15px; position: absolute; top: 115px; width:260px; height: 45px;" ONCHANGE = "javascript:select_change();" name="category" method="POST" class="form-control" id="category">
				<?php
					$shops = getAllShops($db);
					  ?><option value="">Выбрать название магазина..</option>;<?php
					foreach ($shops as $key => $value) {

						echo "<option value=".$value['shop_id'].">".$value['shop_name']."</option>";	
	
					}	
					
					

				?>
				</select>


			<table name = "table" id = "tab" class="table table-bordered">
				<tr  class='hidethis'>
					<th>Название акции</th>
					<th>Скидка</th>
						<th>Начало акции</th>
							<th>Окончание акции</th>
					<th>Товар</th>
						<th>Цена со скидкой</th>
		<th>Название магазина</th>
		<th>Адрес магазина</th>
	
				
				</tr>
				
				<?php 
				$discounts = getAllDiscounts($db);
				foreach ($discounts as $discount) { 
					  ?>
					<tr>

					<td><?php echo $discount['discount_name']; ?></a></td>
				

								<td><?php echo $discount['amount']; ?></td>
									<td><?php echo $discount['begin']; ?></td>
										<td><?php echo $discount['finish']; ?></td>
								<td><?php echo $discount['name']; ?></td>
								<td><?php echo $discount['price'] * (100 - $discount['amount'])/100; ?></td>
								<td><?php echo $discount['shop_name']; ?></td>
<td><?php echo $discount['address']; ?></td>
						
					</tr>
						
				<?php  } ?>
			</table>

	
		</form>
		</div>





<?php
    //echo "<a href=\"config.php?is_exit=1\">Выйти</a>"; //Показываем кнопку выхода
 //echo $_COOKIE["height"];

			/*if(isset($_POST['butt']) ) {
				
				$name = $_POST['shop_name'];

				$address = $_POST['address'];	
				$phone_number = $_POST['phone_number'];

			
				
				addShop($db, $name, $address, $phone_number);
echo "<script>(window.location.href='shops.php')()</script>";*/

			//}?>
			

	</div>


</body>
</html>