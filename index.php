<?php
require_once "connection.php";

if (function_exists($_GET['function'])) {
    $_GET['function']();
}

function get_user()
{
    global $connect;      
    $query = $connect->query("SELECT * FROM user_data");  

    while ($row = mysqli_fetch_object($query))
    {
        $data[] = $row;
    }

    $response = [
        'status' => 1,
        'message' =>'Success',
        'data' => $data
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
}

function get_user_id()
{
    global $connect;
    if (!empty($_GET["id"])) {
        $id = $_GET["id"];      
    }

    $query = "SELECT * FROM user_data WHERE id = $id";      
    $result = $connect->query($query);
    while($row = mysqli_fetch_object($result))
    {
        $data[] = $row;
    }

    if($data) {
        $response = [
            'status' => 1,
            'message' =>'Success',
            'data' => $data
        ];               
    } else {
        $response = [
            'status' => 0,
            'message' =>'No Data Found'
        ];
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
    
}

function store_user()
{
    global $connect;   
    $check = [
        'id' => '',
        'name' => '',
        'gender' => '',
        'nickname' => '',
        'server' => '',
        'idgame' => '',
    ];

    $check_match = count(array_intersect_key($_POST, $check));
    if ($check_match == count($check)) {
        $result = mysqli_query($connect, "INSERT INTO user_data SET
        id = '$_POST[id]',
        name = '$_POST[name]',
        gender = '$_POST[gender]',
        nickname = '$_POST[nickname]',
        server = '$_POST[server]',
        idgame = '$_POST[idgame]'");

        if ($result) {
            $response = [
                'status' => 1,
                'message' =>'Insert Success'
            ];
        } else {
            $response = [
                'status' => 0,
                'message' =>'Insert Failed.'
            ];
        }
    } else {
        $response = [
            'status' => 0,
            'message' =>'Wrong Parameter'
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

function update_user()
{
    global $connect;
    if (!empty($_GET["id"])) {
        $id = $_GET["id"];      
    }   

    $check = ['name' => '', 'gender' => '', 'nickname' => ''];
    $check_match = count(array_intersect_key($_POST, $check));    

    if ($check_match == count($check)) {

        $result = mysqli_query($connect, "UPDATE user_data SET               
        name = '$_POST[name]',
        gender = '$_POST[gender]',
        nickname = '$_POST[nickname]',
        server = '$_POST[server]',
        idgame = '$_POST[idgame]' WHERE id = $id");    
    
        if ($result) {
            $response = [
                'status' => 1,
                'message' =>'Update Success'                  
            ];
        } else {
            $response = [
                'status' => 0,
                'message' =>'Update Failed'                  
            ];
        }
    } else {
        $response = [
            'status' => 0,
            'message' =>'Wrong Parameter',
            'data'=> $id
        ];
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function delete_user()
{
    global $connect;
    $id = $_GET['id'];
    $query = "DELETE FROM user_data WHERE id=".$id;
    if (mysqli_query($connect, $query)) {
        $response = [
            'status' => 1,
            'message' =>'Delete Success'
        ];
    } else {
        $response = [
            'status' => 0,
            'message' => 'Delete Fail.'
        ];
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}