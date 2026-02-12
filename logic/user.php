<?php

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

function insertData($table, $data) {
    $conn = getDbConnection();

    $fields = implode(', ', array_keys($data));
    $values = implode("', '", array_map('mysqli_real_escape_string', $conn, $data));

    $query = "INSERT INTO user_data ($fields) VALUES ('$values')";

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