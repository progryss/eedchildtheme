<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>

		</div><!-- .col-full -->
	</div><!-- #content -->
  
	<?php do_action( 'storefront_before_footer' ); ?>
  <?php if ( is_active_sidebar( 'upper-footer' ) ) : ?>
<div class="upper-footer-main full-width">
      <div class="col-full">
          <div class="upper-footer-widgets">
              <?php dynamic_sidebar( 'upper-footer' ); ?>
          </div>
      </div>
</div>
</div>
<?php endif; ?><!-- #page -->

<div class="col-full-footer plr-0">
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-widgets custom-footer-widgets col-full">
				<div class="footer-widgets-row">
					<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
						<div class="col footer-col-<?php echo $i; ?>">
							<?php if ( is_active_sidebar( 'footer-' . $i ) ) : ?>
								<?php dynamic_sidebar( 'footer-' . $i ); ?>
							<?php endif; ?>
						</div>
					<?php endfor; ?>
				</div>
						<div class="footer-copyright">
				<div>&copy; <?php echo date('Y'); ?> Essential Branding  All Rights Reserved.</div>
				<ul>
				<li><a href="#">Privacy Policy</a></li>
				<li><a href="#">Terms of Service</a></li>
				<li><a href="#">Cookies Settings</a></li>
				</ul>

			</div>

			</div>

			<?php
			/**
			 * Functions hooked in to storefront_footer action
			 *
			 * @hooked storefront_footer_widgets - 10
			 * @hooked storefront_credit         - 20
			 */
			do_action( 'storefront_footer' );
			?>


		</div><!-- .col-full -->
	</footer><!-- #colophon -->

	<?php do_action( 'storefront_after_footer' ); ?>
<?php wp_footer(); ?>

<script>
// Start JS For Header
document.addEventListener('DOMContentLoaded', function () {
  const body = document.body;
  let overlay = document.querySelector('.mobile-menu-overlay');
  if (!overlay) {
    overlay = document.createElement('div');
    overlay.className = 'mobile-menu-overlay';
    body.appendChild(overlay);
  }

  const menuToggle = document.querySelector('.menu-toggle');
  const handheldNav = document.querySelector('.handheld-navigation');
  const mainNav = document.querySelector('.main-navigation');

  let isActive = false;

  if (menuToggle) {
    menuToggle.addEventListener('click', function () {
      body.classList.toggle('menu-open');

      if (!isActive) {
        handheldNav?.classList.add('active');
        mainNav?.classList.add('toggled');
        setTimeout(() => {
          mainNav?.classList.add('toggled-delay');
        }, 800);

        isActive = true;
      } else {
        handheldNav?.classList.remove('active');
        mainNav?.classList.remove('toggled', 'toggled-delay');

        setTimeout(() => {
          handheldNav?.classList.remove('active');
          isActive = false;
        }, 300);
      }
    });
  }

  overlay.addEventListener('click', function () {
    body.classList.remove('menu-open');
    handheldNav?.classList.remove('active');
    mainNav?.classList.remove('toggled', 'toggled-delay');
    isActive = false;
  });
});

// End JS For Header
document.addEventListener('DOMContentLoaded', function () {
    const header = document.querySelector('.site-header');

    function toggleStickyClass() {
        if (window.scrollY > 0) {
            header.classList.add('custom-sticky');
        } else {
            header.classList.remove('custom-sticky');
        }
    }

    window.addEventListener('scroll', toggleStickyClass);
});
</script>

</body>
</html>

