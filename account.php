<?php require_once ("header.php"); ?>
<?php 

/*todo:
 * 	tukaj treba naredit "save" za tisto formo
 * 	lahko se tudi funkcija "saveUserData" naredi v functions.php
 */

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
	<div id="content">
		<div id="left" class="sidebar">
			<?php include ("leftsidebar.php"); ?>
		</div>
		<div id="right" class="sidebar">
			<?php include ("rightsidebar.php")?>
		</div>
		<div id="main">
			<h1>Uredi profil</h1>
			<form id="uporabnik" method="post" action="">
				<p>
					<label for="accnamesurname">Ime in priimek</label>
					<input type="text" name="accnamesurname" id="accnamesurname" disabled="disabled" value="<?php echo $user['name'] . ' ' . $user['surname'] ?>" />
				</p>
				<p>
					<label for="accusername">Uporabniško ime</label>
					<input type="text" name="accusername" id="accusername" disabled="disabled" value="<?php echo $user['username'] ?>" />
				</p>
				<hr />
				<p>
					<label for="acclocation">Lokacija</label>
					<input type="text" name="acclocation" id="acclocation" value="<?php echo $user['location'] ?>" />
				</p>
				<p>
					<label>Država</label>
					<select>
					<?php
					foreach ($country_list as $countryname) {
						echo '<option value="' . $countryname . '" ' . ($user['country'] == $countryname ? 'selected="selected"' : null) . '>' . $countryname . '</option>';
					}
					?>
					</select>			
				</p>
				<hr />
				<p>
					<label for="accemail">E-mail*</label>
					<input type="text" name="accemail" id="accemail" value="<?php echo $user['email'] ?>" />
					<label id="emailerror" class="error"></label>
				</p>
				<p>
					<label for="accphone">Telefon</label>
					<input type="text" name="accphone" id="accphone" value="<?php echo $user['phone'] ?>" />
					<label id="phoneerror" class="error"></label>
				</p>
				<p>
					<label for="accwebsite">Spletna stran</label>
					<input type="text" name="accwebsite" id="accwebsite" value="<?php echo $user['website'] ?>" />
				</p>
				<hr />
				<p>
					<label for="accinterests">Interesi</label>
					<textarea id="accinterests" name="accinterests" rows="4" cols="30"><?php echo $user['interests'] ?></textarea>
				</p>
				<p>
					<label for="accdescription">Opis</label>
					<textarea id="accdescription" name="accdescription" rows="4" cols="30"><?php echo $user['description'] ?></textarea>
				</p>
				<p style="font-size: 10px;">
					*obvezna polja
				</p>
				<hr />
				<p>
					<input type="submit" id="saveaccount" name="saveaccount" value="Shrani" />
				</p>
			</form>
		</div>
	</div>
<?php include ("footer.php"); ?>