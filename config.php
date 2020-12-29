	
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
	.login-block .btn-block
	{
		margin-top:30px;
		padding:15px;
		background:#29aafe;
		border-color:#29aafe;
		width: 200px;
	}
</style>
			</head>
			<body class="login-page>
	
			<div class="login-block">
	<?php
session_start(); //Запускаем сессии

/** 
 * Класс для авторизации
 */ 
class AuthClass {
    private $_login = "admin"; //Устанавливаем логин
    private $_password = "1234"; //Устанавливаем пароль

    /**
     * Проверяет, авторизован пользователь или нет
     * Возвращает true если авторизован, иначе false
     * @return boolean 
     */
    public function isAuth() {
        if (isset($_SESSION["is_auth"])) { //Если сессия существует
            return $_SESSION["is_auth"]; //Возвращаем значение переменной сессии is_auth (хранит true если авторизован, false если не авторизован)
        }
        else return false; //Пользователь не авторизован, т.к. переменная is_auth не создана
    }
    
    /**
     * Авторизация пользователя
     * @param string $login
     * @param string $passwors 
     */
    public function auth($login, $passwors) {
		
        if ($login == $this->_login && $passwors == $this->_password) { //Если логин и пароль введены правильно
            $_SESSION["is_auth"] = true; //Делаем пользователя авторизованным
            $_SESSION["login"] = $login; //Записываем в сессию логин пользователя
            return true;
        }
		else if ($passwors == $this->_password)
		{
			 include 'db.php'; include 'api.php'; 
				$users = getAllCustomers($db);	
			foreach ($users as $key => $value) {
	
						if ($value['customer_name'] == $login)
						{
							 $_SESSION["is_auth"] = true; //Делаем пользователя авторизованным
            $_SESSION["login"] = $login; //Записываем в сессию логин пользователя
						return true;}
					}	
		}
        else { //Логин и пароль не подошел
            $_SESSION["is_auth"] = false;
            return false; 
        }
    }
    
    /**
     * Метод возвращает логин авторизованного пользователя 
     */
    public function getLogin() {
        if ($this->isAuth()) { //Если пользователь авторизован
            return $_SESSION["login"]; //Возвращаем логин, который записан в сессию
        }
    }
    
    
    public function out() {
        $_SESSION = array(); //Очищаем сессию
        session_destroy(); //Уничтожаем
    }
}

$auth = new AuthClass();

if (isset($_POST["login"]) && isset($_POST["password"])) { //Если логин и пароль были отправлены
    if (!$auth->auth($_POST["login"], $_POST["password"])) { //Если логин и пароль введен не правильно
        echo "<h2 style=\"margin-left:30px;\">Логин и пароль введен неверно!</h2>";
    }
}

if (isset($_GET["is_exit"])) { //Если нажата кнопка выхода
    if ($_GET["is_exit"] == 1) {
        $auth->out(); //Выходим
        header("Location: ?is_exit=0"); //Редирект после выхода
    }
}
?>

<?php if ($auth->isAuth() && $auth->getLogin() != "admin") { // Если пользователь авторизован, приветствуем:  
    //echo "Здравствуйте, " . $auth->getLogin() ;

	//echo '<a href="discount_user.php?result=' . $auth->getLogin() .'">посмотреть результат на другой странице</a>';
	 header("Location:discount_user.php?login=" .$auth->getLogin());


} 
else if ($auth->isAuth() && $auth->getLogin() == "admin") { // Если пользователь авторизован, приветствуем:  
    //echo "Здравствуйте, " . $auth->getLogin() ;

	//echo '<a href="discount_user.php?result=' . $auth->getLogin() .'">посмотреть результат на другой странице</a>';
	 header("Location:products.php?login=" .$auth->getLogin());


} 
else { //Если не авторизован, показываем форму ввода логина и пароля
?>
<form method="post" action="" style ="margin-left: 620px; margin-top:230px;">
    Логин: <input type="text" class="form-control" style ="width: 255px; height:35px;" name="login" value="<?php echo (isset($_POST["login"])) ? $_POST["login"] : null; // Заполняем поле по умолчанию ?>" /><br/>
    Пароль: <input type="password"  class="form-control" style =" width: 255px; height:35px;" name="password" value="" /><br/>
    <button style ="width: 130px; border-color:#29aafe; margin-top:20px; margin-left: 65px; padding:5px;border-radius:5px;font-family:Open Sans,sans-serif;
color:#96a2b2;letter-spacing:1px;font-size:14px;" type="submit">Войти</button>
</form>
<?php } ?>
</div>
</body>
</html>

