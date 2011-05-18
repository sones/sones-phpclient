<?php

class RestCredentials {

    private $Username;
    private $Password;

    public function __construct($Username, $Password) {
        $this->Password = $Password;
        $this->Username = $Username;
    }

    public function getUsername() {
        return $this->Username;
    }

    public function getPassword() {
        return $this->Password;
    }

}

?>
