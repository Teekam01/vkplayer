@extends('layouts.master')

@section('head')
<title>VK Ludo Player-Play Ludo King Win Real Money</title>
<style data-jss="" data-meta="MuiInput">
	.MuiInput-root {
		position: relative;
	}

	label+.MuiInput-formControl {
		margin-top: 16px;
	}

	.MuiInput-colorSecondary.MuiInput-underline:after {
		border-bottom-color: #f50057;
	}

	.MuiInput-underline:after {
		left: 0;
		right: 0;
		bottom: 0;
		content: "";
		position: absolute;
		transform: scaleX(0);
		transition: transform 200ms cubic-bezier(0.0, 0, 0.2, 1) 0ms;
		border-bottom: 2px solid #3f51b5;
		pointer-events: none;
	}

	.MuiInput-underline.Mui-focused:after {
		transform: scaleX(1);
	}

	.MuiInput-underline.Mui-error:after {
		transform: scaleX(1);
		border-bottom-color: #f44336;
	}

	.MuiInput-underline:before {
		left: 0;
		right: 0;
		bottom: 0;
		content: "\00a0";
		position: absolute;
		transition: border-bottom-color 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
		border-bottom: 1px solid rgba(0, 0, 0, 0.42);
		pointer-events: none;
	}

	.MuiInput-underline:hover:not(.Mui-disabled):before {
		border-bottom: 2px solid rgba(0, 0, 0, 0.87);
	}

	.MuiInput-underline.Mui-disabled:before {
		border-bottom-style: dotted;
	}

	@media (hover: none) {
		.MuiInput-underline:hover:not(.Mui-disabled):before {
			border-bottom: 1px solid rgba(0, 0, 0, 0.42);
		}
	}

</style>

<style data-jss="" data-meta="MuiInputBase">
	@-webkit-keyframes mui-auto-fill {}

	@-webkit-keyframes mui-auto-fill-cancel {}

	.MuiInputBase-root {
		color: rgba(0, 0, 0, 0.87);
		cursor: text;
		display: inline-flex;
		position: relative;
		font-size: 1rem;
		box-sizing: border-box;
		align-items: center;
		font-family: "Roboto", "Helvetica", "Arial", sans-serif;
		font-weight: 400;
		line-height: 1.1876em;
		letter-spacing: 0.00938em;
	}

	.MuiInputBase-root.Mui-disabled {
		color: rgba(0, 0, 0, 0.38);
		cursor: default;
	}

	.MuiInputBase-multiline {
		padding: 6px 0 7px;
	}

	.MuiInputBase-multiline.MuiInputBase-marginDense {
		padding-top: 3px;
	}

	.MuiInputBase-fullWidth {
		width: 100%;
	}

	.MuiInputBase-input {
		font: inherit;
		color: currentColor;
		width: 100%;
		border: 0;
		height: 1.1876em;
		margin: 0;
		display: block;
		padding: 6px 0 7px;
		min-width: 0;
		background: none;
		box-sizing: content-box;
		animation-name: mui-auto-fill-cancel;
		letter-spacing: inherit;
		animation-duration: 10ms;
		-webkit-tap-highlight-color: transparent;
	}

	.MuiInputBase-input::-webkit-input-placeholder {
		color: currentColor;
		opacity: 0.42;
		transition: opacity 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
	}

	.MuiInputBase-input::-moz-placeholder {
		color: currentColor;
		opacity: 0.42;
		transition: opacity 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
	}

	.MuiInputBase-input:-ms-input-placeholder {
		color: currentColor;
		opacity: 0.42;
		transition: opacity 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
	}

	.MuiInputBase-input::-ms-input-placeholder {
		color: currentColor;
		opacity: 0.42;
		transition: opacity 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
	}

	.MuiInputBase-input:focus {
		outline: 0;
	}

	.MuiInputBase-input:invalid {
		box-shadow: none;
	}

	.MuiInputBase-input::-webkit-search-decoration {
		-webkit-appearance: none;
	}

	.MuiInputBase-input.Mui-disabled {
		opacity: 1;
	}

	.MuiInputBase-input:-webkit-autofill {
		animation-name: mui-auto-fill;
		animation-duration: 5000s;
	}

	label[data-shrink=false]+.MuiInputBase-formControl .MuiInputBase-input::-webkit-input-placeholder {
		opacity: 0 !important;
	}

	label[data-shrink=false]+.MuiInputBase-formControl .MuiInputBase-input::-moz-placeholder {
		opacity: 0 !important;
	}

	label[data-shrink=false]+.MuiInputBase-formControl .MuiInputBase-input:-ms-input-placeholder {
		opacity: 0 !important;
	}

	label[data-shrink=false]+.MuiInputBase-formControl .MuiInputBase-input::-ms-input-placeholder {
		opacity: 0 !important;
	}

	label[data-shrink=false]+.MuiInputBase-formControl .MuiInputBase-input:focus::-webkit-input-placeholder {
		opacity: 0.42;
	}

	label[data-shrink=false]+.MuiInputBase-formControl .MuiInputBase-input:focus::-moz-placeholder {
		opacity: 0.42;
	}

	label[data-shrink=false]+.MuiInputBase-formControl .MuiInputBase-input:focus:-ms-input-placeholder {
		opacity: 0.42;
	}

	label[data-shrink=false]+.MuiInputBase-formControl .MuiInputBase-input:focus::-ms-input-placeholder {
		opacity: 0.42;
	}

	.MuiInputBase-inputMarginDense {
		padding-top: 3px;
	}

	.MuiInputBase-inputMultiline {
		height: auto;
		resize: none;
		padding: 0;
	}

	.MuiInputBase-inputTypeSearch {
		-moz-appearance: textfield;
		-webkit-appearance: textfield;
	}

</style>

<style data-jss="" data-meta="MuiFormLabel">
	.MuiFormLabel-root {
		color: rgba(0, 0, 0, 0.54);
		padding: 0;
		font-size: 1rem;
		font-family: "Roboto", "Helvetica", "Arial", sans-serif;
		font-weight: 400;
		line-height: 1;
		letter-spacing: 0.00938em;
	}

	.MuiFormLabel-root.Mui-focused {
		color: #3f51b5;
	}

	.MuiFormLabel-root.Mui-disabled {
		color: rgba(0, 0, 0, 0.38);
	}

	.MuiFormLabel-root.Mui-error {
		color: #f44336;
	}

	.MuiFormLabel-colorSecondary.Mui-focused {
		color: #f50057;
	}

	.MuiFormLabel-asterisk.Mui-error {
		color: #f44336;
	}

</style>

<style data-jss="" data-meta="MuiInputLabel">
	.MuiInputLabel-root {
		display: block;
		transform-origin: top left;
	}

	.MuiInputLabel-formControl {
		top: 0;
		left: 0;
		position: absolute;
		transform: translate(0, 24px) scale(1);
	}

	.MuiInputLabel-marginDense {
		transform: translate(0, 21px) scale(1);
	}

	.MuiInputLabel-shrink {
		transform: translate(0, 1.5px) scale(0.75);
		transform-origin: top left;
	}

	.MuiInputLabel-animated {
		transition: color 200ms cubic-bezier(0.0, 0, 0.2, 1) 0ms, transform 200ms cubic-bezier(0.0, 0, 0.2, 1) 0ms;
	}

	.MuiInputLabel-filled {
		z-index: 1;
		transform: translate(12px, 20px) scale(1);
		pointer-events: none;
	}

	.MuiInputLabel-filled.MuiInputLabel-marginDense {
		transform: translate(12px, 17px) scale(1);
	}

	.MuiInputLabel-filled.MuiInputLabel-shrink {
		transform: translate(12px, 10px) scale(0.75);
	}

	.MuiInputLabel-filled.MuiInputLabel-shrink.MuiInputLabel-marginDense {
		transform: translate(12px, 7px) scale(0.75);
	}

	.MuiInputLabel-outlined {
		z-index: 1;
		transform: translate(14px, 20px) scale(1);
		pointer-events: none;
	}

	.MuiInputLabel-outlined.MuiInputLabel-marginDense {
		transform: translate(14px, 12px) scale(1);
	}

	.MuiInputLabel-outlined.MuiInputLabel-shrink {
		transform: translate(14px, -6px) scale(0.75);
	}

</style>

<style data-jss="" data-meta="MuiFormControl">
	.MuiFormControl-root {
		border: 0;
		margin: 0;
		display: inline-flex;
		padding: 0;
		position: relative;
		min-width: 0;
		flex-direction: column;
		vertical-align: top;
	}

	.MuiFormControl-marginNormal {
		margin-top: 16px;
		margin-bottom: 8px;
	}

	.MuiFormControl-marginDense {
		margin-top: 8px;
		margin-bottom: 4px;
	}

	.MuiFormControl-fullWidth {
		width: 100%;
	}

</style>

<style data-jss="" data-meta="MuiFormHelperText">
	.MuiFormHelperText-root {
		color: rgba(0, 0, 0, 0.54);
		margin: 0;
		font-size: 0.75rem;
		margin-top: 3px;
		text-align: left;
		font-family: "Roboto", "Helvetica", "Arial", sans-serif;
		font-weight: 400;
		line-height: 1.66;
		letter-spacing: 0.03333em;
	}

	.MuiFormHelperText-root.Mui-disabled {
		color: rgba(0, 0, 0, 0.38);
	}

	.MuiFormHelperText-root.Mui-error {
		color: #f44336;
	}

	.MuiFormHelperText-marginDense {
		margin-top: 4px;
	}

	.MuiFormHelperText-contained {
		margin-left: 14px;
		margin-right: 14px;
	}

</style>

<style data-jss="" data-meta="MuiTextField">

</style>

<style data-jss="" data-meta="MuiTypography">
	.MuiTypography-root {
		margin: 0;
	}

	.MuiTypography-body2 {
		font-size: 0.875rem;
		font-family: "Roboto", "Helvetica", "Arial", sans-serif;
		font-weight: 400;
		line-height: 1.43;
		letter-spacing: 0.01071em;
	}

	.MuiTypography-body1 {
		font-size: 1rem;
		font-family: "Roboto", "Helvetica", "Arial", sans-serif;
		font-weight: 400;
		line-height: 1.5;
		letter-spacing: 0.00938em;
	}

	.MuiTypography-caption {
		font-size: 0.75rem;
		font-family: "Roboto", "Helvetica", "Arial", sans-serif;
		font-weight: 400;
		line-height: 1.66;
		letter-spacing: 0.03333em;
	}

	.MuiTypography-button {
		font-size: 0.875rem;
		font-family: "Roboto", "Helvetica", "Arial", sans-serif;
		font-weight: 500;
		line-height: 1.75;
		letter-spacing: 0.02857em;
		text-transform: uppercase;
	}

	.MuiTypography-h1 {
		font-size: 6rem;
		font-family: "Roboto", "Helvetica", "Arial", sans-serif;
		font-weight: 300;
		line-height: 1.167;
		letter-spacing: -0.01562em;
	}

	.MuiTypography-h2 {
		font-size: 3.75rem;
		font-family: "Roboto", "Helvetica", "Arial", sans-serif;
		font-weight: 300;
		line-height: 1.2;
		letter-spacing: -0.00833em;
	}

	.MuiTypography-h3 {
		font-size: 3rem;
		font-family: "Roboto", "Helvetica", "Arial", sans-serif;
		font-weight: 400;
		line-height: 1.167;
		letter-spacing: 0em;
	}

	.MuiTypography-h4 {
		font-size: 2.125rem;
		font-family: "Roboto", "Helvetica", "Arial", sans-serif;
		font-weight: 400;
		line-height: 1.235;
		letter-spacing: 0.00735em;
	}

	.MuiTypography-h5 {
		font-size: 1.5rem;
		font-family: "Roboto", "Helvetica", "Arial", sans-serif;
		font-weight: 400;
		line-height: 1.334;
		letter-spacing: 0em;
	}

	.MuiTypography-h6 {
		font-size: 1.25rem;
		font-family: "Roboto", "Helvetica", "Arial", sans-serif;
		font-weight: 500;
		line-height: 1.6;
		letter-spacing: 0.0075em;
	}

	.MuiTypography-subtitle1 {
		font-size: 1rem;
		font-family: "Roboto", "Helvetica", "Arial", sans-serif;
		font-weight: 400;
		line-height: 1.75;
		letter-spacing: 0.00938em;
	}

	.MuiTypography-subtitle2 {
		font-size: 0.875rem;
		font-family: "Roboto", "Helvetica", "Arial", sans-serif;
		font-weight: 500;
		line-height: 1.57;
		letter-spacing: 0.00714em;
	}

	.MuiTypography-overline {
		font-size: 0.75rem;
		font-family: "Roboto", "Helvetica", "Arial", sans-serif;
		font-weight: 400;
		line-height: 2.66;
		letter-spacing: 0.08333em;
		text-transform: uppercase;
	}

	.MuiTypography-srOnly {
		width: 1px;
		height: 1px;
		overflow: hidden;
		position: absolute;
	}

	.MuiTypography-alignLeft {
		text-align: left;
	}

	.MuiTypography-alignCenter {
		text-align: center;
	}

	.MuiTypography-alignRight {
		text-align: right;
	}

	.MuiTypography-alignJustify {
		text-align: justify;
	}

	.MuiTypography-noWrap {
		overflow: hidden;
		white-space: nowrap;
		text-overflow: ellipsis;
	}

	.MuiTypography-gutterBottom {
		margin-bottom: 0.35em;
	}

	.MuiTypography-paragraph {
		margin-bottom: 16px;
	}

	.MuiTypography-colorInherit {
		color: inherit;
	}

	.MuiTypography-colorPrimary {
		color: #3f51b5;
	}

	.MuiTypography-colorSecondary {
		color: #f50057;
	}

	.MuiTypography-colorTextPrimary {
		color: rgba(0, 0, 0, 0.87);
	}

	.MuiTypography-colorTextSecondary {
		color: rgba(0, 0, 0, 0.54);
	}

	.MuiTypography-colorError {
		color: #f44336;
	}

	.MuiTypography-displayInline {
		display: inline;
	}

	.MuiTypography-displayBlock {
		display: block;
	}

</style>

<style data-jss="" data-meta="MuiInputAdornment">
	.MuiInputAdornment-root {
		height: 0.01em;
		display: flex;
		max-height: 2em;
		align-items: center;
		white-space: nowrap;
	}

	.MuiInputAdornment-filled.MuiInputAdornment-positionStart:not(.MuiInputAdornment-hiddenLabel) {
		margin-top: 16px;
	}

	.MuiInputAdornment-positionStart {
		margin-right: 8px;
	}

	.MuiInputAdornment-positionEnd {
		margin-left: 8px;
	}

	.MuiInputAdornment-disablePointerEvents {
		pointer-events: none;
	}

</style>

<style data-jss="" data-meta="makeStyles">
	.jss1 {
		font-size: 1.7em;
		font-weight: 700;
	}

	.jss2 {
		font-size: 1.2em;
		font-weight: 500;
	}

	.jss3 {
		font-size: 0.9em;
		font-weight: 500;
	}

	.jss4 {
		color: #B36916;
		font-size: 0.7em;
	}

	.jss5 {
		float: left;
		width: 20%;
		text-align: center;
	}

	.jss6 {
		width: 48px;
		border: 1px solid #0db25b;
		height: 48px;
		margin: 0 auto;
		position: relative;
		border-radius: 50%;
	}

	.jss7 {
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		margin: auto;
		position: absolute;
		max-width: 28px;
	}

	.jss8 {
		font-size: 13px;
		text-align: center;
		letter-spacing: .46px;
	}

	.jss9 {
		width: 30px;
		border: 1px solid #0db25b;
		padding: 1px;
		margin-right: 20px;
		border-radius: 50%;
	}

</style>
@endsection



@section('content')
<div class="main-area" style="padding-top: 60px;">
	<div class="p-4 bg-light"><a class="d-flex align-items-center profile-wallet undefined" href="/transaction-history">
			<picture class="ml-4"><img width="32px" src="{{asset('frontend/images/order-history.png')}}" alt=""></picture>
			<div class="ml-5 mytext text-muted ">Transaction History</div>
		</a></div>
	<div class="divider-x"></div>
	<div class="p-4 bg-light">
		<div class="wallet-card" style="background-color: rgb(71, 130, 244); background-image: url(&quot;/images/bg-wallets-deposit.png&quot;);">
			<div class="d-flex align-items-center">

				<picture class="mr-1"><img height="26px" width="26px" src="{{asset('frontend/images/global-rupeeIcon.png')}}" alt=""></picture><span class="text-white" style="font-size: 1.3em; font-weight: 900;">
					₹ {{ Auth::user()->wallet }}
				</span>
			</div>
			<div class="text-white text-uppercase" style="font-size: 0.9em; font-weight: 500;">Deposit Cash</div>
			<div class="mt-5" style="font-size: 0.9em; color: rgb(191, 211, 255);">Can be used to play Tournaments &amp; Battles.<br>Cannot be withdrawn to Upi or Bank.</div><a href="{{url('/add-funds')}}" class="walletCard-btn d-flex justify-content-center align-items-center text-uppercase">Add Cash</a>
		</div>
		<div class="wallet-card" style="background-color: rgb(127, 153, 255); background-image: url(&quot;/images/bg-wallets-winnings.png&quot;);">
			<div class="d-flex align-items-center">
				<picture class="mr-1"><img height="26px" width="26px" src="{{asset('frontend/images/global-rupeeIcon.png')}}" alt=""></picture><span class="text-white" style="font-size: 1.3em; font-weight: 900;">

			₹ {{ Auth::user()->wallet_winning_cash }}



				</span>
			</div>
			<div class="text-white text-uppercase" style="font-size: 0.9em; font-weight: 500;">Winning Cash</div>
			<div class="mt-5" style="font-size: 0.9em; color: rgb(216, 224, 255);">You can withdraw 24 x 7 Can be withdrawn to Upi or Bank. Can be used to play Tournaments &amp; Battles.</div>
			@if(Auth::user()->wallet_winning_cash > 0)
			    <a href="{{ url('/withdraw-check') }}" class="walletCard-btn d-flex justify-content-center align-items-center text-uppercase">Withdraw</a>
			@else
			    <button onclick="location.href='{{ url('withdraw-alert') }}';" class="walletCard-btn d-flex justify-content-center align-items-center text-uppercase">Withdraw</button>
			@endif
		</div>

		<!--<div class="wallet-card" style="background-color: rgb(71, 130, 244); background-image: url(&quot;/images/bg-wallets-deposit.png&quot;);">
			<div class="d-flex align-items-center">
				<picture class="mr-1"><img height="26px" width="26px" src="{{asset('frontend/images/global-rupeeIcon.png')}}" alt=""></picture><span class="text-white" style="font-size: 1.3em; font-weight: 900;">₹ {{ Auth::user()->wallet }}</span>
			</div>

			<div class="text-white text-uppercase" style="font-size: 0.9em; font-weight: 500;">Send To Friends</div>
			<div class="mt-5" style="font-size: 0.9em; color: rgb(191, 211, 255);">Send Money Your Friends Wallet </div>
			<a href="{{url('/send-money')}}" class="walletCard-btn d-flex justify-content-center align-items-center text-uppercase">Send Money</a>
		</div>-->
	</div>
</div>

@endsection
