<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Spletna učilnica registracija</title>
	<link type="text/css" href="css/style.css" rel="Stylesheet" />
	<link rel="Shortcut Icon" href="favicon.ico" />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
	<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js"></script>

	<script type="text/javascript" src="js/overlib.js"></script>
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
	
</head>
<body>
    <div id="wrapper">
	<div id="header">
		<div id="logo">
			Spletna učilnica
		</div>
		<p></p>
	</div>
	<div id="registerData">
<?php
require_once ("/functions/XmlParsing.php");
/*todo:
 * 	tukaj treba naredit "save" za tisto formo
 * 	lahko se tudi funkcija "saveUserData" naredi v functions.php
 */
$name = isset($_POST["accname"])?$_POST["accname"]:"";
$lastName = isset($_POST["accsurname"])?$_POST["accsurname"]:"";
$username = isset($_POST["accusername"])?$_POST["accusername"]:"";
$password = isset($_POST["accpassword"])?$_POST["accpassword"]:"";

$country_list = array(
	"Afghanistan",
	"Albania",
	"Algeria",
	"Andorra",
	"Angola",
	"Antigua and Barbuda",
	"Argentina",
	"Armenia",
	"Australia",
	"Austria",
	"Azerbaijan",
	"Bahamas",
	"Bahrain",
	"Bangladesh",
	"Barbados",
	"Belarus",
	"Belgium",
	"Belize",
	"Benin",
	"Bhutan",
	"Bolivia",
	"Bosnia and Herzegovina",
	"Botswana",
	"Brazil",
	"Brunei",
	"Bulgaria",
	"Burkina Faso",
	"Burundi",
	"Cambodia",
	"Cameroon",
	"Canada",
	"Cape Verde",
	"Central African Republic",
	"Chad",
	"Chile",
	"China",
	"Colombi",
	"Comoros",
	"Congo (Brazzaville)",
	"Congo",
	"Costa Rica",
	"Cote d'Ivoire",
	"Croatia",
	"Cuba",
	"Cyprus",
	"Czech Republic",
	"Denmark",
	"Djibouti",
	"Dominica",
	"Dominican Republic",
	"East Timor (Timor Timur)",
	"Ecuador",
	"Egypt",
	"El Salvador",
	"Equatorial Guinea",
	"Eritrea",
	"Estonia",
	"Ethiopia",
	"Fiji",
	"Finland",
	"France",
	"Gabon",
	"Gambia, The",
	"Georgia",
	"Germany",
	"Ghana",
	"Greece",
	"Grenada",
	"Guatemala",
	"Guinea",
	"Guinea-Bissau",
	"Guyana",
	"Haiti",
	"Honduras",
	"Hungary",
	"Iceland",
	"India",
	"Indonesia",
	"Iran",
	"Iraq",
	"Ireland",
	"Israel",
	"Italy",
	"Jamaica",
	"Japan",
	"Jordan",
	"Kazakhstan",
	"Kenya",
	"Kiribati",
	"Korea, North",
	"Korea, South",
	"Kuwait",
	"Kyrgyzstan",
	"Laos",
	"Latvia",
	"Lebanon",
	"Lesotho",
	"Liberia",
	"Libya",
	"Liechtenstein",
	"Lithuania",
	"Luxembourg",
	"Macedonia",
	"Madagascar",
	"Malawi",
	"Malaysia",
	"Maldives",
	"Mali",
	"Malta",
	"Marshall Islands",
	"Mauritania",
	"Mauritius",
	"Mexico",
	"Micronesia",
	"Moldova",
	"Monaco",
	"Mongolia",
	"Morocco",
	"Mozambique",
	"Myanmar",
	"Namibia",
	"Nauru",
	"Nepa",
	"Netherlands",
	"New Zealand",
	"Nicaragua",
	"Niger",
	"Nigeria",
	"Norway",
	"Oman",
	"Pakistan",
	"Palau",
	"Panama",
	"Papua New Guinea",
	"Paraguay",
	"Peru",
	"Philippines",
	"Poland",
	"Portugal",
	"Qatar",
	"Romania",
	"Russia",
	"Rwanda",
	"Saint Kitts and Nevis",
	"Saint Lucia",
	"Saint Vincent",
	"Samoa",
	"San Marino",
	"Sao Tome and Principe",
	"Saudi Arabia",
	"Senegal",
	"Serbia and Montenegro",
	"Seychelles",
	"Sierra Leone",
	"Singapore",
	"Slovakia",
	"Slovenia",
	"Solomon Islands",
	"Somalia",
	"South Africa",
	"Spain",
	"Sri Lanka",
	"Sudan",
	"Suriname",
	"Swaziland",
	"Sweden",
	"Switzerland",
	"Syria",
	"Taiwan",
	"Tajikistan",
	"Tanzania",
	"Thailand",
	"Togo",
	"Tonga",
	"Trinidad and Tobago",
	"Tunisia",
	"Turkey",
	"Turkmenistan",
	"Tuvalu",
	"Uganda",
	"Ukraine",
	"United Arab Emirates",
	"United Kingdom",
	"United States",
	"Uruguay",
	"Uzbekistan",
	"Vanuatu",
	"Vatican City",
	"Venezuela",
	"Vietnam",
	"Yemen",
	"Zambia",
	"Zimbabwe"
);

/* podatke preberi v XML, išči po userneme ki je že
 * shranjen v session, shrani v $user.
 */

$user = array(
'username' => 'test', 
'usertype' => 'administrator', 
'password' => '',
'name' => 'Testni',
'surname' => 'Uporabnik',
'email' => 'test@testni.com',
'location' => 'Ljubljana',
'country' => 'Slovenia',
'phone' => '030555666',
'website' => 'http://www.fri.uni-lj.si',
'interests' => 'Nothing at all!',
'description' => 'Opis');
?>
	<div id="content2">
        
        <h1>Registracija</h1>
        <?php
            if(isset($_POST["accusername"]) && isset($_POST["accname"]) && isset($_POST["accsurname"]) && isset($_POST["accpassword"])) {

                echo dodajUserja($name,$lastName,$username,$password);
                echo "<p><a href='login.php'>Prijava</a></p>";
            }
            else {
                 echo "<form id='uporabnik' method='post' action='' onsubmit='return validateRegister()'>
                    <p>
                        <label for='accname'>Ime</label>
                        <input type='text' name='accname' id='accname' value='' />
                    </p>
                    <p>
                        <label for='accsurname'>Priimek</label>
                        <input type='text' name='accsurname' id='accsurname' value='' />
                    </p>
                    <p>
                        <label for='accusername'>Uporabniško ime</label>
                        <input type='text' name='accusername' id='accusername' value='' />
                    </p>
                    <p>
                        <label for='accpassword'>Geslo</label>
                        <input type='password' name='accpassword' id='accpassword' value='' />
                    </p>
                    <hr />
                    <p>
                        <label for='accemail'>E-mail*</label>
                        <input type='text' name='accemail' id='accemail' value='' />
                        <label id='emailerror' class='error'></label>
                    </p>
                    <p style='font-size: 10px;'>
                        vsa polja so obvezna polja
                    </p>
                    <hr />
                    <p>
                        <input type='submit' id='registeraccount' name='registeraccount' value='Registriraj se' />
                    </p>
                </form>";
            }
        ?>
	</div>
	</div>
<?php include ("footer.php"); ?>