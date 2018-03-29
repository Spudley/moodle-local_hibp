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
 * @package    local_externaldisclaimer
 * @author     Simon Champion
 * @copyright  Simon Champion
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace Spudley\LocalHibp;

use admin_setting_configcheckbox;
use admin_setting_configtext;
use admin_settingpage;
use get_config;
use get_string;
use curl;

class hibp
{
    const PLGNAME = 'local_hibp';
    const ROOT_API = 'https://api.pwnedpasswords.com/range/';

    private $enabled = false;
    private $config = [];

    public function __construct()
    {
        $this->enabled = get_config(self::PLGNAME, 'enabled');

        $this->config = [
            'maxpwned' => get_config(self::PLGNAME, 'maxpwned')
        ];
    }

    public function validate($password)
    {
        if (!$this->config['enabled']) {
            return '';
        }

		if ($this->isPwned(sha1($password))) {
            return get_string('passwordispwned', self::PLGNAME);
		}

        return '';
    }

	private function isPwned($sha1Hash)
	{
		$firstFive = substr($sha1Hash, 0, 5);
		$remainder = strtoupper(substr($sha1Hash, 5));	//api returns upper case; make this upper too so that it matches.

        $curl = new curl();
        $curl->setHeader('User-Agent: sc-hibp-plugin-for-Moodle');
        $response = $curl->get(self::ROOT_API.$firstFive, array(), array('CURLOPT_FAILONERROR' => true));
        if ($curl->get_errno()) {
            return false;   //swallow errors; if the service isn't working we'll just have to let users get away with bad passwords.
        }

		$matches = explode("\n", $response);
		foreach ($matches as $match) {
			list($hashMatch, $matchCount) = explode(':', $match);
			if ($hashMatch === $remainder) {
				//Password matches a known compromised password. Oh dear. I think we need to tell the user about that.
				return ($matchCount > (int)$this->config['maxpwned']);	//but maybe not, if it's only been compromised a few times, eh?
			}
		}

		//No match, so password isn't pwned. Phew.
		return false;
   }


    public function settings($ADMIN)
    {
        $settings = new admin_settingpage('local_hibp', \get_string('pluginname', self::PLGNAME));

        $settings->add($this->createSettingCheckbox('enabled'));
        $settings->add($this->createSettingInteger('maxpwned', 10));

        $ADMIN->add('localplugins', $settings);
    }

    private function createSettingCheckbox($name, $default = false)
    {
        $fqName = self::PLGNAME.'/'.$name;
        $title = get_string($name, self::PLGNAME);
        $description = get_string($name.'_desc', self::PLGNAME);
        return new admin_setting_configcheckbox($fqName, $title, $description, $default, true, false);
    }

    private function createSettingInteger($name, $default = 0)
    {
        $fqName = self::PLGNAME.'/'.$name;
        $title = get_string($name, self::PLGNAME);
        $description = get_string($name.'_desc', self::PLGNAME);
        return new admin_setting_configtext($fqName, $title, $description, $default, PARAM_INT);
    }
}
