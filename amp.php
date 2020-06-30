<?php

/* Useful reference https://gist.github.com/ivo-ivanov/7ff88a3fd91cb3b31e1b366358a6c002 */

/**
 * FIXME - do we need to force HTTPS
 */

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

			/* Remove emoji styles */
			remove_action( 'wp_print_styles', 'print_emoji_styles' );

			/* Remove wp-embed.js from the footer
			 * This disables the ability to embed WordPress posts into posts.
			 */
			wp_deregister_script( 'wp-embed' );

			/* Remove window._wpemojiSettings variable */
			remove_filter( 'wp_head', 'print_emoji_detection_script', 7 );

			/* Remove Guttenberg blocks CSS
			 * FIXME - this only works on the front end. We should either disable
			 * the Guttenberg editor completely, or slurp the CSS inline.
			 *
			 * See https://smartwp.com/remove-gutenberg-css/ for more.
			 */
			wp_dequeue_style( 'wp-block-library' );
		    wp_dequeue_style( 'wp-block-library-theme' );


			/* FIXME Everything below is added by Bones in library/bones.php and
			 * can be removed when the effect of doing so is better understood. */
			wp_deregister_script( 'bones-modernizr' );
			wp_deregister_script( 'bones-js' );

			/* FIXME styles need to be in the head */
			wp_dequeue_style( 'bones-stylesheet' );
    		wp_deregister_style( 'bones-stylesheet' );
			wp_dequeue_style( 'bones-ie-only' );
			wp_deregister_style( 'bones-ie-only' );

			/* FIXME if we need this, we just need to add https:// instead of // */
			wp_dequeue_style( 'googleFonts' );
			wp_deregister_style( 'googleFonts' );
		}
	}
, 1000); // Priority for Bones styles and scripts is set at 999, so, escalation...
