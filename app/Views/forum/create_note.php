<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/datatables.bootstrap5.min.css" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <title>Post New Note</title>

    <!-- dropzone css style -->
    <style>
        .files input {
            outline: 2px dashed black;
            outline-offset: -10px;
            -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
            transition: outline-offset .15s ease-in-out, background-color .15s linear;
            padding: 120px 0px 85px 35%;
            text-align: center !important;
            margin: 0;
            width: 100% !important;
        }
        .files input:focus {     
            outline: 2px dashed #92b0b3;
            outline-offset: -10px;
            -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
            transition: outline-offset .15s ease-in-out, background-color .15s linear;
            border:1px solid #92b0b3;
        }
        .files{ 
            position:relative
        }
        .files:after {  pointer-events: none;
            position: absolute;
            top: 60px;
            left: 0;
            width: 50px;
            right: 0;
            height: 56px;
            display: block;
            margin: 0 auto;
            background-size: 100%;
            background-repeat: no-repeat;
        }
        .color input { 
            background-color:#f1f1f1;
        }
        .files:before {
            position: absolute;
            bottom: 10px;
            left: 0;  pointer-events: none;
            width: 100%;
            right: 0;
            height: 57px;
            content: " Choose a File or Drag it here. ";
            display: block;
            margin: 0 auto;
            color: black;
            font-weight: 600;
            text-transform: capitalize;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
             <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Post New Note
                            <a href="<?= site_url('forum/note') ?>" class="btn btn-danger btn-sm float-end">Back</a>
                        </h5>
                    </div>

                    <div class="card-body">
                        <form action="<?= base_url('forum/upload_note') ?>" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="forum-group mb-2">
                                        <label>Note Title</label>
                                        <input type="text" name="title" class="form-control" required placeholder="Enter Note Title">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="forum-group mb-2">
                                        <label>Programming Language</label>
                                        <input type="text" name="language" class="form-control" required placeholder="Enter Programming Language (e.g. python)">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="forum-group mb-2">
                                        <label>Note Description</label>
                                        <textarea style="height: 250px;" name="description" class="form-control" required placeholder="Enter Note Description"></textarea>
                                    </div>
                                </div>
              
                                <div class="form-group files">
                                    <label>Upload Your File (File size no more than 2M)</label>
                                    <input type="file" name="userfile" class="form-control" multiple="">
                                </div>

                                <div class="col-md-12">
                                    <hr>
                                    <button type="submit" class="btn btn-primary px-4 float-end">Upload</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
             </div>   
        </div>
    </div>
</body>
</html>