<?php
/*
 * Send email to admin when new post is published
 */
function twentytwentyone_child_send_email_to_admin( $new_status, $old_status, $post ) {
	if ( 'rw_olx' === $post->post_type && 'publish' === $new_status && 'publish' !== $old_status ) {
		$to      = get_option( 'admin_email' );
		$author  = get_the_author_meta( 'display_name', $post->post_author );
		$subject = 'New post published';
		$message = 'New post published - Title: ' . $post->post_title . ', Author: ' . $author . ', Link: ' . get_permalink( $post->ID );
		wp_mail( $to, $subject, $message );
	}
}

add_action( 'transition_post_status', 'twentytwentyone_child_send_email_to_admin', 10, 3 );

/*
 * Send email to the editor after 20 minutes when new post is published
 */
function twentytwentyone_child_send_email_to_editor( $new_status, $old_status, $post ) {
	if ( 'rw_olx' === $post->post_type && 'publish' === $new_status && 'publish' !== $old_status ) {
		$to      = get_the_author_meta( 'user_email', $post->post_author );
		$author  = get_the_author_meta( 'display_name', $post->post_author );
		$subject = 'New post published';
		$message = 'New post published - Title: ' . $post->post_title . ', Author: ' . $author . ', Link: ' . get_permalink( $post->ID );
		wp_schedule_single_event( time() + 20 * MINUTE_IN_SECONDS, 'twentytwentyone_child_send_email_to_editor_cron', [
			$to,
			$subject,
			$message
		] );
	}
}

add_action( 'transition_post_status', 'twentytwentyone_child_send_email_to_editor', 10, 3 );

function twentytwentyone_child_send_email_to_editor_cron_update( $to, $subject, $message ) {
	wp_mail( $to, $subject, $message );
}

add_action( 'twentytwentyone_child_send_email_to_editor_cron', 'twentytwentyone_child_send_email_to_editor_cron_update', 10, 3 );