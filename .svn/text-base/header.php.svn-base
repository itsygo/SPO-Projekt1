<?php
/* tomi kuha */
require_once("functions/XmlParsing.php");
require_once("functions/functions.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Spletna učilnica</title>
	<link type="text/css" href="css/style.css" rel="Stylesheet" />	
	<link rel="Shortcut Icon" href="favicon.ico" />
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
	<script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js"></script>
    
	<script type="text/javascript" src="js/overlib.js"></script>
    <link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
	
</head>
<body>
<div id="wrapper">
	<div id="header">
		<div id="logo">
			Spletna učilnica
		</div>
		<div id="userdata">
			<?php 
				if (isset($_SESSION["user"])) {
                    $username = $_SESSION['user']['username'];
					echo "<strong>Uporabnik: </strong>$username";
					echo "<br />";
					echo "<a id='odjava' href='login.php?do=logout'>Odjava</a>";
				}
			?>		
		</div>
	</div>