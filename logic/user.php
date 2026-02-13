<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

if (empty($input)) {
    http_response_code(400);
    echo json_encode(['error' => 'Нет данных для обработки']);
    exit;
}

if (isset($input['action'])) 
{
    switch ($input['action']) {
        case 'register':
            unset($input['action']);
            $result = insertData($input);
            break;
        case 'update':
            unset($input['action']);
            $result = updateData($input);
            break;
        
        default:
            $result = ['status' => 'ignored', 'message' => 'Действие не поддерживается'];
            break;
    }
}

// if (isset($input['action']) && $input['action'] === 'register')
// {
//     unset($input['action']);
//     $result = insertData($input);
// } else {
//     $result = ['status' => 'ignored', 'message' => 'Действие не поддерживается'];
// }

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

function updateData($data) {
    $conn = getDbConnection();

    $id = $data['tg_id'];
    unset($data['tg_id']);

    $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);
    $escapedJsonData = mysqli_real_escape_string($conn, $jsonData);

    $stmt = mysqli_prepare($conn, "UPDATE user_data SET datas = '$escapedJsonData' WHERE tg_id = $id");

    if (!$stmt) {
        throw new RuntimeException('Failed to prepare statement: ' . mysqli_error($conn));
    }

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
?>