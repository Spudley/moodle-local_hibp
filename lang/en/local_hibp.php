<?php
// This file is part of the Local HIBP (Have I Been Pwned) plugin for Moodle
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package    local_hibp
 * @author     Simon Champion
 * @copyright  Simon Champion
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 
$string['pluginname'] = 'HIBP (Have I Been Pwned)';
$string['enabled'] = 'Enabled';
$string['enabled_desc'] = 'Enable the HIBP plugin';
$string['maxpwned'] = 'Compromise threshold limit';
$string['maxpwned_desc'] = 'This is the maximum number of times that a password is allowed to appear in the HIBP database before users are blocked from using it. A limit of 10 or lower is reasonable.';

$string['passwordispwned'] = "Sorry, your chosen password is insecure, as it is known to have been previously compromised. This has been verified using the <a href='http://haveibeenpwned.com'>HaveIBeenPwned.com</a> API. For more information on this, please visit <a href='http://haveibeenpwned.com'>HaveIBeenPwned.com</a>. In the meanwhile, please select another password.";
