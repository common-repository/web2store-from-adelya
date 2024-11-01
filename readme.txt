=== Plugin Name ===
Contributors: Adelya
Donate link: http://www.adelya.com/
Tags: web2store, modules, translate, adelya
Requires at least: 4.0.1
Tested up to: 4.7.5
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


This plugin allows to integrate web2store modules to the wordpress pages.

== Description ==

The Web2Store plugin from Adelya Loyalty Operator was designed for customers using Wordpress as CMS for their website. It aims to integrate the different modules present in the existing CRM in all the pages thanks to the shortcodes created by Adelya Loyalty Operator. Each shortcode is specific to a module (login, registration, loyalty, information, stores, gift cards ....).

When the Group code and the Client's server code are stored in the database, the URL of each module will integrate its information in order to redirect the shortcodes on the Web2Store modules corresponding to the store or the client.

The client can therefore manage the modules he wishes to display from his Wordpress platform. The plugin makes it possible or not to resize the modules to the size of the pages of the site. The choice is made in the Settings -> Plugin Name tab.

Finally, the Web2Store plugin manages the translation of modules from the main Wordpress panel. If Wordpress has been configured in French, the administration part and the modules will work in French, otherwise it will work entirely in English.


== Installation ==

This section describes how to install the plugin and get it working.


1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the Settings->Plugin Name screen to configure the plugin
4. Enter your Group code and your server code in the form to register as an Adelya customer. Validate.
5. Configure the module display in the "Adjust web2Store modules on page?" Section. If you want the module to appear completely on the page without a scroll bar, choose Yes, otherwise choose No.


== Frequently Asked Questions ==

= Why is there an error message on the page when I activate a shortcode? =
You encounter the error message when displaying the module when you have an input error on the shortcode or the "module" field is empty. Please check your input.

= Why do the modules display a 404 error on the pages? =
If you encounter a 404 error while displaying the module, there is an error on your group code and / or your server code. Please check your codes and save them again in the form found in the plugin administration.

= Where can I find my Group code and my Server code? =
Adelya Loyalty Operator will provide you with your group code and your server code when installing your plugin.


= Can we resize the pages at any time? =
Yes, you can resize the modules at any time without losing your information.


= Can we change the translation of the plugin without losing the information? =
Yes, you can change the language of modules and administration at any time without losing your information.


= How do I create a new shortcode? =
No, the list of shortcodes is fixed.


== Screenshots ==

1. Screenshot_admin :
2. Screenshot_Shortcode :
3. Screenshot_Module :
4. Screenshot_translate_admin :
5. Screenshot_translate_module :

== Changelog ==

= 1.0 =
* First version

= 2.0 =
* Second version

// == Upgrade Notice ==

= 1.0 =
Upgrade notices describe the reason a user should upgrade.  No more than 300 characters.


// == Arbitrary section ==

You may provide arbitrary sections, in the same format as the ones above.  This may be of use for extremely complicated
plugins where more information needs to be conveyed that doesn't fit into the categories of "description" or
"installation."  Arbitrary sections will be shown below the built-in sections outlined above.



https://www.adelya.com



`<?php code(); // goes in backticks ?>`