<?php
require_once ("/functions/XmlParsing.php");

require_once("functions/functions.php");

function exists_predmetFolder($predmetFolderName) {
    $pathFolder = "./upload/pdfji/".$predmetFolderName;
    return file_exists($pathFolder);
}

function narediMapePredmetov() {
    $xml = readDB();

    foreach($xml->letniki->letnik as $letnik) {
        foreach($letnik->predmeti->predmet as $predmet) {
            if(!exists_predmetFolder(imePredmetaStrippedArgIme((string)$predmet->imePredmeta))) {
                //naredi folder za predmet
                $path = "./upload/pdfji/".imePredmetaStrippedArgIme((string)$predmet->imePredmeta);
                //echo "PATH:".$path;
                mkdir($path, 0777);
                echo "Naredil mapo:".$path."<br />";
            }
        }
    }
}

//ustvari mape ce se ne obstajajo
narediMapePredmetov();

?>
 
