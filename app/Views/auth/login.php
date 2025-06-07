<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= site_url() ?>">Discussion</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-4 offset-4">
                <h4>Login</h4>
                <hr>
                <?php if(!empty(session()->getFlashData('success'))) {
                    ?>
                        <div class="alert alert-success">
                            <?=
                                session()->getFlashData('success')
                            ?>
                        </div>
                    <?php
                } else if(!empty(session()->getFlashData('fail'))) {
                    ?>
                        <div class="alert alert-danger">
                            <?=
                                session()->getFlashData('fail')
                            ?>
                        </div>
                    <?php
                }
                ?>

                <?php if(!empty(session()->getFlashData('resetsuccess'))) { ?>
                    <div class="alert alert-info">
                            <?= session()->getFlashData('resetsuccess') ?>
                    </div>
                <?php } ?>

                <form action="<?= base_url('auth/loginUser') ?>" method="post" class="form mb-3">
                    <?php $validation = \Config\Services::validation(); ?>
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="">E-mail</label>
                        <input type="text" class="form-control"
                        name="email"
                        placeholder="Enter Your Email Here"
                        >
                        <span class="text-danger text-sm"><?= isset($validation) ? display_form_errors($validation, 'email') : "" ?></span>
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Password</label>
                        <input type="password" class="form-control"
                        name="password"
                        placeholder="Enter Your Password Here"
                        >
                        <span class="text-danger text-sm"><?= isset($validation) ? display_form_errors($validation, 'password') : "" ?></span>
                    </div>

                    <div class="form-group mb-3">
						<label class="float-left form-check-label"><input type="checkbox" name="remember"> Remember me</label>
						<a href="<?= base_url('auth/forgotpassword') ?>" class="float-right" style="margin-left: 140px;">Forgot Password?</a>
					</div>

                    <div class="form-group mb-3">
                        <input type="submit" class="btn btn-info"
                        value="Log in"
                        >
                    </div>
                </form>
                <br>
                <?php 
                    echo $googlebutton;
                ?>
                <br>
                <br>
                <a href="<?= site_url('auth/register') ?>">
                    Not yet have an account? Sign up here.
                </a>
            </div>
        </div>
    </div>
    
</body>
</html>