<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css" rel="stylesheet" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-default">
              <div class="container-fluid">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="#"></a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
            		<li><a href="products.php">Товары</a></li>
						<li><a href="shops.php?login1=admin">Магазины</a></li>
						<li><a href="customer.php?login1=admin">Пользователи</a></li>
						<li><a href="order.php?login1=admin">Заказы</a></li>
						<li><a href="consignment.php?login1=admin">Поставки товаров</a></li>
                  </ul>
                </div>
              </div>
          </nav>
        </header>

        <div class="container-fluid">
            <?php include 'db.php'; ?>
            <?php include 'api.php'; ?>
            <?php
				if (isset($_GET['id']))
				{ 
					$id = $_GET['id'];
				
                    if($id) 
                        $product = getProductById($db, $id);
				}
					?>
				

           <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $product['product_id'], $product['category_id']; ?>">
                <div class="form-group">
                    <label for="name">Товар</label>
                    <input type="text" action="" method="POST" style = "width: 480px;" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>">
					 <input type="number" step="0.0001" action="" method="POST" style = "width: 480px;" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>">
					  <input type="number" step="0.0001" action="" method="POST" style = "width: 480px;" class="form-control" id="weight" name="weight" value="<?php echo $product['weight']; ?>">
				  <input type="number" step="0.0001" action="" method="POST" style = "width: 480px;" class="form-control" id="shelf_life" name="shelf_life" value="<?php echo $product['shelf_life']; ?>">
                  </div>
				  <div class="form-group">
					<select ONCHANGE = "javascript:select_change();" name="category" method="POST" style = "width: 400px;" class="form-control" id="category" >
						
<script>select_change();</script>						
                    <?php if(isset($_POST['butt'])) {
                        $productName = $_POST['name'];
					$price = $_POST['price'];
					$weight = $_POST['weight'];
					$shelf_life = $_POST['shelf_life'];
			
						echo "<script>(window.location.href='edit.php?login=admin')()</script>";
				$categoryId=$_COOKIE["height"];
			
                   
                      saveProduct($db, $id, $productName, $price, $weight, $shelf_life, $categoryId);
                    //}
                   /* else {
                        echo '<div class="alert alert-danger" role="alert">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                  <span class="sr-only">Error:</span>
                                  Ошибка сохранения
                                </div>';
                    }*/
					 header ('Location: products.php?login=admin');  // перенаправление на нужную страницу
     // прерываем работу скрипта, чтобы забыл о прошлом
                    }
					
			
                    else {
                        echo '<div class="alert alert-danger" role="alert">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                  <span class="sr-only">Error:</span>
                                  Товар не найден
                                </div>';
                    }
				

				
             ?>
 
				    	<script>
function select_change()
{
	let select = document.querySelector('#category');
		//alert(select.selectedIndex + 1);
		 document.cookie = ("height=") + escape(select.selectedIndex + 1);
	//return (select.selectedIndex + 1);
}
</script>
 

				<?php
					$categories = getAllCategories($db);
		
				
foreach($categories as $k => $v) {
?>

<option value="<?php echo $k ?>"<?php if( $k == $product['category_id'] ): ?> selected="selected"<?php endif; ?>><?php echo $v['category_name'] ?></option>
<?php
}
?>

			
				</select>
			</div>
                  <button name = "butt" type="submit" class="btn btn-default">Сохранить</button>
            </form>
        </div>

        <footer>

        </footer>
    </body>