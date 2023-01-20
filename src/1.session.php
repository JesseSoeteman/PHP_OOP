<?php 

header("Content-Type: application/json");

session_start();

class User {
    public $username;
    public $name;
    public $email;
    private $id;

    public function __construct($username, $name, $email, $id) {
        $this->username = $username;
        $this->name = $name;
        $this->email = $email;
        $this->id = $id;
    }
}


// Create a new user
$user = new User("username", "name", "email", 1);

// Get the username
echo json_encode($user);

// save the user to the session
$_SESSION["user"] = serialize($user);
