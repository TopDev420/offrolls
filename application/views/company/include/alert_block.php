<?php $alerts = $this->document->getAlerts(); ?>
<?php if($alerts){ ?>
	<!-- Alert Block -->
	<div class="py-4 alert--block">
	  <div class="container">
	  	<?php $commissionAlert = isset($alerts['commission']) ? $alerts['commission'] : ''; ?>
	  	<?php if($commissionAlert && $logged && $moduleAction == 'company'){ ?>
		  	<!-- Commission Agree -->
		    <div class="alert alert-<?php echo $alerts['commission']['status']; ?> commission-alertbox" role="alert">
		      <button type="button" class="close d-none" data-dismiss="alert" aria-label="Close">
		        <span aria-hidden="true">&times;</span>
		      </button>
		      <div class="d-flex align-items-center justify-content-between">
		        <h6>Commission Agreement</h6>
		        <div class="mr-4">
		          <button class="ps-btn ps-btn--sm mb-2 ml-2" data-commission-agreement >View</button>
		        </div>
		      </div>
		    </div>
		    <!-- Commission Agre modal -->
		    <div class="modal" role="modal" id="commission-agreement-modal">
		    	<div class="modal-dialog modal-dialog-centered modal-lg">
		    		<div class="modal-content">
		    			<div class="modal-header">
		    				<h6>Commission Agreement</h6>
		    				<button class="close" data-dismiss="modal">&times;</button>
		    			</div>
		    			<div class="modal-body">
		    				<p>Vestibulum pretium non lectus eget interdum. Mauris et luctus libero. Quisque finibus eu eros at luctus. Mauris eros felis, posuere id est in, luctus luctus mi. Duis sem velit, ultricies id eros sed, tempor finibus tortor. Aliquam erat volutpat. Nulla tempus metus augue, vitae facilisis augue consequat dictum. Maecenas porttitor nisl ac mollis ultricies. Nunc ut lobortis tortor. Fusce et dolor vel sem consequat tempor id a nibh. Proin eleifend eleifend quam, in dictum eros hendrerit sit amet.</p>
		    				<p>Nam pretium rutrum dapibus. Pellentesque pellentesque augue ac facilisis faucibus. Nam consectetur sapien urna, sed fringilla ante varius in. Phasellus rutrum nisi ac turpis facilisis, et rhoncus tellus varius. Proin vitae luctus nisi, at tristique odio. Vestibulum ac ipsum in neque blandit rutrum a et dolor. Donec suscipit tempor sapien, quis eleifend sapien elementum a. Integer pellentesque turpis at dolor condimentum blandit id eget ex.</p>
		    				<div class="text-center">
		    					<button class="ps-btn ps-btn--sm" id="btn-commission-agree"><i class="fas fa-check-circle"></i>&nbsp;Agree</button>
		    				</div>
		    			</div>
		    		</div>
		    	</div>
		    </div>
		<?php } ?>
	  </div>
	</div>
<?php } ?>

