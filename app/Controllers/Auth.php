<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Libraries\Hash;

class Auth extends BaseController
{
    private function initGoogleClient() {
        require_once APPPATH."Libraries/vendor/autoload.php";
        $googleClient = new \Google\Client();
        $googleClient->setClientId(getenv('GOOGLE_CLIENT_ID'));
        $googleClient->setClientSecret(getenv('GOOGLE_CLIENT_SECRET'));
        $googleClient->setRedirectUri(getenv('GOOGLE_REDIRECT_URI'));
        $googleClient->addScope("email");
        $googleClient->addScope("profile");
        return $googleClient;
    }

    // render the login page
    public function index() {
        if (isset($_COOKIE['id'])) {
            session()->set('loggedInUser', $_COOKIE['id']);
            return redirect()->to('/dashboard');
        } else {
            $googleClient = $this->initGoogleClient();
            $data['googlebutton'] = '<a href="'.$googleClient->createAuthUrl().'"><img src ="https://onymos.com/wp-content/uploads/2020/10/google-signin-button.png" alt="Login with Google" style="width: 100%; height: 20%;"></a>';
            return view("auth/login", $data);
        }
    }


    public function loginWithGoogle() {
        $googleClient = $this->initGoogleClient();

        $token = $googleClient->fetchAccessTokenWithAuthCode($this->request->getVar('code'));
        if (!isset($token['error'])) {
            $googleClient->setAccessToken($token['access_token']);
            session()->set("AccessToken", $token['access_token']);

            $googleService = new \Google\Service\Oauth2($googleClient);
            $data = $googleService->userinfo->get();

            $userdata = array();
            $userModel = model('App\Models\UserModel');
            $userid = intdiv(intval($data['id']), 1000);

            if ($userModel->isAlreadyRegister($userid)) {
                $userdata = [
                    'name' => $data['givenName']." ".$data['familyName'],
                    'email' => $data['email'],
                    'avatar' => $data['picture'],
                ];

                $userModel->updateUser($userdata, $userid);
            } else {
                $userdata = [
                    'id' => $userid,
                    'name' => $data['givenName']." ".$data['familyName'],
                    'email' => $data['email'],
                    'avatar' => $data['picture'],
                    'created_at' => date("Y-m-d H:i:s"),
                ];

                $userModel->insertUser($userdata);
            }

            session()->set("loggedInUser", $userid);
            return redirect()->to('/forum');

        } else {
            session()->set('Error', "Sorry, login with Google went wrong.");
            return redirect()->to(base_url());
        }
    }

    // render the register page
    public function register() {
        return view("auth/register");
    }

    // for register new user
    public function registerUser() {
        // set the validation rules
        $validated = $this->validate([
            'name' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'You name is required.',
                ],
            ],
            'email' => [
                'rules'  => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email is required.',
                    'valid_email' => 'Please check the Email field. It does not appear to be valid.',
                    'is_unique' => 'Email already taken.',
                ],
            ],
            'password' => [
                'rules'  => 'required|min_length[5]|max_length[20]',
                'errors' => [
                    'required' => 'Password is required.',
                    'min_length' => 'Password must have atleast 6 characters in length.',
                    'max_length' => 'Password must not have characters more thant 18 in length.',
                ],
            ],
            'passwordConf' => [
                'rules'  => 'required|matches[password]',
                'errors' => [
                    'required' => 'Confirm password is required.',
                    'matches' => 'Confirm Password must matches to password.',
                ],
            ],

            'answer1' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Answer is required.',
                ],
            ],

            'answer2' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Answer is required.',
                ],
            ],
        ]);

        // if can not pass the validation, then prompt the indication.
        if(!$validated) {
            return view('auth/register', ['validation'=>$this->validator]);
        }

        // if pass, then save this new user into database
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $passwordConf = $this->request->getPost('passwordConf');
        $q1 = $this->request->getPost('squestion1');
        $a1 = $this->request->getPost('answer1');
        $q2 = $this->request->getPost('squestion2');
        $a2 = $this->request->getPost('answer2');

        $data = [
            'name' => $name,
            'email' => $email,
            // password will be hashed as encryption
            'password' => Hash::encrypt($password),
            'q1' => $q1,
            'a1' => $a1,
            'q2' => $q2,
            'a2' => $a2,
        ];

        $userModel = model('App\Models\UserModel');
        $query = $userModel->insert($data);
        if(!$query) {
            return redirect()->back()->with('fail', 'Saving user failed.');
        } else {
            return redirect()->back()->with('success', 'User added success.');
        }
    }

    // forgot password
    public function forgotPassword() {
        return view('auth/forgot_password.php');
    }

    // reset password
    public function resetPassword() {
        $email = $this->request->getPost('email');
        $userModel = model('App\Models\UserModel');
        $user = $userModel->where('email', $email)->find();
        $user = $user['0'];
        session()->set('userforreset', $user);
        // print_r(session()->get('userforreset'));
        return view('auth/reset_password.php', ['user' => $user]);
    }

    // resetValidation
    public function resetValidation() {
        $validated = $this->validate([
            'password' => [
                'rules'  => 'required|min_length[5]|max_length[20]',
                'errors' => [
                    'required' => 'Password is required.',
                    'min_length' => 'Password must have atleast 6 characters in length.',
                    'max_length' => 'Password must not have characters more thant 18 in length.',
                ],
            ],
            'passwordConf' => [
                'rules'  => 'required|matches[password]',
                'errors' => [
                    'required' => 'Confirm password is required.',
                    'matches' => 'Confirm Password must matches to password.',
                ],
            ],

            'answer1' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Answer is required.',
                ],
            ],

            'answer2' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Answer is required.',
                ],
            ],
        ]);

        // if can not pass the validation, then prompt the indication.
        if(!$validated) {
            $user = session()->get('userforreset');
            return view('auth/reset_password', ['validation'=>$this->validator, 'user'=> $user]);
        }

        // if pass, then update this new user password into database
        $user = session()->get('userforreset');
        $password = $this->request->getPost('password');
        $passwordConf = $this->request->getPost('passwordConf');
        $a1 = $this->request->getPost('answer1');
        $a2 = $this->request->getPost('answer2');
        $session = session();
        // echo $user['a1']."//".$a1."++++++".$user['a2']."//".$a2;
        $session->remove('fail1');
        $session->remove('fail2');
        // print_r($session->get('fail1')."//".$session->get('fail2'));

        if($a1 != $user['a1'] and $a2 != $user['a2']) {
            $session->setFlashdata('fail1', 'Answer Not Correct!');
            $session->setFlashdata('fail2', 'Answer Not Correct!');
            return view('auth/reset_password', ['user'=> $user]);
        } else if ($a1 != $user['a1'] and $a2 == $user['a2']) {
            $session->setFlashdata('fail1', 'Answer Not Correct!');
            return view('auth/reset_password', ['user'=> $user]);
        } else if ($a1 == $user['a1'] and $a2 != $user['a2']) {
            $session->setFlashdata('fail2', 'Answer Not Correct!');
            return view('auth/reset_password', ['user'=> $user]);
        }

        // password will be hashed as encryption
        $userdata = [
            'password' => Hash::encrypt($password)
        ];
        $userid = $user['id'];

        $userModel = model('App\Models\UserModel');
        $userModel->changePassword($userdata, $userid);
        $session->setFlashdata('resetsuccess', 'Password Reset Successful!');
        return redirect()->to(base_url('auth'));
    }

    // for user log in
    public function loginUser() {
        // validation rules for login
        $validated = $this->validate([
            'email' => [
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required' => 'Email is required.',
                    'valid_email' => 'Please check the Email field. It does not appear to be valid.',
                ],
            ],
            'password' => [
                'rules'  => 'required|min_length[6]|max_length[18]',
                'errors' => [
                    'required' => 'Password is required.',
                    'min_length' => 'Password must have atleast 6 characters in length.',
                    'max_length' => 'Password must not have characters more thant 18 in length.',
                ],
            ],
        ]);

        // if can not pass the validation, then prompt with indication.
        if(!$validated) {
            return view('auth/login', ['validation'=>$this->validator]);
        } else {
            // if pass the validation, then verify input with user data in database
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            // for cookies to store email and password, if user tick the 'remember me'
            $if_remember = $this->request->getPost('remember');
            
            $userModel = model('App\Models\UserModel');
            $userInfo = $userModel->where('email', $email)->first();
            if(!$userInfo) {
                echo "<h1>Email Not Found.</h1>";
                return "";
            }
            // Hash function to verify the password
            $checkPassword = Hash::check($password, $userInfo['password']);

            if (!$checkPassword) {
                // if the password is incorrect, then do this
                session()->setFlashdata('fail', 'Incorrect Password.');
                return redirect()->to('auth');
            } else {
                // if the password is correct, then go to dashboard
                $userId = $userInfo['id'];
                // for setting cookie, if user tick the 'remember me'
                if ($if_remember) {
                    setcookie('id', $userId, time() + (86400/24), "/");
                    // setcookie('email', $email, time() + (86400/24), "/");
                    // setcookie('password', $password, time() + (86400/24), "/");
                }
                session()->set('loggedInUser', $userId);
                return redirect()->to('/forum');
            }
        }
    }

    // for user to log out
    public function logout() {
        $session = session();
        $session->destroy();
        //destroy the cookie
        setcookie('id', '', time() - 3600, "/");
        return redirect()->to('/');
    }

}