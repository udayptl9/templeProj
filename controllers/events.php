<?php
    if(isset($_POST['action'])) {
        $con = mysqli_connect("localhost","root","Bagalkot@1","templeproj");
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }
        if($_POST['action'] === 'getEvents') {
            $dateEvent = $_POST['date'];
            $sql = "SELECT * FROM events WHERE eventDate='$dateEvent'";
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
        } else if($_POST['action'] === 'addEvent'){
            $devoteeName = $_POST['devoteeName'];
            $devoteePhoneNumber = $_POST['devoteePhoneNumber'];
            $devoteeAddress = $_POST['devoteeAddress'];
            $eventName = $_POST['eventName'];
            $eventDate = $_POST['eventDate'];
            $eventTime = $_POST['eventTime'];
            $amountPaid = $_POST['amountPaid'];
            $modeOfPayment = $_POST['modeOfPayment'];
            $materials = $_POST['materials'];
            $sql = "INSERT INTO events (devoteeName, devoteePhoneNumber, devoteeAddress, eventName, materials, eventDate, eventTime, amountPaid, modeOfPayment)
            VALUES ('$devoteeName', '$devoteePhoneNumber', '$devoteeAddress', '$eventName', '$materials', '$eventDate', '$eventTime', '$amountPaid', '$modeOfPayment')";
            $response = array();
            $response['text'] = 'true';
            if ($con->query($sql) === TRUE) {
                $response['data'] = "New record created successfully";
            } else {
                $response['text'] = 'false';
                $response['data'] = "Error: " . $sql . "<br>" . $con->error;
            }
            print_r(json_encode($response));
        } else if($_POST['action'] === 'deleteEvent') {
            $id = $_POST['id'];
            $sql = "DELETE FROM events WHERE id=$id";
            if ($con->query($sql) === TRUE) {
                $response = array('text' => 'true');
                print_r(json_encode($response));
            } else {
                $response = array('text' => 'false');
                $response['errorMessage'] = $con->error;
                print_r(json_encode($response));
            }              
        } else if($_POST['action'] === 'updateEvent') {
            $id = $_POST['id'];
            $devoteeName = $_POST['devoteeName'];
            $devoteePhoneNumber = $_POST['devoteePhoneNumber'];
            $devoteeAddress = $_POST['devoteeAddress'];
            $eventName = $_POST['eventName'];
            $eventDate = $_POST['eventDate'];
            $eventTime = $_POST['eventTime'];
            $amountPaid = $_POST['amountPaid'];
            $modeOfPayment = $_POST['modeOfPayment'];
            $materials = $_POST['materials'];
            $sql = "UPDATE events SET devoteeName='$devoteeName', devoteePhoneNumber='$devoteePhoneNumber', devoteeAddress='$devoteeAddress', eventName='$eventName',materials='$materials', eventDate='$eventDate', eventTime='$eventTime', amountPaid='$amountPaid', modeOfPayment='$modeOfPayment' WHERE id=$id";
            if ($con->query($sql) === TRUE) {
                $response = array('text' => 'true');
                print_r(json_encode($response));
            } else {
                $response = array('text' => 'false');
                $response['errorMessage'] = $con->error;
                print_r(json_encode($response));
            }      
        } else if($_POST['action'] === 'getMonthEvents') {
            $month = $_POST['month'];
            $year = $_POST['year'];
            $monthYear = strval($month). "/" . strval($year);
            $sql = "SELECT * FROM events WHERE eventDate LIKE '%$monthYear'";
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
                $data['monthYear'] = $monthYear;
                print_r(json_encode($data));
            }       
        } else if($_POST['action'] === 'addCeremony') {
            $customerName = $_POST['customerName'];
            $customerPhoneNumber = $_POST['customerPhoneNumber'];
            $ceremonyType = $_POST['ceremonyType'];
            $ceremonyDate = $_POST['ceremonyDate'];
            $peopleGathering = $_POST['peopleGathering'];
            $accomodationRequired = $_POST['accomodationRequired'];
            $amountPaid = $_POST['amountPaid'];
            $modeOfPayment = $_POST['modeOfPayment'];
            $sql = "INSERT INTO ceremonies (customerName, phoneNumber, ceremonyType, ceremonyDate, peopleGathering, accomodationRequired, amountPaid, modeOfPayment)
            VALUES ('$customerName', '$customerPhoneNumber', '$ceremonyType', '$ceremonyDate', '$peopleGathering', '$accomodationRequired', '$amountPaid', '$modeOfPayment')";
            $response = array();
            $response['text'] = 'true';
            if ($con->query($sql) === TRUE) {
                $response['data'] = "New record created successfully";
            } else {
                $response['text'] = 'false';
                $response['data'] = "Error: " . $sql . "<br>" . $con->error;
            }
            print_r(json_encode($response));
        } else if($_POST['action'] === 'getMonthCeremonies') {
            $month = $_POST['month'];
            $year = $_POST['year'];
            $monthYear = strval($month). "/" . strval($year);
            $sql = "SELECT * FROM ceremonies WHERE ceremonyDate LIKE '%$monthYear'";
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
                $data['monthYear'] = $monthYear;
                print_r(json_encode($data));
            }       
        } else if($_POST['action'] === 'getCeremonies') {
            $dateEvent = $_POST['date'];
            $sql = "SELECT * FROM ceremonies WHERE ceremonyDate='$dateEvent'";
            $result = mysqli_query($con, $sql);
            $data = array();
            if (mysqli_num_rows($result) > 0) {
                $data['text'] = 'true';
                $data['data'] = array();
                $date['date'] = $dateEvent;
                while($row = mysqli_fetch_assoc($result)) {
                    array_push($data['data'], $row);
                }
                print_r(json_encode($data));
            } else {
                $data['text'] = 'false';
                print_r(json_encode($data));
            }      
        } else if($_POST['action'] === 'deleteCeremony') {
            $id = $_POST['id'];
            $sql = "DELETE FROM ceremonies WHERE id=$id";
            if ($con->query($sql) === TRUE) {
                $response = array('text' => 'true');
                print_r(json_encode($response));
            } else {
                $response = array('text' => 'false');
                $response['errorMessage'] = $con->error;
                print_r(json_encode($response));
            }              
        } else if($_POST['action'] === 'updateCeremony') {
            $id = $_POST['id'];
            $customerName = $_POST['customerName'];
            $customerPhoneNumber = $_POST['customerPhoneNumber'];
            $ceremonyType = $_POST['ceremonyType'];
            $ceremonyDate = $_POST['ceremonyDate'];
            $peopleGathering = $_POST['peopleGathering'];
            $accomodationRequired = $_POST['accomodationRequired'];
            $amountPaid = $_POST['amountPaid'];
            $modeOfPayment = $_POST['modeOfPayment'];
            $sql = "UPDATE ceremonies SET customerName='$customerName', phoneNumber='$customerPhoneNumber', ceremonyType='$ceremonyType', ceremonyDate='$ceremonyDate',peopleGathering='$peopleGathering', accomodationRequired='$accomodationRequired', amountPaid='$amountPaid', modeOfPayment='$modeOfPayment' WHERE id=$id";
            if ($con->query($sql) === TRUE) {
                $response = array('text' => 'true');
                print_r(json_encode($response));
            } else {
                $response = array('text' => 'false');
                $response['errorMessage'] = $con->error;
                print_r(json_encode($response));
            }      
        }
    }
?>