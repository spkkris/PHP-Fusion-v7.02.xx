<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2011 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Plik: kris_user_panel.php
| Autor: krystian1988
| Wersja: 2.00
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
$url = INFUSIONS."kris_user_panel/img/";
$user = "<img src='".$url."user.png' border='0' alt='' />";
$dodaj = "<img src='".$url."add.png' border='0' alt='' />";
$admin = "<img src='".$url."admin.png' border='0' alt='' />";

if (iMEMBER) {
$kmfu_ustawienia = dbarray(dbquery("SELECT * FROM ".DB_KMF_USER.""));
if ($kmfu_ustawienia['statystyki'] == 1 || $kmfu_ustawienia['top_users'] == 1 || $kmfu_ustawienia['ip_users'] == 1 || $kmfu_ustawienia['admin'] == 1 || $kmfu_ustawienia['menu_user'] == 1 || $kmfu_ustawienia['dodaj'] == 1) {
	$msg_count = dbcount("(message_id)", DB_MESSAGES, "message_to='".$userdata['user_id']."' AND message_read='0' AND message_folder='0'");

	openside("Witaj: ".$userdata['user_name']."");
	echo parseubb(parsesmileys($kmfu_ustawienia['ogloszenie']))."<br />";
	if (iADMIN && (iUSER_RIGHTS != "" || iUSER_RIGHTS != "C")) {
		$subm_count = dbcount("(submit_id)", DB_SUBMISSIONS);

		if ($subm_count) { ?>
			<div style='text-align:center;margin-top:15px;'>
			<strong><br /><a href='<?php echo ADMIN; ?>submissions.php<?php echo $aidlink; ?>' class='side' title='<?php echo sprintf($locale['global_125'], $subm_count); ?><?php echo ($subm_count == 1 ? $locale['global_128'] : $locale['global_129']); ?>'><?php echo sprintf($locale['global_125'], $subm_count); ?>
			<?php echo ($subm_count == 1 ? $locale['global_128'] : $locale['global_129']); ?></a></strong>
			</div>
		<?php }
	} ?> 
	<? if ($msg_count) { ?>
		<div style='text-align:center;margin-top:15px;'>
		<strong><a href='<?php echo BASEDIR; ?>messages.php' class='side' title='<?php echo sprintf($locale['global_125'], $msg_count).($msg_count == 1 ? $locale['global_126'] : $locale['global_127']); ?>'><?php echo sprintf($locale['global_125'], $msg_count); ?>
		<?php echo ($msg_count == 1 ? $locale['global_126'] : $locale['global_127']); ?></a></strong>
		</div>
	<? } ?> <br /><?
	 include INFUSIONS."kris_user_panel/user_stats.php";
	if ($kmfu_ustawienia['menu_user'] == 1) {
	?>
	<div class='side-label mvp_head small' style='cursor: pointer;' title='<?php echo $locale['016']; ?>'><?php echo $locale['016']; ?><span style='float:right;'><?php echo $user; ?></span></div>
	<div class='mvp_body small' style='margin-bottom:3px'>
	<?php echo $user; ?> <a href='<?php echo BASEDIR; ?>edit_profile.php' class='side' title='<?php echo $locale['global_120']; ?>'><?php echo $locale['global_120']; ?></a><br />
	<?php echo $user; ?> <a href='<?php echo BASEDIR; ?>messages.php' class='side' title='<?php echo $locale['global_121']; ?>'><?php echo $locale['global_121']; ?></a><br />
	<?php echo $user; ?> <a href='<?php echo BASEDIR; ?>members.php' class='side' title='<?php echo $locale['global_122']; ?>'><?php echo $locale['global_122']; ?></a><br />

	<? if (iADMIN && (iUSER_RIGHTS != "" || iUSER_RIGHTS != "C")) { ?>
		<?php echo $admin; ?> <a href='<?php echo ADMIN; ?>index.php<?php echo $aidlink; ?>' class='side' title='<?php echo $locale['global_123']; ?>'><?php echo $locale['global_123']; ?></a><br />
	<? } ?>

	<div align='center'><a href='<?php echo BASEDIR; ?>index.php?logout=yes' class='uip-small uip-button uip-red' style='margin: 5px; padding:5px;' title='<?php echo $locale['global_124']; ?>'><?php echo $locale['global_124']; ?></a></div>

	
</div>
<? } ?>
	<?
	if ($kmfu_ustawienia['dodaj'] == 1) {
	?>
	 <div class='side-label mvp_head small' style='cursor: pointer;' title='<?php echo $locale['017']; ?>'><?php echo $locale['017']; ?><span style='float:right;'><?php echo $dodaj; ?></span></div>
	 <div class='mvp_body small' style='margin-bottom:3px'>
	 <?php echo $dodaj; ?> <a href='<?php echo BASEDIR; ?>submit.php?stype=l' class='side' title='<?php echo $locale['011']; ?>'><?php echo $locale['011']; ?></a><br />
	<?php echo $dodaj; ?> <a href='<?php echo BASEDIR; ?>submit.php?stype=n' class='side' title='<?php echo $locale['012']; ?>'><?php echo $locale['012']; ?></a><br />
	<?php echo $dodaj; ?> <a href='<?php echo BASEDIR; ?>submit.php?stype=p' class='side' title='<?php echo $locale['014']; ?>'><?php echo $locale['014']; ?></a><br />
	<?php echo $dodaj; ?> <a href='<?php echo BASEDIR; ?>submit.php?stype=d' class='side' title='<?php echo $locale['015']; ?>'><?php echo $locale['015']; ?></a><br />
	
	</div>
	<? } ?>
	 
	<? closeside();
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

		openside($locale['global_100']); ?>
		
	 <div align='center'>
		<form name='loginform' method='post' action='<?php echo $action_url; ?>'>
		<?php echo $locale['global_101']; ?><br /><input type='text' name='user_name' class='textbox' style='width:100px' /><br />
		<?php echo $locale['global_102']; ?><br /><input type='password' name='user_pass' class='textbox' style='width:100px' /><br />
		<label><input type='checkbox' name='remember_me' value='y' title='<?php echo $locale['global_103']; ?>' style='vertical-align:middle;' /></label>
		<input type='submit' name='login' value='<?php echo $locale['global_104']; ?>' class='button' /><br />
		</form><br />

		<?php if ($settings['enable_registration']) { ?>
			<?php echo $locale['global_105']; ?><br /><br />
		<? } ?>
		<?php echo $locale['global_106']; ?></div>
		
		<? closeside();
	}
}
?>