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
    
    .account-block .register, .account-block .login {
        background-color: #fff;
        text-align: center;
        width: 80%;
        margin: auto;
        padding: 4rem;
    }
    
    .account-block .register h5, .account-block .login h5 {
        margin-bottom: 2rem;
    }
</style>

<section class="account-section">
    <div class="container account-inner">
        <div class="account-block">
            <div class="col-md-6" style="margin:auto;">
                <div class="register">
                    <h5>Instamojo</h5>
                    
                    <?php if($message){ ?>
                        <h3><?php echo $message; ?></h3>
                    <?php } else { ?>
                        <h3>Redirecting...</h3>
                    <?php } ?>
                    
                </div>
            </div>
        </div>
    </div>
</section>