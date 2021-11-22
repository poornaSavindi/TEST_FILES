<?php

namespace Ijdb\controllers;

class Register{

   private $authorsTable;

   public function __construct(\Ninja\DataBaseTable $authorsTable){
     $this->authorsTable = $authorsTable;
   }

   public function registerUser(){
     $author = $_POST['author'];

      // Assume the data is valid to begin with
      $valid = true;
      $errors = [];
      // But if any of the fields have been left blank
      // set $valid to false
      if (empty($author['authorname'])) {
        $valid = false;
        $errors[] = 'Name cannot be blank';
      }
      if (empty($author['authoremail'])) {
        $valid = false;
        $errors[] = 'Email cannot be blank';
      }
      else if (filter_var($author['authoremail'],FILTER_VALIDATE_EMAIL) == false) {
        $valid = false;
        $errors[] = 'Invalid email address';
        }
      else { // If the email is not blank and valid:convert the email to lowercase
        $author['authoremail'] = strtolower($author['authoremail']);
      // Search for the lowercase version of $author['email']
        if (count($this->authorsTable->find('authoremail', $author['authoremail'])) > 0) {
          $valid = false;
          $errors[] = 'That email address is already registered';
        }
      }
      if (empty($author['password'])) {
        $valid = false;
        $errors[] = 'Password cannot be blank';
      }
      // If $valid is still true, no fields were blank
      // and the data can be added
      if ($valid == true) {
      // When submitted, the $author variable now contains a
      // lowercase value for email
        $author['password'] =password_hash($author['password'],PASSWORD_DEFAULT);

        $this->authorsTable->save($author);
        header('Location: /author/success');
      } else {
      // If the data is not valid, show the form again
        return ['template' => 'register.html.php',
                'title' => 'Register an account',
                'variables' => ['errors' => $errors,'author' => $author]];
      }
    }


   public function displayForm(){
     return ['template' => 'Register.html.php','title' => 'Register an account'];
   }

   public function success(){
     return ['template' => 'registersuccess.html.php','title' => 'Registration Successful'];
   }
}
