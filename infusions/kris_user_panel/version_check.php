<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2011 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: version_check.php
| Author: krystian1988
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
require_once "../../../maincore.php";
require_once THEMES."templates/admin_header.php";
include INFUSIONS."kris_user_panel/infusion_db.php";

// Check if locale file is available matching the current site locale setting.
if (file_exists(INFUSIONS."kris_user_panel/locale/".$settings['locale'].".php")) {
// Load the locale file matching the current site locale setting.
    include INFUSIONS."kris_user_panel/locale/".$settings['locale'].".php";
} else {
// Load the infusion's default locale file.
    include INFUSIONS."kris_user_panel/locale/Polish.php";
}
  
	
if (!checkrights("KMFU") || !defined("iAUTH") || $_GET['aid'] != iAUTH) { redirect("../../index.php"); }

include INFUSIONS."kris_user_panel/admin_navigation.php";

openside($locale['ver_000']);
echo "<div width='100%' class='tbl' align='center'>";
if(ini_get('allow_url_fopen') != false){ 
	if ($df_ddi_version = file_get_contents("http://www.dev.krismods-fusion.pl/updates/kris_user_panel.txt")) {
		if (preg_match("/^[0-9a-z\.]+$/", $df_ddi_version)) {
		    $in_version = dbarray(dbquery("SELECT inf_version FROM ".DB_INFUSIONS." WHERE inf_folder = 'kris_user_panel'"));	
            $inf_version = $in_version['inf_version'];
		    if (version_compare($df_ddi_version, $inf_version, ">")) {
			echo "<div class='tbl1' style='color:#DD0000; font-weight:bold; border:1px solid #000000; backgorund-color:#ffffff; padding:4px; margin:5px; width:350px;' align='center'>".$locale['ver_001']."</div>
			".$locale['ver_002'].$inf_version."<br />
			".$locale['ver_003'].$df_ddi_version."<br />
			".$locale['ver_004']."";
		} else {
			echo "<div class='tbl1' style='color:#00BB00; font-weight:bold; border:1px solid #000000; backgorund-color:#ffffff; padding:4px; margin:5px; width:350px;' align='center'>".$locale['ver_005']."</div>
			".$locale['ver_006'].$inf_version."<br />
			".$locale['ver_007']; }
		} else {
			echo "<div class='tbl1' style='color:#333333; font-weight:bold; border:1px solid #000000; backgorund-color:#ffffff; padding:4px; margin:5px; width:350px;' align='center'>".$locale['ver_008']."</div>\n
			<div class='tbl1' style='display:none;'>".$locale['ver_009']."</div>"; }
	    } else {
		    echo "<div class='tbl1' align='center' style='color:#333333; font-weight:bold; border:1px solid #000000; backgorund-color:#ffffff; padding:4px; margin:5px; width:350px;' align='center'>".$locale['ver_008']."</div></b>\n
		    <div class='tbl1' style='display:none;'>".$locale['ver_009']."</div>"; }
        } else {
	        echo "<div class='tbl1' align='center' style='color:#333333; font-weight:bold; border:1px solid #000000; backgorund-color:#ffffff; padding:4px; margin:5px; width:350px;' align='center'>".$locale['ver_008']."</div>\n
		    <div class='tbl1' style='display:none;'>".$locale['ver_010']."</div>"; }
            echo "</div></div>\n";
closeside();

require_once THEMES."templates/footer.php";
?>
