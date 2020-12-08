<?php
    if(isset($_POST['action'])) {
        $con = mysqli_connect("localhost","root","Bagalkot@1","templeproj");
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }
        if($_POST['action'] === 'getMaterials') {
            $sql = "SELECT * FROM materials";
            $result = mysqli_query($con, $sql);
            $data = array();
            if (mysqli_num_rows($result) > 0) {
                $data['text'] = 'true';
                $data['data'] = array();
                while($row = mysqli_fetch_assoc($result)) {
                    array_push($data['data'], $row);
                }
                print_r(json_encode($data));
            } else {
                $data['text'] = 'false';
                print_r(json_encode($data));
            }      
        } else if($_POST['action'] === 'addMaterial') {
            $poojaName = $_POST['poojaName'];
            $materialName = $_POST['materialName'];
            $defaultQuantity = $_POST['defaultQuantity'];
            $sql = "INSERT INTO materials (materialName, poojaName, defaultQuantity) VALUES ('$materialName', '$poojaName', '$defaultQuantity')";
            $response = array();
            if ($con->query($sql) === TRUE) {
                $response['text'] = 'true';
                print_r(json_encode($response));
            } else {
                $response['text'] = 'false';
                print_r(json_encode($response));
            }
        } else if($_POST['action'] === 'deleteMaterial') {
            $id = $_POST['id'];
            $sql = "DELETE FROM materials WHERE id=$id";
            if ($con->query($sql) === TRUE) {
                $response = array('text' => 'true');
                echo json_encode($response);
            } else {
                $response = array('text' => 'false');
                $response['errorMessage'] = $con->error;
                echo json_encode($response);
            }      
        } else if($_POST['action'] === 'getMaterialsOfPooja') {
            $eventName = $_POST['eventName'];
            $sql = "SELECT * FROM materials WHERE poojaName='$eventName'";
            $result = mysqli_query($con, $sql);
            $data = array();
            if (mysqli_num_rows($result) > 0) {
                $data['text'] = 'true';
                $data['data'] = array();
                while($row = mysqli_fetch_assoc($result)) {
                    array_push($data['data'], $row);
                }
                print_r(json_encode($data));
            } else {
                $data['text'] = 'false';
                print_r(json_encode($data));
            }      
        }
    }
?>