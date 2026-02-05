<?php
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$botToken = $_ENV['TOKEN'];

// Получаем данные из формы (пример для POST)
$name = htmlspecialchars($_POST['name'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');
$message = htmlspecialchars($_POST['message'] ?? '');
$chatId = $_POST['chat_id'] ?? '';

if (empty($chatId)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'chatId не передан']);
    exit;
}

// Формируем сообщение
$text = "Новая заявка:\n\n";
$text .= "Имя: $name\n";
$text .= "Email: $email\n";
$text .= "Сообщение: $message";

// Отправляем в Telegram
$url = "https://api.telegram.org/bot$botToken/sendMessage";
$data = [
    'chat_id' => $chatId,
    'text' => $text,
    'parse_mode' => 'HTML'
];

$options = [
    'http' => [
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ],
];
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

// Ответ клиенту
if ($result === FALSE) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Ошибка отправки в Telegram']);
} else {
    echo json_encode(['success' => true]);
}
?>