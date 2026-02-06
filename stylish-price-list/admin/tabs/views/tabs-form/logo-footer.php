<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
	<div class="df-spl-row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 footer-demo-section">
			<?php
			$opt = get_option( 'spllk_opt' );
			if ( empty( $opt ) || ( isset( $opt['license'] ) && $opt['license'] !== 'valid' ) ) {
				echo '<p class="free_version">You are using the <span class="highlighted">free (demo)</span> version of the plugin. Click <span class="highlighted"><a href="https://stylishpricelist.com?utm_source=inside-plugin&utm_medium=buy-premium-cta-banner">here</a></span> to buy the pro version.</p>';
			}
			?>
		</div>
	</div>
					<div class="price_wrapper ">
						<div class="modal df-spl-modal fade" id="sell1" data-target="with_tab">
						<div class="modal-dialog">
							<div class="scc-modal">
								<div class="modal-header orange df-spl-p-0">
									<div class="df-spl-row">
										<div class="spl-content unique-spl-content">
											<div class="spl-container-style"></div>
											<div class="spl-container-position">
												<div class="spl-icon-text">
												  <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#5bb3a7"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 224c0 17.7 14.3 32 32 32s32-14.3 32-32c0-53 43-96 96-96H320v32c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l64-64c12.5-12.5 12.5-32.8 0-45.3l-64-64c-9.2-9.2-22.9-11.9-34.9-6.9S320 19.1 320 32V64H160C71.6 64 0 135.6 0 224zm512 64c0-17.7-14.3-32-32-32s-32 14.3-32 32c0 53-43 96-96 96H192V352c0-12.9-7.8-24.6-19.8-29.6s-25.7-2.2-34.9 6.9l-64 64c-12.5 12.5-12.5 32.8 0 45.3l64 64c9.2 9.2 22.9 11.9 34.9 6.9s19.8-16.6 19.8-29.6V448H352c88.4 0 160-71.6 160-160z"/></svg>
												</div>
												<h1>You are switching to <span>Style 1</span></h1>
											</div>
											<button type="button" class="spl-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										</div>
										<div class="df-spl-show-style-mockups">
											<img src="<?php echo SPL_URL . '/assets/images/Style1.png'; ?>" alt="some image" />
											<div class="spl-container-buttom">
												<div class="spl-button-container">
												<button class="spl-button" data-btnType='keep-current'>Switch & Keep My Font Setting</button>
												<button class="spl-button-bacground" data-btnType='use-demo'>Switch & Use Demo Fonts</button>
												<button class="spl-button-sub cancel-btn">Cancel</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal df-spl-modal fade" id="sell2" data-target="without_tab">
						<div class="modal-dialog">
							<div class="scc-modal">
								<div class="modal-header orange df-spl-p-0">
									<div class="df-spl-row">
									<div class="spl-content unique-spl-content">
											<div class="spl-container-style"></div>
											<div class="spl-container-position">
												<div class="spl-icon-text">
												  <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#5bb3a7"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 224c0 17.7 14.3 32 32 32s32-14.3 32-32c0-53 43-96 96-96H320v32c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l64-64c12.5-12.5 12.5-32.8 0-45.3l-64-64c-9.2-9.2-22.9-11.9-34.9-6.9S320 19.1 320 32V64H160C71.6 64 0 135.6 0 224zm512 64c0-17.7-14.3-32-32-32s-32 14.3-32 32c0 53-43 96-96 96H192V352c0-12.9-7.8-24.6-19.8-29.6s-25.7-2.2-34.9 6.9l-64 64c-12.5 12.5-12.5 32.8 0 45.3l64 64c9.2 9.2 22.9 11.9 34.9 6.9s19.8-16.6 19.8-29.6V448H352c88.4 0 160-71.6 160-160z"/></svg>
												</div>
												<h1>You are switching to <span>Style 2</span></h1>
											</div>
											<button type="button" class="spl-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										</div>
										<div class="df-spl-show-style-mockups">
											<img src="<?php echo SPL_URL . '/assets/images/Style2.png'; ?>" alt="some image" />
											<div class="spl-container-buttom">
												<div class="spl-button-container">
												<button class="spl-button" data-btnType='keep-current'>Switch & Keep My Font Setting</button>
												<button class="spl-button-bacground" data-btnType='use-demo'>Switch & Use Demo Fonts</button>
												<button class="spl-button-sub cancel-btn">Cancel</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal df-spl-modal fade" id="sell3" data-target="style_3">
						<div class="modal-dialog">
							<div class="scc-modal">
								<div class="modal-header orange df-spl-p-0">
									<div class="df-spl-row">
									<div class="spl-content unique-spl-content">
											<div class="spl-container-style"></div>
											<div class="spl-container-position">
												<div class="spl-icon-text">
												  <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#5bb3a7"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 224c0 17.7 14.3 32 32 32s32-14.3 32-32c0-53 43-96 96-96H320v32c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l64-64c12.5-12.5 12.5-32.8 0-45.3l-64-64c-9.2-9.2-22.9-11.9-34.9-6.9S320 19.1 320 32V64H160C71.6 64 0 135.6 0 224zm512 64c0-17.7-14.3-32-32-32s-32 14.3-32 32c0 53-43 96-96 96H192V352c0-12.9-7.8-24.6-19.8-29.6s-25.7-2.2-34.9 6.9l-64 64c-12.5 12.5-12.5 32.8 0 45.3l64 64c9.2 9.2 22.9 11.9 34.9 6.9s19.8-16.6 19.8-29.6V448H352c88.4 0 160-71.6 160-160z"/></svg>
												</div>
												<h1>You are switching to <span>Style 3</span></h1>
											</div>
											<button type="button" class="spl-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										</div>
										<div class="df-spl-show-style-mockups">
											<img src="<?php echo SPL_URL . '/assets/images/Style3.png'; ?>" alt="some image" />
											<div class="spl-container-buttom">
												<div class="spl-button-container">
												<button class="spl-button" data-btnType='keep-current'>Switch & Keep My Font Setting</button>
												<button class="spl-button-bacground" data-btnType='use-demo'>Switch & Use Demo Fonts</button>
												<button class="spl-button-sub cancel-btn">Cancel</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						</div>
						<div class="modal df-spl-modal fade" id="sell4" data-target="style_4">
						<div class="modal-dialog">
							<div class="scc-modal">
								<div class="modal-header orange df-spl-p-0">
									<div class="df-spl-row">
									<div class="spl-content unique-spl-content">
											<div class="spl-container-style"></div>
											<div class="spl-container-position">
												<div class="spl-icon-text">
												  <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#5bb3a7"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 224c0 17.7 14.3 32 32 32s32-14.3 32-32c0-53 43-96 96-96H320v32c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l64-64c12.5-12.5 12.5-32.8 0-45.3l-64-64c-9.2-9.2-22.9-11.9-34.9-6.9S320 19.1 320 32V64H160C71.6 64 0 135.6 0 224zm512 64c0-17.7-14.3-32-32-32s-32 14.3-32 32c0 53-43 96-96 96H192V352c0-12.9-7.8-24.6-19.8-29.6s-25.7-2.2-34.9 6.9l-64 64c-12.5 12.5-12.5 32.8 0 45.3l64 64c9.2 9.2 22.9 11.9 34.9 6.9s19.8-16.6 19.8-29.6V448H352c88.4 0 160-71.6 160-160z"/></svg>
												</div>
												<h1>You are switching to <span>Style 4</span></h1>
											</div>
											<button type="button" class="spl-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										</div>
										<div class="df-spl-show-style-mockups">
											<img src="<?php echo SPL_URL . '/assets/images/Style4.png'; ?>" alt="some image" />
											<div class="spl-container-buttom">
												<div class="spl-button-container">
												<button class="spl-button" data-btnType='keep-current'>Switch & Keep My Font Setting</button>
												<button class="spl-button-bacground" data-btnType='use-demo'>Switch & Use Demo Fonts</button>
												<button class="spl-button-sub cancel-btn">Cancel</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>		
						</div>
						<div class="modal df-spl-modal fade" id="sell5" data-target="style_5">
						<div class="modal-dialog">
							<div class="scc-modal">
								<div class="modal-header orange df-spl-p-0">
									<div class="df-spl-row">
									<div class="spl-content unique-spl-content">
											<div class="spl-container-style"></div>
											<div class="spl-container-position">
												<div class="spl-icon-text">
												  <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#5bb3a7"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 224c0 17.7 14.3 32 32 32s32-14.3 32-32c0-53 43-96 96-96H320v32c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l64-64c12.5-12.5 12.5-32.8 0-45.3l-64-64c-9.2-9.2-22.9-11.9-34.9-6.9S320 19.1 320 32V64H160C71.6 64 0 135.6 0 224zm512 64c0-17.7-14.3-32-32-32s-32 14.3-32 32c0 53-43 96-96 96H192V352c0-12.9-7.8-24.6-19.8-29.6s-25.7-2.2-34.9 6.9l-64 64c-12.5 12.5-12.5 32.8 0 45.3l64 64c9.2 9.2 22.9 11.9 34.9 6.9s19.8-16.6 19.8-29.6V448H352c88.4 0 160-71.6 160-160z"/></svg>
												</div>
												<h1>You are switching to <span>Style 5</span></h1>
											</div>
											<button type="button" class="spl-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										</div>
										<div class="df-spl-show-style-mockups">
											<img src="<?php echo SPL_URL . '/assets/images/Style5.png'; ?>" alt="some image" />
											<div class="spl-container-buttom">
												<div class="spl-button-container">
												<button class="spl-button" data-btnType='keep-current'>Switch & Keep My Font Setting</button>
												<button class="spl-button-bacground" data-btnType='use-demo'>Switch & Use Demo Fonts</button>
												<button class="spl-button-sub cancel-btn">Cancel</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>		
						</div>
						<div class="modal df-spl-modal fade" id="sell6" data-target="style_6">
						<div class="modal-dialog">
							<div class="scc-modal">
								<div class="modal-header orange df-spl-p-0">
									<div class="df-spl-row">
									<div class="spl-content unique-spl-content">
											<div class="spl-container-style"></div>
											<div class="spl-container-position">
												<div class="spl-icon-text">
												  <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#5bb3a7"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 224c0 17.7 14.3 32 32 32s32-14.3 32-32c0-53 43-96 96-96H320v32c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l64-64c12.5-12.5 12.5-32.8 0-45.3l-64-64c-9.2-9.2-22.9-11.9-34.9-6.9S320 19.1 320 32V64H160C71.6 64 0 135.6 0 224zm512 64c0-17.7-14.3-32-32-32s-32 14.3-32 32c0 53-43 96-96 96H192V352c0-12.9-7.8-24.6-19.8-29.6s-25.7-2.2-34.9 6.9l-64 64c-12.5 12.5-12.5 32.8 0 45.3l64 64c9.2 9.2 22.9 11.9 34.9 6.9s19.8-16.6 19.8-29.6V448H352c88.4 0 160-71.6 160-160z"/></svg>
												</div>
												<h1>You are switching to <span>Style 6</span></h1>
											</div>
											<button type="button" class="spl-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										</div>
										<div class="df-spl-show-style-mockups">
											<img src="<?php echo SPL_URL . '/assets/images/Style6.png'; ?>" alt="some image" />
											<div class="spl-container-buttom">
												<div class="spl-button-container">
												<button class="spl-button" data-btnType='keep-current'>Switch & Keep My Font Setting</button>
												<button class="spl-button-bacground" data-btnType='use-demo'>Switch & Use Demo Fonts</button>
												<button class="spl-button-sub cancel-btn">Cancel</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						</div>
						<div class="modal df-spl-modal fade" id="sell7" data-target="style_7">
						<div class="modal-dialog">
							<div class="scc-modal">
								<div class="modal-header orange df-spl-p-0">
									<div class="df-spl-row">
									<div class="spl-content unique-spl-content">
											<div class="spl-container-style"></div>
											<div class="spl-container-position">
												<div class="spl-icon-text">
												  <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#5bb3a7"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 224c0 17.7 14.3 32 32 32s32-14.3 32-32c0-53 43-96 96-96H320v32c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l64-64c12.5-12.5 12.5-32.8 0-45.3l-64-64c-9.2-9.2-22.9-11.9-34.9-6.9S320 19.1 320 32V64H160C71.6 64 0 135.6 0 224zm512 64c0-17.7-14.3-32-32-32s-32 14.3-32 32c0 53-43 96-96 96H192V352c0-12.9-7.8-24.6-19.8-29.6s-25.7-2.2-34.9 6.9l-64 64c-12.5 12.5-12.5 32.8 0 45.3l64 64c9.2 9.2 22.9 11.9 34.9 6.9s19.8-16.6 19.8-29.6V448H352c88.4 0 160-71.6 160-160z"/></svg>
												</div>
												<h1>You are switching to <span>Style 7</span></h1>
											</div>
											<button type="button" class="spl-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										</div>
										<div class="df-spl-show-style-mockups">
											<img src="<?php echo SPL_URL . '/assets/images/Style7.png'; ?>" alt="some image" />
											<div class="spl-container-buttom">
												<div class="spl-button-container">
												<button class="spl-button" data-btnType='keep-current'>Switch & Keep My Font Setting</button>
												<button class="spl-button-bacground" data-btnType='use-demo'>Switch & Use Demo Fonts</button>
												<button class="spl-button-sub cancel-btn">Cancel</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						</div>
						<div class="modal df-spl-modal fade" id="sell8" data-target="style_8">
						<div class="modal-dialog">
							<div class="scc-modal">
								<div class="modal-header orange df-spl-p-0">
									<div class="df-spl-row">
									<div class="spl-content unique-spl-content">
											<div class="spl-container-style"></div>
											<div class="spl-container-position">
												<div class="spl-icon-text">
												  <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#5bb3a7"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 224c0 17.7 14.3 32 32 32s32-14.3 32-32c0-53 43-96 96-96H320v32c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l64-64c12.5-12.5 12.5-32.8 0-45.3l-64-64c-9.2-9.2-22.9-11.9-34.9-6.9S320 19.1 320 32V64H160C71.6 64 0 135.6 0 224zm512 64c0-17.7-14.3-32-32-32s-32 14.3-32 32c0 53-43 96-96 96H192V352c0-12.9-7.8-24.6-19.8-29.6s-25.7-2.2-34.9 6.9l-64 64c-12.5 12.5-12.5 32.8 0 45.3l64 64c9.2 9.2 22.9 11.9 34.9 6.9s19.8-16.6 19.8-29.6V448H352c88.4 0 160-71.6 160-160z"/></svg>
												</div>
												<h1>You are switching to <span>Style 8</span></h1>
											</div>
											<button type="button" class="spl-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										</div>
										<div class="df-spl-show-style-mockups">
											<img src="<?php echo SPL_URL . '/assets/images/style8.png'; ?>" alt="some image" />
											<div class="spl-container-buttom">
												<div class="spl-button-container">
												<button class="spl-button" data-btnType='keep-current'>Switch & Keep My Font Setting</button>
												<button class="spl-button-bacground" data-btnType='use-demo'>Switch & Use Demo Fonts</button>
												<button class="spl-button-sub cancel-btn">Cancel</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						</div>
						<div class="modal df-spl-modal fade" id="sell10" data-target="style_10">
							<div class="modal-dialog">
								<div class="scc-modal">
									<div class="modal-header orange df-spl-p-0">
										<div class="df-spl-row">
										<div class="spl-content unique-spl-content">
												<div class="spl-container-style"></div>
												<div class="spl-container-position">
													<div class="spl-icon-text">
													<svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#5bb3a7"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 224c0 17.7 14.3 32 32 32s32-14.3 32-32c0-53 43-96 96-96H320v32c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l64-64c12.5-12.5 12.5-32.8 0-45.3l-64-64c-9.2-9.2-22.9-11.9-34.9-6.9S320 19.1 320 32V64H160C71.6 64 0 135.6 0 224zm512 64c0-17.7-14.3-32-32-32s-32 14.3-32 32c0 53-43 96-96 96H192V352c0-12.9-7.8-24.6-19.8-29.6s-25.7-2.2-34.9 6.9l-64 64c-12.5 12.5-12.5 32.8 0 45.3l64 64c9.2 9.2 22.9 11.9 34.9 6.9s19.8-16.6 19.8-29.6V448H352c88.4 0 160-71.6 160-160z"/></svg>
													</div>
													<h1>You are switching to <span>Style 10</span></h1>
												</div>
												<button type="button" class="spl-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											</div>
											<div class="df-spl-show-style-mockups">
												<img src="<?php echo SPL_URL . '/assets/images/Style10.png'; ?>" alt="some image" />
												<div class="spl-container-buttom">
													<div class="spl-button-container">
													<button class="spl-button" data-btnType='keep-current'>Switch & Keep My Font Setting</button>
													<button class="spl-button-bacground" data-btnType='use-demo'>Switch & Use Demo Fonts</button>
													<button class="spl-button-sub cancel-btn">Cancel</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal df-spl-modal fade" id="selt1" data-target="style_table_1">
							<div class="modal-dialog">
								<div class="scc-modal">
									<div class="modal-header orange df-spl-p-0">
										<div class="df-spl-row">
										<div class="spl-content unique-spl-content">
												<div class="spl-container-style"></div>
												<div class="spl-container-position">
													<div class="spl-icon-text">
													<svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#5bb3a7"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 224c0 17.7 14.3 32 32 32s32-14.3 32-32c0-53 43-96 96-96H320v32c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l64-64c12.5-12.5 12.5-32.8 0-45.3l-64-64c-9.2-9.2-22.9-11.9-34.9-6.9S320 19.1 320 32V64H160C71.6 64 0 135.6 0 224zm512 64c0-17.7-14.3-32-32-32s-32 14.3-32 32c0 53-43 96-96 96H192V352c0-12.9-7.8-24.6-19.8-29.6s-25.7-2.2-34.9 6.9l-64 64c-12.5 12.5-12.5 32.8 0 45.3l64 64c9.2 9.2 22.9 11.9 34.9 6.9s19.8-16.6 19.8-29.6V448H352c88.4 0 160-71.6 160-160z"/></svg>
													</div>
													<h1>You are switching to <span>Table Style 1</span></h1>
												</div>
												<button type="button" class="spl-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											</div>
											<div class="df-spl-show-style-mockups">
												<img src="<?php echo SPL_URL . '/assets/images/style-table-1.png'; ?>" alt="Style Table 1" />
												<div class="spl-container-buttom">
													<div class="spl-button-container">
													<button class="spl-button" data-btnType='keep-current'>Switch & Keep My Font Setting</button>
													<button class="spl-button-bacground" data-btnType='use-demo'>Switch & Use Demo Fonts</button>
													<button class="spl-button-sub cancel-btn">Cancel</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal df-spl-modal fade" id="selt2" data-target="style_table_2">
							<div class="modal-dialog">
								<div class="scc-modal">
									<div class="modal-header orange df-spl-p-0">
										<div class="df-spl-row">
										<div class="spl-content unique-spl-content">
												<div class="spl-container-style"></div>
												<div class="spl-container-position">
													<div class="spl-icon-text">
													<svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#5bb3a7"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 224c0 17.7 14.3 32 32 32s32-14.3 32-32c0-53 43-96 96-96H320v32c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l64-64c12.5-12.5 12.5-32.8 0-45.3l-64-64c-9.2-9.2-22.9-11.9-34.9-6.9S320 19.1 320 32V64H160C71.6 64 0 135.6 0 224zm512 64c0-17.7-14.3-32-32-32s-32 14.3-32 32c0 53-43 96-96 96H192V352c0-12.9-7.8-24.6-19.8-29.6s-25.7-2.2-34.9 6.9l-64 64c-12.5 12.5-12.5 32.8 0 45.3l64 64c9.2 9.2 22.9 11.9 34.9 6.9s19.8-16.6 19.8-29.6V448H352c88.4 0 160-71.6 160-160z"/></svg>
													</div>
													<h1>You are switching to <span>Table Style 2</span></h1>
												</div>
												<button type="button" class="spl-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											</div>
											<div class="df-spl-show-style-mockups">
												<img src="<?php echo SPL_URL . '/assets/images/style-table-2.png'; ?>" alt="Style Table 2" />
												<div class="spl-container-buttom">
													<div class="spl-button-container">
													<button class="spl-button" data-btnType='keep-current'>Switch & Keep My Font Setting</button>
													<button class="spl-button-bacground" data-btnType='use-demo'>Switch & Use Demo Fonts</button>
													<button class="spl-button-sub cancel-btn">Cancel</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
								<!--- END MODAL POPUP ---->
								<!-- Start of settings preview modal -->
								<div class="modal df-spl-modal fade" id="settings-preview" style="overflow: initial;">
									<div class="modal-dialog">
										<div class="scc-modal-content">
											<div class="modal-header orange">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<div class="df-spl-row">
													
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- End of preview modal -->
								<!-- The Modal Videos Tutorials-->
								<div id="myModalVideos" class="modalvideos" style="display:none;">
									<div class="scc-modal-content-videos">
										<span class="closevideo">&times;</span>
										<p>
											<div style="padding-top:15px;text-align:center;font-size:40px;font-weight:bold;color:#5bb3a7!important;">Video Tutorial</div>
											<div style="padding-top:20px;text-align:center;font-size:20px;color:#484848;">How to use Stylish Price List</div>
										</p>
										<!--<br><hr><br>-->
										<p>
											<div class="spl_video_tutorial" style="text-align: center;">
												<iframe loading="lazy" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="100%" max-width="1120" height="630" type="text/html" src="https://www.youtube.com/embed/tq8SE1HC7g0?autoplay=0&fs=1&iv_load_policy=3&show@=0&rel=0&cc_load_policy=0&start=0&end=0&vq=hd1080&origin=https://youtubeembedcode.com"></iframe>
											</div>
										</p>
									</div>
								</div>
								<!-- End of Modal Video Tutorials -->
								<!-- The Modal Videos Tutorials-->
								<div id="dropdown_tips" class="dropdown_tips modal df-spl-modal fade" style="display:none;">
									<div class="scc-modal-content-videos">
										<span class="closevideo" data-dismiss="modal" aria-label="Close">&times;</span>
										<p>
											<div style="padding-top:15px;text-align:center;font-size:40px;font-weight:bold;color:#5bb3a7!important;">Pro Tip</div>
											<div style="padding-top:20px;text-align:center;font-size:20px;color:#484848;">Use a dropdown if you have many categories. You can find the settings on the "More Settings" menu</div>
										</p>
										<div style="margin-left: auto; margin-right: auto; width: max-content;">
											<img src="<?php echo SPL_URL . '/assets/images/tooltip-images/dropdown-categories.png'; ?>">		
										</div>
									</div>
								</div>
								<!-- End of Modal Video Tutorials -->
								<!-- The Modal for warning against not image file chosen for image -->
								<div id="not_an_image_warning" class="not_an_image_warning modal df-spl-modal fade" style="display:none;">
									<div class="scc-modal-content-videos">
										<span class="closevideo" data-dismiss="modal" aria-label="Close">&times;</span>
										<p>
											<div style="padding-top:15px;text-align:center;font-size:40px;font-weight:bold;color:#5bb3a7!important;">Not An Image</div>
											<div style="padding-top:20px;text-align:center;font-size:20px;color:#484848;">The file is not allowed. Please chose an image file.</div>
										</p>
									</div>
								</div>
								<!-- End of Modal Video Tutorials -->
								<!-- The Modal for warning against bad aspect ratio for image -->
								<div id="image_bad_aspect_ratio_warning" class="modal df-spl-modal fade" style="display:none;">
									<div class="scc-modal-content-videos">
										<span class="closevideo" data-dismiss="modal" aria-label="Close">&times;</span>
										<p>
											<div style="padding-top:15px;text-align:center;font-size:40px;font-weight:bold;color:#5bb3a7!important;">Bad aspect ratio</div>
											<div style="padding-top:20px;text-align:center;font-size:20px;color:#484848;">Please choose an image with an wider aspect ratio.</div>
										</p>
									</div>
								</div>
								<!-- End The Modal for warning against bad aspect ratio for image -->
								<!-- The Modal Contact Support-->
								<div id="myModalSupport" class="modalsupport">
									<div class="scc-modal-content-support">
										<span class="closesupport">&times;</span>
										<div style="padding-top:20px;text-align:center;font-size:40px;font-weight:bold;color:#5bb3a7!important;">Contact Support</div>
										<div style="padding-top:20px;text-align:center;font-size:20px;color:#484848;margin-bottom: 100px;">We're here to help!</div>
										<!--<br><hr><br>-->
										<p>
											<div style="text-align: center;">
												<div style="text-align: left;width:100%;max-width:700px;padding-bottom:20px;font-size:16px;">
													<div class="foot-url" style="font-size:24px;margin-top:20px">
														<span class="col-me"><a href="https://designful.freshdesk.com/en/support/solutions/folders/48000670844" target="_blank" style="text-decoration: none!important;">User Guides</a></span>
														<span> | </span>
														<span class="col-me" ><a style="text-decoration: none!important;" href="https://designful.freshdesk.com/en/support/solutions/folders/48000670795" target="_blank">FAQs</a></span>
														<span> | </span>
														<span><a href="https://stylishpricelist.com/support/" target="_blank" style="text-decoration: none!important;">Contact Support</a></span>
													</div>
												</div>
											</div>
											<div class="df-spl-row" style="margin-top:10px;">
			<!---<div class="col-sm-4 col-md-3">
			<a href="https://www.facebook.com/designful/" target="_blank" class="button button-primary video_tutorial_btn">FaceBook Message</a>
		</div>--->
		<div class="col-sm-4 col-md-3">
		</div><Br>
	</div>
</p>
</div>
</div>

<div class="spl-footer-container">
    <div class="spl-footer">
        <div class="spl-footer-left">
            <div class="spl-footer-logo">
                <a href="https://www.stylishpricelist.com" class="spl-footer-logo-link" target="_blank">
                    <img src="<?php echo esc_url(SPL_URL . 'assets/images/spl-logo.webp'); ?>" alt="Stylish Price List" title="Stylish Price List">
                </a>
            </div>
        </div>
        
        <div class="spl-footer-center">
            <div>
                <span class="spl-footer-links-title">Helpful Links</span>
            </div>
            <ul class="spl-footer-links">
                <li>
                    <a href="https://stylishpricelist.com/support/">
                        <i class="far fa-life-ring"></i>
                        <span>Submit A Ticket</span>
                    </a>
                </li>
				<li>
                    <a href="https://stylishpricelist.com/blog/">
					<i class="fas fa-newspaper"></i>
                        <span>Blog</span>
                    </a>
                </li>
                <li>
                    <a href="https://stylishpricelist.com/pricing-plans/">
                        <i class="fas fa-gem"></i>
                        <span>Pricing</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="spl-footer-right">
            <div class="spl-footer-right">
                <div class="spl-plugin-info">
                    <div class="spl-plugin-info-text">
                        <p class="spl-footer-links-title">Do you like this plugin? <span class="spl-emoji">😊</span> We have many more:</p>
                    </div>
                    <div class="spl-footer-plugin-logos-container">    
                        <a href="https://stylishcostcalculator.com" target="_blank" class="spl-footer-plugin-logos">
                            <img src="<?php echo esc_url(SPL_URL . 'assets/images/scc-logo.png'); ?>" alt="Stylish Cost Calculator" title="Stylish Cost Calculator">
                        </a>
                        <a href="https://seo-ai-audit-tool.designful.ca/" target="_blank" class="spl-footer-plugin-logos">
                            <img src="<?php echo esc_url(SPL_URL . 'assets/images/saat-logo.png'); ?>" alt="SEO AI Audit Tool" title="SEO AI Audit Tool">
                        </a>
                        <a href="https://wordpress.org/plugins/smart-table-builder/" target="_blank" class="spl-footer-plugin-logos">
                            <img src="<?php echo esc_url(SPL_URL . 'assets/images/stb-logo.png'); ?>" alt="Smart Table Builder" title="Smart Table Builder">
                        </a>
                        <a href="https://stylishpricelist.com/support/" target="_blank" class="spl-footer-plugin-logos">
                            <img src="<?php echo esc_url(SPL_URL . 'assets/images/spl-logo.webp'); ?>" alt="Stylish Price List" title="Stylish Price List">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End of Modal Video Tutorials -->
<style type="text/css">
	.foot-url span a {
		background: blue;
		padding: 3px 10px 3px 10px;
		color: white!important;
		font-color: white;
		border-radius: 10px;
		font-size: 15px;
	}
	.spl-header{
		display: inline-block;
	}
	.spl-header.logo{
		position: relative;
		top: -20px;
	}
	img.img-responsive1 {
		max-width: 100%;
		height: auto;
	}
	.foot-img-li .col-md-5 .spl-footer, .foot-img-li .col-md-5 ul.foot-li, .foot-img-li .col-md-5 ul.foot-li li {
		display: inline-block;
	}
	.foot-img-li .spl-footer {
		width: 100%;
	}
	.foot-img-li .spl-footer{
		width:100%;
	}
	.foot-img-li {
		margin-top: 30px;
	}
	ul.foot-li{
		width:100%;
		float:left;
	}
	ul.foot-li li a {
		list-style-type: none;
		text-decoration: none;
		padding: 6px;
		font-size: 12px;
		color: #5bb3a7;
	}
	ul.foot-li li{
		width:30%;
		float:left;
	}
	ul.foot-li li:after{
		content: "";
		width: 1px;
		height: 12px;
		background-color: #000;
		position: absolute;
		top: 16px;
	}
	ul.foot-li li:last-child:after{
		display:none;
	}
	.design, .design-2, .design-3{
		position:relative;
	}
	.foot-img-li .design:after, .design-2:after, .design-3:after {
		content: "";
		width: 2px;
		height: 65px;
		background-color: #9c9c9c;
		position: absolute;
		right: 3px;
		top: 0;
	}
	p.foot-social i.fa {
		width: 35px;
		font-size: 20px;
		color: #5bb3a7;
	}
	.foot-text-img p span img {
		width: 100%;
	}
	.foot-text-img p span {
		display: inline-block;
		width: 100%;
		float: left;
	}
	.foot-url {
		text-align: center;
	}
	.foot-url p.col-me {
		color: #5bb3a7;
	}
	.foot-url p {
		margin: 2px;
	}
	.foot-text-img a.plugin_text {
		font-size: 15px;
	}
	.foot-text-img p span img {
		width: 100px;
	}
	.price_wrapper {
		width: 100%;

	}
	.url-foot:after {
		content: "";
		width: 1px;
		height: 100px;
		background-color: #000;
		position: absolute;
		top: 0px;
	}
	.foot-text-img p {
		width: 100%;
		float: left;
		margin: 3px 0px;
		padding-left: 15px;
	}

	.unique-spl-content {
		background: #5bb3a7;
		border-radius: 5px;
	    display: flex;
		align-content: center;
		flex-wrap: wrap;
		align-items: center;
		display: flex;
        justify-content: space-between;
		margin-top: 40px;
		height: 83px;
    }

    .unique-spl-content h1 {
       font-size: 37px;
	   color: #fff;
    }

	.df-spl-show-style-mockups img {
		max-height: 620px;
	}

    @media (max-width: 768px) {
		.df-spl-show-style-mockups img {
			width: 100% !important;
			margin-top: 10px;
		}
		.unique-spl-content {
			width: 100%;
			height: 100px;
		}

		.unique-spl-content h1 {
			font-size: 25px;
		}

		.spl-container-buttom {
			width: 100%;
		}

		.spl-button-container {
			width: 100%;
	    }
    }

	@media (min-width: 769px) and (max-width: 1440px) {
		.df-spl-show-style-mockups img {
			width: 90% !important;
			margin-top: 10px;
		}

		.unique-spl-content {
			width: 90%;
		}

		.spl-container-buttom {
			width: 90%;
		}

		.spl-button-container {
			width: 80%;
	    }
	}

    @media (min-width: 1441px) {
		.df-spl-show-style-mockups img {
			width: 60% !important;
			margin-top: 10px;
		}
		 
        .unique-spl-content {
            width: 60%;
        }

		.spl-container-buttom {
			width: 60%;
		}

		.spl-button-container {
		    width:  65%;
	    }
    }

.modal-dialog .df-spl-row {
    justify-content: center;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.df-spl-show-style-mockups {
    margin: 0 auto;
    display: contents;
}

.spl-close {
	border: none;
    background: #ffffff8a;
    width: 30px;
    height: 30px;
    border-radius: 19px;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 37px;
    cursor: pointer;
    user-select: none;
	margin-right: 11px;
    margin-top: -32px;
}

.spl-close span {
    color: white;
    position: absolute;
	height:55px;
}
.modal-header {
    border: none !important;
}
.spl-container-buttom {
    height: 83px;
    background: white;
    display: flex;
    justify-content: flex-end;
    margin-top: 18px;
    border-radius: 5px; /* Añade un valor para el radio de borde */
}

.spl-button-container {
    display: flex;
    justify-content: space-between; /* Espacio entre elementos */
    align-items: center; /* Alineación vertical al centro */
    padding: 0 27px; /* Añade espaciado a los lados para separación */
}

.spl-button{
	width: 251px;
    height: 50px;
    border-radius: 8px;
    background: white;
    border: 1px solid #5bb3a7;
    font-size: 15px;
	font-weight: 500;
	user-select: none;
	cursor: pointer;
	color:#5bb3a7;
	margin-right: 10px;
}
.spl-button:hover{
	background: #5bb3a7;
	color:white
}
.spl-button-bacground{
	background: #5bb3a7;
	color:white;
	width: 251px;
    height: 50px;
    border-radius: 8px;
	border: 1px solid #5bb3a7;
    font-size: 15px;
	user-select: none;
	cursor: pointer;
	font-weight: 500;
	
}
.spl-button-bacground:hover{
	background:white;
	color:#5bb3a7;
	border: 1px solid #5bb3a7;
}
.spl-button-sub{
	background: white;
    border: none;
    width: 100px;
	font-size: 15px;
	font-weight: 500;
	color:#5bb3a7;
    text-decoration: underline;
	user-select: none;
	cursor: pointer;
}
.spl-icon-text{
	height: 39px;
    width: 38px;
    background:white;
    border-radius: 90px;
    font-size: 15px;
	margin-top:7px;
}
.spl-icon-text svg{
	width: 24px;
    height: 24px; 
	margin-top: 7px;
    margin-left: 6px;
    color: #5bb3a7;
}


			/*.foot-img-li a.spl-footer img {
			width: 100%;
			}*/
			.foot-img-li .foot-li {
				margin-top: 12px;
			}
			@media screen and (max-width:768px){
				.foot-img-li .col-md-1, .foot-img-li .design, .foot-img-li .design-2, .foot-img-li .design-3, .foot-img-li .col-md-3 {
					width: 100%;
					float: left;
				}
				.foot-img-li .spl-footer {
					width: 100%;
					float: left;
					max-width: 200px;
				}
				.foot-url {
					text-align: left;
					margin: 15px 0px;
				}
				.foot-text-img {
					width: 100%;
					float: left;
					margin-bottom: 16px;
				}
				.foot-text-img p {
					padding-left: 0px;
				}
				.foot-img-li .design:after, .design-2:after, .design-3:after{
					display:none;
				}
			}
			@media screen and (max-width:366px){
				ul.foot-li li {
					width: 100%;
					float: left;
				}
				ul.foot-li li:after {
					display:none;
				}
			}
		</style>
