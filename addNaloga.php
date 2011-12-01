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
		echo "<div class='grayBg'><h1>".getImePredmeta($courseid)."</h1></div>";
		

		if ($_SESSION['user']['usertype'] == "ucitelj") {
            if (isset($_POST["dodajNalogo"])) {
                echo dodajNalogo($courseid);
            }
            echo "<p>Dodaj nalogo:</p>";
            /*
             * <naloga>
                  <id>1</id>
                  <besedilo>Izračunaj sedmi odvod strehe fri-ja. Vrni 136. potenco tega odvoda. Rešitev oddaj v pdf formatu.</besedilo>
                  <rokOddaje>28.12.2011</rokOddaje>
                  <oddaneNaloge>
                  </oddaneNaloge>
                </naloga>
             */
            echo "<form action='' method='post'>
                    <p>
                        <input type='hidden' name='dodajNalogo' value='1' />
                        Besedilo:<textarea rows='5' cols='30' name='besedilo' ></textarea><br />
                        Rok oddaje:<input type='text' name='rokOddaje' id='datepickerRokOddaje' readonly='readonly' /><br />
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