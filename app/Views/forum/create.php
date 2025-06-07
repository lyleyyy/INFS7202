<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/datatables.bootstrap5.min.css" />
    <title>Discussion Forum</title>
</head>
<body>    
<div class="container">
        <div class="row">
            <div class="col-md-8 offset-2">
                <h4><?= $title; ?></h4>
                <hr>
                <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>
                        <?= $userInfo['name']; ?>
                    </td>
                    <td>
                        <?= $userInfo['email']; ?>
                    </td>
                    <td>
                        <a href="<?= site_url('auth/logout'); ?>">Logout</a>
                    </td>
                    </tr>
                </tbody>
                </table>
                <?php if(!empty(session()->getFlashData('notification'))) {
                    ?>
                        <div class="alert alert-info">
                            <?=
                                session()->getFlashData('notification')
                            ?>
                        </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row justify-content-center">
             <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Post New Question
                            <a href="<?= site_url('forum') ?>" class="btn btn-danger btn-sm float-end">Back</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('forum/store') ?>" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="forum-group mb-2">
                                        <label>Question Title</label>
                                        <input type="text" name="title" class="form-control" required placeholder="Enter Question Title">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="forum-group mb-2">
                                        <label>Description</label>
                                        <textarea style="height: 250px;" name="description" class="form-control" required placeholder="Enter Description"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <hr>
                                    <button type="submit" class="btn btn-primary px-4 float-end">Post</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
             </div>   
        </div>
    </div>
</body>
</html> -->