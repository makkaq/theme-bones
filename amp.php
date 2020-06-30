<?php

/* The admin bar has JavaScript dependencies, so turn it off.
 * FIXME - is a noscript version avaiable?
 * FIXME - should we remove the option to show/not show it in the admin screens?
 */
show_admin_bar( false );

/* Turn off scripts
 */
add_action( 'wp_enqueue_scripts', function () {
		if ( ! is_admin() ) {
			/* Remove jQuery
             * Obviously this disables anything that depends on jQuery
			 */
			wp_deregister_script('jquery');
			wp_deregister_script('jquery-migrate');

			/* Remove wp-embed.js from the footer
			 * This disables the ability to embed WordPress posts into posts.
			 */
			wp_deregister_script( 'wp-embed' );

			/* Remove window._wpemojiSettings variable */
			remove_filter( 'wp_head', 'print_emoji_detection_script', 7 );

			/* FIXME These are added by Bones in library/bones.php and can be removed when
			 * the effect of doing so is better understood. */
			wp_deregister_script( 'bones-modernizr' );
			wp_deregister_script( 'bones-js' );
		}
	}
, 11);
