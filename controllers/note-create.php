<?php

require 'Validator.php';

$config = require('config.php');
$db = new Database($config['database']);

$heading = 'Create note';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    //add errors array
    $errors = [];

    $validator = new Validator()
;
    //check if textarea is empty, if it is empty push the error message into $errors array with key being 'body'
    if($validator->string($_POST['body'])) {
        $errors['body'] = 'A body of text is required';
    }

    if(strlen($_POST['body']) > 500) {
        $errors['body'] = 'Your note can\'t have more then 500 characters';
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