<?php
    session_start();
    require_once ("/functions/XmlParsing.php");

    if(isset($_GET["updateOcenoNaloge"])) {
        $oddanaNalogaId = $_GET["oddanaNalogaId"];
        $novaOcena = $_GET["novaOcena"];
        $predmetId = $_GET["predmetId"];
        $nalogaId = $_GET["nalogaId"];

        //zapisi v xml novo oceno
        $xml = readDB();
        //echo "oddanaNalogaId:".$oddanaNalogaId.", novaOcena:".$novaOcena.", predmetId:".$predmetId;
        foreach($xml->letniki->letnik as $letnik) {
            foreach($letnik->predmeti->predmet as $predmet) {
                if((string)$predmet->id == $predmetId) {

                    foreach($predmet->nalogePredmeta->naloga as $naloga) {
                        if((string)$naloga->id == $nalogaId) {
                            foreach($naloga->oddaneNaloge->oddanaNaloga as $oddanaNaloga) {
                                if((string)$oddanaNaloga->id == $oddanaNalogaId) {
                                    $oddanaNaloga->ocena = $novaOcena;
                                    saveDB($xml);
                                }
                            }
                        }
                    }

                }
            }
        }

        //vrni v json formatu html kot 'shranjeno' da bo zamenjal celoten input s tem
        $arr = array('outputHtml' => "Shranjeno!");
        echo json_encode($arr);
    }


    if(isset($_GET["calendar"])) {
        //za vsak predmet ki ga obiskujem poglej naloge in si jih nekam zapisi
        $arr = array();
        foreach(userPredmetiXml($_SESSION['user']['id']) as $predmet) {
            //echo "predmet:".(string)$predmet->imePredmeta;
            $imePredmeta = (string)$predmet->imePredmeta;
            $jeZeNoter = false;

            foreach($predmet->nalogePredmeta->naloga as $naloga) {

                $rokOddaje = (string)$naloga->rokOddaje;

                if(array_key_exists($rokOddaje, $arr)) {
                    if (!$jeZeNoter) {
                        $arr[$rokOddaje] = $arr[$rokOddaje]."<br /><p id=\\'calendarPredmet\\'>".$imePredmeta."</p><a href=\\'course.php?id=".(string)$predmet->id."&nalogaId=".(string)$naloga->id."\\'>Naloga ".(string)$naloga->id."</a>";
                    }
                    else {
                        $arr[$rokOddaje] = $arr[$rokOddaje]."<br /><a href=\\'course.php?id=".(string)$predmet->id."&nalogaId=".(string)$naloga->id."\\'>Naloga ".(string)$naloga->id."</a>";
                    }
                }
                else {
                    $jeZeNoter = true;
                    $arr[$rokOddaje] = "<p id=\\'calendarPredmet\\'>".$imePredmeta."</p><a href=\\'course.php?id=".(string)$predmet->id."&nalogaId=".(string)$naloga->id."\\'>Naloga ".(string)$naloga->id."</a>";
                }
            }
        }

        echo json_encode($arr);
    }

?>