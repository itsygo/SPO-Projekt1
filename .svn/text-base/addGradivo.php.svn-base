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
		<p>
		<?php 
		echo "<h1>".getImePredmeta($courseid)."</h1>";
		

		if ($_SESSION['user']['usertype'] == "ucitelj") {
            if (isset($_POST["dodajGradivo"])) {
                echo dodajGradivo($courseid);
            }
            echo "<p>Dodaj gradivo:</p>";
            /*
             * <gradivo>
                  <id>1</id>
                  <besedilo>Gradivo za prvi teden</besedilo>
                  <povezaveGradiva></povezaveGradiva>
                </gradivo>
             */
            echo "<form action='' method='post'>
                    <p>
                        <input type='hidden' name='dodajGradivo' value='1' />
                        Besedilo:<input type='text' name='besedilo' /><br />
                        <input type='hidden' name='stPovezav' value='0' id='stPovezav'/>
                        <input type='button' value='Dodaj povezavo' onclick='dodajPovezavo();'/><br />
                        <input type='button' value='Odstrani povezavo' onclick='odstraniPovezavo();' /><br />
                        <div id='povezaveGradiv'></div>
                        <input type='submit' value='dodaj' />
                    </p>
                  </form>";
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
		</p>
        
	</div>
</div>
<?php require_once ("footer.php"); ?>