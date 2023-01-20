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

// check if the user is logged in
if (isset($_SESSION["user"]) && isset($_SESSION["user2"]) && isset($_SESSION["user3"])) {
    // Get the user from the session
    $user = unserialize($_SESSION["user"]);
    $user2 = unserialize($_SESSION["user2"]);
    $user3 = unserialize($_SESSION["user3"]);
    // Get the username
    echo json_encode([
            $user,
            $user2,
            $user3
        ]);
} else {
    echo json_encode("Not logged in");
}