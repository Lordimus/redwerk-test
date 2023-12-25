<?php
/*
 * Create RW olx image field
 */
function twentytwentyone_child_rw_olx_meta_image() {
	add_meta_box(
		'rw-olx-meta-box',
		__( 'Custom image', 'twentytwentyone' ),
		'output_rw_olx_meta_image',
		array( 'rw_olx' ),
		'normal',
		'high'
	);
}

add_action( 'add_meta_boxes', 'twentytwentyone_child_rw_olx_meta_image' );

function output_rw_olx_meta_image() {
	$rw_olx_meta_image = get_post_meta( get_the_ID(), 'rw_olx_meta_image', true );
	?>
    <div class="rw-olx-meta-image">
		<?php wp_nonce_field( basename( __FILE__ ), 'rw_olx_meta_image_nonce' ); ?>
        <input type="hidden" name="rw_olx_meta_image" id="rw_olx_meta_image" value="<?php echo $rw_olx_meta_image; ?>">
		<?php
		if ( ! empty( $rw_olx_meta_image ) ) {
			$image_url = wp_get_attachment_image_src( $rw_olx_meta_image, 'thumbnail' );
			if ( ! empty( $image_url ) ) {
				$image_url = $image_url[0];
			}
			?>
            <div class="rw-olx-meta-image-content">
                <img src="<?php echo esc_url( $image_url ); ?>"/>
                <br/>
                <button class="button button-primary rw-olx-meta-image-remove">Remove image</button>
            </div>
            <br/>
            <button class="button rw-olx-meta-image-add"><?php echo __( 'Change image', 'twentytwentyone' ); ?></button>
			<?php
		} else {
			?>
            <br/>
            <button class="button rw-olx-meta-image-add"><?php echo __( 'Add image', 'twentytwentyone' ); ?></button>
			<?php
		}
		?>
    </div>
	<?php
}

function save_rw_olx_meta_image( $post_id ) {
	if ( ! isset( $_POST["rw_olx_meta_image_nonce"] )
	     || ! wp_verify_nonce( $_POST["rw_olx_meta_image_nonce"], basename( __FILE__ ) ) ) {
		return $post_id;
	}

	if ( ! current_user_can( "edit_post", $post_id ) ) {
		return $post_id;
	}

	if ( defined( "DOING_AUTOSAVE" ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	$meta_image = '';
	if ( isset( $_POST['rw_olx_meta_image'] ) ) {
		$meta_image = $_POST['rw_olx_meta_image'];
	}
	update_post_meta( $post_id, 'rw_olx_meta_image', $meta_image );
}

add_action( 'save_post', 'save_rw_olx_meta_image' );