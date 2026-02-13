<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

header('Content-Type: application/json');

// Получаем данные из POST
$input = json_decode(file_get_contents('php://input'), true);

if (empty($input)) {
    http_response_code(400);
    echo json_encode(['error' => 'Нет данных для обработки']);
    exit;
}

if (isset($input['action']) && $input['action'] === 'register')
{
    unset($input['action']);
    $result = insertData($input);
} else {
    $result = ['status' => 'ignored', 'message' => 'Действие не поддерживается'];
}

function getDbConnection() {
    $servername = "localhost";
    $username = "cw809330_test";
    $password = "uzhBMnT7";
    $dbname   = "cw809330_test";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Соединение не удалось: " . mysqli_connect_error());
    }

    return $conn;
}

function insertData($data) {
    $conn = getDbConnection();

    $fields = implode(', ', array_keys($data));
    $placeholders = implode(', ', array_fill(0, count($data), '?'));

    $stmt = mysqli_prepare($conn, 
        "INSERT INTO user_data ($fields) VALUES ($placeholders)"
    );

    $types = str_repeat('s', count($data));
    mysqli_stmt_bind_param($stmt, $types, ...array_values($data));

    $success = mysqli_stmt_execute($stmt);
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
    return $success;
}

function getData($table, $fields = '*', $where = '') {
    $conn = getDbConnection();

    $query = "SELECT $fields FROM $table";
    if (!empty($where)) {
        $query .= " WHERE $where";
    }

    $result = mysqli_query($conn, $query);
    $data = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }

    mysqli_close($conn);
    return $data;
}

function updateData($table, $data, $where) {
    $conn = getDbConnection();

    $updates = [];
    foreach ($data as $field => $value) {
        $updates[] = "$field = '" . mysqli_real_escape_string($conn, $value) . "'";
    }
    $updateStr = implode(', ', $updates);

    $query = "UPDATE $table SET $updateStr WHERE $where";

    $success = mysqli_query($conn, $query);

    mysqli_close($conn);
    return $success;
}
?>