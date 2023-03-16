<?php
    // 問い合わせで、ニュースとブログを取る。
    global $post;
    $news = get_posts_from_categories('News',4);
    $blogs = get_posts_from_categories( 'Blog', 2 );

?>
<div class="archive_area common_width">
    <div class="archive_news_area">
        <div class="archive_news_title archive_title">
            <img src="<?php echo get_template_directory_uri() ?>/images/common/NEWS.png" alt="NEWS" class="news_title_img">
            <div class="btn_row_text">ニュース</div>
        </div>
        <div class="archive_news_content_area">
	        <?php foreach ($news as $new) {
	            $post = $new;
		        setup_postdata( $post );?>
                <div class="archive_news_content">
                    <div class="archive_news_post_title archive_post_title">
                        <a href="<?php the_permalink()?>">
					        <?php the_title();?>
                        </a>
                    </div>
                    <div class="archive_news_date archive_date">
				        <?php the_date();?>
                    </div>
                </div>
		        <?php wp_reset_postdata();
	        }?>
        </div>
        <div class="archive_news_btn_area archive_btn_area">
            <a href="/news/" class="archive_news_btn archive_btn font_hiragino">
                <img src="<?php echo get_template_directory_uri() ?>/images/common/link-mark.svg" alt="link-mark" class="archive_btn_mark" />
                <div class="btn_row_text">MORE</div>
            </a>
        </div>
    </div>
    <div class="archive_blog_area">
        <div class="archive_blog_title archive_title">
            <img src="<?php echo get_template_directory_uri() ?>/images/common/BLOG.png" alt="BLOG" class="blog_title_img">
            <div class="btn_row_text">ブログ</div>
        </div>
        <div class="archive_blog_content_area">
	        <?php foreach ($blogs as $blog) {
		        $post = $blog;
		        setup_postdata( $post );?>
                <div class="archive_blog_content">
                    <div class="archive_blog_img">
                        <a href="<?php the_permalink()?>">
                            <img src="<?php
                                    echo catch_that_image();
                                ?>" alt="<?php the_title();?>" class="archive_blog_img">
                        </a>
                    </div>
                    <div class="archive_blog_main">
                        <div class="archive_blog_title_area">
                            <div class="archive_blog_post_title archive_post_title">
                                <a href="<?php the_permalink()?>">
							        <?php the_title(); ?>
                                </a>
                            </div>
                            <div class="archive_blog_date archive_date">
						        <?php the_date(); ?>
                            </div>
                        </div>
                        <div class="archive_blog_content_text">
                            <a href="<?php the_permalink()?>">
                                <?php custom_string_from_the_excerpt();?>
                            </a>
                        </div>
                    </div>
                </div>
		        <?php wp_reset_postdata();
		                wp_reset_query();
	        }?>
        </div>
        <div class="archive_blog_btn_area archive_btn_area">
            <a href="/blog/" class="archive_news_btn archive_btn font_hiragino">
                <img src="<?php echo get_template_directory_uri() ?>/images/common/link-mark.svg" alt="link-mark" class="archive_btn_mark" />
                <div class="btn_row_text">MORE</div>
            </a>
        </div>
    </div>
</div>
