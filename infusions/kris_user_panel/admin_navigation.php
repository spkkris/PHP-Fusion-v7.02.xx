<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2011 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: admin_navigation.php
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
require_once INFUSIONS."kris_user_panel/infusion_db.php";

    opentable($locale['title']);
	echo "<div style='text-align:center;'><a href='".INFUSIONS."kris_user_panel/kris_user_panel_admin.php".$aidlink."'>".$locale['kmf']."</a> - 
	<a href='".INFUSIONS."kris_user_panel/version_check.php".$aidlink."'>".$locale['kmf1']."</a>\n";
	echo "</div>\n";
	closetable();

?>