<?php
/**
 * Spy Report Rendering
 * @package OGSpy
 * @version 3.04b ($Rev: 7508 $)
 * @subpackage views
 * @author Kyser
 * @created 15/12/2005
 * @copyright Copyright &copy; 2007, http://ogsteam.fr/
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */


if (!defined('IN_SPYOGAME')) {
    die('Hacking attempt');
}

$reports = galaxy_reportspy_show();
$galaxy = $pub_galaxy;
$system = $pub_system;
$row = $pub_row;

if ($reports === false) {
    redirection('index.php?action=message&amp;id_message=errorfatal&amp;info');
}

$favorites = user_getfavorites_spy();

require_once('views/page_header_2.php');
if (sizeof($reports) == 0) {
    echo '<p>' . $lang['REPORT_NOREPORTAVAILABLE'] . "</p>\n";
    echo '<script>window.opener.location.href=window.opener.location.href;</script>';
} else {
    foreach ($reports as $v) {
        $spy_id = $v['spy_id'];
        $sender = $v['sender'];
        if (sizeof($favorites) < $server_config['max_favorites_spy']) {
            $string_addfavorites = 'window.location = \'index.php?action=add_favorite_spy&amp;spy_id=' . $spy_id . '&amp;galaxy=' . $galaxy . '&amp;system=' . $system . '&amp;row=' . $row . '\';';
        } else {
            $string_addfavorites = 'alert(\'' . $lang['REPORT_MAXFAVORITES'] . ' (' . $server_config['max_favorites_spy'] . ')\')';
        }
        $string_delfavorites = 'window.location = \'index.php?action=del_favorite_spy&amp;spy_id=' . $spy_id . '&amp;galaxy=' . $galaxy . '&amp;system=' . $system . '&amp;row=' . $row . '&amp;info=2\';';
        $string_delspy       = 'window.location.href = \'index.php?action=del_spy&amp;spy_id='     . $spy_id . '&amp;galaxy=' . $galaxy . '&amp;system=' . $system . '&amp;row=' . $row . '&amp;info=2\';';

        echo '<div><span style="font-weight:bold;">' . $lang['REPORT_RESENTBY'] . ' ' . $sender . '</span>' . date($lang['REPORT_DATEFORMAT'], $v['dateRE']) . "</div>\n";
        echo '<div style="text-align:right">';
        if (!isset($favorites[$spy_id])) {
            echo "<input type='button' value='" . $lang['REPORT_ADDTOFAV'] . "' onclick=\"$string_addfavorites\">\n";
        } else {
            echo "<input type='button' value='" . $lang['REPORT_REMOVEFROMFAV'] . "' onclick=\"$string_delfavorites\">\n";
        }
        if ($user_data['user_admin'] == 1 || $user_data['user_coadmin'] == 1) {
            echo "<input type='button' value='" . $lang['REPORT_DELETE'] . "' onclick=\"$string_delspy\">\n";
        }
        echo "</div><br/>\n";
        echo $v['data'] . "<br/><br/>\n";
    }
}
echo "<br/>\n";
require_once('views/page_tail_2.php');