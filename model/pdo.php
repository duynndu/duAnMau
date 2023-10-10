<?php
$conn = null;
try {
    $conn = new PDO('mysql:host=localhost;dbname=shoestore', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    echo 'Kết nối thất bại ' . $e->getMessage() . '<br>';
}
function getDataBy($table, $data)
{
    foreach ($data as $key => $value) {
        $data[$key] = $key . "='" . $value . "'";
    }
    $data = implode(" AND ", $data);
    $sql = "SELECT * FROM ${table} WHERE ${data}";
    return query($sql)->fetch();
}

function getAll($table, $orderBy, $limit,$where='')
{
    $orderBy = $orderBy ?? ['id ASC'];
    $limit = $limit ?? 15;
    $orderBy = implode(",", $orderBy);
    $sql = "SELECT * FROM ${table} ${where} ORDER BY ${orderBy} LIMIT ${limit}";
    return query($sql)->fetchAll();
}

function addData($table, $data)
{
    foreach ($data as $key => $value) {
        $data[$key] = "'" . $value . "'";
    }
    $cols = implode(",", array_keys($data));
    $values = implode(",", array_values($data));
    $sql = "INSERT INTO ${table} (${cols}) VALUES (${values})";
    return query($sql)->rowCount();
}
function addDataReturnId($table, $data)
{
    global $conn;
    foreach ($data as $key => $value) {
        $data[$key] = "'" . $value . "'";
    }
    $cols = implode(",", array_keys($data));
    $values = implode(",", array_values($data));
    $sql = "INSERT INTO ${table} (${cols}) VALUES (${values})";
    query($sql);
    return $conn->lastInsertId();
}

function updateData($table, $data, $id)
{
    foreach ($data as $key => $value) {
        $data[$key] = $key . "='" . $value . "'";
    }
    $data = implode(",", $data);
    $sql = "UPDATE ${table} SET ${data} WHERE id=${id}";
    return query($sql)->rowCount();
}

function deleteData($table, $id)
{
    $sql = "DELETE FROM ${table} WHERE id=${id}";
    return query($sql)->rowCount();
}

function query($sql)
{
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt;
}


function getAllDataBy($table,$select,$join,$where,$orderBy,$limit=15){
    $select=$select??['*'];
    $join=$join??'';
    $where=$where??'';
    $orderBy = $orderBy ?? ['id ASC'];
    $select=implode(',',$select);
    $orderBy = implode(",", $orderBy);
    $sql = "
    SELECT ${select} FROM ${table} ${join} ${where} 
    ORDER BY ${orderBy} LIMIT ${limit}";
    return query($sql)->fetchAll();
}

function statistical(){
    $sql="SELECT brands.id AS brand_id,brands.name AS brand_name,MIN(shoes.price) AS min,MAX(shoes.price) AS max,AVG(shoes.price) AS avg,COUNT(shoes.name) AS count
        FROM brands
        JOIN shoes ON 	brands.id=shoes.brand_id
        GROUP BY brands.name
        ORDER BY brands.id";
    return query($sql)->fetchAll();
}


?>
