<?php

$config = require('config.php');
$db = new Database($config['database']);

$heading = 'Note';

$note = $db->query('select * from notes where id = :id', [
      'id' => $_GET['id']])->fetch();


// if there is no note under specific id number show 404(default for abort)
if (! $note) {
    abort(Response::NOT_FOUND);
}


// currently hard coding user, show 403 if user not matching
$currentUserId = 1;

if ($note['user_id'] !== $currentUserId) {
    abort(Response::FORBIDDEN);
}

require "views/note.view.php";