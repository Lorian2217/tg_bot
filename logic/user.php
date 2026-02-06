<?php
$staticName = 'Данила';
$staticPost = 'test@test.com';

$name = htmlspecialchars($_POST['name'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');

$match = ($name === $staticName && $email === $staticPost);

if ($match == false) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Такой пользователь не найден!']);
} else {
    echo json_encode(['success' => true]);
}
?>