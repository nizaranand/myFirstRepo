<?php

/*
 * custom pagination
 */

function wpv_pagination($pages = '', $range = null) {
	global $wp_query;
	
	$page = get_query_var('paged') ? get_query_var('paged') : 1;
	
	if ($pages == '') {
		$pages = $wp_query->max_num_pages;
		if (!$pages) {
			$pages = 1;
		}
	}
	
	// if $range is not set, we'll try to always show five pages
	if($range === null) {
		if($page == 1 || $page == $pages) {
			$range = 4;
		} else if ($page == 2 || $page == $pages-1) {
			$range = 3;
		} else {
			$range = 2;
		}
		
		$showitems = 5;
	} else {
		$showitems = ($range * 2) + 1;
	}
	
	if (1 != $pages) {
		echo "<div class='pagination'><ul>";
		if ($page > 2 && $page > $range + 1 && $showitems < $pages) echo "<li><a href='" . get_pagenum_link(1) . "'><span>First</span></a></li>";
		if ($page > 1 && $showitems < $pages) echo "<li><a href='" . get_pagenum_link($page - 1) . "' class='prev-btn'><span>".__('Previous', 'wpv')."</span></a></li>";
		echo "<li class='middle'><ul>";
		for ($i = 1;$i <= $pages;$i++) {
			if (1 != $pages && (!($i >= $page + $range + 1 || $i <= $page - $range - 1) || $pages <= $showitems)) {
				echo ($page == $i) ? "<li class='current'>" . $i . "</li>" : "<li><a href='" . get_pagenum_link($i) . "' class='inactive' ><span>" . $i . "</span></a></li>";
			}
		}
		echo "</ul></li>";
		if ($page < $pages && $showitems < $pages) echo "<li><a href='" . get_pagenum_link($page + 1) . "' class='next-btn'><span>".__('Next', 'wpv')."</span></a></li>";
		if ($page < $pages - 1 && $page + $range - 1 < $pages && $showitems < $pages) echo "<li><a href='" . get_pagenum_link($pages) . "'><span>Last</span></a></li>";
		echo "</ul></div>\n";
	}
}
