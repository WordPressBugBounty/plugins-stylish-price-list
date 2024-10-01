<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="spl-header-wrapper">
	<div class="spl-header-logo">
		<p></p>
		<div class="spl-container-header">
		<a href="https://stylishpricelist.com/" class="spl-header">
			<img src="<?php echo SPL_URL . '/assets/images/Stylish-Price-List-Logo-418x134.png'; ?>" class="img-responsive1" alt="Image" style="max-height: 40px;">
		</a>
		<?php
		$opt = get_option( 'spllk_opt' );
		if ( empty( $opt ) ) {
			?>
			<span class="spl_plug_ver">Demo</span>
			<?php
		}
		if ( ! empty( $opt ) ) {
			?>
			<span class="spl_plug_ver">Premium</span>
		<?php } ?>
		</div>
	</div>
	<a class="spl-back-to-dashboard-btn" href="<?php echo admin_url(); ?>">
		<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none" style="vertical-align: sub;">
			<path d="M5.14583 3.1665L2.375 5.5415L5.14583 8.31234" stroke="white" stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M2.375 5.5415H11.4768C14.2013 5.5415 16.515 7.76609 16.621 10.4894C16.7335 13.3671 14.3557 15.8332 11.4768 15.8332H4.74921" stroke="white" stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>
		WP Dashboard
	</a>
</div>
<style type="text/css">
	.spl_plug_ver{
		position: relative;
		top: -6px;
		font-weight: 700;
		font-size: 16px;
		color: #5bb3a7;
		text-transform: uppercase;
	}
	.spl-header{
		display: inline-block;
	}
	.spl-header.logo{
		position: relative;
		top: -20px;
	}
	img.img-responsive1 {
		max-width: 80%;
		height: auto;
	}
	.inner-footer-logo-section h4 {
		float: left;
		margin-right: 16px;
	}
	.inner-footer-logo-section {
		float: right;
	}
	.inner-footer-logo-section {
		margin-top: 26px;
	}
	.inner-footer-logo-section img {
		-webkit-filter: grayscale(100%);
		filter: grayscale(100%);
	}
	.inner-footer-logo-section img {
		width: 47%;
	}
	.inner-footer-logo-section {
		width: 200px;
	}
</style>
