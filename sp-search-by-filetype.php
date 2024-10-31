<?php

/*
Plugin Name: Search by File Type
Plugin URI: http://www.shaneandpeter.com/wordpress
Description: Implements methods for separating searches by type [post|video|audio|image]
Author: Shane and Peter, Inc.
Version: 1.0
Author URI: http://www.shaneandpeter.com/

Todo:
* restrict results to status = 'published'

*/

class spSearchFilter {

	// Filters for restricting search results
	function search_filter($where) {
		switch ($this->type) {
			case 'audio' :
				$where = $this->status_swap($where);
				$where .= " AND post_mime_type = 'audio/mpeg'";
				break;
			case 'video' :
				$where = $this->status_swap($where);
				$where .= " AND post_mime_type = 'application/octet-stream'";
				break;
			case 'image' :
				$where = $this->status_swap($where);
				$where .= " AND (post_mime_type = 'image/jpeg' OR post_mime_type = 'image/gif' OR post_mime_type = 'image/png')";
				break;
			case 'post' :
				$where .= " AND post_type = 'post'";
				break;
		}
	
		if ($where)
			return $where;
	}
	
	function status_swap($where) {
		return preg_replace(
			"/wp_posts.post_status = 'publish'/",
			"wp_posts.post_status = 'inherit'", 
			$where );
	}

}

// Public function for getting the attachment result type
function get_type($id) {
	$post = &get_post($id);
	if ($post) {
		switch ($post->post_mime_type) {
			case 'audio/mpeg' :	
				return 'audio';
				break;
			case 'application/octet-stream' :
				return 'video';
				break;
			case 'image/jpeg' :
			case 'image/gif' :
			case 'image/png' :
				return 'image';
				break;
			default :
				return 'post';
				break;
		}
	}
}

// Process ?type=...
if ($_GET['type']) {
	$spsf = new spSearchFilter();
	$spsf->type = $_GET['type'];
	add_filter('posts_where', array($spsf,'search_filter'));
}

// Public function for specifying a type within a page.
function sp_search($type) {
	$spsf = new spSearchFilter();
	$spsf->type = $type;
	add_filter('posts_where', array($spsf,'search_filter'));
}

?>
