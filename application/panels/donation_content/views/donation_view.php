<!--<form action="charge.php" method="post">-->
<!--    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"-->
<!--            data-key="--><?php //echo publishable_key ?><!--"-->
<!--            data-description="Access for a year"-->
<!--            data-amount="5000"-->
<!--            data-locale="auto"></script>-->
<!--</form>-->
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add Donation</h5>

                </div>
                <div class="ibox-content">
                    <form method="post" action="<?php echo $this->config->base_url();?>donation_content/createdonation" class="form-horizontal" id="create_story_form" name="create_story_form" enctype="multipart/form-data">


                        <div class="form-group"><label class="col-sm-2 control-label">Full Name</label>

                            <div class="col-sm-10"><input type="text" placeholder="Enter Full Name" class="form-control"  name="fullname" id="fullname" ></div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group"><label class="col-sm-2 control-label">Card Number</label>

                            <div class="col-sm-10"><input type="text" placeholder="Enter Card Number" class="form-control"  name="cardnumber" id="cardnumber"></div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group"><label class="col-sm-2 control-label">Exp-Month</label>

                            <div class="col-sm-10"><input type="text" placeholder="Enter Exp Month" class="form-control"  name="expmonth" id="expmonth"></div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group"><label class="col-sm-2 control-label">Exp-Year</label>

                            <div class="col-sm-10"><input type="text" placeholder="Enter Exp Year" class="form-control"  name="expyear" id="expyear"></div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group"><label class="col-sm-2 control-label">cvv</label>

                            <div class="col-sm-10"><input type="text" placeholder="Enter cvv" class="form-control"  name="cvv" id="cvv"></div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group"><label class="col-sm-2 control-label">Amount</label>

                            <div class="col-sm-10"><input type="text" placeholder="Enter Amount" class="form-control"  name="amount" id="amount"></div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
<!--                                <a class="btn btn-white" href="--><?php //echo $this->config->base_url();?><!--stories/view">Cancel</a>-->
                                <button class="btn btn-primary" type="submit">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>