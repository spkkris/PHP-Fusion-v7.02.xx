<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2011 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Plik: user_stats.php
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
include_once INCLUDES."infusions_include.php";
if (file_exists(INFUSIONS."kris_user_panel/locale/".$settings['locale'].".php")) {
	include INFUSIONS."kris_user_panel/locale/".$settings['locale'].".php";
} else {
	include INFUSIONS."kris_user_panel/locale/Polish.php";
}
add_to_head("<script type='text/javascript' src='".INFUSIONS."kris_user_panel/mvp.js'></script>");
$url = INFUSIONS."kris_user_panel/img/";
$staty = "<img src='".$url."stats.png' border='0' alt='' />";
$ip = "<img src='".$url."ip.png' border='0' alt='' />";
$admin = "<img src='".$url."admin.png' border='0' alt='' />";
include LOCALE.LOCALESET."admin/main.php";
?>
<div align="center">
	<? if ($userdata['user_avatar'] != "") { ?>  
    <img src="<?php echo IMAGES; ?>avatars/<?php echo $userdata['user_avatar']; ?>"/><br /><br />
		<? } else { ?>
			<img src="<?php echo IMAGES; ?>avatars/noavatar100.png" /><br /><br />
		<? } ?>
		</div>
		<?
	if ($kmfu_ustawienia['statystyki'] == 1) {
	?>
		<div class='side-label mvp_head small' style='cursor: pointer;' title='<?php echo $locale['019']; ?>'><?php echo $locale['019']; ?><span style='float:right;'><?php echo $staty; ?></span></div>
	<div class='mvp_body small' style='margin-bottom:3px'>
		<?php echo $staty; ?> <?php echo $locale['001']; ?><strong><?php echo USER_IP; ?></strong><br />
		<?php echo $staty; ?> <?php echo $locale['002']; ?><strong><?php echo $userdata['user_posts']; ?></strong><br />
		<?php echo $staty; ?> <?php echo $locale['003']; ?><strong><?php echo number_format(dbcount("(comment_id)", DB_COMMENTS, "comment_name='".$userdata['user_id']."'")); ?></strong><br />
		<?php echo $staty; ?> <?php echo $locale['004']; ?><strong><?php echo number_format(dbcount("(news_id)", DB_NEWS, "news_name='".$userdata['user_id']."'")); ?></strong><br />
		<?php echo $staty; ?> <?php echo $locale['005']; ?><strong><?php echo number_format(dbcount("(photo_id)", DB_PHOTOS, "photo_user='".$userdata['user_id']."'")); ?></strong><br />
		<?php echo $staty; ?> <?php echo $locale['006']; ?><strong><?php echo number_format(dbcount("(download_id)", DB_DOWNLOADS, "download_user='".$userdata['user_id']."'")); ?></strong><br />
		</div>
		<? } ?>
		<?
	if ($kmfu_ustawienia['top_users'] == 1) {
	?>
		<div class='side-label mvp_head small' style='cursor: pointer;' title='<?php echo $locale['023']; ?>'><?php echo $locale['023']; ?><span style='float:right;'><?php echo $staty; ?></span></div>
	<div class='mvp_body small' style='margin-bottom:3px'>
	<?php $result = dbquery("SELECT user_name, user_location, user_status, user_id, count(user_id) AS post_count FROM ".DB_POSTS." INNER JOIN
".DB_USERS." ON post_author=user_id GROUP BY user_name ORDER BY post_count DESC LIMIT 0,5"); ?>
<table width='100%' cellpadding='0' cellspacing='0'>
<? if(dbrows($result)!=0){
while($data=dbarray($result)){ ?>
<tr><td class='small2' align='left'><?php echo profile_link($data['user_id'], $data['user_name'], $data['user_status']); ?></td><td class='small2' align='right'>[<?php echo $data['post_count']; ?>]</td></tr>
<?}
} else { ?>
<tr><td class="small"><?php echo $locale['007a']; ?></td></tr>
<? } ?>
</table>
	</div>
	<? } ?>
	<?
	if ($kmfu_ustawienia['ip_users'] == 1) {
	?>
		<? if(iSUPERADMIN) {
		?><div class='side-label mvp_head small' style='cursor: pointer;' title='<?php echo $locale['020']; ?>'><?php echo $locale['020']; ?><span style='float:right;'><?php echo $ip; ?></span></div>
	<div class='mvp_body small' style='margin-bottom:3px'><?
  $wynik = dbquery("SELECT GROUP_CONCAT(CAST(user_id AS CHAR)) AS user_id, GROUP_CONCAT(CAST(user_name AS CHAR)) AS ip_user_name, user_ip, COUNT(user_ip) AS num FROM ".DB_USERS." GROUP BY user_ip HAVING num > 1"); ?>
  <table border="0" width="100%" class="small">
  <? if(dbrows($wynik) > 0)
  {     
    $users = '';
    while($r = dbarray($wynik))
    {
      $name = explode(",", $r['ip_user_name']);
      $id = explode(",", $r['user_id']);
      $c = array_combine($id, $name);
      foreach ($c as $key => $value)
      {
        $users .= "<a href='".BASEDIR."profile.php?lookup=".$key."'>".$value."</a>, ";
      } ?>
    <tr><td class="small"><?php echo $ip; ?> <span style="font-weight: bold;"><?php echo $r['user_ip']; ?></span> <?php echo $locale['008'].number_format($r['num']).$locale['009']; ?></td></tr>
    <tr><td class="small"><?php echo substr($users, 0, -2); ?></td></tr>
      <? $users = ''; ?>
   <? }
  }
  else
  { ?>
    <tr><td class="small"><?php echo $locale['007']; ?></td></tr>
 <? } ?>
  </table><br /></div>
  <? } 
  }?>
   <?
	if ($kmfu_ustawienia['admin'] == 1) {
	?>
  <? if(iADMIN){
  ?><div class='side-label mvp_head small' style='cursor: pointer;' title='<?php echo $locale['021']; ?>'><?php echo $locale['021']; ?><span style='float:right;'><?php echo $admin; ?></span></div>
	<div class='mvp_body small' style='margin-bottom:3px'><?
  $pages = array(1 => false, 2 => false, 3 => false, 4 => false, 5 => false); 
$index_link = false; $admin_nav_opts = ""; $current_page = 0;
  $result = dbquery("SELECT admin_title, admin_page, admin_rights, admin_link FROM ".DB_ADMIN." ORDER BY admin_page DESC, admin_title ASC");
$rows = dbrows($result);
while ($data = dbarray($result)) {		
	if ($data['admin_link'] != "reserved" && checkrights($data['admin_rights'])) {
		$pages[$data['admin_page']] .= "<option value='".ADMIN.$data['admin_link'].$aidlink."'>".preg_replace("/&(?!(#\d+|\w+);)/", "&amp;", $data['admin_title'])."</option>\n";
	}
}

$content = false;
for ($i = 1; $i < 6; $i++) {
	$page = $pages[$i];
		
	if ($page) {
		$admin_pages = true; ?>
		
		<form action="<?php echo FUSION_SELF; ?>">
		<select onchange="window.location.href=this.value" style="width:100%;" class="textbox">
		<option value="<?php echo FUSION_SELF; ?>" style="font-style:italic;" selected="selected"><?php echo $locale['ac0'.$i]; ?></option>
		<?php echo $page; ?></select></form>
		
		<? $content = true;
		
	}
	
}
?></div><?
}
}
  ?>


