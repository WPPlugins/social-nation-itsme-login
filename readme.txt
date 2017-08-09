=== Social Nation It'sMe Login ===
Contributors: socialnationdev
Tags:  login, register, social login, social networks, itsme, 
Requires at least: 4.4
Tested up to: 4.6.6
Stable tag: 1.0.7
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Social Nation It'sMe Login is a web service that authorizes It'sMe users to log in on the Partner’s website through web or mobile application, using the It'sMe credentials.

Once logged-on Partner can get the information that the user has authorized to share.

This service has been developed by implementing the authorization protocol oAuth 2.0.

Social Nation It'sMe offers to partners the following technologies:
- REST API: All services exposed by Social Nation It'sMe are exposed through REST services accessible from Partner.
- OAuth 2.0: The authorization protocol used for the resource provisioning to the Partner.
- LOGIN WITH It'sMe: A single sign-on using the It'sMe credentials to access the Partner web site without the need to create new login credentials.

USING THE SHORTCODE

To display It'sMe Login button inside a WordPress page, you can use the shortcode:
[socialnation_itsme_login text='text before button' text_after='text after button']

To customize the style of It’sMe Login button you can overwrite the following CSS classes:
div.sn_iml_login_button{ ... }
a.sn_iml_login_button{ ... }
img.sn_iml_login_button{ ... }
.sn_iml_login_button_text{  }
.sn_iml_login_button_img{  }
.sn_iml_login_button_text_after{  }

For basic usage, you can also have a look at the [Social Nation Developers Web Site](https://developers.socialnation.it)

== Installation ==

AUTOMATIC INSTALL

- From your WordPress dashboard, navigate to the Plugins menu and click Add New.
- In the search field type "Social Nation Itsme Login" and click Search Plugins. 
- Once you’ve found our It'sMe plugin you can install it by simply clicking “Install Now”.

MANUAL INSTALL

- Upload "social-nation-itsme-login" folder in the "/wp-content/plugins/" folder.
- Activate the plugin using the "Plugins" menu in WordPress.


INITIAL SETUP

You will find "Social Nation It'sMe Login" sub-menu in the "Settings" menu in WordPress.
Complete the fields "Name OAuth" (Customer Service ID), "OAuth Value" (Customer Service Secret Password), "Redirect URI" (Token URL Notification) and save the changes.
Note: If you want to test It'mMe Login with your test credentials the flag "Test mode" should be selected.

Selecting the flag "Enable Log" a .log file is created in which you can see the transactions carried out by the plugin.

The .log file is created in the “wp-content/uploads/social-nation-itsme-login” folder. 
Check if WordPress user has write permissions to the uploads folder. 
Once activated, and every time you save the settings the plugin tries to create this directory.
If during activation you do not have write permission the uploads folder is not created. 
You will need to properly set permissions and then save It’sMe Login settings, in this way the plugin will create itsme-log folder, and you can view the log file.

For more information read the guidance [WordPress Changing File Permissions](https://codex.wordpress.org/Changing_File_Permissions)

== Screenshots ==

1. Report Settings.
2. General Settings.
3. It'sMe Login Button Example 1.
4. It'sMe Login Button Example 2.
5. It'sMe Login Button Example 3.
6. It'sMe Login Button Example 4.
7. It'sMe Login Button Example 5.
8. It'sMe Login Button Example 6.
9. It'sMe Login Button Example 7.
10. It'sMe Login Button Example 8.

== Changelog ==

= 1.0.7 =

* Release date: June 27th, 2017

**Bug Fixes**

* Settings Checkboxes now can be unchecked


= 1.0.6 =

* Release date: June 13th, 2017

**Bug Fixes**

* Refresh fields after save settings


= 1.0.5 =

* Release date: June 13th, 2017

**Enhancements**

* User Report

