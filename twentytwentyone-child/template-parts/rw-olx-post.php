<?php
$postID    = $args['post_id'] ?? get_the_ID();
$image     = get_post_meta( $postID, 'rw_olx_meta_image', true );
$image_url = wp_get_attachment_image_src( $image, 'rw-olx-post' );
if ( ! empty( $image_url ) ) {
	$image_url = $image_url[0];
}

$types = get_the_terms( $postID, 'rw_olx_type' );
?>
<div class="archive-rw-olx__post">
    <div class="archive-rw-olx__post-image">
		<?php if ( ! empty( $image_url ) ): ?>
            <a href="<?php echo get_permalink(); ?>" class="archive-rw-olx__post-link">
                <img src="<?php echo esc_url( $image_url ); ?>"
                     alt="<?php echo get_the_title(); ?>"/>
            </a>
		<?php endif; ?>
    </div>
    <div class="archive-rw-olx__post-content">
        <a href="<?php echo get_permalink(); ?>" class="archive-rw-olx__post-link">
            <h3 class="archive-rw-olx__post-title"><?php echo get_the_title(); ?></h3>
        </a>

		<?php if ( ! empty( $types ) ) : ?>
            <div class="archive-rw-olx__post-types">
				<?php foreach ( $types as $type ) :
					$type_link = get_term_link( $type->term_id );
					?>
                    <a href="<?php echo $type_link; ?>"
                       class="archive-rw-olx__post-type"><?php echo $type->name; ?></a>
				<?php endforeach; ?>
            </div>
		<?php endif; ?>
    </div>
</div>