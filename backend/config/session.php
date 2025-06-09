<?php

class Session
{
    private $signed_in = false;
    public $user_id;
    public $user_type; // Add this property

    function __construct()
    {
        // session_start();
        $this->check_login();
    }

    public function is_signed_in()
    {
        return $this->signed_in;
    }

    public function login($user, $user_type)
    {
        if ($user) {
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->user_type = $_SESSION['user_type'] = $user_type; // Store user type
            $this->signed_in = true;
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_type']); // Unset user type
        unset($this->user_id);
        unset($this->user_type);
        $this->signed_in = false;
    }

    private function check_login()
    {
        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->user_type = $_SESSION['user_type']; // Retrieve user type
            $this->signed_in = true;
        } else {
            unset($this->user_id);
            unset($this->user_type);
            $this->signed_in = false;
        }
    }
}



$session = new Session();
