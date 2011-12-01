<?php require_once ("header.php"); ?>
<?php
/*
todo:
	@tukaj se prikažo podatki o predmetu, odvisno o 
	usertype in o tem če je študent vpisan v predmet:
	
	administrator
		lahko vidi in ureja
	
	student
		ni vpisan
			vidi opis in se lahko "prijavi"
		je vpisan
			vidi vse
	
	profesor
		je admin
			vidi in ureja predmet
		ni admin
			vidi opis in ne more se "prijavit"
 */

//$var = $_SERVER['QUERY_STRING']; //dobiješ celi query nazaj
$courseid = isset($_GET["id"])?$_GET["id"]:"";
/*
 * z baze vzamo podatke o $courseid;
 * nazaj se dobije $course;
 */
$course = array("ID" => 223232, "name" => "Ime predmeta", "ID_year" => "1", "description" => "opis ki je lahko ful dolg...", "lecturer_username" => "lekturko");

/*
 * za $course['lecturer_username']; je treba nazaj dobit
 * ime in priimek voditelja predmeta:
 * shrani v $lecturer
 */

$lecturer = array("name" => "Nori", "surname" => "Profesor");

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
        //if enrolled
        if (isset($_POST["enrollme"])) {
            echo enroll($courseid);
        }
        //if unenrolled
        if (isset($_POST["unenrollme"])) {
            echo unenroll($courseid);
        }
        
        if (($_SESSION['user']['usertype'] == 'student' && !enrolled($courseid, "student") )) {
            showEnrollOption($courseid);
        }
        else if (($_SESSION['user']['usertype'] == 'ucitelj' && !enrolled($courseid, "ucitelj") )) {
            echo "Ti nisi predavatelj tega predmeta.";
        }
        else {
            echo "<div class='naslovnicaPredmeta'><h1>".getImePredmeta($courseid)."</h1>";

            /*tukaj grejo se gumbi:
             * vpis na predmet - student
             * popis naloga itn, poglej nalogo, oddaj - student
             * uredi (dodaj voditelja, dodaj...) - admin
             * uredi/dodaj, oceni naloge - profesor
             * */
            if ($_SESSION['user']['usertype'] == "administrator") {
                //lahko vidi in spreminja vse
            } else if ($_SESSION['user']['usertype'] == "ucitelj") {

            /*
            je predmet_admin
                vidi in ureja predmet
            ni predmet_admin
                vidi opis in ne more se "prijavit"
            */
            } else if ($_SESSION['user']['usertype'] == "student") {
            /*
            ni vpisan
                vidi opis in se lahko "prijavi"
            je vpisan
                vidi vse
            */
            }
            ?>
            
            <?php
                if(isset($_GET['nalogaId'])) {
                    $nalogaId = $_GET["nalogaId"];
            ?>
                    <h3>Naloga:</h3>
                    
                      <?php
                        foreach(nalogePredmeta($courseid)->naloga as $naloga) {
                            if((string)$naloga->id == $_GET["nalogaId"]) {
                                echo nalogaHtml($naloga, $courseid);
                            }
                        }
                      ?>
                    
                    
                        <br />
                        <?php
                            if ($_SESSION['user']['usertype'] == "ucitelj") {
                                //Izpisi vse oddane naloge z ocenami in dodaj moznost spremembe ocene
                                echo "<h3>Oddane Naloge:</h3>";
                                $counter = 0;
                                foreach(oddaneNalogePredmeta($courseid, $nalogaId) as $oddanaNaloga) {
                                    $oddanaNalogaId = (string)$oddanaNaloga->id;
                                    $curHtml = "<div id='n".$oddanaNaloga->id."' class='oddanaNalogaBg'>";
                                    $inputBoxNaloga = "<input type='text' class='nova_ocena' name='nameNovaOcenaInput_" .$oddanaNalogaId."' id='novaOcenaInput_" .$oddanaNalogaId."' value='' />";
                                    $imePredmetaStripped = imePredmetaStripped($courseid);
                                    $pdfLink = "upload/pdfji/".$imePredmetaStripped."/".(string)$oddanaNaloga->pdfLink;
                                    $saveLink = "<a href=\"javascript: updateOcenoNaloge('".$nalogaId."','".$oddanaNalogaId."','".$courseid."');\">Oceni</a>";
                                    $trenutnaOcena = ((string)$oddanaNaloga->ocena == "") ? "neocenjeno": ((string)$oddanaNaloga->ocena);
                                    $curHtml .= "<p><strong>Pdf:</strong> <a href='".$pdfLink."' rel='external'>". ((string)$oddanaNaloga->pdfLink) ."</a> <strong>Trenutna ocena: </strong>
                                                " . $trenutnaOcena. " </p><div id='novaOcena_".$oddanaNalogaId."'><strong>Nova ocena: </strong>" . $inputBoxNaloga." ". $saveLink. "</div>";
                                    $curHtml .= "</div><br />";
                                    echo $curHtml;
                                    $counter++;
                                }
                                if($counter == 0)
                                    echo "Še nihče ni oddal naloge.";
                            }
                        ?>
                    

            <?php
                }else {
                    echo celotenOpisPredmeta($courseid);
            ?>

                    <p>
                    <?php echo '<i>Profesor: ' . profesorPredmetaImeInPriimek($courseid) . '</i>'; ?>
                    </p>
                    
                      <?php

                        $gradiva = gradivaPredmeta($courseid);
                        if (count($gradiva->gradivo) > 0) {
                            echo "<hr />";
                            foreach($gradiva->gradivo as $gradivo) {
                                echo gradivoHtml($gradivo);

                            }
                        }
                      ?>
                    

                      <?php

                        $naloge = nalogePredmeta($courseid);
                        if (count($naloge->naloga) > 0) {
                            echo '
                                        <hr />
                                        <h3>Naloge:</h3>
                                    ';
                            echo "<ul>";
                            foreach($naloge->naloga as $naloga) {
                                echo "<li><a href='course.php?id=$courseid&amp;nalogaId=$naloga->id'>". $naloga->id .". Naloga</a></li>";
                            }

                            echo "</ul>";
                        }
                      ?>
                    
                        <hr />
                    
                        <?php

                          if($_SESSION['user']['usertype'] == "ucitelj") {
                            echo '    <form action="urediPredmet.php?idPredmeta='.$courseid.'" method="post">
                                        <p><input type="submit" value="uredi" /></p>
                                    </form>';
                          }
                          else if($_SESSION['user']['usertype'] == "student") {
                            echo "".showUnEnrollOption($courseid, $_SESSION['user']['usertype'])."</div>";
                          }
                        ?>
                    
            <?php }
        }
        ?>
	</div>
	</div>
</div>
<?php require_once ("footer.php"); ?>