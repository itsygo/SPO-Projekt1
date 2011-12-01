<?php

/*
 * Parsing Functions
 */

$xml_db = "baza.xml";

function readDB() {
	global $xml_db;
	if (file_exists($xml_db))
    	$xml = simplexml_load_file($xml_db);
	else
    	exit('No such file -> "$xmlfile"');

	return $xml;
}
 function saveDB($xml) {
	global $xml_db;
     /*
	$xmlHandle = fopen($xml_db, "w");
	fwrite($xmlHandle, $xml->asXML());
	fclose($xmlHandle);*/

    //Format XML to save indented tree rather than one line
    $dom = new DOMDocument('1.0');
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $dom->loadXML($xml->asXML());
    //Echo XML - remove this and following line if echo not desired
    //echo $dom->saveXML();
    //Save XML to file - remove this and following line if save not desired
    $dom->save($xml_db);
}


function getUser($id) {
    try{

        $xml = readDB();
        /*
         *
         *  $baza = preberiBazo();
            $cha = $baza->addChild('uporabnik');
            $cha->addChild('ime', $ime);
            $cha->addChild('priimek', $priimek);
            $cha->addChild('denarnica');
            $cha->addChild('transakcijski');
            $cha->addChild('varcevalni');

            //echo $baza->asXML();
            shraniBazo($baza);
         */
        foreach ($xml->users->user as $user) {
            //$user->id = '1333';
            //saveDB($xml);
            if($user->id == $id) {
                $user->addChild('TestniOtrok','TesniValueOtroka');
                saveDB($xml);
            }

                //return "id: ".$user->id.", name: ".$user->ime;
        }



    }
    catch(Exception $e){
        echo $e->getMessage();
        exit();
    }
}

function predmetiLetnika() {
    $xml = readDB();
    $html = "";
    foreach($xml->letniki->letnik as $letnik) {
        $html .= "<h3>$letnik->letnikIme</h3>";
        $html .= "<ul>";

        foreach($letnik->predmeti->predmet as $predmet) {
            $html .= "<li><a href='course.php?id=$predmet->id' title='$predmet->imePredmeta'>$predmet->imePredmeta</a></li>";
        }

        $html .= "</ul>";
    }

    return $html;
}

function getImePredmeta($courseId) {
    $xml = readDB();
    foreach($xml->letniki->letnik as $letnik) {
        foreach($letnik->predmeti->predmet as $predmet) {
            if($predmet->id == $courseId) {
                return (string)$predmet->imePredmeta;

            }
        }
    }

}

function celotenOpisPredmeta($courseId) {

    $xml = readDB();
    $html = "";
    foreach($xml->letniki->letnik as $letnik) {
        foreach($letnik->predmeti->predmet as $predmet) {
            if($predmet->id == $courseId) {

                $html .= "<p>Opis: ".$predmet->opisPredmeta ."</p>";
            }
        }
    }
    return $html;
}

function imePredmetaStripped($courseId) {
    $xml = readDB();
    foreach($xml->letniki->letnik as $letnik) {
        foreach($letnik->predmeti->predmet as $predmet) {
            if($predmet->id == $courseId) {
                return imePredmetaStrippedArgIme((string)$predmet->imePredmeta);
            }
        }
    }
}

function imePredmetaStrippedArgIme($ime) {
    $str = str_replace(" ", "", $ime);
    $str = str_replace("č", "c", $str);
    $str = str_replace("š", "s", $str);
    $str = str_replace("ž", "z", $str);
    $str = str_replace("Č", "C", $str);
    $str = str_replace("Š", "S", $str);
    $str = str_replace("Ž", "Z", $str);
    return $str;
}

function profesorPredmetaId($courseId) {
    $xml = readDB();
    foreach($xml->letniki->letnik as $letnik) {
        foreach($letnik->predmeti->predmet as $predmet) {
            if($predmet->id == $courseId) {
                return $predmet->profesor->userId;
            }
        }
    }
}

function profesorPredmetaImeInPriimek($courseId) {

    $profesorId = profesorPredmetaId($courseId);
    $xml = readDB();
    foreach($xml->users->user as $user) {
        if($user->id == (string)$profesorId) {
            return "$user->ime $user->priimek";
        }
    }
}

function gradivaPredmeta($courseid) {

    $xml = readDB();
    foreach($xml->letniki->letnik as $letnik) {
        foreach($letnik->predmeti->predmet as $predmet) {
            if((string)$predmet->id == $courseid) {
                return $predmet->gradivaPredmeta;
            }
        }
    }
}

function gradivoHtml($gradivo) {
    $idGradiva = (string)$gradivo->id;
    $html = "<h3>".$idGradiva.". gradivo</h3>";
    $html .= "<p>".(string)$gradivo->besedilo."</p>";
    $html .= "<p>Povezave:</p>";
    $html .= "<ul>";
    foreach($gradivo->povezaveGradiva->povezava as $povezava) {
        $html .= "<li><a href='$povezava->url' rel='external'>$povezava->besedilo</a></li>";
    }
    $html .= "</ul>";
    
    return $html;
}

function nalogePredmeta($courseid) {

    $xml = readDB();
    foreach($xml->letniki->letnik as $letnik) {
        foreach($letnik->predmeti->predmet as $predmet) {
            if($predmet->id == $courseid) {
                return $predmet->nalogePredmeta;
            }
        }
    }
}

function nalogaHtml($naloga, $courseId) {

    $html = "";
    $html .= "<p>$naloga->besedilo</p>";
    $sloCezRok = (datumVecjiOd($naloga->rokOddaje));
    if ($_SESSION['user']['usertype'] == 'student' ) {
        $imePredmetaStripped = imePredmetaStripped($courseId);
        $nalogaId = $naloga->id;
        
        //$html .= "<p>Rok oddaje: $naloga->rokOddaje 23:59 - ". (($sloCezRok == true) ? 'Čas za oddajo je potekel.' : 'Pohiti<br />')."</p>";




        $html .= "<br /><br />";
        $oddalHtml = "<p>Zaenkrat nisi še nič oddal.</p>";
        $oddal = false;
        foreach($naloga->oddaneNaloge->oddanaNaloga as $oddanaNaloga) {
            if($oddanaNaloga->userId == $_SESSION['user']['id']) {
                $oddal = true;
                $datoteka = explode("/",$oddanaNaloga->pdfLink);
                $datoteka = $datoteka[count($datoteka)-1];
                $oddalHtml = "<p class='taskdate'>Oddana datoteka: <strong>".$datoteka."</strong></p><p class='taskdate'>Ocena: <strong>";
                $oddalHtml .= ($oddanaNaloga->ocena == "") ? "Ni še ocenjeno": "$oddanaNaloga->ocena".".00%";
                $oddalHtml .= "</strong></p>";
            }
        }

        if(!$oddal) {
            if($sloCezRok){
                $oddalHtml .= "<p>Ampak to ni izgovor zato avtomatska ocena 0.00%</p>";
            }
            else {
                $htmlFormaOddaja = '<form action="upload.php" class="taskdate" method="post" enctype="multipart/form-data">
                        <p><input type="hidden" name="predmet" value="'.$imePredmetaStripped.'"></input>
                        <input type="hidden" name="nalogaId" value="'.$nalogaId.'"></input>
                        <input type="file" name="file" id="file" /></p>
                        <p><input type="submit" name="submit" value="Nalozi" /></p>
                      </form>';
                $oddalHtml .= $htmlFormaOddaja;
            }
        }

        $html .= $oddalHtml;
        $html .= "<p class='taskdate'>Rok za oddajo: $naloga->rokOddaje 23:59</p>";
    }
    return $html;
}

function userPredmeti($userId) {
    $mojiPredmeti = array();

    if($_SESSION["user"]["usertype"] == "ucitelj") {
        $xml = readDB();
        foreach($xml->letniki->letnik as $letnik) {
            foreach($letnik->predmeti->predmet as $predmet) {
                foreach($predmet->profesor as $profesor) {
					foreach($profesor->userId as $userId) {
						if((string)$userId == $_SESSION['user']['id']) {
							$mojiPredmeti[] = array('id' => (string)$predmet->id, 'ime' => (string) $predmet->imePredmeta);
						}
					}
                }
            }
        }
    }
    else {
        $xml = readDB();
        foreach($xml->letniki->letnik as $letnik) {
            foreach($letnik->predmeti->predmet as $predmet) {
                foreach($predmet->ucenci as $ucenci) {
					foreach($ucenci->userId as $userId) {
						if((string)$userId == $_SESSION['user']['id']) {
							$mojiPredmeti[] = array('id' => (string)$predmet->id, 'ime' => (string) $predmet->imePredmeta);
						}
					}
                }
            }
        }
    }
    return $mojiPredmeti;
}

function userPredmetiXml($userId) {
    $mojiPredmeti = array();

    if($_SESSION["user"]["usertype"] == "ucitelj") {
        $xml = readDB();
        foreach($xml->letniki->letnik as $letnik) {
            foreach($letnik->predmeti->predmet as $predmet) {
                foreach($predmet->profesor as $profesor) {
                    foreach($profesor->userId as $userId) {
                        if((string)$userId == $_SESSION['user']['id']) {
                            $mojiPredmeti[] = $predmet;
                        }
                    }
                }
            }
        }
    }
    else {
        $xml = readDB();
        foreach($xml->letniki->letnik as $letnik) {
            foreach($letnik->predmeti->predmet as $predmet) {
                //$mojiPredmeti[] = $predmet;
                foreach($predmet->ucenci as $ucenci) {
                    foreach($ucenci->userId as $userId) {
                        if((string)$userId == $_SESSION['user']['id']) {
                            $mojiPredmeti[] = $predmet;
                        }
                    }
                }
            }
        }
    }

    return $mojiPredmeti;
}

function datumVecjiOd($datum) {
    $arr = explode(".", $datum);
    $reversedDate = (string)($arr[2].".".$arr[1].".".$arr[0]);
    $todayDate = (string) date("Y.m.d");
    //$todayDate = "2011.12.28";
    //echo "TODAY:".$todayDate.", reversedDate:".$reversedDate;
    //if($todayDate == "2011.12.28") echo "LALA1";
    //if($reversedDate == "2011.12.28") echo "LALA2";
    //echo "strcmp->".strcmp($todayDate, $reversedDate);
    if (strcmp($todayDate, $reversedDate) > 0)
        return true;
    else
        return false;
}

function oddajOddanoNalogo($nalogaId, $imePredmetaStripped, $userId, $newFileName) {
    //echo "nalogaId:".$nalogaId;
    $xml = readDB();

    /*
     * <oddanaNaloga>
          <id>1</id>
          <userId>4</userId>
          <pdfLink>3_1_druga.pdf</pdfLink>
          <ocena>1</ocena>
        </oddanaNaloga>
     */
    foreach($xml->letniki->letnik as $letnik) {
        foreach ($letnik->predmeti->predmet as $predmet) {
            //echo "<br />id:".$predmet->id."curImePredmetaStripped:".imePredmetaStripped((string)$predmet->id)."-".$imePredmetaStripped;
            if(imePredmetaStripped((string)$predmet->id) == $imePredmetaStripped) {
                //nasel predmet
                foreach($predmet->nalogePredmeta->naloga as $naloga) {
                    if((string)$naloga->id == $nalogaId) {
                        //give birth to a new child
                        $oddaneNaloge = $naloga->oddaneNaloge;
                        $oddanaNaloga = $oddaneNaloge->addChild('oddanaNaloga');

                        $newId = findMaxIdOddanaNaloga($oddaneNaloge) + 1;
                        $oddanaNaloga->addChild('id', $newId);
                        $oddanaNaloga->addChild('userId', $userId);
                        $oddanaNaloga->addChild('pdfLink', $newFileName);
                        $oddanaNaloga->addChild('ocena', "");


                        saveDB($xml);
                    }
                }



                //$user->addChild('TestniOtrok','TesniValueOtroka');
                //saveDB($xml);
            }
        }
    }
}

function findMaxIdOddanaNaloga($oddaneNaloge) {
    $m = 0;
    foreach($oddaneNaloge->oddanaNaloga as $oddanaNaloga) {
        if ((int)((string)$oddanaNaloga->id) > $m)
            $m = (int)((string)$oddanaNaloga->id);
    }
    return ((int)$m);
}

function oddaneNalogePredmeta($courseid, $nalogaId) {
    $xml = readDB();
    //echo "LALALA";
    foreach($xml->letniki->letnik as $letnik) {
        foreach ($letnik->predmeti->predmet as $predmet) {
            //echo "<br />id:".$predmet->id."curImePredmetaStripped:".imePredmetaStripped((string)$predmet->id)."-".$imePredmetaStripped;
            if((string)$predmet->id == $courseid) {
                foreach($predmet->nalogePredmeta->naloga as $naloga) {
                    if((string)$naloga->id == $nalogaId) {
                        return $naloga->oddaneNaloge->oddanaNaloga;
                    }
                }

            }
        }
    }
}

function findMaxIdNaloga($nalogePredmeta) {
    $m = 0;
    foreach($nalogePredmeta->naloga as $naloga) {
        if ((int)((string)$naloga->id) > $m)
            $m = (int)((string)$naloga->id);
    }
    return ((int)$m);
}

function dodajNalogo($courseId) {
    if(!isset($_POST["besediloNaloge"]) || !isset($_POST["rokOddaje"]))
        return "NAPAKA: Potrebno je izpolniti vsa polja!";

    $xml = readDB();
    foreach($xml->letniki->letnik as $letnik) {
        foreach($letnik->predmeti->predmet as $predmet) {
            if((string)$predmet->id == $courseId) {
                $nalogePredmeta = $predmet->nalogePredmeta;
                $novaNaloga = $nalogePredmeta->addChild("naloga");

                $newId = findMaxIdNaloga($nalogePredmeta) + 1;

                /*
                 * <naloga>
                      <id>1</id>
                      <besedilo>Izračunaj sedmi odvod strehe fri-ja. Vrni 136. potenco tega odvoda. Rešitev oddaj v pdf formatu.</besedilo>
                      <rokOddaje>28.12.2011</rokOddaje>
                      <oddaneNaloge>
                      </oddaneNaloge>
                    </naloga>
                 */
                $novaNaloga->addChild("id", $newId);
                $novaNaloga->addChild("besedilo", $_POST["besediloNaloge"]);
                $novaNaloga->addChild("rokOddaje", $_POST["rokOddaje"]);
                $novaNaloga->addChild("oddaneNaloge", "");

                saveDB($xml);

                return "Naloga je bila uspešno dodana!";
            }
        }
    }

    return "Predmeta nisem našel...";
}

function findMaxIdGradivo($gradivaPredmeta) {
    $m = 0;
    foreach($gradivaPredmeta->gradivo as $gradivo) {
        if ((int)((string)$gradivo->id) > $m)
            $m = (int)((string)$gradivo->id);
    }
    return ((int)$m);
}

function dodajGradivo($courseId) {
    if(!isset($_POST["besediloGradiva"]))
        return "NAPAKA: Potrebno je izpolniti polje besedilo!";

    $xml = readDB();
    foreach($xml->letniki->letnik as $letnik) {
        foreach($letnik->predmeti->predmet as $predmet) {
            if((string)$predmet->id == $courseId) {
                $gradivaPredmeta = $predmet->gradivaPredmeta;
                $novoGradivo = $gradivaPredmeta->addChild("gradivo");

                $newId = findMaxIdGradivo($gradivaPredmeta) + 1;

                /*
                 * <gradivo>
                      <id>1</id>
                      <besedilo>Gradivo za prvi teden</besedilo>
                      <povezaveGradiva>
                        <povezava>
                          <id>1</id>
                          <url>http://www.google.com</url>
                          <besedilo>Tvoj best frend</besedilo>
                        </povezava>
                        <povezava>
                          <id>2</id>
                          <url>http://www.24ur.com</url>
                          <besedilo>Govorijo resnico</besedilo>
                        </povezava>
                      </povezaveGradiva>
                    </gradivo>
                 */
                $novoGradivo->addChild("id", $newId);
                $novoGradivo->addChild("besedilo", $_POST["besediloGradiva"]);
                $novePovezaveGradiva = $novoGradivo->addChild("povezaveGradiva","");
                for($i = 0; $i < $_POST['stPovezav']; $i++) {
                    $curPovezava = $novePovezaveGradiva->addChild("povezava", "");
                    $curPovezava->addChild("id", $i+1);
                    $curPovezava->addChild("url", $_POST["povezava".($i+1)."_url"]);
                    $curPovezava->addChild("besedilo", $_POST["povezava".($i+1)."_besedilo"]);

                }

                saveDB($xml);

                return "Gradivo je bilo uspešno dodano!";
            }
        }
    }

    return "Predmeta nisem našel...";
}

function profesorjiDropDown() {
    $xml = readDB();
    $html = "<select id='lecturers' name='profesorjiDropDown'>";
    foreach($xml->users->user as $user) {
        if((string)$user->tip == "ucitelj") {
            $userId = (string)$user->id;
            $imeInPriimek = (string)$user->ime . " " . (string)$user->priimek;
            $html .= "<option value='".$userId."'>".$imeInPriimek."</option>";
        }
    }
    $html .= "</select>";
    return $html;
}

function letnikiDropDown() {
    $xml = readDB();
    $html = "<select id='courseyear' name='letnikiDropDown'>";
    foreach($xml->letniki->letnik as $letnik) {
        $letnikIme = (string)$letnik->letnikIme;
        $html .= "<option value='".$letnikIme."'>".$letnikIme."</option>";

    }
    $html .= "</select>";
    return $html;
}
function findMaxIdPredmeta() {
    $xml = readDB();
    $m = 0;
    foreach($xml->letniki->letnik as $letnik) {
        foreach($letnik->predmeti->predmet as $predmet) {
            if ((int)((string)$predmet->id) > $m)
                $m = (int)((string)$predmet->id);
        }

    }
    return ((int)$m);
}

function dodajpredmet() {
    $xml = readDB();
    $letnikIme = $_POST["letnikiDropDown"];
    $profesorId = $_POST["profesorjiDropDown"];
    foreach($xml->letniki->letnik as $letnik) {
        if ((string)$letnik->letnikIme == $letnikIme) {
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
            $predmetiLetnika = $letnik->predmeti;
            $novPredmet = $predmetiLetnika->addChild("predmet");
            $newId = findMaxIdPredmeta() +1;


            $novPredmet->addChild("id", $newId);
            $novPredmet->addChild("imePredmeta", $_POST["imePredmeta"]);
            $novPredmet->addChild("opisPredmeta", $_POST["opisPredmeta"]);
            $profTag = $novPredmet->addChild("profesor", "");
            $profTag->addChild("userId", $profesorId);

            $novPredmet->addChild("ucenci", "");
            $novPredmet->addChild("gradivaPredmeta", "");
            $novPredmet->addChild("nalogePredmeta", "");

            saveDB($xml);
            //$path = dirname(__FILE__)."/../upload/pdfji/".imePredmetaStripped($newId);
            //echo "PATH:".$path;
            //echo "dirname:".dirname(__FILE__);
            //mkdir("/upload/pdfji/".imePredmetaStripped($newId), 0777);
            $path = "./upload/pdfji/".imePredmetaStrippedArgIme($_POST["imePredmeta"]);
            echo "PATH:".$path;
            mkdir($path, 0777);

            return "Predmet je bil uspešno dodan!";
        }
    }
}

function updateOpisPredmeta($courseid) {
    $xml = readDB();
    foreach($xml->letniki->letnik as $letnik) {
        foreach($letnik->predmeti->predmet as $predmet) {
            if((string)$predmet->id == $courseid) {
                $predmet->opisPredmeta = $_POST["opisPredmeta"];
                saveDB($xml);

                return "Opis shranjen!";
            }
        }
    }
}

function enrolled($courseid, $tip) {
    $xml = readDB();
    $uId = $_SESSION['user']['id'];
    foreach($xml->letniki->letnik as $letnik) {
        foreach($letnik->predmeti->predmet as $predmet) {
            if((string)$predmet->id == $courseid) {
                if ($tip == "student") {
                    foreach($predmet->ucenci->userId as $userId) {
                        if((string)$userId == $uId) {
                            return true;
                        }
                    }
                }
                else {
                    foreach($predmet->profesor->userId as $userId) {
                        if((string)$userId == $uId) {
                            return true;
                        }
                    }
                }
            }
        }
    }
    return false;
}

function showEnrollOption($courseId) {

    echo '<form method="post" id="enrollcourse" name="enrollcourse" action="">';
    echo '<p class="tasksbottom"><input type="submit" id="enrollme" name="enrollme" value="Vpiši me" /></p>';
    echo '</form>';
}

function enroll($courseid) {
    $xml = readDB();
    foreach($xml->letniki->letnik as $letnik) {
        foreach($letnik->predmeti->predmet as $predmet) {
            if((string)$predmet->id == $courseid) {
                $ucenci = $predmet->ucenci;
                $ucenci->addChild("userId", $_SESSION['user']['id']);

                saveDB($xml);
                return "Uspesno vpisan v predmet!";
            }
        }
    }
}

function showUnEnrollOption($courseid, $tip) {
    if($tip == "student") {
        echo '<form method="post" id="unenrollcourse" name="unenrollcourse" action="">';
        echo '<p class="tasksbottom"><input type="submit" id="unenrollme" name="unenrollme" value="Izpiši me" /></p>';
        echo '</form>';
    }
}

function unenroll($courseid) {
    $xml = readDB();
    foreach($xml->letniki->letnik as $letnik) {
        foreach($letnik->predmeti->predmet as $predmet) {
            if((string)$predmet->id == $courseid) {
                $count = 0;
                foreach($predmet->ucenci->userId as $userId) {
                    
                    if((string)$userId == $_SESSION['user']['id']) {

                        unset($predmet->ucenci->userId[$count]);
                        //$dom=dom_import_simplexml($userId);
                        //$dom->parentNode->removeChild($dom);

                        saveDB($xml);
                        return "Uspesno izpisan iz predmeta!";
                    }
                    $count++;
                }
            }
        }
    }
}

function stUserjev() {
    $xml = readDB();
    $counter = 0;
    foreach($xml->users->user as $user) {
        $counter++;
    }
    return $counter;
}

function dodajUserja($name,$lastName,$username,$password) {

    $xml = readDB();
    $tip = "student";
    $nextID = stUserjev()+1;
    foreach($xml->users as $users) {
            /*
             *<id>1</id>
              <ime>Boris</ime>
              <priimek>Bogdanovich</priimek>
              <username>alpha</username>
              <password>male</password>
              <tip>administrator</tip>
             */
            $user = $users->addChild("user");


            $user->addChild("id", $nextID);
            $user->addChild("ime", $name);
            $user->addChild("priimek", $lastName);
            $user->addChild("username", $username);
            $user->addChild("password", $password);
            $user->addChild("tip", $tip);
            saveDB($xml);
            //$path = dirname(__FILE__)."/../upload/pdfji/".imePredmetaStripped($newId);
            //echo "PATH:".$path;
            //echo "dirname:".dirname(__FILE__);
            //mkdir("/upload/pdfji/".imePredmetaStripped($newId), 0777);

            return "Student je bil uspešno dodan!";
        
    }

    //return "ime:".$name.", priimek:".$lastName.", username:".$username.", password:".$password;
}

?>