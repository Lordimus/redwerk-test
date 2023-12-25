<?php
get_header();
?>
    <!--ARCHIVE RW OLX-->
    <section class="archive-rw-olx">
        <div class="archive-rw-olx__container">

            <div class="archive-rw-olx__title">
                <h1><?php esc_html_e( 'RW Olx posts', 'twentytwentyone' ); ?></h1>
            </div>

			<?php if ( have_posts() ) : ?>
                <div class="archive-rw-olx__posts">
					<?php while ( have_posts() ) : the_post();
						$postID = get_the_ID();
						get_template_part( '/template-parts/rw-olx-post', null, [ 'post_id' => $postID ] );
					endwhile; ?>
                </div>
			<?php else : ?>
                <p><?php esc_html_e( 'No posts.', 'twentytwentyone' ); ?></p>
			<?php endif; ?>
        </div>
    </section>
    <!--ARCHIVE RW OLX end-->
<?php
get_footer();