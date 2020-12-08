<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temple Project</title>
</head>
<body>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }
        .addPoojaDiv {
            max-width: 500px;
            width: 500px;
            border: 0;
            border-radius: 10px;
            margin: 0 auto;
            padding: 20px;
            top: 150px;
            box-shadow: 1px 1px 3px 1px grey;
            margin-top: 120px;
        }
        button {
            background: rgb(89, 173, 89);
            cursor: pointer;
            border: 0;
            border-radius: 6px;
            padding: 10px;
            color: white;
            font-weight: bold;
        }
        .addPoojaDiv div {
            width: 100%;
            margin: 10px 0 10px 0;
        }

        .addPoojaDiv div input, .addPoojaDiv div label, .addPoojaDiv div select {
            width: 100%;
        }
        .addPoojaDiv div input, .addPoojaDiv div select {
            padding: 5px;
        }
        .showPoojas {
            margin: 0 auto;
            width: 60%;
            margin-top: 50px;
        }
        .showPoojas table {
            width: 100%;
            text-align: center;
        }
        tr:nth-child(even) {background-color: #f2f2f2;}
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <div class="main">
        <div class="addPoojaDiv">
            <h3>Add Material</h3>
            <form class="addPoojaForm" style="margin-top: 15px;">
                <div>
                    <label>Material Name</label>
                    <input type="text" class="materialName">
                </div>
                <div>
                    <label>Pooja Name</label>
                    <select class="poojaName"></select>
                </div>
                <div>
                    <label>Default Quantity</label>
                    <input type="number" class="defaultQuantity" value=0>
                </div>
                <div>
                    <button type="submit">Add Material</button>
                </div>
            </form>
        </div>
        <div class="showPoojas">
            <table class="poojasTable">
                <thead>
                    <tr>
                        <th>Sl. No.</th>
                        <th>Material Name</th>
                        <th>Pooja Name</th>
                        <th>Default Quanity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="poojaList">
                </tbody>
            </table>
        </div>
    </div>
</body>
<script>
    $.ajax({
        url: 'controllers/poojas.php',
        type: 'post',
        data: {
            action: 'getPoojas',
        }, beforeSend: function() {
            console.log('Getting Poojas');
        }, success: function(response) {
            if(JSON.parse(response).text === 'true') {
                const poojas = JSON.parse(response).data;
                poojas.forEach(pooja=>{
                    document.querySelector('.poojaName').innerHTML += `
                        <option value='${pooja.poojaName}'>${pooja.poojaName}</option>
                    `;
                })
            } else {
                console.log(JSON.parse(response))
            }
        }, error: function(error) {
            console.log(error);
        }
    })
    $.ajax({
        url: 'controllers/materials.php',
        type: 'post',
        data: {
            action: 'getMaterials',
        }, beforeSend: function() {
            console.log('Getting Materials');
        }, success: function(response) {
            if(JSON.parse(response).text === 'true') {
                const poojas = JSON.parse(response).data;
                var index = 1;
                poojas.forEach(pooja=>{
                    document.querySelector('.poojaList').innerHTML += `
                        <tr>
                            <td>${index}</td>
                            <td>${pooja.materialName}</td>
                            <td>${pooja.poojaName}</td>
                            <td>${pooja.defaultQuantity}</td>
                            <td><button onclick="deletePooja(${pooja.id})" style="background: red;">Delete</button></td>
                        </tr>
                    `;
                    index++;
                })
            } else {
                console.log(JSON.parse(response))
            }
        }, error: function(error) {
            console.log(error);
        }
    })
    document.querySelector('.addPoojaForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const materialName = document.querySelector('.materialName').value;
        const poojaName = document.querySelector('.poojaName').value;
        const defaultQuantity = document.querySelector('.defaultQuantity').value;
        $.ajax({
            url: 'controllers/materials.php',
            type: 'post',
            data: {
                action: 'addMaterial',
                poojaName: poojaName,
                materialName: materialName,
                defaultQuantity: defaultQuantity,
            }, beforeSend: function() {
                console.log("Adding Material");
            }, success: function(response) {
                console.log(response);
                if(JSON.parse(response).text === 'true') {
                    console.log(JSON.parse(response));
                    window.location.reload();
                }
            }, error: function(error) {
                console.log(error);
            }
        })
    })
    function deletePooja(id) {
        $.ajax({
            url: 'controllers/materials.php',
            type: 'post',
            data: {
                action: 'deleteMaterial',
                id: id
            }, beforeSend: function() {
                console.log("Deleting Material");
            }, success: function(response) {
                if(JSON.parse(response).text === 'true') {
                    console.log(JSON.parse(response));
                    window.location.reload();
                }
            }, error: function(error) {
                console.log(error);
            }
        })
    }
</script>
</html>