<?php
// Setup data
// Link_markの画像を取る
$src_link_mark = get_template_directory_uri() . '/images/common/link-mark.svg';
$link_mark = '<span class="link_mark"><img src="' . $src_link_mark . '" alt="Link Mark"></span>';
$link_mark_opposite = '<span class="link_mark_opposite"><img src="' . $src_link_mark . '" alt="Link Mark"></span>';
?>
<ul class="pagination">
    <?php
    $is_last = false;
    $pagination = 5;    // 1ページに表示するページ送りの最大数

    $cat = get_the_category();
    $cat = $cat[0];
    $catname = get_cat_name($cat->term_id);     // カテゴリー名を取得
    $catid = get_cat_ID($catname);              // カテゴリーIDを取得

    $post_id = get_the_ID();    // 現在の投稿IDを取得
    $post_id_array = array();   // 取得したくない投稿情報ID（複数指定する場合は,で区切る）

    // 投稿記事のカテゴリ内で新着から何番目かを確認
    $args = array('posts_per_page' => -1, 'category' => $catid, 'exclude' => $post_id_array);
    $posts = get_posts($args);
    $posts_ids = array();

    foreach ($posts as $post) {
        $posts_ids[] += $post->ID;
    }

    $post_current = array_search($post_id, $posts_ids);     // 現在の記事番号（順番）を取得
    $post_last = count($posts_ids);                         // 同じカテゴリー内の記事数
    $post_last_group = $post_last - $pagination;            // 最後尾のページ送りグループ
    $post_last_switch = $post_last - ($pagination - 1);     // 最後の5つに切り替えるする記事番号

    // 最大値が1〜4まで前後のリンク数が異なる
    switch ($pagination) {
        case 1:
            $post_prev = $post_current;
            $post_next = $post_current + 1;
            break;

        case 2:
            $post_prev = $post_current;
            $post_next = $post_current + 2;
            break;

        case 3:
            $post_prev = $post_current - 1;
            $post_next = $post_current + 2;
            break;

        case 4:
            $post_prev = $post_current - 1;
            $post_next = $post_current + 3;
            break;

        default:
            $post_prev = $post_current - 2;
            $post_next = $post_current + 3;
            break;
    }

    wp_reset_postdata();

    // 「次へ（新しい記事へ）」リンクの設定
    if ($post_last >= $pagination && $post_current > ($pagination - 2)) {
        if ($pagination != $post_last) {
            next_post_link('<li class="prev_post_link">%link</li>', $link_mark_opposite . '<span>PREV</span>', true);
            echo '<li><a href="' . get_permalink($posts_ids[0]) . '">1</li><li class="san_maru_pre">…</li>';
        }
    }

    // 記事数が最大数以上ある場合
    // 例）最大数が5個で、記事が5個以上ある場合
    if ($post_last >= $pagination) {
        if ($post_current < ($pagination - 1)) {
            $is_first = true;

            for ($i = 0; $i < $pagination; $i++) {
                if ($i == $post_current) {
                    // 現在のページ
                    echo '<li class="active"><a href="#">' . ($i + 1) . '</a></li>';
                } else {
                    // その他のページ
                    echo '<li><a href="' . get_permalink($posts_ids[$i]) . '">' . ($i + 1) . '</a></li>';
                }
            }
        } else if ($post_current >= $post_last_switch) {
            $is_last = true;

            for ($i = $post_last_group; $i < $post_last; $i++) {
                if ($i == $post_current) {
                    // 現在のページ
                    echo '<li class="active"><a href="#">' . ($i + 1) . '</a></li>';
                } else {
                    // その他のページ
                    echo '<li><a href="' . get_permalink($posts_ids[$i]) . '">' . ($i + 1) . '</a></li>';
                }
            }
        } else {
            for ($i = $post_prev; $i < $post_next; $i++) {
                if ($i == $post_current) {
                    // 現在のページ
                    echo '<li class="active"><a href="#">' . ($i + 1) . '</a></li>';
                } else {
                    // その他のページ
                    echo '<li><a href="' . get_permalink($posts_ids[$i]) . '">' . ($i + 1) . '</a></li>';
                }
            }
        }
    } // ここまで / 記事数が最大数以上ある場合

    // 記事数が最大数未満の場合
    else {
        for ($i = 0; $i < $post_last; $i++) {
            if ($i == $post_current) {
                // 現在のページ
                echo '<li class="active"><a href="#">' . ($i + 1) . '</a></li>';
            } else {
                // その他のページ
                echo '<li><a href="' . get_permalink($posts_ids[$i]) . '">' . ($i + 1) . '</a></li>';
            }
        }
    } // ここまで / 記事数が最大数未満の場合

    // 「前へ（古い記事へ）」リンクの設定
    if ($post_last >= $pagination && $is_last == false && $post_next <= $post_last && $pagination != $post_last) {
        if ($pagination == 2 && $post_current != ($post_last - 2)) {
            echo '<li class="san_maru">…</li></li><li><a href="' . get_permalink(end($posts_ids)) . '">' . $post_last . '</li>';
            previous_post_link('<li class="next_post_link">%link</li>', '<span>NEXT</span>' . $link_mark, true);
        } else if ($pagination != 2) {
            echo '<li class="san_maru">…</li><li><a href="' . get_permalink(end($posts_ids)) . '">' . $post_last . '</li>';
            previous_post_link('<li class="next_post_link">%link</li>', '<span>NEXT</span>' . $link_mark, true);
        }
    }
    ?>
</ul>