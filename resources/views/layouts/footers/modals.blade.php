<div class="modal fade" id="contactSeller">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Feedback / Questions</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
				<div class="row">
					<div class="col">
						<form action="">

							<p>For time sensitive questions contact the auctioneer immediately</p>
							<button type="button" class="btn btn-secondary">Click here for Auctioneer Info</button>
							<h4>What is your question / feedback about</h4>
							<div class="radio">
								<label><input type="radio" name="optradio" checked>Questions about an auction, lot, bidding,
									shipping, etc. for <a href="#">Bidera</a></label>
							</div>
							<label>- Or -</label>
							<div class="radio">
								<label>
									<input type="radio" name="optradio">
									Technical website questions, log in issues, or suggestions and enhancements
								</label>
							</div>
							<div id="feedback-specifics" class="tab-pane active">
								<fieldset>
									<legend class="hidden"></legend>
									<div class="form-group">
										<label for="feedback-name" class="col-sm-4 control-label">Name (optional)</label>
										<div class="col-md-12">
											<input class="form-control" id="feedback-name" name="Name" type="text">
										</div>
									</div>
									<div class="form-group">
										<label for="feedback-email" class="col-sm-4 control-label">Email address</label>
										<div class="col-md-12">
											<input class="form-control" data-val="true"
												   data-val-email="The Email field is not a valid e-mail address."
												   data-val-required="The Email field is required." id="feedback-email" name="Email"
												   placeholder="Email address" type="text" value="" aria-required="true">
											<span class="field-validation-valid help-block" data-valmsg-for="Email"
												  data-valmsg-replace="true"></span>
										</div>
									</div>
									<div class="form-group">
										<label for="feedback-phone" class="col-sm-4 control-label">Phone</label>
										<div class="col-md-12">
											<input class="form-control" data-val="true"
												   data-val-phone="The Phone field is not a valid phone number."
												   data-val-required="The Phone field is required." id="feedback-phone" name="Phone"
												   placeholder="Phone" type="text" value="" aria-required="true">
											<span class="field-validation-valid help-block" data-valmsg-for="Phone"
												  data-valmsg-replace="true"></span>
										</div>
									</div>
									<div class="form-group">
										<label for="feedback-text" class="col-sm-4 control-label">Feedback / Question</label>
										<div class="col-md-12">
											<textarea class="form-control" cols="20" data-val="true"
													  data-val-length="Maximum 1000 Characters" data-val-length-max="1000"
													  data-val-length-min="1" data-val-required="The Feedback field is required."
													  id="feedback-text" name="Feedback" placeholder="Feedback / Question" rows="2"
													  aria-required="true" spellcheck="false"></textarea>
											<span class="field-validation-valid help-block" data-valmsg-for="Feedback"
												  data-valmsg-replace="true"></span>
										</div>
									</div>

								</fieldset>
							</div>
						</form>
					</div>
				</div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-secondary">submit</button>
            </div>

        </div>
    </div>
</div>

