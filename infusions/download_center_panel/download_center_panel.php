<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2014 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Plik: download_center_panel.php
| Autor: krystian1988
| Wersja: 2.02
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
if (file_exists(INFUSIONS."download_center_panel/locale/".$settings['locale'].".php")) {
	include INFUSIONS."download_center_panel/locale/".$settings['locale'].".php";
} else {
	include INFUSIONS."download_center_panel/locale/Polish.php";
}
include INFUSIONS."download_center_panel/infusion_db.php";
include INFUSIONS."download_center_panel/inc.php";
opentable("Ostatnio dodane pliki");
$kmfd_ustawienia = dbarray(dbquery("SELECT * FROM ".DB_KMF_DCP));
if ($kmfd_ustawienia['czas'] || $kmfd_ustawienia['slider'] == 1) {
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
		if ($kmfd_ustawienia['slider'] == 1) {
			if ($kmfd_ustawienia['strona'] == 1) {
			include INFUSIONS."download_center_panel/func/slider-left.php";
			} else {
				include INFUSIONS."download_center_panel/func/slider-right.php";
			}
	} else {
if ($kmfd_ustawienia['strona'] == 1) {
			include INFUSIONS."download_center_panel/func/no-slider-left.php";
			} else {
				include INFUSIONS."download_center_panel/func/no-slider-right.php";
			}
	}
	echo autor();
closetable();
add_to_footer("<script type='text/javascript'>
	$(document).ready(
		function() {
			$('#dlticker').dlTicker('".$kmfd_ustawienia['czas']."');
			$('#dlticker').show('slow');
		}
	);
	</script>");
}
?>