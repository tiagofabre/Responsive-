<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main div element.
 *
 * @package Odin
 * @since 2.2.0
 */
?>

		</div><!-- .row -->
	</div><!-- #wrapper -->

	<footer id="footer" role="contentinfo">


		<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>

			<div class="footer-widgets clear">

				<div class="widget-area col-md-4">

					<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>

						<?php dynamic_sidebar( 'footer-1' ); ?>

					<?php endif; ?>

				</div><!-- .widget-area -->

				<div class="widget-area clearfix col-md-4">

					<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>

						<?php dynamic_sidebar( 'footer-2' ); ?>

					<?php endif; ?>

				</div><!-- .widget-area -->

				<div class="widget-area clearfix col-md-4">

					<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>

						<?php dynamic_sidebar( 'footer-3' ); ?>

					<?php endif; ?>

				</div><!-- .widget-area -->

			</div><!-- .footer-widgets -->

		<?php endif; ?>

		
		<div class="container">
			<p><?php echo sprintf( __( 'Powered by <a href="%s" rel="nofollow" target="_blank">MonsterDev Brasil</a> and <a href="%s" rel="nofollow" target="_blank">WordPress</a>.', 'odin' ), 'http://www.monsterdev.com.br/', 'http://wordpress.org/' ); ?></p>
		</div><!-- .container -->
	</footer><!-- #footer -->

	<?php wp_footer(); ?>
</body>
</html>
