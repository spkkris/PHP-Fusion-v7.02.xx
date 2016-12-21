<?php
echo "<table cellpadding='0' cellspacing='2' style='padding-top: 6px;' width='100%' align='center'><tr>";
echo "<td class='tbl2' style='width: 50%;' align='center' valign='top'><a href='".BASEDIR."downloads.php'>".$locale['all']."</a></td>";
if(iMEMBER){
echo "<td class='tbl2' style='width: 50%;' align='center' valign='top'><a href='".BASEDIR."submit.php?stype=d'>".$locale['dodaj']."</a></td>";
}
echo "</tr></table>";
		echo "<ul id='dlticker' class='dl-ticker'>";
$pytanie = dbquery("SELECT download_id, download_title, download_count, download_image_thumb, download_description, download_description_short, download_count, download_cat FROM ".DB_DOWNLOADS." ORDER BY download_id DESC LIMIT ".$kmfd_ustawienia['ile']."");
$brak = dbrows($pytanie);
               if ($brak != 0) {
						while ($odp = dbarray($pytanie)) {
						echo "<li>";
if ($odp['download_image_thumb']) {
							$obraz = DOWNLOADS."images/".$odp['download_image_thumb'];
						} else {
							$obraz = DOWNLOADS."images/no_image.jpg";
						}		
if ($kmfd_ustawienia['pokaz'] == 1) {
							$opis = nl2br(stripslashes($odp['download_description_short']));
						} else {
							$opis = nl2br(parseubb(parsesmileys($odp['download_description'])));
							}						
echo "<table cellpadding='0' cellspacing='2' style='padding-top: 6px;' width='100%' align='center'><tr>";
echo "<td style='width: 70%;' align='left' valign='top'>".$opis."</td>";
echo "<td style='width: 30%;' align='center' valign='top'>".$odp['download_title']."<br /><img src='".$obraz."' class='thumb-dl-default thumb-rotate' alt='".$odp['download_title']."'><br />".$locale['018'].$odp['download_count']."<br /><a href='".BASEDIR."downloads.php?download_id=".$odp['download_id']."' class='uip-small uip-button uip-red'>".$locale['017']."</a></td>";
echo "</tr></table>";
	} 
	echo "</li>";
	} else {
	  echo "<div class='admin-message'>".$locale['020']."</div>";
    }
	echo "</ul>";
?>