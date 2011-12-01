<?php
/*
to-do
	@on page load, ID "courseslist" must be filled with
 	data, depending ond user role.
 	
 	@navigacija se generira odvisno od tipa uporabnika
 	
*/

?>
<div id="navigation" class="item">
	<h2>Navigacija</h2>
	<ul>
		<li><a href="index.php">Domov</a></li>
		<li>
			<a id="courseslink" href="#">Moji predmeti</a>
			<ul id="courseslist">
				<?php
					$vsajEn = 0;
                    foreach(userPredmeti($_SESSION['user']['id']) as $predmet) {
                        $idPredmeta = $predmet['id'];
						$vsajEn = 1;
                        echo "<li><a href='course.php?id=$idPredmeta'>".$predmet['ime']."</a></li>";
                    }
					if($vsajEn == 0)
						echo "<li></li>";
                
                ?>
			</ul>
		</li>

	</ul>
    <?php
        if($_SESSION['user']['usertype'] == "administrator") {
            echo '<h2>Admin</h2>';
            echo '<ul><li><a href="dodajPredmet.php">Dodaj predmet</a></li></ul>';
        }
    ?>
</div>
<div id="navigation2" class="item">
	<h2>Profil</h2>
	<ul>
		<li><a href="account.php">Nastavitve</a></li>
		<li><a href="changepassword.php">Spremeni geslo</a></li>
	</ul>
</div>