<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function loginView()
    {
        return $this->view('pages/auth/login', [
            'pageTitle' => 'Login',
        ]);
    }

    public function registerView()
    {
        return $this->view('pages/auth/register', [
            'pageTitle' => 'Register',
        ]);
    }

    public function processLogin()
    {
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            $errors = [];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format.";
            }
            if (empty($password)) {
                $errors[] = "Password cannot be empty.";
            }

            if (!empty($errors)) {
                $_SESSION['flash_message'] = [
                    'type' => 'error',
                    'message' => 'Invalid email or password.',
                ];

                $this->redirect('/login');

                exit();
            }


            $user = $this->userModel->loginUser($email, $password);

            if ($user) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['logged_in'] = true;

                $_SESSION['flash_message'] = [
                    'type' => 'success',
                    'message' => 'Login successful. Welcome!',
                ];

                $this->redirect('/profile');

                exit();
            }

            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Error occurred during login.',
            ];

            $this->redirect('/login');
        }
    }

    public function processRegister()
    {
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            $errors = [];

            if (empty($username)) {
                $errors[] = "Username cannot be empty.";
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format.";
            }

            if (empty($password)) {
                $errors[] = "Password cannot be empty.";
            }

            if (!empty($errors)) {
                $_SESSION['flash_message'] = [
                    'type' => 'error',
                    'message' => 'Invalid email or password.',
                ];

                $this->redirect('/register');

                exit();
            }

            $user = $this->userModel->createUser($username, $email, $password);

            if ($user === "Email already exists") {
                $_SESSION['flash_message'] = [
                    'type' => 'error',
                    'message' => 'Email already registered.',
                ];

                $this->redirect('/register');

                exit();
            }

            if ($user) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['logged_in'] = true;

                $_SESSION['flash_message'] = [
                    'type' => 'success',
                    'message' => 'Registration successful. Welcome!',
                ];

                $this->redirect('/profile');

                exit();
            }

            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Error occurred during registration.',
            ];

            $this->redirect('/register');
        }
    }
}
