<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");

    require_once '../database.php';
    require_once '../model/Conference.php';

    $database = new Database();

    $db = $database->dbConnect();
    $conf = new Conference($db);

    $method = $_SERVER['REQUEST_METHOD'];
    $path = explode('/', $_SERVER['REQUEST_URI']);

    switch($method){

        case "GET":
            $id = $path[3];
            if(isset($id) && is_numeric($id))
            {
                $data = $conf->getById($id);
                echo json_encode($data);
            }
            else
            {
                $data = $conf->getAll();
                echo json_encode($data);
            }
            break;

        case "POST":
            $post_data = json_decode(file_get_contents('php://input'));
            
            $stmt = $conf->post($post_data);

            if($stmt) 
            {
                $response = ['status' => 1, 'message' => 'Conference created successfully.'];
            } 
            else 
            {
                $response = ['status' => 0, 'message' => 'Failed to create conference.'];
            }

            echo json_encode($response);
            break;

        case "PUT":
            $update_data = json_decode(file_get_contents('php://input'));

            $current_data = $conf->getById($update_data->id);

            $stmt = $conf->update($current_data, $update_data);

            if($stmt) 
            {
                $response = ['status' => 1, 'message' => 'Conference updated successfully.'];
            } 
            else 
            {
                $response = ['status' => 0, 'message' => 'Failed to update conference.'];
            }

            echo json_encode($response);
            break;

        case "DELETE":
            $id = $path[3];
            $stmt = $conf->delete($id);

            if($stmt) 
            {
                $response = ['status' => 1, 'message' => 'Conference deleted successfully.'];
            } 
            else 
            {
                $response = ['status' => 0, 'message' => 'Failed to delete conference.'];
            }

            echo json_encode($response);
            break;
    }
?>