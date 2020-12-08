<?php
    require_once('dompdf/autoload.inc.php');
    use Dompdf\Dompdf;
    if(isset($_GET['action'])) {
        if($_GET['action'] === 'createPDF') {
            $devoteeName = $_GET['devoteeName'];
            $devoteePhoneNumber = $_GET['devoteePhoneNumber'];
            $devoteeAddress = $_GET['devoteeAddress'];
            $eventName = $_GET['eventName'];
            $eventDate = $_GET['eventDate'];
            $eventTime = $_GET['eventTime'];
            $amountPaid = $_GET['amountPaid'];
            $modeOfPayment = $_GET['modeOfPayment'];
            $materials = json_decode($_GET['materials']);

            $dompdf = new Dompdf();
            $html = '<html>
            <head></head>
            <body>
            <style>
                body {
                    border: 1px solid black;
                    padding: 8px;
                }
                h2 {
                    text-align: center;
                    padding: 5px;
                }
            </style>
            <div>
                <h2>Receipt</h2>
            <div>
            <div>
                Devotee Name: '.$devoteeName.'
            <div>
            <div>
                Devotee Phone Number: '.$devoteePhoneNumber.'
            <div>
            <div>
                Devotee Address: '.$devoteeAddress.'
            <div>
            <div>
                Event Name: '.$eventName.'
            <div>
            <div>
                Event Date: '.$eventDate.'
            <div>
            <div>
                Event Time: '.$eventTime.'
            <div>
            <div>
                Amount Paid: '.$amountPaid.'
            </div>
            <div>
                Mode Of Payment: '.$modeOfPayment.'
            <div>
            Materials: 
            <table style="width: 100%; text-align: center; border-collapse: collapse;" border=1>
            <thead>
                <tr>
                    <th>Sl. No.</th>
                    <th>Material</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>';
            $index = 1;
            foreach($materials as $material) {
                $html = $html.'<tr>
                    <td>'.$index.'</td>
                    <td>'.$material->materialName.'</td>
                    <td>'.$material->materialQuantity.'</td>
                </tr>';
                $index++;
            }
            $html = $html.'</tbody>
                </table>
                </body>
            </html>';
            $dompdf->loadHtml($html); 
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream('receipt', array('Attachment'=>0));
        } else if($_GET['action'] === 'createCeremony'){
            $customerName = $_GET['customerName'];
            $phoneNumber = $_GET['phoneNumber'];
            $ceremonyType = $_GET['ceremonyType'];
            $ceremonyDate = $_GET['ceremonyDate'];
            $peopleGathering = $_GET['peopleGathering'];
            $accomodationRequired = $_GET['accomodationRequired'];
            $accReq = ($accomodationRequired) ? 'Yes' : 'No';
            $amountPaid = $_GET['amountPaid'];
            $modeOfPayment = $_GET['modeOfPayment'];
            $dompdf = new Dompdf();
            $html = '<html>
            <head></head>
            <body>
            <style>
                body {
                    border: 1px solid black;
                    padding: 8px;
                }
                h2 {
                    text-align: center;
                    padding: 5px;
                }
            </style>
            <div>
                <h2>Receipt</h2>
            <div>
            <div>
                Customer Name: '.$customerName.'
            <div>
            <div>
                Phone Number: '.$phoneNumber.'
            </div>
            <div>
                Ceremony Type: '.$ceremonyType.'
            <div>
            <div>
                Ceremony Date: '.$ceremonyDate.'
            <div>
            <div>
                People Gathering: '.$peopleGathering.'
            <div>
            <div>
                Accomodation Required: '.$accReq.'
            <div>
            <div>
                Amount Paid: '.$amountPaid.'
            </div>
            <div>
                Mode Of Payment: '.$modeOfPayment.'
            <div>
            </body>
            </html>';
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream('receipt', array('Attachment'=>0));
        }
    }
?>