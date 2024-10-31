=== S&P Search by File Type ===
Contributors: Shane & Peter, Inc.
Donate link: http://www.shaneandpeter.com
Tags: widget, search, image, video, audio
Requires at least: 2.5
Tested up to: 2.6
stable tag: 1.0

Break your search up by file types.  Implements methods for separating searches by type [post|video|audio|image]

== Description ==
Break your search up by file types.  Implements methods for separating searches by type [post|video|audio|image]


todo:
* restrict results to status = 'published'

== Installation ==

**Install**

1. Unzip the `sp-search-by-file-type.zip` file. 
1. Upload the the `sp-search-by-file-type` folder (not just the files in it!) to your `wp-contents/plugins` folder. If you're using FTP, use 'binary' mode.

**Activate**

1. In your WordPress administration, go to the Plugins page

**Implement**

To use this plugin, add links in your search/tags/categories/etc loops that set the type so as to filter the list.  

Usage: http://someurl/?type=[post|video|audio|image]

Tab Example:

<code>
<ul class="search_filters">
	<li><a href="<? bloginfo('url'); ?>?s=<? echo $_GET['s'] ?>">All</a></li>
	<li><a href="<? bloginfo('url'); ?>?s=<? echo $_GET['s'] ?>&type=post">Posts</a></li>
	<li><a href="<? bloginfo('url'); ?>?s=<? echo $_GET['s'] ?>&type=image">Images</a></li>
	<li><a href="<? bloginfo('url'); ?>?s=<? echo $_GET['s'] ?>&type=video">Videos</a></li>
	<li><a href="<? bloginfo('url'); ?>?s=<? echo $_GET['s'] ?>&type=audio">Audio</a></li>
</ul>
</code>

get_type($id) can be used within the loop to detect the post mime type.

If you find any bugs or have any ideas, please mail us.

sp_search($type) can be used before query_posts() to restrict results within a template.  Example:

<code>
sp_search('video');
query_posts();
if (have_posts()) :
// internal loop here
endif;
</code>