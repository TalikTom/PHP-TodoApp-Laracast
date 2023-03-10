<?php

require 'Validator.php';

$config = require('config.php');
$db = new Database($config['database']);

$heading = 'Create note';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    //add errors array
    $errors = [];


;
    //check if textarea is empty, if it is empty push the error message into $errors array with key being 'body'
    if(! Validator::string($_POST['body'], 1, 500)) {
        $errors['body'] = 'A body of no more then 500 characters is required';
    }

    if(empty($errors))
    {
        $db->query('INSERT INTO notes(body, user_id) VALUES(:body, :user_id)', [
            'body' => $_POST['body'],
            'user_id' => 1,
        ]);
    }


}

require 'views/note-create.view.php';