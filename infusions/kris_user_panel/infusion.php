<?php
if (!defined("IN_FUSION")) { die("Access Denied"); }

if (file_exists(INFUSIONS."kris_user_panel/locale/".$settings['locale'].".php")) {
	include INFUSIONS."kris_user_panel/locale/".$settings['locale'].".php";
} else {
	include INFUSIONS."kris_user_panel/locale/English.php";
}

include INFUSIONS."kris_user_panel/infusion_db.php";

// Infusion general information
$inf_title = $locale['title'];
$inf_description = $locale['desc'];
$inf_version = "4.00";
$inf_developer = "krystian1988";
$inf_email = "administracja@krismods-fusion.pl";
$inf_weburl = "http://www.krismods-fusion.pl";

$inf_folder = "kris_user_panel";


$inf_newtable[1] = DB_KMF_USER." (
   statystyki TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
   top_users TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
   ip_users TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
   admin TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
   menu_user TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
   dodaj TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
   PRIMARY KEY (statystyki)
) ENGINE=MyISAM;";
$inf_insertdbrow[1] = DB_KMF_USER." (
statystyki,
top_users,
ip_users,
admin,
menu_user,
dodaj
) VALUES (
'1',
'1',
'1',
'1',
'1',
'1'
)";

$inf_adminpanel[1] = array(
	"title" => $locale['title'],
	"image" => "",
	"panel" => "kris_user_panel_admin.php",
	"rights" => "KMFU"
);

$inf_droptable[1] = DB_KMF_USER;


?>