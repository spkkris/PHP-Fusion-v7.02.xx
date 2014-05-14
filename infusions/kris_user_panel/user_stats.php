<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2011 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Plik: user_stats.php
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
include_once INCLUDES."infusions_include.php";
if (file_exists(INFUSIONS."kris_user_panel/locale/".$settings['locale'].".php")) {
	include INFUSIONS."kris_user_panel/locale/".$settings['locale'].".php";
} else {
	include INFUSIONS."kris_user_panel/locale/Polish.php";
}
add_to_head("<script type='text/javascript' src='".INFUSIONS."kris_user_panel/mvp.js'></script>");
include LOCALE.LOCALESET."admin/main.php";

echo "<div align='center'>";
	 if ($userdata['user_avatar'] != "") {  
    echo "<img src='".IMAGES."avatars/".$userdata['user_avatar']."'/><br /><br />";
		 } else { 
			echo "<img src='".IMAGES."avatars/noavatar100.png' /><br /><br />";
		 } 
		echo "</div>";
		
	if ($kmfu_ustawienia['statystyki'] == 1) {
		echo "<div class='side-label mvp_head small' style='cursor: pointer;' title='".$locale['019']."'>".$locale['019']."</div>
	<div class='mvp_body small' style='margin-bottom:3px'>";
		echo $locale['001']."<strong>".USER_IP."</strong><br />";
		echo $locale['002']."<strong>".$userdata['user_posts']."</strong><br />";
		echo $locale['003']."<strong>".number_format(dbcount("(comment_id)", DB_COMMENTS, "comment_name='".$userdata['user_id']."'"))."</strong><br />";
		echo $locale['004']."<strong>".number_format(dbcount("(news_id)", DB_NEWS, "news_name='".$userdata['user_id']."'"))."</strong><br />";
		echo $locale['005']."<strong>".number_format(dbcount("(photo_id)", DB_PHOTOS, "photo_user='".$userdata['user_id']."'"))."</strong><br />";
		echo $locale['006']."<strong>".number_format(dbcount("(download_id)", DB_DOWNLOADS, "download_user='".$userdata['user_id']."'"))."</strong><br />";
		echo "</div>";
		 } 
		
	if ($kmfu_ustawienia['top_users'] == 1) {
	echo "<div class='side-label mvp_head small' style='cursor: pointer;' title='".$locale['023']."'>".$locale['023']."</div>
	<div class='mvp_body small' style='margin-bottom:3px'>";
	$result = dbquery("SELECT user_name, user_location, user_status, user_id, count(user_id) AS post_count FROM ".DB_POSTS." INNER JOIN
".DB_USERS." ON post_author=user_id GROUP BY user_name ORDER BY post_count DESC LIMIT 0,5");
echo "<table width='100%' cellpadding='0' cellspacing='0'>";
if(dbrows($result)!=0){
while($data=dbarray($result)){ 
echo "<tr><td class='small2' align='left'>".profile_link($data['user_id'], $data['user_name'], $data['user_status'])."</td><td class='small2' align='right'>[".$data['post_count']."]</td></tr>";
}
} else { 
echo "<tr><td class='small'>".$locale['007a']."</td></tr>";
 } 
echo "</table>
	</div>";
	 } 
	
	if ($kmfu_ustawienia['ip_users'] == 1) {
	
		if(iSUPERADMIN) {
		echo "<div class='side-label mvp_head small' style='cursor: pointer;' title='".$locale['020']."'>".$locale['020']."</div>
	<div class='mvp_body small' style='margin-bottom:3px'>";
  $wynik = dbquery("SELECT GROUP_CONCAT(CAST(user_id AS CHAR)) AS user_id, GROUP_CONCAT(CAST(user_name AS CHAR)) AS ip_user_name, user_ip, COUNT(user_ip) AS num FROM ".DB_USERS." GROUP BY user_ip HAVING num > 1");
  echo "<table border='0' width='100%' class='small'>";
   if(dbrows($wynik) > 0)
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
      } 
    echo "<tr><td class='small'><span style='font-weight: bold;'>".$r['user_ip']."</span> ".$locale['008'].number_format($r['num']).$locale['009']."</td></tr>
    <tr><td class='small'>".substr($users, 0, -2)."</td></tr>";
       $users = ''; 
    }
  }
  else
  { 
    echo "<tr><td class='small'>".$locale['007']>"</td></tr>";
  } 
  echo "</table><br /></div>";
   } 
  }
   
	if ($kmfu_ustawienia['admin'] == 1) {
	
   if(iADMIN){
  echo "<div class='side-label mvp_head small' style='cursor: pointer;' title='".$locale['021']."'>".$locale['021']."</div>
	<div class='mvp_body small' style='margin-bottom:3px'>";
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
		$admin_pages = true; 
		
		echo "<form action='".FUSION_SELF."'>
		<select onchange='window.location.href=this.value' style='width:100%;' class='textbox'>
		<option value='".FUSION_SELF."' style='font-style:italic;' selected='selected'>".$locale['ac0'.$i]."</option>
		".$page."</select></form>";
		
		 $content = true;
		
	}
	
}
echo "</div>";
}
}
  ?>