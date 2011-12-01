<?php require_once ("header.php"); ?>
<?php


//$var = $_SERVER['QUERY_STRING']; //dobiješ celi query nazaj
$courseid = isset($_GET["predmetId"])?$_GET["predmetId"]:"";


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
		echo "<h1>Dodaj predmet</h1>";
		
		if ($_SESSION['user']['usertype'] == "administrator") {
            if (isset($_POST["dodajPredmet"])) {
                echo dodajpredmet();
            }
            /*
             * <predmet>
                  <id>2</id>
                  <imePredmeta>Spletno programiranje</imePredmeta>
                  <opisPredmeta>Pretiravali bomo z domačimi nalogami :D</opisPredmeta>
                  <profesor>
                    <userId>2</userId>
                  </profesor>
                  <ucenci></ucenci>
                  <gradivaPredmeta></gradivaPredmeta>
                  <nalogePredmeta></nalogePredmeta>
                </predmet>
             */
            echo "<form action='' method='post'>
                    <p>
                        <input type='hidden' name='dodajPredmet' value='1' />
                        <label for='courseid'>Ime predmeta</label><input type='text' name='imePredmeta' id='courseid' />
                    </p>
                    <p>
                        <label for='courseyear'>Letnik</label>".letnikiDropDown()."
                    </p>
                    <p>
                        <label for='coursedesc'>Opis</label>
                        <textarea id='coursedesc' name='opisPredmeta' rows='10' cols='30'></textarea>
                    </p>
                    <p>
                        <label>Predavatelj</label>".profesorjiDropDown()."
                    </p>
                    <p>
                        <input type='submit' value='Dodaj predmet' />
                    </p>
                  </form>";


            /*
             * echo '<p>';
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
             */
		/*
		je predmet_admin
			vidi in ureja predmet
		ni predmet_admin
			vidi opis in ne more se "prijavit"
		*/
		} else {
		    echo "NONONO LOPOV!";
		}
		?>
        
	</div>
</div>
<?php require_once ("footer.php"); ?>