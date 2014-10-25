<?php
if (file_exists(INFUSIONS."download_center_panel/locale/".$settings['locale'].".php")) {
	include INFUSIONS."download_center_panel/locale/".$settings['locale'].".php";
} else {
	include INFUSIONS."download_center_panel/locale/Polish.php";
}
opentable("Ostatnio dodane pliki");
add_to_head("<style type='text/css'>
.dl-ticker {
		display: none;
		list-style-type: none;
		padding: 3px;
		margin-bottom: 2px;
		height:auto;
	   }
	   .uip-button  {
	           background: #222 repeat-x; 
	           display: inline-block; 
	           padding: 5px 10px 6px; 
	           color: #fff; 
	           text-decoration: none;
	           -moz-border-radius: 6px; 
	           -webkit-border-radius: 6px;
	           -moz-box-shadow: 0 1px 3px rgba(0,0,0,0.6);
	           -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.6);
	           text-shadow: 0 -1px 1px rgba(0,0,0,0.25);
	           border-bottom: 1px solid rgba(0,0,0,0.25);
	           position: relative;
	           cursor: pointer
               }
.uip-red.uip-button { background-color: #e62727; }
.uip-red.uip-button:hover { background-color: #cf2525; }
.thumb-rotate{
    -webkit-transition-duration: 0.8s;
    -moz-transition-duration: 0.8s;
    -o-transition-duration: 0.8s;
    transition-duration: 0.8s;
     
    -webkit-transition-property: -webkit-transform;
    -moz-transition-property: -moz-transform;
    -o-transition-property: -o-transform;
    transition-property: transform;
     
    overflow:hidden;
 
    }  
 
.thumb-rotate:hover  
{
    -webkit-transform:rotate(360deg);
    -moz-transform:rotate(360deg);
    -o-transform:rotate(360deg);
}  
.thumb-dl-default {
-moz-opacity: 0.80;
-khtml-opacity: 0.80;
opacity: 0.80;
-ms-filter:'progid:DXImageTransform.Microsoft.Alpha'(Opacity=80);
filter: progid:DXImageTransform.Microsoft.Alpha(opacity=80);
filter:alpha(opacity=80);
	background-color: #c0c0c0;
	-moz-box-shadow: inset 0 0 2px 2px #d8d8d8;
    -webkit-box-shadow: inset 0 0 2px 2px#4770e3;
    box-shadow: inset 0 0 2px 2px #4770e3;
	border: 1px solid #4770e3;
	-webkit-border-radius: 100px;
    -moz-border-radius: 100px;
    border-radius: 100px;
	margin: 6px 5px 0 0; /* top right bottom left*/
	padding: 5px;
	}
	.thumb-dl-default:hover {
-moz-opacity: 1;
-khtml-opacity: 1;
opacity: 1;
-ms-filter:'progid:DXImageTransform.Microsoft.Alpha'(Opacity=100);
filter: progid:DXImageTransform.Microsoft.Alpha(opacity=100);
filter:alpha(opacity=100);
	background-color: #c0c0c0;
	-moz-box-shadow: inset 0 0 2px 2px #d8d8d8;
    -webkit-box-shadow: inset 0 0 2px 2px#4770e3;
    box-shadow: inset 0 0 2px 2px #4770e3;
	border: 1px solid #4770e3;
		-webkit-border-radius: 100px;
    -moz-border-radius: 100px;
    border-radius: 100px;
	margin: 6px 5px 0 0; /* top right bottom left*/
	padding: 5px;
	}</style>
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
echo "<td class='tbl1' style='width: 30%;' align='center' valign='top'>".$odp['download_title']."<br /><img src='".$obraz."' class='thumb-dl-default thumb-rotate' alt='".$odp['download_title']."'><br />Pobrań: ".$odp['download_count']."<br /><a href='".BASEDIR."downloads.php?download_id=".$odp['download_id']."' class='uip-small uip-button uip-red'>Pobierz</a></a></td>";
echo "</tr></table>";
	
	} 
	echo "</li>";
	
	} else {
	  echo "<div class='admin-message'>".$locale['020']."</div>";
  
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