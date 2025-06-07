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
    
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <script src="<?= base_url('assets/js/jquery-3.5.1.js'); ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <!-- popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

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
            </div>
        </div>
    </nav>

    <div class="card" style="width: 50rem; margin: 200px; margin-top: 100px; margin-left: 450px;">
        <div class="card-body">
            <h3 class="card-title">Title</h3>
            <p class="card-text"><?= $question['title'] ?></p>
        </div>

        <div class="card-body">
            <h5 class="card-title">User, Language & Date</h5>
            <p class="card-text"><?= $question['username'].",   ".$question['language'].",   ".$question['created_at'] ?></p>
        </div>

        <div class="card-body">
            <h5 class="card-title">Description</h5>
            <p class="card-text"><?= $question['description'] ?></p>
        </div>
        <!-- <div class="card-body">
            <h5 class="card-title">Attachment</h5>
            <img src="..." class="card-img-top" alt="Question Attachment (if any)">
        </div> -->
        <hr>
        <div class="card-body">
            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#questionModal">POST</button>
            <h5 class="card-title">Comments</h5>
            <br>
            <table class="table table-bordered">
                <tbody class="commentdata">
                </tbody>
            </table>
        </div>

        <!-- Modal for above ADD buttion -->
        <div class="modal fade" id="questionModal" tabindex="-1" aria-labelledby="questionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="questionModalLabel">New Comment Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- here comes the form -->
                    <div class="form-group">
                        <label>Leave Your Comment</label> <span id="error_comment" class="text-danger ms-3"></span>
                        <!-- <input type="text" class="form-control description" placeholder="Enter the Title"> -->
                        <textarea style="height: 250px;" class="form-control comment" placeholder="Enter the Comment Here"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary ajaxquestion-post">Post</button>
                </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // console.log("qdwqdwdwqdlyle");
            loadComment();
        });

        function loadComment() {
            $.ajax({
                method: "GET",
                url: "question_details/fetchcomment",
                success: function (response) {
                    // console.log(response.comments);
                    // here the key is the index of array, the value is that value under the index
                    $.each(response.comments, function(key, value) {
                        console.log(value['username']);
                        console.log(value['created_at']);
                        console.log(value['comment']);
                        $('.commentdata').append('<tr>\
                        <td>' + value['username'] + '</td>\
                        <td>' + value['created_at'] + '</td>\
                        <td>' + value['comment'] + '</td>\
                        <br>\
                        </tr>');
                    });
                }
            });
        }
    </script>

    <script>
        $(document).ready(function () {
            $(document).on('click', '.ajaxquestion-post', function() {

                if($.trim($('.comment').val()).length == 0) {
                    error_comment = 'Please enter the comment.';
                    $('#error_comment').text(error_comment);
                } else {
                    error_comment = '';
                    $('#error_comment').text(error_comment);
                }
                // alert("Hello!");

                if(error_comment != '') {
                    return false;
                } else {
                    var data = {
                            'comment': $('.comment').val(),
                    };
                    // alert("Hello!!!");

                    $.ajax({
                        method: "POST",
                        // OMG! do not use /forum/ajaxstore!
                        url: "question_details/storecomment",
                        data: data,
                        success: function (response) {
                            // console.log("aaaaa");
                            // console.log(response);
                            $('#questionModal').modal('hide');
                            $('#questionModal').find('textarea').val('');
                            alert("Successfully posted!");
                            $('.commentdata').html("");
                            loadComment();
                            // alertify.set('notifier', 'position', 'top-right');
                            // alertify.success(response.status);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>