<?php 


class Auth extends DBConnection {
    private $user;
    public function __construct($user) {
        $this->user = $user;
    }

    public function user() {
        return $this->user;
    }
}

?>