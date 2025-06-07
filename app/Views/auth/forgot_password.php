<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Password Reset</title>
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
                <h4>Password Reset</h4>
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
                <form action="<?= base_url('auth/resetpassword') ?>" method="post" class="form mb-3">
                    <?php $validation = \Config\Services::validation(); ?>
                    <?= csrf_field(); ?>
                    <div class="form-group mb-3">
                        <label for="">E-mail</label>
                        <input type="text" class="form-control"
                        name="email"
                        value="<?= set_value('email'); ?>"
                        placeholder="Enter Your Email Here"
                        >
                        <span class="text-danger text-sm"><?= isset($validation) ? display_form_errors($validation, 'email') : "" ?></span>
                    </div>

                    <div class="form-group mb-3">
                        <input type="submit" class="btn btn-info"
                        value="Next"
                        >
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>