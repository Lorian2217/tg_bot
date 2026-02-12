<?php
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
    $result = insertData($input);
} else {
    $result = ['status' => 'ignored', 'message' => 'Действие не поддерживается'];
}

function getDbConnection() {
    $servername = "localhost";
    $username = "cw809330";
    $password = "uzhBMnT7";
    $dbname   = "cw809330_test";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Соединение не удалось: " . mysqli_connect_error());
    }

    return $conn;
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

function insertData($data) {
    $conn = getDbConnection();

    $fields = implode(', ', array_keys($data));
    $values = implode("', '", array_map('mysqli_real_escape_string', $conn, $data));

    $query = "INSERT INTO user_data (username, tg_id, phone) VALUES ('$values')";

    $success = mysqli_query($conn, $query);

    mysqli_close($conn);
    return $success;
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