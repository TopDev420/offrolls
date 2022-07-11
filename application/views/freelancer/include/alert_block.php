<?php $alerts = $this->document->getAlerts(); ?>
<?php if ($alerts) { ?>
    <!-- Alert Block -->
    <div class="py-4 alert--block">
        <div class="container">
            <?php $paymentInfoAlert = isset($alerts['payment_info']) ? $alerts['payment_info'] : ''; ?>
            <?php if ($paymentInfoAlert && $logged && $moduleAction == 'freelancer') { ?>
                <!-- payment_info Agree -->
                <div class="alert alert-<?php echo $alerts['payment_info']['status']; ?> payment-info-alertbox" role="alert">
                    <button type="button" class="close d-none" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="d-flex align-items-center justify-content-between">
                        <h6>Payment Agreement</h6>
                        <div class="mr-4">
                            <button class="ps-btn ps-btn--sm mb-2 ml-2" data-payment-detail>View</button>
                        </div>
                    </div>
                </div>
                <!-- payment_info Agre modal -->
                <div class="modal" role="modal" id="payment-info-agreement-modal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6>Payment Info Agreement</h6>
                                <button class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form id="bank_acc_details" method="POST">
                                    <div class="form-group ele--jqvalid px-4">
                                        <input type="text" class="form-control" name="account_number" placeholder="Account Number" />
                                    </div>
                                    <div class="form-group ele--jqvalid px-4">
                                        <input type="text" class="form-control" name="ifsc_code" placeholder="IFSC Code" />
                                    </div>
                                    <div class="form-group ele--jqvalid px-4">
                                        <input type="text" class="form-control" name="bank_name" placeholder="Bank Name" />
                                    </div>
                                    <div class="form-group ele--jqvalid px-4">
                                        <input type="text" class="form-control" name="branch_name" placeholder="Branch Name" />
                                    </div>
                                    <!-- <div class="form-group ele--jqvalid px-4">
                                        <input type="text" class="form-control" name="upi_id" placeholder="UPI ID" />
                                    </div> -->
                                    <div class="text-center">
                                        <button type="submit" class="ps-btn ps-btn--sm"><i class="fas fa-check-circle"></i>&nbsp;Agree</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>