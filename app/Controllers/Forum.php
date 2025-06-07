<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Forum extends BaseController
{
    // public function __construct() {
    //     helper(['url']);
    // }

    // for render the main forum page
    public function index() {
        // if already login then render main page, else then indicate to log in first.
        if (session()->has('loggedInUser')) {
            // for displaying user information
            $userModel = model('App\Models\UserModel');
            $loggedInUserId = session()->get('loggedInUser');
            $userInfo = $userModel->find($loggedInUserId);

            $data = [
                'title' => 'Discussion Forum',
                'userInfo' => $userInfo,
            ];

            // print_r($userInfo);
            // print_r($loggedInUserId)."///".$userInfo['id'];


            // for displaying questions
            $questionModel = model('App\Models\QuestionModel');
            $questions = $questionModel->findAll();

            // // user data, and questions will be pass to view, for further display
            return view('forum/index', ['data' => $data, 'questions' => $questions]);
        } else {
            echo "<h1>You must log in first.<h1>";
        }
    }

    // render question create page
    public function create() {
        // display user information
        $userModel = model('App\Models\UserModel');
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);

        $data = [
            'title' => 'Discussion Forum',
            'userInfo' => $userInfo,
        ];

        return view('forum/create', $data);
    }

    // save the created question into database
    public function store() {
        $questionModel = model('App\Models\QuestionModel');

        $userModel = model('App\Models\UserModel');
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);

        $data = [
            'userid'=> $loggedInUserId,
            'username' => $userInfo['name'],
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
        ];

        $query = $questionModel->insert($data);
        if(!$query) {
            return redirect('forum')->with('fail', 'Question post failed.');
        } else {
            return redirect('forum')->with('success', 'Question post success.');
        }
    }

    // use ajax for new question create and store into database
    public function ajaxStore() {
        $questionModel = model('App\Models\QuestionModel');

        $userModel = model('App\Models\UserModel');
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);

        $data = [
            'userid'=> $loggedInUserId,
            'username' => $userInfo['name'],
            'title' => $this->request->getPost('title'),
            'language' => $this->request->getPost('language'),
            'description' => $this->request->getPost('description'),
        ];
        
        $questionModel->insert($data);
        $data2 = ['status' => 'Successfully posted!'];
        return $this->response->setJSON($data2);
    }

    // use ajax to fetch questions data from database to display without reloading the page
    public function ajaxFetch() {
        $questionModel = model('App\Models\QuestionModel');
        $data['questions'] = $questionModel->findAll();
        return $this->response->setJSON($data);
    }

    // search box input autocompletion
    public function autoComplete() {
        $term = $this->request->getVar('term');
        $questionModel = model('App\Models\QuestionModel');
        $languages = $questionModel->like('language', $term, 'both')->findColumn('language');
        return $this->response->setJSON($languages);
    }

    // search questions by its programming language category
    public function search() {
        $language = strtolower($this->request->getPost('language'));
        $questionModel = model('App\Models\QuestionModel');
        $search_results = $questionModel->where('language', $language)->findAll();

        if ($search_results) {
            return view('forum/search_results', ['search_results' => $search_results]);
        } else {
            echo "Nothing found.";
        }
    }

    // navigate to question details page for specific question
    public function questionDetails() {
        $questionId = $this->request->getPost('questionid');
        session()->set('questionid', $questionId);
        // echo session()->get('questionid')."qwddwqdq";
        $questionModel = model('App\Models\QuestionModel');
        $question = $questionModel->where('id', $questionId)->find();
        // print_r($question);
        // print_r($questionId);
        return view("forum/question_details", ['question' => $question['0']]);
        // echo $question['0']['language'];
    }

    public function storeComment() {
        $commentModel = model('App\Models\CommentModel');

        $userModel = model('App\Models\UserModel');
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);

        $data = [
            'questionid'=> session()->get('questionid'),
            'userid'=> $loggedInUserId,
            'username' => $userInfo['name'],
            'comment' => $this->request->getPost('comment'),
        ];

        $commentModel->insert($data);
        $status = ['status' => 'Successfully posted!'];
        return $this->response->setJSON($status);
    }

    public function fetchComment() {
        $commentModel = model('App\Models\CommentModel');
        $questionId = session()->get('questionid');
        $data['comments'] = $commentModel->where('questionid', $questionId)->findAll();
        return $this->response->setJSON($data);
    }

    // render the study note page
    public function note() {
        if (session()->has('loggedInUser')) {
            // display user information
            $userModel = model('App\Models\UserModel');
            $loggedInUserId = session()->get('loggedInUser');
            $userInfo = $userModel->find($loggedInUserId);
    
            $data = [
                'title' => 'Discussion Forum',
                'userInfo' => $userInfo,
            ];
    
            // for displaying notes
            $noteModel = model('App\Models\NoteModel');
            $notes = $noteModel->findAll();
    
            return view('forum/note', ['data' => $data, 'notes' => $notes]);
            } else {
                echo "<h1>You must log in first.<h1>";
            }
    }

    // render the new note create page
    public function createNote() {
        return view('forum/create_note');
    }

    // upload and store the new note into database
    public function uploadNote() {
        $userModel = model('App\Models\UserModel');
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);

        $userid = $loggedInUserId;
        $username = $userInfo['name'];
        $title = $this->request->getPost('title');
        $language = $this->request->getPost('language');
        $description = $this->request->getPost('description');

        $file = $this->request->getFile('userfile');
        $file->move(WRITEPATH . 'uploads');
        $filename = $file->getName();

        $model = model('App\Models\NoteModel');
        $check = $model->upload($userid, $username, $title, $language, $description, $filename);
        if ($check) {
            return redirect('forum/note');
        } else {
            echo "fail!";
        }
    }

    // download study note
    public function download(){
        $id = $this->request->getGet('id');
        $noteModel = model('App\Models\NoteModel');
        $data = $noteModel->find($id);
        $path = ROOTPATH.'writable/uploads/'.$data['filename'];
        return $this->response->download($path, null);
	}

    // add to favorite
    public function addToFavorite() {
        $favoriteModel = model('App\Models\FavoriteModel');
        $loggedInUserId = session()->get('loggedInUser');
        $questionid = $this->request->getPost('questionid');

        $questionModel = model('App\Models\QuestionModel');
        $question = $questionModel->where('id', $questionid)->find();
        $title = $question['0']['title'];
        $questionusername = $question['0']['username'];
        $language = $question['0']['language'];
        

        $session = session();
        
        if ($favoriteModel->check($loggedInUserId, $questionid)) {
            // print_r($favoriteModel->check($loggedInUserId, $questionid));
            // $data = ['status' => "Already in My Favorites!", 'userid' => $loggedInUserId, 'qid'=> $questionid];
            $session->setFlashdata('status1', 'Already in My Favorites!');
            return redirect()->to(base_url('forum'));
        } else {
            $favoriteModel->add($loggedInUserId, $questionid, $title, $questionusername, $language);
            // $data = ['status' => 'Successfully added into My Favorites!'];
            $session->setFlashdata('status2', 'Successfully added into My Favorites!');
            return redirect()->to(base_url('forum'));
        }
        // $data = ['status' => $favoriteModel->check($loggedInUserId, $questionid)];
        // return $this->response->setJSON($data);
    }
}