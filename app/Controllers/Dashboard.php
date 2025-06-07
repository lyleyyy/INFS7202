<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index() {
        if (session()->has('loggedInUser')) {
        $userModel = model('App\Models\UserModel');
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);

        $data = [
            'title' => 'Dashboard',
            'userInfo' => $userInfo,
        ];

        return view('dashboard/index', $data);
    
        } else {
            echo "<h1>You must log in first.<h1>";
        }
    }

    // for user to upload their profile image
    public function uploadImage() {
        $loggedInUserId = session()->get('loggedInUser');

        $file = $this->request->getFile('userImage');
        $file->move(WRITEPATH . 'uploads');
        $filename = $file->getName();
        $model = model('App\Models\UserModel');
        $check = $model->upload($loggedInUserId, $filename);
        if ($check) {
            return redirect()->to('dashboard');
        } else {
            echo "upload failed!";
        }
    }

    // for render the page of update user email
    public function updateEmail() {
        return view('dashboard/update_email');
    }

    // for user to update their email
    public function updateEmailAction() {
        // validate the new email
        $validated = $this->validate([
            'email' => [
                'rules'  => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email is required.',
                    'valid_email' => 'Please check the Email field. It does not appear to be valid.',
                    'is_unique' => 'Email already taken.',
                ],
            ],
        ]);

        // if not pass the validation rule, then back to update_email page with validation indication.
        if(!$validated) {
            return view('dashboard/update_email', ['validation'=>$this->validator]);
        }

        // if pass the validation, then get the new email through post, 
        // and update into database, and then back to dashboard
        $email = $this->request->getPost('email');

        $data = [
            'email' => $email,
        ];

        $userModel = model('App\Models\UserModel');
        $loggedInUserId = session()->get('loggedInUser');
        $check = $userModel->updateEmail($loggedInUserId, $data);

        if($check) {
            return redirect()->to('/dashboard');
        } else {
            echo "update fail!";
        }
    }

    public function myFavorites() {
        $userModel = model('App\Models\UserModel');
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);
        $data = [
            'title' => 'My Favorite Questions',
            'userInfo' => $userInfo,
        ];

        $favoriteModel = model('App\Models\FavoriteModel');
        $questions = $favoriteModel->where('userid', $loggedInUserId)->findAll();
        // echo $questions;
        // foreach($questions as $question) {
        //     echo $question;
        // }
        
        return view('dashboard/my_favorites', ['data' => $data, 'questions' => $questions]);
    }

    public function removeFavorite() {
        $favoriteid = $this->request->getPost('favoriteid');
        $favoriteModel = model('App\Models\FavoriteModel');
        $favoriteModel->remove($favoriteid);

        return redirect()->to(base_url('dashboard/myfavorites'));
    }
}