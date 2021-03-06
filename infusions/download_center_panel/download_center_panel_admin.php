<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2014 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Plik: download_center_panel_admin.php
| Autor: krystian1988
| Wersja: 2.03
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
require_once "../../maincore.php";
if (!checkrights("KMFD") || !defined("iAUTH") || $_GET['aid'] != iAUTH) { redirect("../../index.php"); }
require_once THEMES."templates/admin_header.php";
if (file_exists(INFUSIONS."download_center_panel/locale/".$settings['locale'].".php")) {
	include INFUSIONS."download_center_panel/locale/".$settings['locale'].".php";
} else {
	include INFUSIONS."download_center_panel/locale/Polish.php";
}
include INFUSIONS."download_center_panel/infusion_db.php";
include INFUSIONS."download_center_panel/inc.php";
if (isset($_GET['status']) && !isset($message)) {
	if ($_GET['status'] == "su") {
	$message = $locale['ok'];
	} elseif ($_GET['status'] == "nsu") {
	$message = $locale['blad'];
	}elseif ($_GET['status'] == "nsue") {
	$message = $locale['blad1'];
	}
	if ($message) {	echo "<div id='close-message'><div class='admin-message'>".$message."</div></div>\n"; }
	}
if (isset($_POST['zapisz'])) {
			
	if (is_numeric($_POST['ile']) &&  is_numeric($_POST['slider']) &&  is_numeric($_POST['pokaz']) &&  is_numeric($_POST['strona']) &&  is_numeric($_POST['czas'])) {
	$result = dbquery("UPDATE ".DB_KMF_DCP." SET ile='".(isNum($_POST['ile']) ? $_POST['ile'] : "0")."', slider='".(isNum($_POST['slider']) ? $_POST['slider'] : "0")."', pokaz='".(isNum($_POST['pokaz']) ? $_POST['pokaz'] : "0")."', strona='".(isNum($_POST['strona']) ? $_POST['strona'] : "0")."', czas='".(isNum($_POST['czas']) ? $_POST['czas'] : "0")."'");	
	if (!$result) { 
	redirect(FUSION_SELF.$aidlink."&status=nsu");
	} else {
	redirect(FUSION_SELF.$aidlink."&status=su");
	}
	}else{
	redirect(FUSION_SELF.$aidlink."&status=nsue");
	} 
	}
$kmfu_ustawienia = dbarray(dbquery("SELECT * FROM ".DB_KMF_DCP));
	$ile = isNum($kmfu_ustawienia['ile']);
	$slider = isNum($kmfu_ustawienia['slider']);
	$pokaz = isNum($kmfu_ustawienia['pokaz']);
	$strona = isNum($kmfu_ustawienia['strona']);
	$czas = isNum($kmfu_ustawienia['czas']);
	$wlacz = "<img src='".INFUSIONS."download_center_panel/img/on.png' alt='".$locale['wlacz']."' class='admin-icons'/>";
	$wylacz = "<img src='".INFUSIONS."download_center_panel/img/off.png' alt='".$locale['wylacz']."' class='admin-icons'/>";
	$zapisz = "<div style='text-align:center;margin-top:10px;margin-bottom:10px;'><input type='submit' class='button' name='zapisz' value='".$locale['zapisz']."' /></div>";
opentable($locale['admin']);
echo"<div style='text-align: center;' class='admin-message center'>".$locale['admin']."</div>";
        echo "<form name='kmfu_form' method='post' action='".FUSION_SELF.$aidlink."'>\n";
		echo "<table cellpadding='0' cellspacing='0' width='100%' style='margin-top: 10px;' class='tbl-border center'>\n<tr>\n";
		echo "<td  class='tbl' width='50%' align='left'>".$locale['019']."</td>\n";
		echo "<td  align='left' class='tbl'><input name='ile' type='number' min='1' max='255' style='width: 70px' value='".$kmfu_ustawienia['ile']."' class='textbox'>\n";
		echo "</input>".$locale['026'];
		echo "</td></tr><tr>\n";
		echo "<td  class='tbl' width='50%' align='left'>".$locale['023']."</td>\n";
		echo "<td  align='left' class='tbl'><select name='slider' class='textbox'>\n";
		echo "<option value='1'".($kmfu_ustawienia['slider'] == "1" ? " selected='selected'" : "").">".$locale['wlacz']."</option>\n";
		echo "<option value='0'".($kmfu_ustawienia['slider'] == "0" ? " selected='selected'" : "").">".$locale['wylacz']."</option>\n";
		echo "</select>";
		echo ($kmfu_ustawienia['slider'] == 1 ? $wlacz : $wylacz);
		echo "</td></tr><tr>\n";
		echo "<td  class='tbl' width='50%' align='left'>".$locale['27']."</td>\n";
		echo "<td  align='left' class='tbl'><select name='pokaz' class='textbox'>\n";
		echo "<option value='1'".($kmfu_ustawienia['pokaz'] == "1" ? " selected='selected'" : "").">".$locale['25']."</option>\n";
		echo "<option value='0'".($kmfu_ustawienia['pokaz'] == "0" ? " selected='selected'" : "").">".$locale['26']."</option>\n";
		echo "</select>";
		echo "</td></tr><tr>\n";
		echo "</td></tr><tr>\n";
		echo "<td  class='tbl' width='50%' align='left'>".$locale['024']."</td>\n";
		echo "<td  align='left' class='tbl'><select name='strona' class='textbox'>\n";
		echo "<option value='1'".($kmfu_ustawienia['strona'] == "1" ? " selected='selected'" : "").">".$locale['lewa']."</option>\n";
		echo "<option value='0'".($kmfu_ustawienia['strona'] == "0" ? " selected='selected'" : "").">".$locale['prawa']."</option>\n";
		echo "</select>";
		echo "</td></tr><tr>\n";
		echo "<td  class='tbl' width='50%' align='left'>".$locale['czas']."</td>\n";
		echo "<td  align='left' class='tbl'><input name='czas' type='number' min='5' max='60' style='width: 70px' value='".$kmfu_ustawienia['czas']."' class='textbox'>\n";
		echo "</input>".$locale['025'];
		echo "</td></tr><tr>\n";
		echo"</table>\n";
		echo $zapisz;
		echo "</form>\n";
		echo autor();
closetable();

require_once THEMES."templates/footer.php";
?>