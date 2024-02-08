<div class="menu-items">
						<a class="box" href="{{ url('add-funds') }}"  style="width: 128px !important;">
							<picture class="moneyIcon-container"><img src="{{asset('frontend/images/global-rupeeIcon.png')}}" alt=""></picture>
							<div class="mt-1 ml-1">
								<div class="moneyBox-header">Total Blanace</div>
								<div class="moneyBox-text">₹{{ (int) Auth::user()->wallet }}</div>
							</div>
							<picture class="moneyBox-add"><img src="{{asset('frontend/images/global-addSign.png')}}" alt=""></picture>
						</a>
						&nbsp; 
						<a class="box" href="{{ url('/comission-reedem') }}">
							<picture class="moneyIcon-container"><img src="{{asset('frontend/images/reward_red.png')}}" alt=""></picture>
							<div class="mt-1 ml-1">
								<div class="moneyBox-header">Earning</div>
								<div class="moneyBox-text">₹{{ (int) Auth::user()->wallet_reffer }}</div>
							</div>
							<picture class="moneyBox-add"></picture>
						</a>
						</div>
						<span class="mx-5"> 
							
						</span>