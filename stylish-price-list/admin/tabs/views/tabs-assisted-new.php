<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
$choices_data = DF_SPL_QUIZ_CHOICES;
$choice_data_tmp = $choices_data;
unset ( $choice_data_tmp['elementSuggestions'] );
unset ( $choice_data_tmp['stepResult'] );
$choices_data_with_icons = array_map(function ( $choice ) {
	$choice = array_map( function( $choice ) {
		$choice['icon'] = file_get_contents(DF_SPL_WIZARD_ICONS_DIR . $choice['icon'] . '.svg');
		return $choice;
	}, $choice );
	return $choice;
}, $choice_data_tmp );
// Add back the element suggestions
$choices_data_with_icons['elementSuggestions'] = $choices_data['elementSuggestions'];
$choices_data_with_icons['stepResult'] = $choices_data['stepResult'];
$logged_in_user     = wp_get_current_user();
$opt_user_email     = get_option( 'df_spl_emailsender', get_option( 'admin_email' ) );

if ( empty( $user_email ) ) {
    $opt_user_email = get_option( 'admin_email' );
}
$opt_user_full_name = apply_filters( 'spl_wq_user_full_name', $logged_in_user->display_name );
$opt_user_email     = apply_filters( 'spl_wq_user_email', $opt_user_email );
wp_localize_script( 'spl-add-new-page', 'pageSplWizard', [ 'nonce' => wp_create_nonce( 'spl-add-new-page' ) ] );
?>
<div class="wrap">
    <div id="add-new-page-wrapper" class="container-fluid my-5 mx-auto with-vh">
        <div class="row">
            <div class="col page-section" id="welcome-section">
                <div class="bg-white">
                    <div class="mx-auto py-5 text-center">
                        <div class="head">
                            <strong class="lead fw-bold display-5">Welcome! 👋</strong>
                            <p class="fw-bold">Let’s build a new price list</p>
                        </div>
                        <div class="action-btn mx-auto">
                                <button type="button" class="btn-lg bg-spl-secondary mb-2 text-capitalize" data-btn-action="startQuiz">
                                    <span class="spl-icn-wrapper text-dark">
                                        <?php // echo spl_get_kses_extended_ruleset( $this->spl_icons['check-square'] ); ?>
                                    </span>
                                    <span class="btn-text ms-2 text-white">Start Setup Wizard</span>
                                </button>
                                <button type="button" class="btn-lg mb-2 bg-white btn-primary-outlined text-capitalize" data-btn-action="showNewCalcNameInput">
                                    <span class="spl-icn-wrapper">
                                        <?php // echo spl_get_kses_extended_ruleset( $this->spl_icons['edit-2'] ); ?>
                                    </span>
                                    <span class="btn-text ms-2">Start from scratch</span>
                                </button>
								<?php if ( ! empty( get_option( 'spllk_opt' ) ) ) : ?>
                                <button type="button" class="btn-lg bg-white btn-primary-outlined text-capitalize" data-btn-action="showRestorePrompt">
                                    <span class="spl-icn-wrapper">
                                        <?php // echo spl_get_kses_extended_ruleset( $this->spl_icons['baseline-restore'] ); ?>
                                    </span>
                                    <span class="btn-text ms-2">Restore A Backup</span>
                                </button>
								<?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col page-section d-none" id="new-calc-creator-section">
                <div class="px-4 py-3 bg-white">
                    <div class="head">
                        <div class="text-muted text-uppercase">Option B</div>
                        <strong>Start from scratch</strong>
                    </div>
					<div id="create-new-prompt-loading" class="progress mt-2 d-none" role="progressbar" aria-label="loading" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
						<div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 100%"></div>
					</div>
                    <div id="create-new-prompt-body" class="body">
                        <div class="input-group my-3">
                            <input type="text" class="form-control" id="new-calc-name" placeholder="Price list name">
                        </div>
                        <p>Create a new price list from scratch with your own layout and style.</p>
                        <p class="text-danger d-none">Please enter a name for the price list</p>
                    </div>
                    <div id="create-new-prompt-actions" class="action-btn">
                        <button type="button" data-relative-field="new-calc-name" class="btn btn-primary">Create price list</button>
                    </div>
                </div>
            </div>
            <div class="col page-section d-none" id="restore-section">
                <div class="px-4 py-3 bg-white">
                    <div class="head">
                        <div class="text-muted text-uppercase">Option C</div>
                        <strong>Restore From A Backup</strong>
                    </div>
					<div id="backup-restore-loading" class="progress mt-2 d-none" role="progressbar" aria-label="loading" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
						<div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 100%"></div>
					</div>
					<form class="body" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) . '?action=spl_restore_backup' ); ?>" enctype="multipart/form-data">
                        <div class="input-group my-3">
							<?php wp_nonce_field( 'spl_restore_nonce' ); ?>
                            <input type="file" accept=".csv" class="form-control" name="importtocsv" id="restoration-file" placeholder="Select a file">
                        </div>
                        <p>Please upload a backup CSV file.</p>
                        <p class="text-danger d-none">Please select a file from the input field above</p>
						<div class="action-btn">
							<button type="submit" name="restore" value="restore" onclick="document.querySelector('#backup-restore-loading').classList.remove('d-none');" data-relative-field="restoration-file" class="btn btn-primary">Restore</button>
						</div>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade quiz-modal" id="quizModal" aria-hidden="true" aria-labelledby="quizModalLabel" tabindex="-1">
</div>
<div class="modal fade quiz-modal" id="quizModal2" aria-hidden="true" aria-labelledby="quizModalLabel2" tabindex="-1">
</div>
<div class="modal fade quiz-modal" id="quizModal3" aria-hidden="true" aria-labelledby="quizModalLabel3" tabindex="-1">
</div>
<div class="modal fade quiz-modal" id="quizModal4" aria-hidden="true" aria-labelledby="quizModalLabel4" tabindex="-1">
</div>
<div class="modal fade quiz-modal" id="quizModal5" aria-hidden="true" aria-labelledby="quizModalLabel5" tabindex="-1">
</div>
<div class="modal fade quiz-modal" id="quizResult" aria-hidden="true" aria-labelledby="quizModalResult" tabindex="-1">
</div>
<script type="text/json" id="choices-data">
	<?php
    echo wp_json_encode( $choices_data_with_icons );
?>
</script>
<script type="text/html" id="tmpl-quiz-modal-content">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content p-3 vh-95">
			<div class="px-3 pt-3 text-center modal-head">
				<# if (data.currentStep != 1) { #>
					<span class="spl-icn-wrapper modal-back-nav" data-dismiss="modal" onclick="handleBackNavigation({{ data.currentStep == 'Result' ? 4 : data.currentStep - 1 }}, this)">
						<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
					</span>
				<# } #>
				<h1 class="{{ data.currentStep === 'Result' ? 'mt-5 mb-4' : ''  }}">{{{data.title}}}</h1>
				<p class="text-muted <# if ( data.currentStep == 'Result' ) { #> spl-text-black <# } #> spl-result-section-padding">{{{data.subtitle}}}</p>
			</div>
			<div class="modal-body pt-0">
				<# if (data.modalLead && data.modalLead.length) { #>
					<p class="fw-bold lead-text">{{{data.modalLead}}}</p>
				<# } #>
				<# if (data?.showFormNameInput) { #>
					<div class="px-4 py-3 bg-white">
						<div class="head">
							<strong>Please enter a name for the price list</strong>
						</div>
						<div class="body">
							<div class="input-group my-3">
								<input type="text" autofocus class="form-control" id="calc-from-answes-name" placeholder="Price list name">
							</div>
							<p>Create a new price list from the answers you have given in the previous steps.</p>
							<p class="text-danger d-none" data-warning-for="calc-from-answes-name">The above field cannot be empty</p>
						</div>
						<div class="action-btn">
							<button type="button" data-relative-field="calc-from-answes-name" class="btn btn-primary">Create price list</button>
						</div>
					</div>
				<# } #>
				<# if ( ['Result', 1].includes( data.currentStep ) ) { #>
					<div class="choices-wrapper"></div>
				<# } else { #>
					<div class="choices-wrapper row row-cols-2"></div>
				<# } #>
			</div>
			<# if ( Boolean( data?.actionBtnTitle?.length ) ) { #>
				<# if ( data.currentStep !== 'Result' ) { #>
				<div class="modal-footer d-block">
					<div class="d-grid gap-2">
						<button class="btn spl-setup-wizard-button btn-primary" data-max-steps="5" data-next-step={{ data.quizNextStep }} type="button">{{data.actionBtnTitle}}</button>
								
					</div>
				</div>
				<# } #>	
			<# } #>
		</div>
	</div>
</script>
<script type="text/html" id="tmpl-quiz-choices-content">
		<# data.choices.forEach( (choice, i) => {
			let currentKey = UUIDv4.generate();
			let answersStoreIndex = quizAnswersStore['step' + data.step][choice.key];
			// let hasHelpLink = choice.helpLink && choice.helpLink !== '#';
			let hasHelpLink = false;
		#>
			<div class="col d-flex flex-column g-3 user-select-none">
                <input class="col-sm-1" hidden {{ answersStoreIndex == true ? 'checked' : '' }} type="checkbox" name="{{ choice.key }}" id="key-{{ currentKey }}">
				<label role="button" class="card {{ [1,2].includes(data.step) ? '' : 'v2' }} {{ choice.key !== 'others' ? 'has-help-article' : '' }} m-0 flex-sm-grow-1 justify-content-center" for="key-{{ currentKey }}">
					<div class="form-check-label col-sm-11 {{ [1, 2].includes(data.step) ? 'd-flex align-items-center flex-column' : 'd-flex' }} ps-1">
						{{{ choice.icon }}}
						<div>
							<div class="question-title-wrapper">
								<!-- <i class="material-icons align-middle text-primary">{{ choice.icon }}</i> -->
								<strong>{{ choice.choiceTitle }}</strong>&nbsp;
								<# if (hasHelpLink) { #>
									<a href="{{{ choice.helpLink }}}" target="_blank" class="card-help-icn" title="Click to learn more"></a>
								<# } #>
							</div>
							<# if ( choice?.choiceDescription && choice.choiceDescription.length ) { #>
								<p class="pt-1 question-desc-text">{{ choice.choiceDescription }}</p>
							<# } #>
						</div>
					</div>
				</label>
			</div>
			<# if (choice.key == 'others') { #>
				<div class="form-check w-100 d-none">
					<input class="form-control form-control-sm mb-2 mt-2 w-100 others-input" type="text" name="step{{data.step}}-othersInput" id="othersInput-{{currentKey}}" placeholder="Please specify" required="">
					<label class="form-check-label" for="othersInput-{{currentKey}}">Others</label>
				</div>
			<# } #>
		<# }) #>
</script>
<script type="text/html" id="tmpl-quiz-columned-card-choices-content">
<# if (data.step == 'Result' && data.choices?.length) {  #>
	<p class="mb-0">Recommended <b>Features</b></p>
<# } #>
<div class="row row-cols-3 g-0 w-100">
	<# 
	if (data.step == 'Result') {
		data = filterResultPageSuggestions(data);
	}
	data.choices.forEach( (choice, i) => {
		let currentKey = UUIDv4.generate();
		let icon = typeof(choice.icon) == 'string' ? svgCollection[choice.icon] : choice.icon.map(z => svgCollection[z]).join('');
		let choiceCardClasses = [];
		if (choice.helpLink && choice.helpLink.length > 1) {
			choiceCardClasses.push('has-help-article');
		}
		let title = choice?.choiceSimpleTitle ? choice.choiceSimpleTitle : choice.choiceTitle;
		let hasHelpLink = choice.helpLink && choice.helpLink !== '#';
	#>
	<div class="col d-flex flex-column g-3 {{ data.step === 'Result' ? 'd-none' : '' }}">
		<input type="checkbox" {{ quizAnswersStore['step' + data.step][choice.key] == true ? 'checked' : '' }} class="d-none" name="{{ choice.key }}" id={{currentKey}}>

		<label role="button" class="card {{ [1,2].includes(data.step) ? '' : 'v2' }} {{ choice.key !== 'others' ? 'has-help-article' : '' }} m-0 flex-sm-grow-1 justify-content-center" for="{{ currentKey }}">
			<div class="form-check-label col-sm-11 {{ [1, 2].includes(data.step) ? 'd-flex align-items-center flex-column' : 'd-flex' }} ps-1">
				{{{ choice.icon }}}
				<div class="text-center">
					<div class="question-title-wrapper">
						<strong>{{ choice.choiceTitle }}</strong>&nbsp;
						<# if (hasHelpLink) { #>
							<a href="{{{ choice.helpLink }}}" target="_blank" class="card-help-icn" title="Click to learn more"></a>
						<# } #>
					</div>
					<# if ( choice?.choiceDescription && choice.choiceDescription.length ) { #>
						<p class="pt-1 m-0 question-desc-text">{{ choice.choiceDescription }}</p>
					<# } #>
				</div>
			</div>
		</label>
	</div>
	<# }) #>
  </div>
  <# if (data.step == '1') {
	const businessAndIndustyFieldsFilledUp = quizAnswersStore.step1?.['industry-type']?.length && quizAnswersStore.step1?.['business-name']?.length;
	const conditionalHideClass = businessAndIndustyFieldsFilledUp ? '' : 'd-none';
  #>
	<div class="my-3 {{ conditionalHideClass }}" id="businessNameWrapper">
		<label for="businessName" class="form-label">What is your business name?</label>
		<input type="text" value="{{ quizAnswersStore.step1?.['business-name'] }}" name="business-name" class="form-control scc-setup-wizard-text-inputs" id="businessName">
	</div>
	<div class="my-3 {{ conditionalHideClass }}" id="industryTypeWrapper">
		<label for="industryType" class="form-label">What is your industry?</label>
		<input type="text" value="{{ quizAnswersStore.step1?.['industry-type'] }}" name="industry-type" class="form-control" id="industryType">
	</div>
	<button type="submit"id="firstStepNextBtn" data-max-steps="5" data-next-step="2" class="btn btn-primary w-100 {{ conditionalHideClass }}">Continue</button>
  <# } #>
  <# if (data.step == 'Result') { #>
	<# if (data.elementSuggestions?.length) { #>
  <div class="mt-3 d-none">
	<p class="mb-0">Recommended <b>Elements</b></p>
	<div class="row row-cols-3 g-0">
		<# data.elementSuggestions.forEach( (choice, i) => {
			let currentKey = UUIDv4.generate();
			let choiceCardClasses = [];
			let icon = typeof(choice.icon) == 'string' ? svgCollection[choice.icon] : choice.icon.map(z => svgCollection[z]).join('');
			if (choice.helpLink) {
				choiceCardClasses.push('has-help-article');
			}
			let title = choice?.choiceSimpleTitle ? choice.choiceSimpleTitle : choice.choiceTitle;
			let hasHelpLink = choice.helpLink && choice.helpLink !== '#';
		#>
		<div class="col d-flex flex-column g-3">
			<input type="checkbox" {{ quizAnswersStore['step' + data.step][choice.key] == true ? 'checked' : '' }} data-element-suggestion="1" class="d-none" name="{{ choice.key }}" id={{currentKey}}>
			<label class="card {{ choiceCardClasses.join( ' ' ) }} single-row-btn text-center mt-0 py-0 flex-sm-grow-1" role="button" for={{currentKey}}>
				<span class="btn-content">
					<span class="spl-icn-wrapper">{{{ icon }}}</span>
					<p class="mb-0 mt-2 result-card me-1">{{ title }}</p>
					<# if ( hasHelpLink ) { #>
						<a href="{{{ choice.helpLink }}}" target="_blank" class="card-help-icn" title="Click to learn more"></a>
					<# } #>
				</span>
			</label>
		</div>
		<# }) #>
	</div>
  </div>
  <# } #>
  <form class="mt-4 spl-result-section-margin" id="quiz-result-email-form">
	<div id="wq_field_wrapper">
		<div class="mt-3">
			<label for="wq_your_name" class="form-label text-white">Your Name</label>
			<input type="text" class="form-control" value="<?php echo esc_attr( $opt_user_full_name ); ?>" id="wq_your_name">
		</div>
		<p class="m-0 text-danger">Please fill out the field above</p>
		<div class="mt-3">
			<label for="wq_your_email" class="form-label text-white">Your Email</label>
			<input type="email" class="form-control" value="<?php echo esc_attr( $opt_user_email ); ?>" id="wq_your_email">
		</div>
		<p class="m-0 text-danger">Please fill out the field above</p>

		<button class="btn spl-setup-wizard-button spl-backend-wizard-button mt-4 w-100" data-max-steps="5" data-next-step="0" data-result-action="email" type="button">	
			Email Setup Steps & Open Builder
			<div class="spl-liquid-shape"></div>
		</button>
  </div>
</form>
<div class="text-center mt-2">
	<a href="#" class="spl-text-black spl-setup-wizard-button spl-font-size-normal" data-max-steps="5" data-next-step="0" data-result-action="pdf" ><strong>Skip and Take me to the price list editor</strong></a>
</div>
  <# } #>
</script>