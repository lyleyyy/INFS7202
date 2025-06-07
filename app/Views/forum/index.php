<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" />
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/datatables.bootstrap5.min.css" /> -->
    <!-- auto complete -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" />
    
    <script src="<?= base_url('assets/js/jquery-3.5.1.js'); ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <!-- popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- auto complete -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script>
        // catch the item with id'keyword' for autocompletion function
        $(function() {
            $("#keyword").autocomplete({
                source: "<?= site_url('forum/autocomplete') ?>",
            });
        });
    </script>

    <title>Discussion Forum</title>
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
            <form action="<?= base_url('forum/search_results') ?>" method="post" class="d-flex" role="search">
                <input class="form-control me-2" id="keyword" name="language" type="search" placeholder="Search by Language..." aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2">
                <h4><?= $data['title']; ?></h4>
                <hr>
                <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <!-- <th scope="col">Action</th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>
                        <?= $data['userInfo']['name']; ?>
                    </td>
                    <td>
                        <?= $data['userInfo']['email']; ?>
                    </td>
                    </tr>
                </tbody>
                </table>
                <?php if(!empty(session()->getFlashData('status1'))) {?>
                    <div class="alert alert-danger">
                        <?=
                            session()->getFlashData('status1')
                        ?>
                    </div>
                <?php } elseif(!empty(session()->getFlashData('status2'))) { ?>
                    <div class="alert alert-info">
                        <?=
                            session()->getFlashData('status2')
                        ?>
                    </div>
                <?php } else { ?>
                <?php }?>
                
            </div>
        </div>
    </div>
    
    <div class="container mt-4">
        <div class="row">
             <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Questions
                            <!-- abandoned -->
                            <!-- <a href="<?= site_url('forum/create') ?>" class="btn btn-primary btn-sm float-end">Add</a>
                            <br>
                            <br> -->
                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#questionModal">POST</button>
                        </h5>
                    </div>

                    <!-- Modal for above ADD buttion -->
                    <div class="modal fade" id="questionModal" tabindex="-1" aria-labelledby="questionModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="questionModalLabel">New Question Post</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- here comes the form -->
                                <div class="form-group">
                                    <label>Question Title</label> <span id="error_name" class="text-danger ms-3"></span>
                                    <input type="text" class="form-control title" placeholder="Enter the Title">
                                </div>

                                <div class="form-group">
                                    <label>Programming Language</label> <span id="error_language" class="text-danger ms-3"></span>
                                    <input type="text" class="form-control language" placeholder="Enter the Programming Language (e.g. python)">
                                </div>

                                <div class="form-group">
                                    <label>Question Description</label> <span id="error_description" class="text-danger ms-3"></span>
                                    <!-- <input type="text" class="form-control description" placeholder="Enter the Title"> -->
                                    <textarea style="height: 250px;" class="form-control description" placeholder="Enter the Description"></textarea>
                                </div>

                                <!-- <div class="form-group">
                                    <label>Attachement (if any)</label>
                                    <input type="file" class="form-control file">
                                </div> -->
                            <!-- <input type="submit" value="Upload"> -->

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary ajaxquestion-post">Post</button>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered" id="mydatatable">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>User</th>
                                    <th>Date&Time</th>
                                    <th>Programming Language</th>
                                    <th>Question Description</th>
                                    <th>Action</th>
                                    <th>Add to Favorite</th>
                                    <!-- <th>Attachment</th> -->
                                </tr>
                            </thead>
                            <tbody class="questiondata">
                            </tbody>
                            <tbody>
                                <!-- abandoned -->
                                <!-- here temporary comment out-->
                                <!-- <?php foreach($questions as $question) : ?>
                                <tr>
                                    <td><?= $question['title'] ?></td>
                                    <td><?= $question['username'] ?></td>
                                    <td><?= $question['created_at'] ?></td>
                                    <td><?= $question['description'] ?></td>
                                    <td><a href="" class="btn btn-success btn-sm">Answer</td>
                                </tr>
                                <?php endforeach; ?> -->
                            </tbody>
                        </table>
                    </div>
                </div>
             </div>   
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // console.log("qdwqdwdwqd");
            loadQuestion();
        });

        function loadQuestion() {
            $.ajax({
                method: "GET",
                url: "forum/ajaxfetch",
                success: function (response) {
                    // console.log(response.questions);
                    // here the key is the index of array, the value is that value under the index
                    $.each(response.questions, function(key, value) {
                        // console.log(value['title']);
                        // console.log(value['username']);
                        // console.log(value['created_at']);
                        // console.log(value['description']);
                        // <a href="#" class="badge btn-info view_btn">VIEW</a>\
                        // <td>\
                        //     <a href=<?= base_url("forum/download") ?>><input type ="hidden" name="questionid" value=\ "' + value['id'] + '" /><button class="btn btn-success btn-sm">DOWNLOAD</button></a>\
                        // </td>\
                        $('.questiondata').append('<tr>\
                        <td>' + value['title'] + '</td>\
                        <td>' + value['username'] + '</td>\
                        <td>' + value['created_at'] + '</td>\
                        <td>' + value['language'] + '</td>\
                        <td>' + value['description'] + '</td>\
                        <td>\
                            <form action=<?= base_url("forum/question_details") ?> method="post">\
                            <input type ="hidden" name="questionid" value=\ "' + value['id'] + '" />\
                            <button class="btn btn-success btn-sm">VIEW</button></form>\
                        </td>\
                        <td>\
                            <form action=<?= base_url("forum/addtofavorite") ?> method="post">\
                            <input type ="hidden" name="questionid" class="questionid" value=\ "' + value['id'] + '" />\
                            <button class="btn btn-danger btn-sm ajaxfavorite">Favorite</button></form>\
                        </td>\
                        </tr>');
                    });
                }
            });
        }
    </script>

    <script>
        $(document).ready(function () {
            $(document).on('click', '.ajaxquestion-post', function() {
                // alert("Hello!!!!!!!!!!");
                if($.trim($('.title').val()).length == 0) {
                    error_name = 'Please enter the title.';
                    $('#error_name').text(error_name);
                } else {
                    error_name = '';
                    $('#error_name').text(error_name);
                }

                if($.trim($('.language').val()).length == 0) {
                    error_language = 'Please enter the language.';
                    $('#error_language').text(error_language);
                } else {
                    error_language = '';
                    $('#error_language').text(error_language);
                }

                if($.trim($('.description').val()).length == 0) {
                    error_description = 'Please enter the description.';
                    $('#error_description').text(error_description);
                } else {
                    error_description = '';
                    $('#error_description').text(error_description);
                }

                if(error_name != '' || error_description != '' || error_language != '') {
                    return false;
                } else {
                    var data = {
                            'title': $('.title').val(),
                            'language': $('.language').val(),
                            'description': $('.description').val(),
                            // 'file': $('.file').val(),
                    };

                    $.ajax({
                        method: "POST",
                        // OMG! do not use /forum/ajaxstore!
                        url: "forum/ajaxstore",
                        data: data,
                        success: function (response) {
                            // console.log("aaaaa");
                            // console.log(response);
                            $('#questionModal').modal('hide');
                            $('#questionModal').find('input').val('');
                            alert("Successfully posted!");
                            $('.questiondata').html("");
                            loadQuestion();
                            // alertify.set('notifier', 'position', 'top-right');
                            // alertify.success(response.status);
                        }
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $(document).on('click', '.ajaxfavorite', function() {
                // var data = {
                //             'questionid': $('.questionid').val(),
                // };

                // alert($('.questionid').val());

                $.ajax({
                    method: "POST",
                    // OMG! do not use /forum/ajaxstore!
                    url: "forum/addtofavorite",
                    // data: data,
                    success: function (response) {
                        // console.log("aaaaa");
                        // console.log(response.status);
                        // console.log(response.userid);
                        // console.log(response.qid);
                        alert("Successfully posted!");
                    }
                });
            });
        });
    </script>   
</body>
</html>