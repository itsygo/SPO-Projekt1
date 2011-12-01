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


$courseid = isset($_GET["id"])?$_GET["id"]:"";

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
		<h1><?php echo $course['name'] ?></h1>
		<?php 
		echo '<form id="savecourse" name="savecourse" method="post" action="">';
		echo '<p>';
		echo '<label for="courseid">Id predmeta</label>';
		echo '<input type="text" name="courseid" id="courseid" disabled="true" value=' . $course['ID'] . '>';
		echo '</p>';
		echo '<p>';
		echo '<label for="courseyear">Letnik</label>';
		echo '<select id="courseyear">';
			foreach ($years as $year) {
				echo '<option value"' . $year['year'] . '" ' . ($course['ID_year'] == $year['year'] ? 'selected="selected"' : null) . '>' . $year['year'] . '</option>';
			}
		echo '</select>';
		echo '</p>';
		echo '<p>';
		echo '<label for="coursedesc">Opis</label>';
		echo '<textarea id="coursedesc" name="coursedesc" rows="10">' . $course['description'] . '</textarea>';
		echo '</p>';
		echo '<p>';
		echo '<label for="lecturer">Predavatelj</label>';
		echo '<select id="lecturers">';
			foreach ($lecturers as $lec) {
				echo '<option value"' . $lec['username'] . '" ' . ($lecturer['username'] == $lec['username'] ? 'selected="selected"' : null) . '>' . $lec['name'] . ' ' . $lec['surname'] . '</option>';
			}
		echo '</select>';
		echo '</p>';
		echo '<p>';
		echo '<input type="submit" id="btnsavecourse" name="btnsavecourse" value="Shrani">';
		echo '</p>';
		echo '</form>';

		if ($usertype == "teacher") {
			//lessons
			echo '<hr />';
			echo '<h3>Dodaj gradivo:</h3>';
			echo '<form id="savelesson" name="savelesson" method="post" action=""';
			echo '<p>';
			echo '<label for="lessonname">Ime gradiva</label>';
			echo '<input type="text" id="lessonname" name="lessonname">';
			echo '</p>';
			echo '<p>';
			echo '<label for="lessondesc">Opis gradiva</label>';
			echo '<textarea id="lessondesc" name="lessondesc" rows="10"></textarea>';
			echo '</p>';
			echo '<p>';
			echo '<input type="file" multiple="true" id="documents" name="documents">';
			echo '</p>';
			echo '<p>';
			echo '<textarea id="lessondesc" name="lessondesc" rows="5" placeholder="seperate with new row"></textarea>';
			echo '</p>';
			echo '<p>';
			echo '<input type="submit" id="btnaddlesson" name="btnaddlesson" value="Dodaj">';
			echo '</p>';
			echo '</form>';
			
			//tasks
			echo '<hr />';
			echo '<h3>Dodaj nalogo:</h3>';
			echo '<form id="savetask" name="savetask" method="post" action=""';
			echo '<p>';
			echo '<label for="taskname">Ime naloge</label>';
			echo '<input type="text" id="taskname" name="taskname">';
			echo '</p>';
			echo '<p>';
			echo '<label for="taskdesc">Opis naloge</label>';
			echo '<textarea id="taskdesc" name="taskdesc" rows="10"></textarea>';
			echo '</p>';
			echo '<p>';
			echo '<label for="taskdeadline">Deadline</label>';
			echo '<input type="text" id="taskdeadline" name="taskdeadline" placeholder="24.11.2011">';
			echo '</p>';
			echo '<p>';
			echo '<input type="submit" id="btnaddtask" name="btnaddtask" value="Dodaj">';
			echo '</p>';
			echo '</form>';
		}
		?>
	</div>
</div>
<?php require_once ("footer.php"); ?>