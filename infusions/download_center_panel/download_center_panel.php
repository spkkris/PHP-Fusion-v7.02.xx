<?php

opentable("Ostatnio dodane pliki");
add_to_head("<style type='text/css'>
        .dl-ticker {
		display: none;
		list-style-type: none;
		padding: 3px;
		margin-bottom: 2px;
		height:auto;
	   }
		</style>
		
		<script language='JavaScript' type='text/javascript' src='".INFUSIONS."download_center_panel/ticker.js'></script>
		");
		echo "<ul id='dlticker' class='dl-ticker'>";
$pytanie = dbquery("SELECT download_id, download_title, download_count, download_image_thumb, download_description, download_description_short, download_count, download_cat FROM ".DB_DOWNLOADS." ORDER BY download_id DESC LIMIT 10");
$brak = dbrows($pytanie);

               if ($brak != 0) {
						while ($odp = dbarray($pytanie)) {
						echo "<li>";

if ($odp['download_image_thumb']) {
							$obraz = DOWNLOADS."images/".$odp['download_image_thumb'];
						} else {
							$obraz = DOWNLOADS."images/no_image.jpg";
						}
						$opis = ($odp['download_description'] != "" ? nl2br(parseubb(parsesmileys($odp['download_description']))) : nl2br(stripslashes($odp['download_description_short'])));		
echo "<table cellpadding='0' cellspacing='2' style='padding-top: 6px;' width='100%' align='center'><tr>";
echo "<td class='tbl1' style='width: 70%;' align='left' valign='top'>".$opis."</td>";
echo "<td class='tbl1' style='width: 30%;' align='center' valign='top'>".$odp['download_title']."<br /><img src='".$obraz."' class='thumb-dl-default thumb-rotate' alt='".$odp['download_title']."'><br />Pobrań: ".$odp['download_count']."<br /><a href='".BASEDIR."downloads.php?download_id=".$odp['download_id']."' class='zielony button'>Pobierz</a></a></td>";
echo "</tr></table>";
	
	} 
	echo "</li>";
	
	} else {
	  echo "<div class='admin-message'>Brak plikow w downloadzie.</div>";
  
    }
	echo "</ul>";

closetable();
add_to_footer("<script type='text/javascript'>
	$(document).ready(
		function() {
			$('#dlticker').dlTicker('7000');
			$('#dlticker').show('slow');
		}
	);
	</script>");
?>