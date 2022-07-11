<style>
    body {
        background-color: #f3f8f9;
    }

    .bg-white {
        background-color: #fff;
    }

    .account-section {
        margin-top: 90px;
        margin-bottom: 90px;
    }

    .account-section .account-block {
        display: flex;
        align-items: center;
    }

    .account-block .response,
    .account-block .login {
        background-color: #fff;
        text-align: center;
        width: 80%;
        margin: auto;
        padding: 4rem;
    }

    .account-block .response h5,
    .account-block .login h5 {
        margin-bottom: 2rem;
    }

    .response .message p {
        font-size: 2rem;
        line-height: 1.4;
    }

    .green-shadow {
        box-shadow: 0 0 30px rgba(60, 118, 61, 0.6);
    }

    .red-shadow {
        box-shadow: 0 0 30px rgba(169, 68, 66, 0.6);
    }

    .blue-shadow {
        box-shadow: 0 0 30px rgba(49, 112, 143, 0.6);
    }
</style>

<!-- Menubar -->
<?php include APPPATH . 'views/company/include/menubar.php'; ?>
<!-- Menubar End -->
<div class="section-default-header"></div>

<?php

if ($status == 'Credit') {
    $response_class = 'green-shadow';
    $success = true;
} elseif ($status == 'Failed') {
    $response_class = 'red-shadow';
    $success = false;
} else {
    $response_class = 'blue-shadow';
    $success = false;
}
?>
<section class="account-section padding-top-60 padding-bottom-60">
    <div class="container account-inner">
        <div class="account-block">
            <div class="col-md-6" style="margin:auto;">
                <div class="mb-4 response <?php echo $response_class ?>">
                    <h5>Payment</h5>

                    <?php if ($message) { ?>
                        <h4 class="message"><?php echo $message; ?></h4>
                    <?php } else { ?>
                        <a href="<?php echo $redirect_link; ?>" class="button_fat">Account</a>
                    <?php } ?>

                </div>
                <!-- <div class="text-center">
                    <a href="<?php echo $redirect_link; ?>" class="button-default small-sm primary-bg white-text">Go to Job</a>
                </div> -->

            </div>
        </div>
    </div>
</section>

<script>
    $(function() {
        setTimeout(function() {
            window.location.href = "<?php echo $redirect_link; ?>";
        }, 10000);
    });
</script>