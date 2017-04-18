
                    <form name="contactConfirm" id="confirmForm" novalidate>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="form-group">
                                    <label for="name">Name *</label>
                                    <input type="text" class="form-control" value=<?php echo("'$fullname'") ?> id="name" required data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" class="form-control" value=<?php echo("$useremail") ?> id="email" required data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone *</label>
                                    <input type="tel" class="form-control" placeholder="Your Phone *" id="phone" required data-validation-required-message="Please enter your phone number.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <input type="hidden" name="txId" value=<?php echo("$tx_token") ?>  >
                            <input type="hidden" name="amount" value=<?php echo("$amount") ?>  >
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button type="submit" class="btn btn-xl">Confirm!</button>
                            </div>
                        </div>
                    </form>
                