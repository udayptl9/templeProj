<?php
    if(isset($_POST['action'])) {
        $con = mysqli_connect("localhost","root","Bagalkot@1","templeproj");
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }
        if($_POST['action'] === 'getPoojas') {
            $sql = "SELECT * FROM poojas";
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
        } else if($_POST['action'] === 'addPooja') {
            $poojaName = $_POST['poojaName'];
            $sql = "INSERT INTO poojas (poojaName) VALUES ('$poojaName')";
            $response = array();
            if ($con->query($sql) === TRUE) {
                $response['text'] = 'true';
                print_r(json_encode($response));
            } else {
                $response['text'] = 'false';
                print_r(json_encode($response));
            }
        } else if($_POST['action'] === 'deletePooja') {
            $id = $_POST['id'];
            $sql = "DELETE FROM poojas WHERE id=$id";
            if ($con->query($sql) === TRUE) {
                $response = array('text' => 'true');
                echo json_encode($response);
            } else {
                $response = array('text' => 'false');
                $response['errorMessage'] = $con->error;
                echo json_encode($response);
            }      
        }
    }
?>