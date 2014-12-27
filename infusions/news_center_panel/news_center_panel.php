<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2014 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Plik: news_center_panel.php
| Autor: krystian1988
| Wersja: 1.00
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
if (file_exists(INFUSIONS."news_center_panel/locale/".$settings['locale'].".php")) {
	include INFUSIONS."news_center_panel/locale/".$settings['locale'].".php";
} else {
	include INFUSIONS."news_center_panel/locale/Polish.php";
}
include INFUSIONS."news_center_panel/infusion_db.php";
include INFUSIONS."news_center_panel/inc.php";
opentable("Ostatnio dodane newsy");
$kmfn_ustawienia = dbarray(dbquery("SELECT * FROM ".DB_KMF_NCP.""));
if ($kmfn_ustawienia['ile'] || $kmfn_ustawienia['slider'] == 1) {
add_to_head("<style type='text/css'>
.dl-ticker {
		display: none;
		list-style-type: none;
		padding: 3px;
		margin-bottom: 2px;
		height:auto;
	   }</style>
		<script language='JavaScript' type='text/javascript' src='".INFUSIONS."news_center_panel/ticker.js'></script>
		");
		if ($kmfn_ustawienia['slider'] == 1) {
		echo "<ul id='dlticker' class='dl-ticker'>";
$pytanie = dbquery("SELECT tn.*, tc.*, tu.user_id, tu.user_name, tu.user_status
			FROM ".DB_NEWS." tn
			LEFT JOIN ".DB_USERS." tu ON tn.news_name=tu.user_id
			LEFT JOIN ".DB_NEWS_CATS." tc ON tn.news_cat=tc.news_cat_id
			WHERE ".groupaccess('news_visibility')." AND (news_start='0'||news_start<=".time().")
				AND (news_end='0'||news_end>=".time().") AND news_draft='0'
			GROUP BY news_id
			ORDER BY news_sticky DESC, news_datestamp DESC LIMIT ".$kmfn_ustawienia['ile']."");
$brak = dbrows($pytanie);
               if ($brak != 0) {
						while ($odp = dbarray($pytanie)) {
						echo "<li>";
						$opis = ($odp['news_news'] != "" ? nl2br(stripslashes($odp['news_news'])) : nl2br(stripslashes($odp['news_news'])));		
echo "<table cellpadding='0' cellspacing='1' style='padding-top: 2px;' width='100%' align='center'><tr>";
echo "<a href='".BASEDIR."news.php?readmore=".$odp['news_id']."'><h2>".$odp['news_subject']."</h2></a>";
echo $opis;
echo "<hr /><td class='tbl1' style='width: 100%;' align='left' valign='top'>".$locale['024'].$odp['user_name'].$locale['025'].$odp['news_cat_name'].$locale['018'].$odp['news_reads']."</td>";
echo "</tr></table>";
	} 
	echo "</li>";
	} else {
	  echo "<div class='admin-message'>".$locale['020']."</div>";
    }
	echo "</ul>";
	} else {
$pytanie = dbquery("SELECT tn.*, tc.*, tu.user_id, tu.user_name, tu.user_status
			FROM ".DB_NEWS." tn
			LEFT JOIN ".DB_USERS." tu ON tn.news_name=tu.user_id
			LEFT JOIN ".DB_NEWS_CATS." tc ON tn.news_cat=tc.news_cat_id
			WHERE ".groupaccess('news_visibility')." AND (news_start='0'||news_start<=".time().")
				AND (news_end='0'||news_end>=".time().") AND news_draft='0'
			GROUP BY news_id
			ORDER BY news_sticky DESC, news_datestamp DESC LIMIT ".$kmfn_ustawienia['ile']."");
$brak = dbrows($pytanie);
               if ($brak != 0) {
						while ($odp = dbarray($pytanie)) {
						$opis = ($odp['news_news'] != "" ? nl2br(stripslashes($odp['news_news'])) : nl2br(stripslashes($odp['news_news'])));		
echo "<table cellpadding='0' cellspacing='1' style='padding-top: 2px;' width='100%' align='center'><tr>";
echo "<a href='".BASEDIR."news.php?readmore=".$odp['news_id']."'><h2>".$odp['news_subject']."</h2></a>";
echo $opis;
echo "<hr /><td class='tbl1' style='width: 100%;' align='left' valign='top'>".$locale['024'].$odp['user_name'].$locale['025'].$odp['news_cat_name'].$locale['018'].$odp['news_reads']."</td>";
echo "</tr></table>";
	} 
	} else {
	  echo "<div class='admin-message'>".$locale['020']."</div>";
    }
	}
	echo autor();
closetable();
add_to_footer("<script type='text/javascript'>
	$(document).ready(
		function() {
			$('#dlticker').dlTicker('7000');
			$('#dlticker').show('slow');
		}
	);
	</script>");
}
?>