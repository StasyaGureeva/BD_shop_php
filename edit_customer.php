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
                 $id = $_GET['id'];
                 if($id) {
                        $customer = getCustomerById($db, $id);
						
                    if(isset($_POST['butt'])) {
                        $name = $_POST['customer_name'];
								
						saveCustomer($db, $id, $name);
						header ('Location: customer.php?login1=admin'); 
                    }
				}
			
                    else {
                        echo '<div class="alert alert-danger" role="alert">
                                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                  <span class="sr-only">Error:</span>
                                  Товар не найден
                                </div>';
                    }
				
             ?>
			 
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $customer['customer_id']; ?>">
                <div class="form-group">
					<label for="name">Пользователь</label>
                    <input type="text" style = "width: 480px;"  action="" method="POST" class="form-control" id="customer_name" name="customer_name" value="<?php echo $customer['customer_name']; ?>">
                  </div>
			     <button name = "butt" type="submit" class="btn btn-default">Сохранить</button>
			</div>
             
            </form>
        </div>

    </body>