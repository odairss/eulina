<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of email
 *
 * @author odair
 */
class email {

    private $idemail;
    private $email;

    function getIdemail() {
        return $this->idemail;
    }

    function getEmail() {
        return $this->email;
    }

    function setIdemail($idemail) {
        $this->idemail = $idemail;
    }

    function setEmail($email) {
        $this->email = $email;
    }

}
