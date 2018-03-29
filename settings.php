<?php
/**
 * @package    local_hibp
 * @author     Simon Champion
 * @copyright  Simon Champion
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use Spudley\LocalHibp\hibp;

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__.'/hibp.php');

if (is_siteadmin()) {
    $hibp = new hibp();
    $hibp->settings($ADMIN);
}
