<?php
session_start();

$currentPath = $_SERVER["PHP_SELF"];
$parts = Explode('/', $currentPath);
$currentPage = $parts[count($parts) - 1];

//check current page and do proper things
if ($currentPage == 'login.php') {
	if (isset($_SESSION['user'])) {
		$do = isset($_GET["do"])?$_GET["do"]:"";
		if ($do == "logout")
			doLogout();
		else
			header ("Location: index.php"); 
	} else {
		//DO LOGIN
		$error = doLogin();
	}
} else {
	if (isset($_SESSION['user'])) {
		$logindata = $_SESSION['user'];
		$expire = $logindata["expire"];
		$expiretime = 30*60; //session expires in 30mins
		if ($expire + $expiretime < time()) {
			doLogout();
		}
		$username = $logindata["username"];
		$usertype = $logindata["usertype"];
	} else {
		goToLoginPage();
	}
}

function doLogin() {
	//include("config.php"); //database config - see example
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		//$sql = "SELECT id FROM admin WHERE username='$myusername' and passcode='$mypassword'";
		//$result = mysql_query($sql);
		//$row = mysql_fetch_array($result);
		//$active = $row['active'];
		//$count = mysql_num_row($result);
		//$count = 1;
			
		//for test
		$count = 0;

        $xml = readDB();
        $userData = "";
        foreach($xml->users->user as $user) {
            //echo "username:".$user->username." ,password:".$user->password."<br />";
            if($user->username == $username && $user->password == $password) {
                $userdata = array("id" => (string)$user->id, "username" => $username, "usertype" => (string) $user->tip, "expire" => time());
                $count = 1;
            }
        }
		//echo $count;
        
		if ($count == 1) {
			/* Shranjevanje v session */
			//session_register("myusername");
			$_SESSION['user'] = $userdata;
			header("Location: index.php");
			return '';
		} else {
			return 'Uporabniško ime ali geslo ni veljavno.';
		}
	}
}

function doLogout() {
	session_destroy();
	goToLoginPage();
}

function goToLoginPage() {
	header ("Location: login.php");
}
?>