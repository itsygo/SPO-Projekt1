<?php require_once ("header.php"); ?>

<div id="content">
	<div id="left" class="sidebar">
	<?php require_once ("leftsidebar.php"); ?>
	</div>
	<div id="right" class="sidebar">
	<?php require_once ("rightsidebar.php")?>
	</div>
	<div id="main">
		<h1>Informacija o prenosu:</h1>
        
		<p>
		<?php
            $predmetStripped = $_POST["predmet"];
            $nalogaId = $_POST["nalogaId"];
            if ($_FILES["file"]["type"] == "application/pdf") {
                if ($_FILES["file"]["size"] < 1000000) {
                    if ($_FILES["file"]["error"] > 0)
                    {
                        echo "Error: " . $_FILES["file"]["error"] . "<br />";
                    }
                    else
                    {
                        echo "Datoteka " . $_FILES["file"]["name"] . " je bila uspešno naložena.<br />";
                        /*echo "Type: " . $_FILES["file"]["type"] . "<br />";
                        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
                        echo "Stored in: " . $_FILES["file"]["tmp_name"];*/
                    }
                    $fileName = "".$_SESSION['user']['id']."_".$nalogaId."_" . $_FILES["file"]["name"];
                    $filePath = "pdfji/".imePredmetaStrippedArgIme($predmetStripped)."/" . $fileName;
                    //echo "PATH:".$_POST["predmet"];
                    if (file_exists($filePath))
                        {
                            echo $_FILES["file"]["name"] . " already exists. ";
                        }
                        else
                        {
                            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/".$filePath); //pdfji/Matematika2/" . "63070299_n2_" . $_FILES["file"]["name"]);
                            //echo "Stored in: " . "upload/".$filePath;//pdfji/Matematika2/" . "63070299_n2_" . $_FILES["file"]["name"];
                            oddajOddanoNalogo($nalogaId, $predmetStripped, $_SESSION['user']['id'], $fileName);
                        }
                }
                else {
                    echo "Napaka: Datoteka je večja od dovoljene velikosti!";
                }
            }
            else {
                echo "Napačna oddaja, oddati morate .pdf datoteko!";
            }
        ?>
		</p>
	</div>
</div>
<?php require_once ("footer.php"); ?>