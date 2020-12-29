<?php


function getAllProducts($db) {
  $sql = "SELECT * FROM product
  	left JOIN category ON category_id = category.id;   
	";
	$result = array();

	$stmt = $db->prepare($sql);

	$stmt->execute();

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$result[$row['product_id']] = $row;
	}

	return $result;
}



function getAllCategories($db) {
    $sql =  
			  "SELECT * FROM category;
	";
	$result = array();

	$stmt = $db->prepare($sql);

	$stmt->execute();

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$result[$row['id']] = $row;
	}

	return $result;
}



function getProductById($db, $id) {
	$sql = "SELECT * FROM product
			WHERE product_id = :product_id;
			";

	$stmt = $db->prepare($sql);
	$stmt->bindValue(':product_id', $id, PDO::PARAM_INT);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row;
}


function saveProduct($db, $id,  $productName, $price, $weight, $shelf_life, $categoryId ) {
	$sql = "UPDATE product SET name = :name, shelf_life = :shelf_life, weight = :weight,price = :price, category_id = :category_id WHERE product_id = :product_id;
	";

	$stmt = $db->prepare($sql);
	$stmt->bindValue(':name', $productName, PDO::PARAM_STR);
	$stmt->bindValue(':shelf_life', $shelf_life, PDO::PARAM_INT);
	$stmt->bindValue(':weight', $weight, PDO::PARAM_INT);
	$stmt->bindValue(':price', $price, PDO::PARAM_INT);
	$stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
	 $stmt->bindValue(':product_id', $id, PDO::PARAM_INT);

	$stmt->execute();
}


function addProduct($db, $productName, $categoryId, $price, $weight, $shelf_life) {
	$sql = "INSERT INTO product(name, shelf_life, weight, price, category_id) 
			VALUES(:name, :shelf_life, :weight, :price, :category_id);
	";

	$stmt = $db->prepare($sql);
	$stmt->bindValue(':name', $productName, PDO::PARAM_STR);
	$stmt->bindValue(':shelf_life', $shelf_life, PDO::PARAM_INT);
	$stmt->bindValue(':weight', $weight, PDO::PARAM_INT);
	$stmt->bindValue(':price', $price, PDO::PARAM_INT);
	$stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);

	$stmt->execute();

}



function deleteProduct($db, $id) {
	$sql = "DELETE FROM product WHERE product_id = :product_id;";

	$stmt = $db->prepare($sql);
	$stmt->bindValue(":product_id", $id, PDO::PARAM_INT);

	$stmt->execute();
}


function getAllShops($db) {
  $sql = "SELECT * FROM shop;
 
	";
	$result = array();

	$stmt = $db->prepare($sql);

	$stmt->execute();

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$result[$row['shop_id']] = $row;
	}

	return $result;
}


function getShopById($db, $id) {
	$sql = "SELECT * FROM shop
			WHERE shop_id = :shop_id;
			";

	$stmt = $db->prepare($sql);
	$stmt->bindValue(':shop_id', $id, PDO::PARAM_INT);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row;
}


function saveShop($db, $id,  $shopName, $address, $phone_number) {
	$sql = "UPDATE shop SET shop_name = :shop_name , address = :address, phone_number = :phone_number where shop_id = :shop_id;
	";

	$stmt = $db->prepare($sql);
	$stmt->bindValue(':shop_name', $shopName, PDO::PARAM_STR);
	$stmt->bindValue(':address', $address, PDO::PARAM_STR);
	$stmt->bindValue(':phone_number', $phone_number, PDO::PARAM_STR);
	$stmt->bindValue(':shop_id', $id, PDO::PARAM_INT);

	$stmt->execute();
}


function addShop($db, $shopName, $address, $phone_number) {
	$sql = "INSERT INTO shop(shop_name,  address, phone_number) 
			VALUES(:shop_name,  :address, :phone_number);
	";

	$stmt = $db->prepare($sql);
	$stmt->bindValue(':shop_name', $shopName, PDO::PARAM_STR);
	$stmt->bindValue(':address', $address, PDO::PARAM_STR);
	$stmt->bindValue(':phone_number', $phone_number, PDO::PARAM_STR);

	$stmt->execute();

}

function deleteShop($db, $id) {
	$sql = "DELETE FROM shop WHERE shop_id = :shop_id";

	$stmt = $db->prepare($sql);
	$stmt->bindValue(":shop_id", $id, PDO::PARAM_INT);

	$stmt->execute();
}


function getAllDiscounts($db) {
  $sql = "
 SELECT * FROM discount 
  left JOIN product_has_discount ON discount_id_key = discount_id 
  left JOIN product ON product_has_discount.product_id_key = product.product_id 
  left JOIN product_has_order ON product_has_order.product_id_key = product.product_id 
  left JOIN `order` ON order_id_key = order_id 
  left JOIN shop ON shop_id = shop_id_key;
 
	";
	$result = array();

	$stmt = $db->prepare($sql);

	$stmt->execute();
	$i = 0;
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	
		$result[$i] = $row;
		$i = $i+1;
	}
	return $result;
}


function getDiscountById($db, $id) {
	$sql = "SELECT * FROM discount 
	left JOIN product_has_discount ON discount_id_key = discount_id 
	left JOIN product ON product_has_discount.product_id_key = product.product_id 
	left JOIN product_has_order ON product_has_order.product_id_key = product.product_id 
	left JOIN `order` ON order_id_key = order_id 
	left JOIN shop ON shop_id = shop_id_key
	where discount = :discount_id;
			";

	$stmt = $db->prepare($sql);
	$stmt->bindValue(':discount_id', $id, PDO::PARAM_INT);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row;
}


function getAllOrders($db) {
  $sql = "
 SELECT order_id, Date_and_time, customer_name, price,shop_name, name FROM `order` 
 left JOIN customer ON customer_id_key = customer_id
 left JOIN product_has_order ON order_id_key = order_id
 left JOIN product ON product_id_key = product_id
 left JOIN shop ON shop_id_key = shop_id
 order by Date_and_time desc;
	";
	$result = array();

	$stmt = $db->prepare($sql);
	$stmt->execute();

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$result[$row['order_id']] = $row;
	}

	return $result;
}


function getOrdersOfUser($db, $name) {
  $sql = "
 SELECT order_id, Date_and_time, customer_name, price,shop_name, name FROM `order` 
 left JOIN customer ON customer_id_key = customer_id
 left JOIN product_has_order ON order_id_key = order_id
 left JOIN product ON product_id_key = product_id
 left JOIN shop ON shop_id_key = shop_id
where customer_name = :name order by Date_and_time desc;

	";
	$result = array();

	$stmt = $db->prepare($sql);
	$stmt->bindValue(':name', $name, PDO::PARAM_STR);
	$stmt->execute();

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$result[$row['order_id']] = $row;
	}

	return $result;
}


function getOrderById($db, $id) {
	$sql = "SELECT * FROM discount
	left JOIN product_has_discount ON discount_id_key = discount_id 
	left JOIN product ON product_has_discount.product_id_key = product.product_id 
	left JOIN product_has_order ON product_has_order.product_id_key = product.product_id 
	left JOIN `order` ON order_id_key = order_id 
	left JOIN shop ON shop_id = shop_id_key
	where discount = :discount_id;
			";

	$stmt = $db->prepare($sql);
	$stmt->bindValue(':discount_id', $id, PDO::PARAM_INT);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row;
}


function getAllConsignments($db) {
  $sql = "
 SELECT distinct* FROM consignment
  inner JOIN consignment_has_product ON consignment_id_key = consignment_id 
  left JOIN suplier ON suplier_id_key = suplier_id 
  left JOIN worker ON suplier_id_key = suplier_id 
  left JOIN worker_has_shop ON suplier_id_key = suplier_id 
  left JOIN shop ON shop_id = suplier_id_key = suplier_id
  left JOIN product ON product_id_key = product_id order by date_of_production desc;
	";
	$result = array();

	$stmt = $db->prepare($sql);

	$stmt->execute();


	$stmt->execute();

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$result[$row['consignment_id']] = $row;
	}

	return $result;
}


function getAllWorkers($db) {
  $sql = "
 SELECT * FROM worker;
 
	";
	$result = array();

	$stmt = $db->prepare($sql);

	$stmt->execute();


	$stmt->execute();

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$result[$row['worker_id']] = $row;
	}

	return $result;
}


function getAllCustomers($db) {
  $sql = "SELECT * FROM customer;
 
	";
	$result = array();

	$stmt = $db->prepare($sql);

	$stmt->execute();

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$result[$row['customer_id']] = $row;
	}

	return $result;
}


function saveCustomer($db, $id,  $name) {
	$sql = "UPDATE customer SET customer_name = :customer_name where customer_id = :customer_id;
	";

	$stmt = $db->prepare($sql);
	$stmt->bindValue(':customer_name', $name, PDO::PARAM_STR);
	$stmt->bindValue(':customer_id', $id, PDO::PARAM_INT);

	$stmt->execute();
}


function addCustomer($db, $customerName) {
	$sql = "INSERT INTO customer(customer_name) 
			VALUES(:customer_name);
	";

	$stmt = $db->prepare($sql);
	$stmt->bindValue(':customer_name', $customerName, PDO::PARAM_STR);

	$stmt->execute();

}

function getCustomerById($db, $id) {
	$sql = "SELECT * FROM customer
			WHERE customer_id = :customer_id;
			";

	$stmt = $db->prepare($sql);
	$stmt->bindValue(':customer_id', $id, PDO::PARAM_INT);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row;
}


function deleteCustomer($db, $idCustomer) {
	$sql = "DELETE FROM customer WHERE customer_id = :customer_id;";

	$stmt = $db->prepare($sql);
	$stmt->bindValue(':customer_id', $idCustomer, PDO::PARAM_INT);

	$stmt->execute();
}


function getOrderBy30days($db) {
  $sql = "SELECT order_id, Date_and_time, customer_name, price,shop_name, name FROM `order` 
 left JOIN customer ON customer_id_key = customer_id
 left JOIN product_has_order ON order_id_key = order_id
 left JOIN product ON product_id_key = product_id
 left JOIN shop ON shop_id_key = shop_id
 WHERE  
`Date_and_time` BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE()
 order by Date_and_time desc;
 
	";
	$result = array();

	$stmt = $db->prepare($sql);

	$stmt->execute();

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$result[$row['order_id']] = $row;
	}

	return $result;
}


function getOrderBy100days($db) {
  $sql = "SELECT order_id, Date_and_time, customer_name, price,shop_name, name FROM `order` 
 left JOIN customer ON customer_id_key = customer_id
 left JOIN product_has_order ON order_id_key = order_id
 left JOIN product ON product_id_key = product_id
 left JOIN shop ON shop_id_key = shop_id
 WHERE  
`Date_and_time` BETWEEN DATE_SUB(CURDATE(), INTERVAL 100 DAY) AND CURDATE()
 order by Date_and_time desc;
 
	";
	$result = array();

	$stmt = $db->prepare($sql);

	$stmt->execute();

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$result[$row['order_id']] = $row;
	}

	return $result;
}


function getOrderWithMaxDate($db) {
	$sql = "SELECT MAX(Date_and_time) FROM `order`;
			";

	$stmt = $db->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row;
}


function getAllShopsAscByName($db) {
  $sql = "SELECT * FROM shop order by shop_name asc;
 
	";
	$result = array();

	$stmt = $db->prepare($sql);

	$stmt->execute();

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$result[$row['shop_id']] = $row;
	}

	return $result;
}


function getAllShopsAscByAddress($db) {
  $sql = "SELECT * FROM shop order by address asc;
 
		";
	$result = array();

	$stmt = $db->prepare($sql);

	$stmt->execute();

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$result[$row['shop_id']] = $row;
	}

	return $result;
}


function getAllShopsAscByNumber($db) {
  $sql = "SELECT * FROM shop order by phone_number asc;
 
		";
	$result = array();

	$stmt = $db->prepare($sql);

	$stmt->execute();

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$result[$row['shop_id']] = $row;
	}

	return $result;
}


function getNumberOfProductsInCategories($db) {
  $sql = "SELECT product_id, name, category_name, count(*) as cn, sum(price)
  FROM product 
  inner join category on category_id = category.id 
  group by category.id;
 
		";
	$result = array();

	$stmt = $db->prepare($sql);

	$stmt->execute();

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$result[$row['product_id']] = $row;
	}

	return $result;
}



function getFullPriceOfProducts($db) {
  $sql = "SELECT sum(price)FROM product;
 
		";
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row;
}



function productsWithPriceInRange($db, $bottomBorder, $topBorder) {
  $sql = "SELECT * FROM product 
		left JOIN category ON category_id = id
		where price between :bottomBorder and :topBorder;
 
		";
		
	$result = array();

	$stmt = $db->prepare($sql);
	$stmt->bindValue(':bottomBorder', $bottomBorder, PDO::PARAM_INT);
	$stmt->bindValue(':topBorder', $topBorder, PDO::PARAM_INT);
	$stmt->execute();


	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$result[$row['product_id']] = $row;
	}

	return $result;
}


function productsPriceTop3ByExpensive($db) {
  $sql = "SELECT * FROM product 
		left JOIN category ON category_id = category.id 
		where price>=(select price from product order by price desc limit 2, 1) 
		order by price desc;
		
		";
		
	$result = array();

	$stmt = $db->prepare($sql);

	$stmt->execute();

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$result[$row['product_id']] = $row;
	}

	return $result;
}



function productsPriceTop3ByCheap($db) {
  $sql = "SELECT * FROM product 
		left JOIN category ON category_id = category.id 
		where price<=(select price from product order by price asc limit 2, 1) 
		order by price desc;
		
		";
		
	$result = array();

	$stmt = $db->prepare($sql);

	$stmt->execute();

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$result[$row['product_id']] = $row;
	}

	return $result;
}


function productsMaxWeight($db) {
  $sql = "SELECT MAX(weight) FROM product;
		
		";
		
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row;
}


function productsCountSum($db) {
  $sql = "SELECT name, sum(count) FROM product 
		inner join consignment_has_product group by name;
		
		";
		
		$result = array();

	$stmt = $db->prepare($sql);

	$stmt->execute();

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$result[$row['name']] = $row;
	}

	return $result;
}

?>

