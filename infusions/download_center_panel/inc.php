<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2014 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Plik: inc.php
| Autor: DysNet
| Wersja: 2.04 FINAL
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
function autor() {
$www = "http://www.dysnet.pl";
$copy = "Copyright DysNet 2014 - ".date("Y");
echo "<div align='right'><a href='".$www."' target='_blank' title='".$copy."'>©</a></div>";
}

?>