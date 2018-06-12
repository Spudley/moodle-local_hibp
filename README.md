Local/HIBP
==========

This is a Moodle plugin that aims to improve password security for your site's users by preventing them from using a password that is known to have been compromised.

In order to do this, the plugin makes use of the "Have I Been Pwned" API, operated by noted security researcher Troy Hunt.

HaveIBeenPwned.com contains an archive of user credentials that have been made public after being hacked, and allows anyone to query the database to find out whether their credentials have been compromised.

For the purposes of validating a new password, the API can be used to determine whether the password being entered has already been compromised. If the requested password already exists in the HaveIBeenPwned database, it should be assumed to be insecure, because many hacking attempts will use existing known credentials when attempting to crack new passwords.

In addition, the API also returns the number of times that the specified password exists in the database. This can also be used to establish the security (or lack thereof) of a given password; if it exists many times in the database, then it is clearly a commonly used password, and thus vulnerable to attack even if it successfully passes the conventional complexity tests.

This plugin is based on a similar plugin that I had previously written for Joomla.


Version History
----------------

* 1.0.0     Initial release.


Installation
----------------

This is a standard Moodle 'local' plugin. Installation is via Moodle's plugin manager. Go to the Install Plugin page, and follow the instructions.


Requirements
------------

This plugin should work with Moodle v3.6 and higher.

Note: The callback hook that the plugin uses was added to Moodle core by the author of this plugin in order to allow the plugin to be implemented. The patch was accepted into the core, but not in time for the release of Moodle 3.5. It will therefore be available for the release of Moodle 3.6.

Should you wish to use this plugin with an earlier version of Moodle, the changes made to the core to support the plugin can be back-ported relatively easily. Please see the Moodle tracker ticket linked below for further details.


Configuration
-------------

In the plugin configuration, set the options as follows:

* Enabled:

  This checkbox turns the plugin on. Make sure you have populated the other configuration fields before enabling the plugin.

* Compromise threshold limit:

  This is an integer value that allows you to specify how many times a password should appear in the HaveIBeenPwned database before we prevent it from being used. The default and ideal setting for this is zero, but you may consider this too strict. The option can be set to any value up to 10.


Caveats, Limitations, To-dos and Notes
--------------------------------------

* In the event that the API is broken or offline, the plugin will fail silently and allow the password to be used.
* The API is aggressively cached and generally extremely quick to respond, but it it is possible that it may add a delay to page load time, particularly in the scenario where the system gets a timeout from the API request.


References
----------

Documentation for the HaveIBeenPwned API can be found here: https://haveibeenpwned.com/API/v2

The main HIBP site and further information about it can be found at https://haveibeenpwned.com/

The author of HIBP is Troy Hunt. His personal site can be found here: https://www.troyhunt.com/

For those interested in the Moodle core patch that was made to enable this plugin, you can read about it on the Moodle Tracker: https://tracker.moodle.org/browse/MDL-61694


License
----------------
As with Moodle itself, this plugin is licensed under the GPLv3 license. The license document should be included.

The HaveIBeenPwned API is licensed under the Creative Commons Attribution 4.0 International License.
