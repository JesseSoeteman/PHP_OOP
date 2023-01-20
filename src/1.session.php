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
$user2 = new User("username2", "name2", "email2", 2);
$user3 = new User("username3", "name3", "email3", 3);

// Get the username
echo json_encode([
    $user,
    $user2,
    $user3
]);

// save the user to the session
$_SESSION["user"] = serialize($user);
$_SESSION["user2"] = serialize($user2);
$_SESSION["user3"] = serialize($user3);
