<?php
//==============================================================================================
// prepend
//==============================================================================================
// include_once 'config.php';
// session_start();

// require_once 'pageClass.php';
// $thisPage = new page();

// require_once 'utilClass.php';
// $_util = new util();

// define("CACHE_CLEAR", "?202004270001");

$company_name = "Nguyễn Đức Mỹ";

$description = "Nguyễn Đức Mỹ";
$keyword = "Software Engineer, IT Jobs, Software Development, IT Consulting, Developer";

//========================================================================
// 絵文字削除
//========================================================================
remove_action("wp_head", "print_emoji_detection_script", 7);
remove_action("wp_print_styles", "print_emoji_styles");

remove_action('wp_head', 'feed_links', 2); //サイト全体のフィード
remove_action('wp_head', 'feed_links_extra', 3); //その他のフィード
remove_action('wp_head', 'rsd_link'); //Really Simple Discoveryリンク
remove_action('wp_head', 'wlwmanifest_link'); //Windows Live Writerリンク
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); //前後の記事リンク
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0); //ショートリンク
remove_action('wp_head', 'rel_canonical'); //canonical属性
remove_action('wp_head', 'wp_generator'); //WPバージョン

remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');

function add_theme_caps()
{
	$role = get_role('editor');

	$role->add_cap('manage_instagram_feed_options');
}

add_action('admin_init', 'add_theme_caps');

//==============================================================================
// 固有読み込みファイル設定
// 引数：個別読み込みファイル配列（type ファイル種別, src ファイルパス）
// 返値：個別読み込みファイルテキスト　$files
//==============================================================================
function loadUniqueFile($uniqueLoad)
{
	$files = "";

	// 引数が空または配列でなければ空を返す
	if (!is_array($uniqueLoad) || empty($uniqueLoad)) {
		return $files;
	}

	foreach ($uniqueLoad as $file) {
		if ($file["type"] == "css") {
			$files .= "<link rel='stylesheet' href='" . $file["src"] . CACHE_CLEAR . "' type='text/css'>\n";
		} else if ($file["type"] == "js") {
			$files .= "<script type='text/javascript' src='" . $file["src"] . CACHE_CLEAR . "'></script>\n";
		}
	}

	return $files;
}

/**
 * ページネーション出力関数
 * $paged : 現在のページ
 * $pages : 全ページ数
 * $range : 左右に何ページ表示するか
 * $show_only : 1ページしかない時に表示するかどうか
 */
function pagination($pages, $paged, $range = 5)
{
	$src_link_mark = get_template_directory_uri() . '/images/common/link-mark.svg';
	$link_mark = '<span class="link_mark"><img src="' . $src_link_mark . '" alt="Link Mark"></span>';
	$link_mark_opposite = '<span class="link_mark_opposite"><img src="' . $src_link_mark . '" alt="Link Mark"></span>';

	$pages = (int) $pages;    //float型で渡ってくるので明示的に int型 へ
	if ($pages == 0) {
		$pages = 1;
	}
	$paged = $paged ?: 1;       //get_query_var('paged')をそのまま投げても大丈夫なように
	$paged_group = $paged - $range + 1;            // 最後尾のページ送りグループ
	$paged_switch = $paged - ($range - 1);     // 最後の5つに切り替えるする記事番号

	// 最大値が1〜4まで前後のリンク数が異なる
	switch ($range) {
		case 1:
			$post_prev = $pages;
			$post_next = $pages;
			break;

		case 2:
			$post_prev = $pages;
			$post_next = $pages + 1;
			break;

		case 3:
			$post_prev = $pages - 1;
			$post_next = $pages + 1;
			break;

		case 4:
			$post_prev = $pages - 1;
			$post_next = $pages + 2;
			break;

		default:
			$post_prev = $pages - 2;
			$post_next = $pages + 2;
			break;
	}

	echo ('<ul class="pagination">');

	if ($pages != 1) {
		echo '<li class="prev_post_link"><a href="' . get_pagenum_link($pages - 1) . '" rel="next">';
		echo $link_mark_opposite . '<span>PREV</span></a></li>';
	}
	// 「次へ（新しい記事へ）」リンクの設定
	if ($paged >= $range && $pages - 1 > ($range - 2)) {
		if ($range != $paged) {
			echo '<li><a href="' . get_pagenum_link(1) . '">1</a></li><li class="san_maru_pre">…</li>';
		}
	}

	// 記事数が最大数以上ある場合
	// 例）最大数が5個で、記事が5個以上ある場合
	$is_last = false;
	if ($paged >= $range) {
		if ($pages - 1 < ($range - 1)) {
			for ($i = 1; $i <= $range; $i++) {
				if ($i == $pages) {
					// 現在のページ
					echo '<li class="active">' . ($i) . '</li>';
				} else {
					// その他のページ
					echo '<li><a href="' . get_pagenum_link($i) . '">' . ($i) . '</a></li>';
				}
			}
		} else if ($pages - 1 >= $paged_switch) {
			$is_last = true;

			for ($i = $paged_group; $i <= $paged; $i++) {
				if ($i == $pages) {
					// 現在のページ
					echo '<li class="active">' . ($i) . '</li>';
				} else {
					// その他のページ
					echo '<li><a href="' . get_pagenum_link($i) . '">' . ($i) . '</a></li>';
				}
			}
		} else {
			for ($i = $post_prev; $i <= $post_next; $i++) {
				if ($i == $pages) {
					// 現在のページ
					echo '<li class="active">' . ($i) . '</li>';
				} else {
					// その他のページ
					echo '<li><a href="' . get_pagenum_link($i) . '">' . ($i) . '</a></li>';
				}
			}
		}
	} // ここまで / 記事数が最大数以上ある場合

	// 記事数が最大数未満の場合
	else {
		for ($i = 1; $i <= $paged; $i++) {
			if ($i == $pages) {
				// 現在のページ
				echo '<li class="active">' . ($i) . '</li>';
			} else {
				// その他のページ
				echo '<li><a href="' . get_pagenum_link($i) . '">' . ($i) . '</a></li>';
			}
		}
	} // ここまで / 記事数が最大数未満の場合

	// 「前へ（古い記事へ）」リンクの設定
	if ($paged >= $range && $is_last == false && $post_next <= $paged && $range != $paged) {
		if ($range == 2 && $pages != ($paged - 2)) {
			echo '<li class="san_maru">…</li></li><li><a href="' . get_pagenum_link($paged) . '">' . $paged . '</a></li>';
		} else if ($range != 2) {
			echo '<li class="san_maru">…</li><li><a href="' . get_pagenum_link($paged) . '">' . $paged . '</a></li>';
		}
	}

	if ($pages != $paged) {
		echo '<li class="next_post_link"><a href="' . get_pagenum_link($pages + 1) . '" rel="prev">';
		echo '<span>NEXT</span>' . $link_mark . '</a></li>';
	}
	echo ('</ul>');
}