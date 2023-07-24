<?php declare(strict_types = 1);

class User {
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $regDate;

    function __construct($id = NULL, $firstName, $lastName, $email = NULL, $regDate = NULL) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->regDate = $regDate;
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getRegDate() {
        return $this->regDate;
    }

    public function setRegDate($regDate) {
        $this->regDate = $regDate;
    }
}

?>