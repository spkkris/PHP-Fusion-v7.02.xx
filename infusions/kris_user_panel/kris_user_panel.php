<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2014 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Plik: kris_user_panel.php
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
if (!defined("IN_FUSION")) { die("Access Denied"); }
if (file_exists(INFUSIONS."kris_user_panel/locale/".$settings['locale'].".php")) {
	include INFUSIONS."kris_user_panel/locale/".$settings['locale'].".php";
} else {
	include INFUSIONS."kris_user_panel/locale/Polish.php";
}
add_to_head("<style type='text/css'>
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
		
	</style>");
include INFUSIONS."kris_user_panel/infusion_db.php";
add_to_head("<script type='text/javascript' src='".INFUSIONS."kris_user_panel/mvp.js'></script>");
if (iMEMBER) {
$kmfu_ustawienia = dbarray(dbquery("SELECT * FROM ".DB_KMF_USER.""));
if ($kmfu_ustawienia['statystyki'] == 1 || $kmfu_ustawienia['top_users'] == 1 || $kmfu_ustawienia['ip_users'] == 1 || $kmfu_ustawienia['admin'] == 1 || $kmfu_ustawienia['menu_user'] == 1 || $kmfu_ustawienia['dodaj'] == 1) {
	$msg_count = dbcount("(message_id)", DB_MESSAGES, "message_to='".$userdata['user_id']."' AND message_read='0' AND message_folder='0'");
	openside("Witaj: ".$userdata['user_name']."");
	if (iADMIN && (iUSER_RIGHTS != "" || iUSER_RIGHTS != "C")) {
		$subm_count = dbcount("(submit_id)", DB_SUBMISSIONS);
		if ($subm_count) {
			echo "<div style='text-align:center;margin-top:15px;'>\n";
			echo "<strong><a href='".ADMIN."submissions.php".$aidlink."' class='side'>".sprintf($locale['global_125'], $subm_count);
			echo ($subm_count == 1 ? $locale['global_128'] : $locale['global_129'])."</a></strong>\n";
			echo "</div>\n";
		}
	} 
	if ($msg_count) {
		echo "<div style='text-align:center;margin-top:15px;'>\n";
		echo "<strong><a href='".BASEDIR."messages.php' class='side'>".sprintf($locale['global_125'], $msg_count);
		echo ($msg_count == 1 ? $locale['global_126'] : $locale['global_127'])."</a></strong>\n";
		echo "</div>\n";
	}
	 include INFUSIONS."kris_user_panel/user_stats.php";
	if ($kmfu_ustawienia['menu_user'] == 1) {
	
	echo "<div class='side-label mvp_head small' style='cursor: pointer;' title='".$locale['016']."'>".$locale['016']."</div>
	<div class='mvp_body small' style='margin-bottom:3px'>";
	echo "<a href='".BASEDIR."edit_profile.php' class='side' title='".$locale['global_120']."'>".$locale['global_120']."</a><br />";
	echo "<a href='".BASEDIR."messages.php' class='side' title='".$locale['global_121']."'>".$locale['global_121']."</a><br />";
	echo "<a href='".BASEDIR."members.php' class='side' title='".$locale['global_122']."'>".$locale['global_122']."</a><br />";
	 if (iADMIN && (iUSER_RIGHTS != "" || iUSER_RIGHTS != "C")) { 
		echo "<a href='".ADMIN."index.php".$aidlink."' class='side' title='".$locale['global_123']."'>".$locale['global_123']."</a><br />";
	 } 
	echo "<div align='center'><a href='".BASEDIR."index.php?logout=yes' class='uip-small uip-button uip-red' style='margin: 5px; padding:5px;' title='".$locale['global_124']."'>".$locale['global_124']."</a></div>
</div>";
 } 
	if ($kmfu_ustawienia['dodaj'] == 1) {
	 echo "<div class='side-label mvp_head small' style='cursor: pointer;' title='".$locale['017']."'>".$locale['017']."</div>
	 <div class='mvp_body small' style='margin-bottom:3px'>";
	echo "<a href='".BASEDIR."submit.php?stype=l' class='side' title='".$locale['011']."'>".$locale['011']."</a><br />";
	echo "<a href='".BASEDIR."submit.php?stype=n' class='side' title='".$locale['012']."'>".$locale['012']."</a><br />";
	echo "<a href='".BASEDIR."submit.php?stype=p' class='side' title='".$locale['014']."'>".$locale['014']."</a><br />";
	echo "<a href='".BASEDIR."submit.php?stype=d' class='side' title='".$locale['015']."'>".$locale['015']."</a><br />
	</div>";
	 }
	 closeside();
	} else {
	$msg_count = dbcount("(message_id)", DB_MESSAGES, "message_to='".$userdata['user_id']."' AND message_read='0' AND message_folder='0'");
	openside($userdata['user_name']);
	echo THEME_BULLET." <a href='".BASEDIR."edit_profile.php' class='side'>".$locale['global_120']."</a><br />\n";
	echo THEME_BULLET." <a href='".BASEDIR."messages.php' class='side'>".$locale['global_121']."</a><br />\n";
	echo THEME_BULLET." <a href='".BASEDIR."members.php' class='side'>".$locale['global_122']."</a><br />\n";
	if (iADMIN && (iUSER_RIGHTS != "" || iUSER_RIGHTS != "C")) {
		echo THEME_BULLET." <a href='".ADMIN."index.php".$aidlink."' class='side'>".$locale['global_123']."</a><br />\n";
	}
	echo THEME_BULLET." <a href='".BASEDIR."index.php?logout=yes' class='side'>".$locale['global_124']."</a>\n";
	if ($msg_count) {
		echo "<div style='text-align:center;margin-top:15px;'>\n";
		echo "<strong><a href='".BASEDIR."messages.php' class='side'>".sprintf($locale['global_125'], $msg_count);
		echo ($msg_count == 1 ? $locale['global_126'] : $locale['global_127'])."</a></strong>\n";
		echo "</div>\n";
	}
	if (iADMIN && checkrights("SU")) {
		$subm_count = dbcount("(submit_id)", DB_SUBMISSIONS);
		if ($subm_count) {
			echo "<div style='text-align:center;margin-top:15px;'>\n";
			echo "<strong><a href='".ADMIN."submissions.php".$aidlink."' class='side'>".sprintf($locale['global_125'], $subm_count);
			echo ($subm_count == 1 ? $locale['global_128'] : $locale['global_129'])."</a></strong>\n";
			echo "</div>\n";
		}
	}
	closeside();
	}
} else {
	if (!preg_match('/login.php/i',FUSION_SELF)) {
		$action_url = FUSION_SELF.(FUSION_QUERY ? "?".FUSION_QUERY : "");
		if (isset($_GET['redirect']) && strstr($_GET['redirect'], "/")) {
			$action_url = cleanurl(urldecode($_GET['redirect']));
		}
		openside($locale['global_100']); 
	 echo "<div align='center'>
		<form name='loginform' method='post' action='".$action_url."'>";
		echo $locale['global_101']."<br /><input type='text' name='user_name' class='textbox' style='width:100px' /><br />";
		echo $locale['global_102']."<br /><input type='password' name='user_pass' class='textbox' style='width:100px' /><br />
		<label><input type='checkbox' name='remember_me' value='y' title='".$locale['global_103']."' style='vertical-align:middle;' /></label>
		<input type='submit' name='login' value='".$locale['global_104']."' class='button' /><br />
		</form><br />";
		if ($settings['enable_registration']) { 
			 echo $locale['global_105']."<br /><br />";
		 } 
		 echo $locale['global_106']."</div>";
		 closeside();
	}
}
?>