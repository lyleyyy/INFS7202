<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" />
    <script src="<?= base_url('assets/js/jquery-3.5.1.js'); ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <!-- popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Dashboard</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= site_url() ?>">Discussion</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Navigation
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?= site_url('forum') ?>">Discussion Board</a></li>
                    <li><a class="dropdown-item" href="<?= site_url('forum/note') ?>">Study Notes Share</a></li>
                    <li><a class="dropdown-item" href="<?= site_url('dashboard') ?>">User Profile</a></li>
                    <li><a class="dropdown-item" href="<?= site_url('donation') ?>">Donate Us</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="<?= site_url('auth/logout'); ?>">Logout</a></li>
                </ul>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2">
                <h4><?= $title; ?></h4>
                <hr>
                <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">Profile Pic</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                    <th scope="col">Favorites</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">
                        <img src="writable/uploads/<?= $userInfo['avatar'] ?>" alt="" width="200px" height="150px">
                        <form action="<?= base_url('auth/uploadImage'); ?>"
                            method="post"
                            enctype="multipart/form-data">
                            <input type="file"
                                   class="form-control"
                                   name="userImage"
                                   size="10">
                            <hr>
                            <p>Image size should be no more than 2M</p>
                            <hr>
                            <input type="submit" value="Upload">
                        </form>
                    </th>
                    <td>
                        <?= $userInfo['name']; ?>
                    </td>
                    <td>
                        <?= $userInfo['email']; ?>
                    </td>
                    <td>
                        <a href="<?= site_url('dashboard/update_email'); ?>">Update Your Email</a>
                    </td>
                    <td>
                        <a href="<?= site_url('dashboard/myfavorites'); ?>">My Favorites</a>
                    </td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>
    
</body>
</html>