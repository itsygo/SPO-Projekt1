<?php require_once ("header.php"); ?>
<?php
/*
 * todo:
 * 
 * @shranjevanje podatkov
 * 
 * @tukaj sem uporablja input type file z HTML5 verzije.
 * pri staremu je mozno samo en file uploadat, tukaj pa več.
 * v glavnem, če nekaj ne bo delalo, odstrani atribut "multiple"
 * 
 * @shranjuj tud ID-i, kot pri vsih
 * 
 * @tud pazi na ID-e predmetov
 * 
 * @kje se uporabljajo date_entered ali nekaj podobnega,
 * vnesi "trenutno" vreme
 */


$courseid = isset($_GET["idPredmeta"])?$_GET["idPredmeta"]:"";

/*
 * z baze vzamo podatke o $courseid;
 * nazaj se dobije -> $course;
 */
$course = 
array(	"ID" => 223232, 
		"name" => "Ime predmeta", 
		"ID_year" => "1", 
		"description" => "opis ki je lahko ful dolg...", 
		"lecturer_username" => "lekturko");

/*
 * z baze preberi vse letnike -> $years
 */
$years = 
array(
array(	"ID" => 1,
		"year" => "2011"),
array(	"ID" => 2,
		"year" => "2012")
);

/*
 * preberi vse profesore z baze, po "usertype"
 */

$lecturers = array(
array("username" => "norip", "name" => "Nori", "surname" => "Profesor"),
array("username" => "zidpa", "name" => "Zidpa", "surname" => "Nicla")
);

/*
 * z baze preberi ime in priimek voditelja/profesora
 * za tisti predmet -> $lecturer
 */
$lecturer = array("username" => "norip", "name" => "Nori", "surname" => "Profesor");


?>
<div id="content">
	<div id="left" class="sidebar">
	<?php require_once ("leftsidebar.php"); ?>
	</div>
	<div id="right" class="sidebar">
	<?php require_once ("rightsidebar.php")?>
	</div>
	<div id="main">
		<?php
		if ($_SESSION['user']['usertype'] == "ucitelj") {
            //headline
            echo '<h1>'.getImePredmeta($courseid).'</h1>';
			echo '<hr />';
            
            //if updated opis predmeta
            if (isset($_POST["updateOpisPredmeta"])) {
                echo updateOpisPredmeta($courseid);
            }
            //if added gradivo
            if (isset($_POST["dodajGradivo"])) {
                echo dodajGradivo($courseid);
            }
            //if added naloga
            if (isset($_POST["dodajNalogo"])) {
                echo dodajNalogo($courseid);
            }
            //opis predmeta

            echo '<h3>Predmet:</h3>';
			echo '<form id="savelesson" method="post" action="">';
            echo "<p>
                        <label for='coursedesc'>Opis</label>
                        <textarea id='coursedesc' name='opisPredmeta' rows='10' cols='30'></textarea>
                    </p>";
            echo "<p>";
            echo "<input type='hidden' name='updateOpisPredmeta' value='1' />";
			echo '<input type="submit" id="btnaddlesson" name="btnaddlesson" value="Dodaj" />';
			echo '</p>';
			echo '</form>';


			//lessons
            echo '<hr />';
			echo '<h3>Dodaj gradivo:</h3>';
			echo '<form id="savelesson2" method="post" action="">';
			echo '<p>';
			echo '<label for="lessondesc">Opis gradiva</label>';
			echo '<textarea id="lessondesc" name="besediloGradiva" rows="10" cols="30"></textarea>';
			echo '</p>';
			echo '<p>';
            echo "<input type='hidden' name='dodajGradivo' value='1' />";
            echo "<input type='hidden' name='stPovezav' value='0' id='stPovezav'/>";
            echo "</p>";
            echo "<p>Povezave</p>";
            echo "<p><input type='button' value='Dodaj povezavo' onclick='dodajPovezavo();'/>";
            echo "</p>";
            echo "<p>";
            echo "<input type='button' value='Odstrani povezavo' onclick='odstraniPovezavo();' />";
            echo "</p>";
            echo "<div id='povezaveGradiv'></div>";
            echo "<p>";
			echo '<input type="submit" id="btnaddlesson2" name="btnaddlesson2" value="Dodaj" />';
			echo '</p>';
			echo '</form>';
			
			//tasks
			echo '<hr />';
			echo '<h3>Dodaj nalogo:</h3>';
			echo '<form id="savetask" method="post" action="">';
			echo '<p>';
			echo '<label for="taskdesc">Opis naloge</label>';
			echo '<textarea id="taskdesc" name="besediloNaloge" rows="10" cols="30"></textarea>';
			echo '</p>';
			echo '<p>';
			echo '<label for="taskdeadline">Deadline</label>';
			echo '<input type="text" id="datepickerRokOddaje" readonly="readonly" name="rokOddaje" />';
			echo '</p>';
			echo '<p>';
            echo "<input type='hidden' name='dodajNalogo' value='1' />";
			echo '<input type="submit" id="btnaddtask" name="btnaddtask" value="Dodaj" />';
			echo '</p>';
			echo '</form>';
		}
		?>
	</div>
</div>
<?php require_once ("footer.php"); ?>