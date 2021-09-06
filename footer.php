<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Gilape
 */

/**
 * Hook - gilape_footer
 * @hooked gilape_footer - 10
 */
do_action( 'gilape_footer' );
?>
<div id="scroll_to_top" class="scroll-to-top"><i class="fa fa-angle-up"></i></div>
<?php wp_footer(); ?>

</body>
</html>
