<?php require_once ("header.php"); ?>
<?php
/*
 * preverit ce je login zapisan v session.
 * v session zapisat roletype

 todo:
 @na tisti strani se izpišo vsi predmeti ki pripadajo
 šoli, fakulteti ali kaj je že
 */

$predmeti = array(
"1. letnik" => array(
array(	"ID" => 223232,
		"name" => "Predmet",
		"ID_year" => "1",
		"description" => "opis ki je lahko ful dolg...",
		"lecturer_username" => "lekturko"
), 
array(	"ID" => 223232,
		"name" => "Predmet1",
		"ID_year" => "1",
		"description" => "opis ki je lahko ful dolg...",
		"lecturer_username" => "lekturko"
), 
array(	"ID" => 223262,
		"name" => "Predmet2",
		"ID_year" => "1",
		"description" => "opis ki je lahko ful dolg...",
		"lecturer_username" => "lekturko"
)),
"2. letnik" => array(
array(	"ID" => 223232,
		"name" => "Predmet",
		"ID_year" => "1",
		"description" => "opis ki je lahko ful dolg...",
		"lecturer_username" => "lekturko"
)
));

/*tukaj je dosta samo če se dobijo nazaj podatki 
 * (ostalo ni pomembno tukaj):
 * ID
 * name
 * description
 */

?>

<div id="content">
	<div id="left" class="sidebar">
	<?php require_once ("leftsidebar.php"); ?>
	</div>
	<div id="right" class="sidebar">
	<?php require_once ("rightsidebar.php")?>
	</div>
	<div id="main">
        <div class='naslovnicaPredmeta'><h1>Predmeti</h1></div>
        
		<div>
		<?php
		
        echo predmetiLetnika();
		?>
		</div>
	</div>
</div>
<?php require_once ("footer.php"); ?>