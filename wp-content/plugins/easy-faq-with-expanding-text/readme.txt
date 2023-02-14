=== Easy FAQ with Expanding Text ===
Contributors: bgentry
Donate link: http://bryangentry.us/pay-me
Tags: faq pages
Tested up to: 4.3.1
Stable tag: 3.2.8.3.1
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easily create a Frequently Asked Questions page with answers that slide down when the questions are clicked. Shortcode is available, not required.

== Description ==

Easily create headings that users can click on to reveal additional text below in WordPress pages and posts. Anyone who can use the WordPress post editor can use this plugin to create animated FAQ pages, or other pages that have this effect. No need for a shortcode or other coding needed!

To create your FAQ page, create a new page or post, click a checkbox on the post editing screen. In the content of the page, select a heading style for the questions or titles that you want to appear, and the paragraphs, lists, photos, and videos beneath them will be hidden until the heading is clicked. OR you can use the shortcodes [bg_faq_start] and [bg_faq_end] to wrap the section of content that you want to have this effect.

== Installation ==

1. Upload the 'easy-faq-by-bgentry' folder to your `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Click on FAQ Admin Page in the left-side menu on the dashboard for detailed instructions and settings

== Changelog ==

=3.3.8.3.1=
*Fixed an error message with array_key_exists where a non-array was being returned

=3.2.8.3=
Fixed what 3.2.8.2 was supposed to fix. :)

=3.2.8.2=
*Fixed a few more lines causing PHP notices on servers with certain PHP error notice settings.

=3.2.8.1=
*Fixed another PHP notice.

=3.2.8=
*Fixed a couple of lines of code that were causing some users to experience PHP notices.

=3.2.7=
*Added an option at the bottom of the options page for those who have donated

=3.2.6=
*Fixed code that was preventing the "one question open at a time" feature from working when the shortcode was used.
*Updated program to allow the one question open at a time to work even when there are additional divs and other elements wrapping the content.

=3.2.5=
* Added a second color (white) for the optional visual cues that appear next to the drop down headings.

=3.2.4=
* Updated javascript to restore ability to apply the animated effects to headings that are in tables or within other elements.

=3.2.3 =
* Fixed the ability to have each page or post individually control whether it will have just one answer open at a time.
* Updated javascript to improve the nested drop down feature

= 3.2.2 =
* Made the plugin more reliable for a wider variety of use cases, using more efficient coding. (Details: In the previous version, the plugin would not operate on pages that called the content filter before loading the main content of the page.)

= 3.2.1 =
* Added a checking mechanism that ensures the animation effects only get applied once, even on some WordPress pages that strangely tried to call the javascript twice

= 3.2 =
* Introduced [bg_faq_start] and [bg_faq_end] shortcodes to allow users to apply drop down effects to only certain parts of the page. This allows for more complicated layouts, such as a page that has lots of headings but only a few that need the dropdown text, or nested dropdowns.
* Display settings (such as visual cues, or the option to display only one "answer" at a time) are now available for each individual page or post.
* Improved the plugin's ability to operate on single pages even if it is used with a theme that is missing the wp_footer hook

= 3.1.5 =
Improved compability with Internet Explorer by removing a line of javascript that was not needed.

= 3.1 =
* Very minor update to adjust the location of the arrows and other images that indicate that a heading has drop down text. Now those will be centered even in themes that assign padding to the top of those headings.

= 3.0 =
* Now you can assign the expanding text effect to any page or post, including pages that do not have "FAQ" in the title. This is done through a checkbox added to each page and post editing screen. Pages containing "FAQ" or "Frequently asked questions" in the title still receive the effect automatically, so people who used previous versions of this plugin do not need to go back and change anything.
* The drop down text effects work on pages, single posts, and in a list of posts (index page)
* Added two options for a visual cue that makes it obvious that you can click on the questions to expand some text.
* Formatting a line of text as a heading 6 (h6) now allows users to stop the dropdown animations for that line and the lines following it, until another heading is used again.

= 2.1 =
* Made the plugin more compatible with other plugins or themes that add elements to a page's content (such as social share buttons). With this update, those themes should not make the introductory paragraphs disappear.

= 2.0 =
* Improved the performance of the plugin when answers contain different colored text, lists, etc.
* Removed the need to examine your WordPress theme and HTML to determine the class name for your content container. The plugin now finds the content automatically.
* Updated and perfected the documentation and instructions.

= 1.1 =
*Added styles so a hand pointer cursor shows when people hover over headings / questions
*Allowed unordered and ordered lists to be used in answers and hidden / shown correctly
*Allow one to two paragraphs (depending on theme) at the very beginning of the content that is not hidden, allowing user to use an introductory paragraph

= 1.0 =
* The plugin was invented!