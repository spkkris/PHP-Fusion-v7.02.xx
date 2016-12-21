<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2014 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Plik: infusion.php
| Autor: DysNet
| Wersja: 2.04
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
if (!defined("IN_FUSION")) { die("Access Denied"); }
if (file_exists(INFUSIONS."download_center_panel/locale/".$settings['locale'].".php")) {
	include INFUSIONS."download_center_panel/locale/".$settings['locale'].".php";
} else {
	include INFUSIONS."download_center_panel/locale/English.php";
}
include INFUSIONS."download_center_panel/infusion_db.php";
// Infusion general information
$inf_title = $locale['title'];
$inf_description = $locale['desc'];
$inf_version = "2.04";
$inf_developer = "DysNet";
$inf_email = "admin@dysnet.pl";
$inf_weburl = "http://www.dysnet.pl";
$inf_folder = "download_center_panel";
$inf_newtable[1] = DB_KMF_DCP." (
   ile TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
   slider TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
   pokaz TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
   strona TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
   czas TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
   PRIMARY KEY (ile)
) ENGINE=MyISAM;";
$inf_insertdbrow[1] = DB_KMF_DCP." (
ile,
slider,
pokaz,
strona,
czas
) VALUES (
'10',
'1',
'1',
'1',
'5'
)";
$inf_adminpanel[1] = array(
	"title" => $locale['title'],
	"image" => "",
	"panel" => "download_center_panel_admin.php",
	"rights" => "KMFD"
);
$inf_droptable[1] = DB_KMF_DCP;
?>