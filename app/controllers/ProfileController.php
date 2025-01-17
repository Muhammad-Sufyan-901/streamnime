<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\UserModel;

class ProfileController extends BaseController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function profileView()
    {
        return $this->view('pages/profile/index', [
            'pageTitle' => 'Profile',
        ]);
    }

    public function updateProfile()
    {
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);

            $errors = [];

            if (empty($username)) {
                $errors[] = "Username cannot be empty.";
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format.";
            }

            if (!empty($errors)) {
                $_SESSION['flash_message'] = [
                    'type' => 'error',
                    'message' => $errors,
                ];

                $this->redirect('/profile');

                exit();
            }

            $user = $this->userModel->updateUser($_SESSION['user_id'], $username, $email);

            if ($user === "Email already exists") {
                $_SESSION['flash_message'] = [
                    'type' => 'error',
                    'message' => 'Email already registered.',
                ];

                $this->redirect('/profile');

                exit();
            }
            if ($user) {
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['flash_message'] = [
                    'type' => 'success',
                    'message' => 'Profile updated successfully.',
                ];
            } else {
                $_SESSION['flash_message'] = [
                    'type' => 'error',
                    'message' => 'Error occurred during profile update.',
                ];
            }

            $this->redirect('/profile');

            exit();
        }
    }
}
