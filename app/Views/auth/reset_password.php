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
                <form action="<?= base_url('auth/resetvalidation') ?>" method="post" class="form mb-3">
                    <?php $validation = \Config\Services::validation(); ?>
                    <?= csrf_field(); ?>

                    <div class="form-group mb-3">
                        <label for="">New Password</label>
                        <input type="password" class="form-control"
                        name="password"
                        placeholder="Enter Your Password Here"
                        >
                        <span class="text-danger text-sm"><?= isset($validation) ? display_form_errors($validation, 'password') : "" ?></span>
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Confirm New Password</label>
                        <input type="password" class="form-control"
                        name="passwordConf"
                        placeholder="Enter Your Password Again Here"
                        >
                        <span class="text-danger text-sm"><?= isset($validation) ? display_form_errors($validation, 'passwordConf') : "" ?></span>
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Secret Question 1</label>
                        <p style="font-weight: bold;"><?= $user['q1'] ?></p>
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Answer</label>
                        <input type="text" class="form-control"
                        name="answer1"
                        value="<?= set_value('answer1'); ?>"
                        placeholder="Enter Your Answer Here"
                        >
                        <span class="text-danger text-sm"><?= isset($validation) ? display_form_errors($validation, 'answer1') : "" ?></span>
                    </div>

                    <?php if(!empty(session()->getFlashData('fail1'))) { ?>
                        <div class="alert alert-danger">
                            <?=
                                session()->getFlashData('fail1')
                            ?>
                        </div>
                    <?php } ?>

                    <div class="form-group mb-3">
                        <label for="">Secret Question 2</label>
                        <p style="font-weight: bold;"><?= $user['q2'] ?></p>
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Answer</label>
                        <input type="text" class="form-control"
                        name="answer2"
                        value="<?= set_value('answer2'); ?>"
                        placeholder="Enter Your Answer Here"
                        >
                        <span class="text-danger text-sm"><?= isset($validation) ? display_form_errors($validation, 'answer2') : "" ?></span>
                    </div>

                    <?php if(!empty(session()->getFlashData('fail2'))) { ?>
                        <div class="alert alert-danger">
                            <?=
                                session()->getFlashData('fail2')
                            ?>
                        </div>
                    <?php } ?>

                    <div class="form-group mb-3">
                        <input type="submit" class="btn btn-info"
                        value="Reset"
                        >
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>