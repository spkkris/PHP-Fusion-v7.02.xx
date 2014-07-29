<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2011 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Plik: kris_user_panel_admin.php
| Autor: krystian1988
| Wersja: 4.00
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
if (!checkrights("KMFU") || !defined("iAUTH") || $_GET['aid'] != iAUTH) { redirect("../../index.php"); }
require_once THEMES."templates/admin_header.php";
if (file_exists(INFUSIONS."kris_user_panel/locale/".$settings['locale'].".php")) {
	include INFUSIONS."kris_user_panel/locale/".$settings['locale'].".php";
} else {
	include INFUSIONS."kris_user_panel/locale/Polish.php";
}
include INFUSIONS."kris_user_panel/infusion_db.php";
include INFUSIONS."kris_user_panel/version_check.php";
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
			
	if (is_numeric($_POST['statystyki']) &&  is_numeric($_POST['top_users']) && is_numeric($_POST['ip_users']) && is_numeric($_POST['admin']) && is_numeric($_POST['menu_user']) && is_numeric($_POST['dodaj'])) {
	$result = dbquery("UPDATE ".DB_KMF_USER." SET statystyki='".(isNum($_POST['statystyki']) ? $_POST['statystyki'] : "0")."', top_users='".(isNum($_POST['top_users']) ? $_POST['top_users'] : "0")."', ip_users='".(isNum($_POST['ip_users']) ? $_POST['ip_users'] : "0")."', admin='".(isNum($_POST['admin']) ? $_POST['admin'] : "0")."', menu_user='".(isNum($_POST['menu_user']) ? $_POST['menu_user'] : "0")."', dodaj='".(isNum($_POST['dodaj']) ? $_POST['dodaj'] : "0")."'");	
	if (!$result) { 
	redirect(FUSION_SELF.$aidlink."&status=nsu");
	} else {
	redirect(FUSION_SELF.$aidlink."&status=su");
	}
	}else{
	redirect(FUSION_SELF.$aidlink."&status=nsue");
	} 
	}
$kmfu_ustawienia = dbarray(dbquery("SELECT * FROM ".DB_KMF_USER));
	$statystyki = isNum($kmfu_ustawienia['statystyki']);
	$top_users = isNum($kmfu_ustawienia['top_users']);
	$ip_users = isNum($kmfu_ustawienia['ip_users']);
	$admin = isNum($kmfu_ustawienia['admin']);
	$menu_user = isNum($kmfu_ustawienia['menu_user']);
	$dodaj = isNum($kmfu_ustawienia['dodaj']);
opentable($locale['admin']);
echo"<div style='text-align: center;' class='admin-message center'>".$locale['admin'].$locale['admin1']."</div>";
        echo "<form name='kmfu_form' method='post' action='".FUSION_SELF.$aidlink."'>\n";
		echo "<table cellpadding='0' cellspacing='0' width='98%' style='margin-top: 10px;' class='tbl-border center'>\n<tr>\n";
		echo "<td  class='tbl' width='50%' align='left'>".$locale['019']."</td>\n";
		echo "<td  align='left' class='tbl'><select name='statystyki' class='textbox'>\n";
		echo "<option value='1'".($kmfu_ustawienia['statystyki'] == "1" ? " selected='selected'" : "").">".$locale['wlacz']."</option>\n";
		echo "<option value='0'".($kmfu_ustawienia['statystyki'] == "0" ? " selected='selected'" : "").">".$locale['wylacz']."</option>\n";
		echo "</select>";
		echo ($kmfu_ustawienia['statystyki'] == 1 ? "<img src='".INFUSIONS."kris_user_panel/img/on.png' alt='".$locale['wlacz']."' class='admin-icons'/>" : "<img src='".INFUSIONS."kris_user_panel/img/off.png' alt='".$locale['wylacz']."' class='admin-icons'/>");
		echo "</td></tr><tr>\n";
		echo "<td  class='tbl' width='50%' align='left'>".$locale['023']."</td>\n";
		echo "<td  align='left' class='tbl'><select name='top_users' class='textbox'>\n";
		echo "<option value='1'".($kmfu_ustawienia['top_users'] == "1" ? " selected='selected'" : "").">".$locale['wlacz']."</option>\n";
		echo "<option value='0'".($kmfu_ustawienia['top_users'] == "0" ? " selected='selected'" : "").">".$locale['wylacz']."</option>\n";
		echo "</select>";
		echo ($kmfu_ustawienia['top_users'] == 1 ? "<img src='".INFUSIONS."kris_user_panel/img/on.png' alt='".$locale['wlacz']."' class='admin-icons'/>" : "<img src='".INFUSIONS."kris_user_panel/img/off.png' alt='".$locale['wylacz']."' class='admin-icons'/>");
		echo "</td></tr><tr>\n";
		echo "<td  class='tbl' width='50%' align='left'>".$locale['020']."</td>\n";
		echo "<td  align='left' class='tbl'><select name='ip_users' class='textbox'>\n";
		echo "<option value='1'".($kmfu_ustawienia['ip_users'] == "1" ? " selected='selected'" : "").">".$locale['wlacz']."</option>\n";
		echo "<option value='0'".($kmfu_ustawienia['ip_users'] == "0" ? " selected='selected'" : "").">".$locale['wylacz']."</option>\n";
		echo "</select>";
		echo ($kmfu_ustawienia['ip_users'] == 1 ? "<img src='".INFUSIONS."kris_user_panel/img/on.png' alt='".$locale['wlacz']."' class='admin-icons'/>" : "<img src='".INFUSIONS."kris_user_panel/img/off.png' alt='".$locale['wylacz']."' class='admin-icons'/>");
		echo "</td></tr><tr>\n";
		echo "<td  class='tbl' width='50%' align='left'>".$locale['021']."</td>\n";
		echo "<td  align='left' class='tbl'><select name='admin' class='textbox'>\n";
		echo "<option value='1'".($kmfu_ustawienia['admin'] == "1" ? " selected='selected'" : "").">".$locale['wlacz']."</option>\n";
		echo "<option value='0'".($kmfu_ustawienia['admin'] == "0" ? " selected='selected'" : "").">".$locale['wylacz']."</option>\n";
		echo "</select>";
		echo ($kmfu_ustawienia['admin'] == 1 ? "<img src='".INFUSIONS."kris_user_panel/img/on.png' alt='".$locale['wlacz']."' class='admin-icons'/>" : "<img src='".INFUSIONS."kris_user_panel/img/off.png' alt='".$locale['wylacz']."' class='admin-icons'/>");
		echo "</td></tr><tr>\n";
		echo "<td  class='tbl' width='50%' align='left'>".$locale['016']."</td>\n";
		echo "<td  align='left' class='tbl'><select name='menu_user' class='textbox'>\n";
		echo "<option value='1'".($kmfu_ustawienia['menu_user'] == "1" ? " selected='selected'" : "").">".$locale['wlacz']."</option>\n";
		echo "<option value='0'".($kmfu_ustawienia['menu_user'] == "0" ? " selected='selected'" : "").">".$locale['wylacz']."</option>\n";
		echo "</select>";
		echo ($kmfu_ustawienia['menu_user'] == 1 ? "<img src='".INFUSIONS."kris_user_panel/img/on.png' alt='".$locale['wlacz']."' class='admin-icons'/>" : "<img src='".INFUSIONS."kris_user_panel/img/off.png' alt='".$locale['wylacz']."' class='admin-icons'/>");
		echo "</td></tr><tr>\n";
		echo "<td  class='tbl' width='50%' align='left'>".$locale['017']."</td>\n";
		echo "<td  align='left' class='tbl'><select name='dodaj' class='textbox'>\n";
		echo "<option value='1'".($kmfu_ustawienia['dodaj'] == "1" ? " selected='selected'" : "").">".$locale['wlacz']."</option>\n";
		echo "<option value='0'".($kmfu_ustawienia['dodaj'] == "0" ? " selected='selected'" : "").">".$locale['wylacz']."</option>\n";
		echo "</select>";
		echo ($kmfu_ustawienia['dodaj'] == 1 ? "<img src='".INFUSIONS."kris_user_panel/img/on.png' alt='".$locale['wlacz']."' class='admin-icons'/>" : "<img src='".INFUSIONS."kris_user_panel/img/off.png' alt='".$locale['wylacz']."' class='admin-icons'/>");
	echo "</td></tr><tr>\n";
		echo"</table>\n";
		echo "<div style='text-align:center;margin-top:10px;margin-bottom:10px;'><input type='submit' class='button' name='zapisz' value='".$locale['zapisz']."' /></div>\n";
		echo "</form>\n";
closetable();

require_once THEMES."templates/footer.php";
?>