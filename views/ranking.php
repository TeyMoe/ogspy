<?php
/**
 * Rankings
 * @package OGSpy
 * @version 3.04b ($Rev: 7508 $)
 * @subpackage views
 * @author Kyser
 * @created 15/12/2005
 * @copyright Copyright &copy; 2007, http://ogsteam.fr/
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace Ogsteam\Ogspy;

if (!defined('IN_SPYOGAME')) {
    die("Hacking attempt");
}

require_once("views/page_header.php");
?>

    <table width="100%">
        <tr>
            <td>
                <table>
                    <tr align="center">
                        <?php
                        if (!isset($pub_subaction)) {
                            $subaction = "player";
                        } else {
                            $subaction = $pub_subaction;
                        }

                        if ($subaction != "player") {
                            echo "\t\t\t" . "<td class='c' width='150' onclick=\"window.location = 'index.php?action=ranking&amp;subaction=player';\">";
                            echo "<a style='cursor:pointer'><span style=\"color: lime; \">" . $lang['RANK_PLAYERS'] . "</span></a>";
                            echo "</td>";
                        } else {
                            echo "\t\t\t" . "<th width='150'>";
                            echo "<a>" . $lang['RANK_PLAYERS'] . "</a>";
                            echo "</th>";
                        }

                        if ($subaction != "ally") {
                            echo "\t\t\t" . "<td class='c' width='150' onclick=\"window.location = 'index.php?action=ranking&amp;subaction=ally';\">";
                            echo "<a style='cursor:pointer'><span style=\"color: lime; \">" . $lang['RANK_ALLIANCES'] . "</span></a>";
                            echo "</td>";
                        } else {
                            echo "\t\t\t" . "<th width='150'>";
                            echo "<a>" . $lang['RANK_ALLIANCES'] . "</a>";
                            echo "</th>";
                        }
                        ?>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center">
                <?php
                switch ($subaction) {
                    case "player" :
                        // data necssaire
                        $data_general = galaxy_show_ranking_player();
                        $availableDatatade = get_all_ally_distinct_date_ranktable();
                        $is_player = true;
                        require_once("rankings.php");
                        break;

                    case "ally" :
                        // data necssaire
                        $data_general = galaxy_show_ranking_ally();
                        $availableDatatade = get_all_ally_distinct_date_ranktable();
                        $is_player = false;

                        require_once("rankings.php");
                        break;
                }
                ?>
            </td>
        </tr>
    </table>

<?php
require_once("views/page_tail.php");
?>