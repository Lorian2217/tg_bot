<?php
$staticName = 'Данила';
$staticPost = 'test@test.com';

$name = htmlspecialchars($_POST['name'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');

$match = ($name === $staticName && $email === $staticPost);
?>