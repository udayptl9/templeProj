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
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <style>
        table td {
            background: white;
        }
        .calendarTable td:hover {
            transform: scale(1.08);
        }
        .main {
            display: grid;
            grid-template-columns: 100% 0%;
            height: 100vh;
            grid-template-areas: "dates dayView";
        }
        .calendar {
            margin: 15px;
        }
        .selected {
            background: lightblue;
        }
        .calendar .day {
            padding: 15px;
            border: 0;
            box-shadow: 1px 1px 3px 1px grey;
            min-height: 100px;
            border-radius: 5px;
            text-align: left;
            vertical-align: top;
            cursor: pointer;
        }
        .calendar div {
            text-align: center;
        }
        .calendar .days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
        }
        .main .dayView {
            background: rgba(139, 139, 139, 0.5);
            padding: 15px;
            position: relative;
            width: 100%;
            bottom: 0;
            right: 0;
            top: 0;
            grid-area: dayView;
            display: none;
        }
        .dayEvents div, .dayCeremonies div {
            background: white;
            color: black;
            padding: 5px;
            border-radius: 8px;
            margin-bottom: 5px;
            position: relative;
        }
        .dayEvents {
            max-height: 40vh;
            overflow-y: auto;
        }
        .dayCeremonies {
            max-height: 40vh;
            overflow-y: auto;
        }
        .dayDetail {
            display: inline;
        }
        .dayDetail h4 {
            display: inline;
        }
        .addEvent {
            width: 40vw;
            z-index: 2;
            position: fixed;
            background: white;
            left: 0;
            right: 0;
            top: 30px;
            border: 0;
            box-shadow: 1px 1px 3px 1px grey;
            border-radius: 10px;
            margin: 0 auto;
            transform: scale(0);
        }
        
        .addEvent .divTitle {
            background: rgb(223, 214, 214);
            border-radius: 5px;
            height: 40px;
            text-align: center;
            color: black;
            font-weight: bold;
            font-size: 30px;
        }
        .addEvent .eventType {
            display: grid;
            grid-template-columns: 50% 50%;
        }
        .addEvent .eventType div {
            padding: 5px;
            background: greenyellow;
            margin: 5px;
            cursor: pointer;
            text-align: center;
        }
        .eventForms {
            padding: 15px;
            max-height: 80vh;
            overflow-y: auto;
        }
        .card-header {
            margin-top: 15px;
        }
        .poojaForm form div {
            width: 100%;
            margin: 8px;
            margin-top: 15px;
        }
        .poojaForm input, .poojaForm label, .poojaForm select{
            width: 98%;
        }
        .poojaForm input, .poojaForm select {
            height: 30px;
            border: 0;
            border-bottom: 1px solid black;
        }
        .ceremonyForm form div {
            width: 100%;
            margin: 8px;
            margin-top: 15px;
        }
        .calendarTable {
            max-width: 80%;
            margin: 0 auto;
        }
        .ceremonyForm input, .ceremonyForm label, .ceremonyForm select{
            width: 98%;
        }
        .ceremonyForm input, .ceremonyForm select {
            height: 30px;
            border: 0;
            border-bottom: 1px solid black;
        }
        button {
            background: rgb(190, 173, 202);
            border: 0;
            padding: 10px;
            cursor: pointer;
        }
        .addEventClose {
            padding: 5px;
            height: 30px;
            top: 5px;
            font-size: 15px;
            font-weight: 100;
            background: white;
            opacity: 0.5;
            position: absolute;
            right: 5px;
            cursor: pointer;
        }

        .addEventTrigger {
            position: absolute;
            bottom: 15px;
        }

        .addEventTrigger button{
            min-width: 100px !important;
            border: 0;
            border-radius: 5px;
        }
        
        .dayViewClose {
            position: absolute;
            top: 15px;
            right: 15px;
            opacity: 0.5;
            background: white;
            padding: 10px;
            cursor: pointer;
        }

        .addEventIn {
            transition: 0.2s;
            transform: scale(1);
        }

        .addEventOut {
            transition: 0.2s;
            transform: scale(0);
        }

        @keyframes addEventAnimation {
            from {transform: scale(0);}
            to {transform: scale(1);}
        }

        .calendarTable td, .calendarTable th {
            max-width: 1px;
        }

        .showDayIn {
            transition: 0.2s;
            grid-template-columns: 70% 30%;
        }

        .showDayOut {
            transition: 0.2s;
            grid-template-columns: 100% 0%;
        }

        @keyframes showDayDetails {
            from {grid-template-columns: 100% 0%;}
            to {grid-template-columns: 70% 30%;}
        }
        .screen {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: black;
            opacity: 0.5;
            display: none;
            z-index: 2;
        }
        table {
            width: 100%;
        }
        .calendar select {
            width: 80px;
            height: 30px;
        }
        .calendarTable tr {
            height: 100px;
        }
        .today {
            background: rgb(104, 104, 212);
            color: white;
            font-weight: bold;
        }

        .materialTable {
            width: 100%;
            max-height: 100px;
            overflow-y: auto;
        }

        .tableTd {
            margin: 5px;
            border-radius: 5px;
            box-shadow: 1px 1px 3px 1px grey;
        }
        .delete {
            cursor: pointer;
            background: red;
            color: white;
            font-weight: bold;
            border: 0;
            border-radius: 4px;
            position: absolute;
            right: 10px;
            bottom: 10px;
        }
        .update {
            cursor: pointer;
            background: blue;
            color: white;
            font-weight: bold;
            border: 0;
            border-radius: 4px;
            position: absolute;
            right: 80px;
            bottom: 10px;
        }
        .eventFirstLetter {
            border: 0;
            border-radius: 50%;
            background: wheat;
            width: 25px;
            padding: 5px;
            display: inline;
        }
        .ceremonyFirstLetter {
            border: 0;
            border-radius: 50%;
            background: rgb(113, 233, 183);
            width: 25px;
            padding: 5px;
            display: inline;
        }
        .materialsDisplay td, .materialsDisplay th {
            border: 1px solid black;
            padding: 5px;
        }

        .materialsDisplay {
            border: 1px solid black;
            width: 100%;
            border-collapse: collapse;
        }
        .printReceipt {
            border: 0;
            background: blue;
            border-radius: 5px;
            color: white;
            font-weight: bold;
        }
    </style>
    <div class="screen"></div>
    <div class="addEvent">
        <div class="divTitle">Add Event</div><span class="addEventClose">X</span>
        <div class="eventType">
            <div class="eventFormToggle">Event</div>
            <div class="ceremonyFormToggle">Ceremony</div>
        </div>
        <div class="eventForms">
            <div class="poojaForm">
                <form class="poojaFormData" action="controllers/addevent.php">
                    <input type="text" class="eventId" style="display: none;">
                    <div>
                        <label>Devotee Name</label>
                        <input type="text" class="customerName">
                    </div>
                    <div>
                        <label>Devotee Mobile Number</label>
                        <input type="text" class="customerNumber">
                    </div>
                    <div>
                        <label>Devotee Address</label>
                        <input type="text" class="customerAddress">
                    </div>
                    <div>
                        <label>Event Name</label>
                        <select name="eventName" class="eventName">
                        </select>
                    </div>
                    <div>
                        <label>Materials</label>
                        <table class="materialTable">
                            <tbody class="materials">
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <label>Event Date</label>
                        <input type="text" value="" class="eventDate" disabled>
                    </div>
                    <div>
                        <label>Event Time</label>
                        <input type="time" class="eventTime">
                    </div>
                    <div>
                        <label>Amount Paid</label>
                        <input type="number" class="amountPaid">
                    </div>
                    <div>
                        <label>Mode of Payment</label>
                        <select name="modeOfPayment" class="modeOfPayment">
                            <option value="Cash">Cash</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Online Payment">Online Payment</option>
                        </select>
                    </div>
                    <div>
                        <button class="submitButton" type="submit">Add Event</button>
                    </div>
                </form>
            </div>
            <div class="ceremonyForm" style="display: none;">
                <form action="addEvent.php" class="ceremonyFormData">
                    <input type="text" class="ceremonyEventId" style="display: none;">
                    <div>
                        <label>Customer Name</label>
                        <input type="text" class="ceremonyCustomerName">
                    </div>
                    <div>
                        <label>Customer Mobile Number</label>
                        <input type="number" class="ceremonyCustomerPhoneNumber">
                    </div>
                    <div>
                        <label>Ceremony Type</label>
                        <select class="ceremonyType">
                            <option value="Marriage">Marriage</option>
                            <option value="Engagement">Engagement</option>
                        </select>
                    </div>
                    <div>
                        <label>Date</label>
                        <input type="text" class="ceremonyDate" disabled>
                    </div>
                    <div>
                        <label>People Gathering</label>
                        <input type="text" class="ceremonyPeopleGathering">
                    </div>
                    <div>
                        <label>Accomodation Required</label>
                        <input type="checkbox" class="accomodationRequired">
                    </div>
                    <div>
                        <label>Amount Paid</label>
                        <input type="number" class="ceremonyAmountPaid">
                    </div>
                    <div>
                        <label>Mode of Payment</label>
                        <select name="ceremonyModeOfPayment" class="ceremonyModeOfPayment">
                            <option value="Cash">Cash</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Online Payment">Online Payment</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="ceremonySubmitButton">Add Ceremony</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="calendar">
            <div class="container col-sm-4 col-md-7 col-lg-4 mt-5">
                <div class="card">
                    <form class="form-inline">
                        <label class="lead mr-2 ml-2" for="month">Jump To: </label>
                        <select class="form-control col-sm-4" name="month" id="month" onchange="jump()">
                            <option value=0>Jan</option>
                            <option value=1>Feb</option>
                            <option value=2>Mar</option>
                            <option value=3>Apr</option>
                            <option value=4>May</option>
                            <option value=5>Jun</option>
                            <option value=6>Jul</option>
                            <option value=7>Aug</option>
                            <option value=8>Sep</option>
                            <option value=9>Oct</option>
                            <option value=10>Nov</option>
                            <option value=11>Dec</option>
                        </select>
            
            
                        <label for="year"></label><select class="form-control col-sm-4" name="year" id="year" onchange="jump()">
                        <option value=1990>1990</option>
                        <option value=1991>1991</option>
                        <option value=1992>1992</option>
                        <option value=1993>1993</option>
                        <option value=1994>1994</option>
                        <option value=1995>1995</option>
                        <option value=1996>1996</option>
                        <option value=1997>1997</option>
                        <option value=1998>1998</option>
                        <option value=1999>1999</option>
                        <option value=2000>2000</option>
                        <option value=2001>2001</option>
                        <option value=2002>2002</option>
                        <option value=2003>2003</option>
                        <option value=2004>2004</option>
                        <option value=2005>2005</option>
                        <option value=2006>2006</option>
                        <option value=2007>2007</option>
                        <option value=2008>2008</option>
                        <option value=2009>2009</option>
                        <option value=2010>2010</option>
                        <option value=2011>2011</option>
                        <option value=2012>2012</option>
                        <option value=2013>2013</option>
                        <option value=2014>2014</option>
                        <option value=2015>2015</option>
                        <option value=2016>2016</option>
                        <option value=2017>2017</option>
                        <option value=2018>2018</option>
                        <option value=2019>2019</option>
                        <option value=2020>2020</option>
                        <option value=2021>2021</option>
                        <option value=2022>2022</option>
                        <option value=2023>2023</option>
                        <option value=2024>2024</option>
                        <option value=2025>2025</option>
                        <option value=2026>2026</option>
                        <option value=2027>2027</option>
                        <option value=2028>2028</option>
                        <option value=2029>2029</option>
                        <option value=2030>2030</option>
                    </select></form>
                    <h3 class="card-header" id="monthAndYear"></h3>
                    <table class="calendarTable table table-bordered table-responsive-sm" id="calendar">
                        <thead>
                        <tr style="height: 30px;">
                            <th>Sun</th>
                            <th>Mon</th>
                            <th>Tue</th>
                            <th>Wed</th>
                            <th>Thu</th>
                            <th>Fri</th>
                            <th>Sat</th>
                        </tr>
                        </thead>
            
                        <tbody id="calendarBody">
            
                        </tbody>
                    </table>
            
                    <div class="form-inline">
            
                        <button class="btn btn-outline-primary col-sm-6" id="previous" onclick="previous()">Previous</button>
            
                        <button class="btn btn-outline-primary col-sm-6" id="next" onclick="next()">Next</button>
                    </div>
                    <br/>
                    
                </div>
            </div>
        </div>
        <div class="dayView">
            <div class="dayViewClose">X</div>
            <div class="dayDetail">
                <h4>Day: <span class="daySelecetd">Monday</span></h4>
                <h4>Date: <span class="dateSelected">01/01/2020</span></h4>
            </div>
            <br><br>
            <div>Day Events</div>
            <div class="dayEvents">
                
            </div><br>
            <div>Day Caremonies</div>
            <div class="dayCeremonies">
                
            </div>
            <div class="addEventTrigger">
                <button>Add Event</button>
            </div>
        </div>
    </div>
    <div style="display: none;">
        <div class="toPDF">

        </div>
    </div>
    <script>
    var daysDisplayed;
    var today = new Date();
    var dateString;
    var eventsSaved = [];
    var caremoniesSaved = [];
    var materialsSaved = [];
    var updateEventTrigger = false;
    var ceremonyUpdateTrigger = false;
    var currentMonth = today.getMonth();
    var currentYear = today.getFullYear();
    var selectYear = document.getElementById("year");
    var selectMonth = document.getElementById("month");

    var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

    var monthAndYear = document.getElementById("monthAndYear");
    showCalendar(currentMonth, currentYear);

    function next() {
        currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
        currentMonth = (currentMonth + 1) % 12;
        showCalendar(currentMonth, currentYear);
    }

    function previous() {
        currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
        currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
        showCalendar(currentMonth, currentYear);
    }

    function jump() {
        currentYear = parseInt(selectYear.value);
        currentMonth = parseInt(selectMonth.value);
        showCalendar(currentMonth, currentYear);
    }

    function showCalendar(month, year) {

        let firstDay = (new Date(year, month)).getDay();

        var tbl = document.getElementById("calendarBody"); // body of the calendar

        // clearing all previous cells
        tbl.innerHTML = "";

        // filing data about month and in the page via DOM.
        monthAndYear.innerHTML = months[month] + " " + year;

        // creating all cells
        let date = 1;
        for (let i = 0; i < 6; i++) {
            // creates a table row
            let row = document.createElement("tr");

            //creating individual cells, filing them up with data.
            for (let j = 0; j < 7; j++) {
                if (i === 0 && j < firstDay) {
                    var cell = document.createElement("td");
                    var cellText = document.createTextNode("");
                    cell.appendChild(cellText);
                    row.appendChild(cell);
                }
                else if (date > daysInMonth(month, year)) {
                    break;
                }
                else {
                    document.getElementById('month').value = month.toString();
                    document.getElementById('year').value = year.toString();
                    var cell = document.createElement("td");
                    var div = document.createElement('div');
                    div.classList.add('dateMention');
                    var cellText = document.createTextNode(date);
                    if (date === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
                        cell.classList.add("today");
                    }
                    cell.classList.add("tableTd");
                    cell.classList.add("day");
                    div.appendChild(cellText);
                    cell.appendChild(div);
                    row.appendChild(cell);
                    date++;
                }
            }
            tbl.appendChild(row);
        }
        $.ajax({
            url: 'controllers/events.php',
            type: 'post',
            data: {
                action: 'getMonthEvents',
                month: `${month + 1}`,
                year: year
            }, beforeSend: function() {
                console.log("Get Events of month");
            }, success: function(response) {
                var eventsOfMonth = JSON.parse(response);
                if(eventsOfMonth.data !== undefined) {
                    eventsOfMonth.data.forEach(event=> {
                        var allDates = document.querySelectorAll('.dateMention');
                        allDates.forEach(date=>{
                            if(date.innerHTML === event.eventDate.split('/')[0]) {
                                date.parentNode.innerHTML += `
                                    <div class="eventFirstLetter">${event.eventName[0]}</div>
                                `;
                            }
                        })
                    })
                }        
            }, error: function(error) {
                console.log(error);
            }
        })
        $.ajax({
            url: 'controllers/events.php',
            type: 'post',
            data: {
                action: 'getMonthCeremonies',
                month: `${month + 1}`,
                year: year
            }, beforeSend: function() {
                console.log("Get Ceremonies of month");
            }, success: function(response) {
                var eventsOfMonth = JSON.parse(response);
                if(eventsOfMonth.data !== undefined) {
                    eventsOfMonth.data.forEach(event=> {
                        var allDates = document.querySelectorAll('.dateMention');
                        allDates.forEach(date=>{
                            if(date.innerHTML === event.ceremonyDate.split('/')[0]) {
                                date.parentNode.innerHTML += `
                                    <div class="ceremonyFirstLetter">${event.ceremonyType[0]}</div>
                                `;
                            }
                        })
                    })
                }        
            }, error: function(error) {
                console.log(error);
            }
        })
        daysDisplayed = document.querySelectorAll('.day');
        daysDisplayed.forEach((day) => {
            day.addEventListener('click', (event) => {
            event.preventDefault();
            daysDisplayed.forEach(day => {
                day.classList.remove('selected');
            })
            day.classList.toggle('selected');
            document.querySelector('.dayView').style.display = 'block';
            document.querySelector('.main').classList.add('showDayIn');
            document.querySelector('.main').classList.remove('showDayOut');
                var events = [];
                dateString = day.querySelector('.dateMention').innerHTML + "/" + (parseInt(selectMonth.value) + 1) + "/" + parseInt(selectYear.value); 
                document.querySelector('.eventDate').value = dateString;
                const dateStringAlternative = (parseInt(selectMonth.value) + 1) + "/" + day.querySelector('.dateMention').innerHTML + "/" + parseInt(selectYear.value); 
                document.querySelector('.dateSelected').innerHTML = dateString;
                const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                const d = new Date(dateStringAlternative);
                const dayName = days[d.getDay()];
                document.querySelector('.daySelecetd').innerHTML = dayName;
                $.ajax({
                    url: 'controllers/events.php',
                    type: 'post',
                    data: {
                        action: 'getEvents',
                        date: `${dateString.toString()}`,
                        day: dayName,
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        console.log("Getting Events");
                    },
                    success: function(response) {
                        if(response.text === 'true') {
                            events = response.data;
                            $('.dayEvents').html('');
                            var index = 1;
                            events.forEach(event => {
                                eventsSaved.push(event);
                                $('.dayEvents').append(`
                                    <div>
                                        <div>Devotee Name: ${event.devoteeName}</div>
                                        <div>Devotee Phone Number: ${event.devoteePhoneNumber}</div>
                                        <div>Devotee Address: ${event.devoteeAddress}</div>
                                        <div>Event Name: ${event.eventName}</div>
                                        <div>Event Date: ${event.eventDate}</div>
                                        <div>Event Time: ${event.eventTime}</div>
                                        ${(event.amountPaid !== undefined) ? (`<div>Amount Paid: `+ event.amountPaid +` </div>`): ('')}
                                        <div>Mode of Payment: ${event.modeOfPayment}</div>
                                        <div class="materials_${event.id}" style="display: none;">Materials:
                                            <table style="width: 60%; text-align: left;" class="materialsDisplay_${event.id} materialsDisplay">
                                                <thead>
                                                    <tr>
                                                        <th>Material<th>
                                                        <th>Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody class='materialsBody_${event.id}'>
                                                    
                                                </tbody>
                                            </table>    
                                        </div>
                                        <button onclick="printReceipt(${index}, ${event.id}, '${event.devoteeName}', '${event.devoteePhoneNumber}', '${event.devoteeAddress}', '${event.eventName}', '${event.eventDate}', '${event.eventTime}', '${event.amountPaid}', '${event.modeOfPayment}')" class="printReceipt">Get Receipt</button>
                                        <button onclick="updateEvent(${index}, ${event.id}, '${event.devoteeName}', '${event.devoteePhoneNumber}', '${event.devoteeAddress}', '${event.eventName}', '${event.eventDate}', '${event.eventTime}', '${event.amountPaid}', '${event.modeOfPayment}')" class="update">Update</button>
                                        <button onclick="deleteEvent(${event.id})" class="delete">Delete</button>
                                    </div>
                                `)
                                if(event.materials !== '' && event.materials !== undefined && event.materials !== null && event.materials.length > 1) {
                                    const materialsList = JSON.parse(event.materials);
                                    if(materialsList['materials'].length > 0) {
                                        $(`.materials_${event.id}`).css('display', 'block');
                                        materialsList['materials'].forEach(material=>{
                                            $(`.materialsBody_${event.id}`).append(`
                                                <tr>
                                                    <td>${material.materialName}</td>
                                                    <td></td>
                                                    <td>${material.materialQuantity}</td>
                                                </tr>
                                            `)
                                        })
                                    }
                                }
                                index++;
                            })
                        } else {
                            $('.dayEvents').html('');
                        }
                    },
                    error: function(error) {
                        console.log("Error: ", error);
                    },
                })
                $.ajax({
                    url: 'controllers/events.php',
                    type: 'post',
                    data: {
                        action: 'getCeremonies',
                        date: `${dateString.toString()}`,
                        day: dayName,
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        console.log("Getting Ceremonies");
                    },
                    success: function(response) {
                        if(response.text === 'true') {
                            events = response.data;
                            $('.dayCeremonies').html('');
                            var index = 1;
                            events.forEach(event => {
                                caremoniesSaved.push(event);
                                $('.dayCeremonies').append(`
                                    <div>
                                        <div>Customer Name: ${event.customerName}</div>
                                        <div>Customer Phone Number: ${event.phoneNumber}</div>
                                        <div>Type: ${event.ceremonyType}</div>
                                        <div>Date: ${event.ceremonyDate}</div>
                                        <div>People Gathering: ${event.peopleGathering}</div>
                                        ${(event.accomodationRequired === 1 || event.accomodationRequired === "1") ? (`<div>Accomodation Required: `+ 'Yes' +` </div>`): (`<div>Accomodation Required: `+ 'No' +` </div>`)}
                                        <div>Amount Paid: ${event.amountPaid}</div>
                                        <div>Mode of Payment: ${event.modeOfPayment}</div>
                                        <button onclick="printCeremony(${index}, ${event.id}, '${event.customerName}', '${event.phoneNumber}', '${event.ceremonyType}', '${event.ceremonyDate}', '${event.peopleGathering}', '${event.accomodationRequired}', '${event.amountPaid}', '${event.modeOfPayment}')" class="printReceipt">Get Receipt</button>
                                        <button onclick="updateCeremony(${index}, ${event.id}, '${event.customerName}', '${event.phoneNumber}', '${event.ceremonyType}', '${event.ceremonyDate}', '${event.peopleGathering}', ${event.accomodationRequired}, '${event.amountPaid}', '${event.modeOfPayment}')" class="update">Update</button>
                                        <button onclick="deleteCeremony(${event.id})" class="delete">Delete</button>
                                    </div>
                                `)
                                index++;
                            })
                        } else {
                            $('.dayCeremonies').html('');
                        }
                    },
                    error: function(error) {
                        console.log("Error: ", error);
                    },
                })
            })
        })
    }

    $.ajax({
        url: 'controllers/poojas.php',
        type: 'post',
        data: {
            action: 'getPoojas',
        }, beforeSend: function() {
            console.log("Getting Poojas");
        }, success: function(response) {
            if(JSON.parse(response).text === 'true') {
                const poojas = JSON.parse(response).data;
                poojas.forEach(pooja=>{
                    document.querySelector('.eventName').innerHTML += `
                        <option value="${pooja.poojaName}">${pooja.poojaName}</option>
                    `;
                })
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
            console.log("Getting Materials");
        }, success: function(response) {
            if(JSON.parse(response).text === 'true') {
                const materials = JSON.parse(response).data;
                materialsSaved = materials;
            }
        }, error: function(error) {
            console.log(error);
        }
    })

    document.querySelector('.eventName').addEventListener('change', function(event) {
        event.preventDefault();
        const eventName = document.querySelector('.eventName').value;
        document.querySelector('.materials').innerHTML = '';
        $.ajax({
            url: 'controllers/materials.php',
            type: 'post',
            data: {
                action: 'getMaterialsOfPooja',
                eventName: eventName,
            }, beforeSend: function() {
                console.log("Getting Materials");
            }, success: function(response) {
                if(JSON.parse(response).text === 'true') {
                    const poojas = JSON.parse(response).data;
                    poojas.forEach(pooja=>{
                        document.querySelector('.materials').innerHTML += `
                            <tr class="materialRow">
                                <td><input style="width: auto;" type="checkbox" class="materialRequired" checked><td>
                                <td class="materialName">${pooja.materialName}</td>
                                <td><input style="width: auto;" class="materialQuantity" type='number' value=${pooja.defaultQuantity}></td>
                            </tr>
                        `;
                    })
                }
            }, error: function(error) {
                console.log(error);
            }
        })
    })

    function deleteEvent(id) {
        $.ajax({
            url: 'controllers/events.php',
            type: 'post',
            data: {
                action: 'deleteEvent',
                id: id,
            }, beforeSend: function() {
                console.log("Deleting Event");
            }, success: function(response) {
                console.log(response);
                window.location.reload();
            }, error: function(error) {
                console.log(error);
            }
        })
    }

    function deleteCeremony(id) {
        $.ajax({
            url: 'controllers/events.php',
            type: 'post',
            data: {
                action: 'deleteCeremony',
                id: id,
            }, beforeSend: function() {
                console.log("Deleting Ceremony");
            }, success: function(response) {
                console.log(response);
                window.location.reload();
            }, error: function(error) {
                console.log(error);
            }
        })
    }

    function updateEvent(index, id, devoteeName, devoteePhoneNumber, devoteeAddress, eventName, eventDate, eventTime, amountPaid, modeOfPayment) {
        updateEventTrigger = true;
        var materialsAdded = JSON.parse(eventsSaved[index-1]['materials'])['materials'];
        var temp = [];
        document.querySelector('.materials').innerHTML = '';
        materialsAdded.forEach(material=>{
            temp.push(material.materialName);
            document.querySelector('.materials').innerHTML += `
                <tr class="materialRow">
                    <td><input style="width: auto;" type="checkbox" class="materialRequired" checked><td>
                    <td class="materialName">${material.materialName}</td>
                    <td><input style="width: auto;" class="materialQuantity" type='number' value=${material.materialQuantity}></td>
                </tr>
            `;
        })
        materialsSaved.forEach(materialSaved=>{
            if(!temp.includes(materialSaved.materialName)) {
                if(materialSaved.poojaName === eventName) {
                    document.querySelector('.materials').innerHTML += `
                        <tr class="materialRow">
                            <td><input style="width: auto;" type="checkbox" class="materialRequired"><td>
                            <td class="materialName">${materialSaved.materialName}</td>
                            <td><input style="width: auto;" class="materialQuantity" type='number' value=${materialSaved.defaultQuantity}></td>
                        </tr>
                    `;
                }
            }
        })
        if(updateEventTrigger) {
            document.querySelector('.divTitle').innerHTML = "Update Event";
            document.querySelector('.customerName').value = devoteeName;
            document.querySelector('.customerNumber').value = devoteePhoneNumber;
            document.querySelector('.customerAddress').value = devoteeAddress;
            document.querySelector('.eventName').value = eventName;
            document.querySelector('.eventDate').value = eventDate;
            document.querySelector('.eventTime').value = eventTime;
            document.querySelector('.amountPaid').value = ((amountPaid!==undefined) ? amountPaid : 0);
            document.querySelector('.modeOfPayment').value = modeOfPayment;
            document.querySelector('.eventId').value = id;
            document.querySelector('.eventType').style.display = 'none';
            document.querySelector('.addEvent').classList.add('addEventIn');
            document.querySelector('.addEvent').classList.remove('addEventOut');
            document.querySelector('.screen').style.display = 'block';
            document.querySelector('.submitButton').innerHTML = 'Update Event';
            document.querySelector('.eventFormToggle').click();
        }
    }

    function printCeremony(index, id, customerName, phoneNumber, ceremonyType, ceremonyDate, peopleGathering, accomodationRequired, amountPaid, modeOfPayment) {
        let a= document.createElement('a');
        a.target= '_blank';
        a.href= `controllers/createPDF.php?customerName=${customerName}&phoneNumber=${phoneNumber}&ceremonyType=${ceremonyType}&ceremonyDate=${ceremonyDate}&peopleGathering=${peopleGathering}&accomodationRequired=${accomodationRequired}&amountPaid=${amountPaid}&modeOfPayment=${modeOfPayment}&action=createCeremony`;
        a.click();
    }

    function updateCeremony(index, id, customerName, phoneNumber, ceremonyType, ceremonyDate, peopleGathering, accomodationRequired, amountPaid, modeOfPayment) {
        ceremonyUpdateTrigger = true;
        if(ceremonyUpdateTrigger) {
            document.querySelector('.submitButton').innerHTML = 'Update Ceremony';
            document.querySelector('.divTitle').innerHTML = "Update Event";
            document.querySelector('.ceremonyCustomerName').value = customerName;
            document.querySelector('.ceremonyCustomerPhoneNumber').value = phoneNumber;
            document.querySelector('.ceremonyType').value = ceremonyType;
            document.querySelector('.ceremonyDate').value = ceremonyDate;
            document.querySelector('.ceremonyPeopleGathering').value = peopleGathering;
            document.querySelector('.accomodationRequired').checked = (accomodationRequired === 1 || accomodationRequired === "1")? true : false;
            document.querySelector('.ceremonyAmountPaid').value = amountPaid;
            document.querySelector('.ceremonyModeOfPayment').value = modeOfPayment;
            document.querySelector('.ceremonyEventId').value = id;
            document.querySelector('.eventType').style.display = 'none';
            document.querySelector('.addEvent').classList.add('addEventIn');
            document.querySelector('.addEvent').classList.remove('addEventOut');
            document.querySelector('.screen').style.display = 'block';
            document.querySelector('.ceremonySubmitButton').innerHTML = 'Update Ceremony';
            document.querySelector('.ceremonyFormToggle').click();
        }
    }

    function printReceipt(index, id, devoteeName, devoteePhoneNumber, devoteeAddress, eventName, eventDate, eventTime, amountPaid, modeOfPayment) {
        var materialsAdded = JSON.parse(eventsSaved[index-1]['materials'])['materials'];
        let a= document.createElement('a');
        a.target= '_blank';
        a.href= `controllers/createPDF.php?devoteeName=${devoteeName}&devoteePhoneNumber=${devoteePhoneNumber}&devoteeAddress=${devoteeAddress}&eventName=${eventName}&eventDate=${eventDate}&eventTime=${eventTime}&amountPaid=${amountPaid}&modeOfPayment=${modeOfPayment}&materials=${JSON.stringify(materialsAdded)}&action=createPDF`;
        a.click();
      }
    function daysInMonth(iMonth, iYear) {
        return 32 - new Date(iYear, iMonth, 32).getDate();
    }
    document.querySelector('.eventFormToggle').addEventListener('click', function(event) {
        event.preventDefault();
        document.querySelector('.poojaForm').style.display = 'block';
        document.querySelector('.ceremonyForm').style.display = 'none';
        document.querySelector('.submitButton').innerHTML = 'Add Event';
    })
    document.querySelector('.ceremonyFormToggle').addEventListener('click', function(event) {
        event.preventDefault();
        document.querySelector('.poojaForm').style.display = 'none';
        document.querySelector('.ceremonyForm').style.display = 'block';
        document.querySelector('.ceremonyDate').value = dateString;
    })
    document.querySelector('.addEventClose').addEventListener('click', function(event) {
        event.preventDefault();
        document.querySelector('.addEvent').classList.add('addEventOut');
        document.querySelector('.addEvent').classList.remove('addEventIn');
        document.querySelector('.screen').style.display = 'none';
    })
    document.querySelector('.addEventTrigger').addEventListener('click', function(event) {
        event.preventDefault();
        updateEventTrigger = false;
        ceremonyUpdateTrigger = false;
        document.querySelector('.divTitle').innerHTML = "Add Event";
        document.querySelector('.materials').innerHTML = '';
        document.querySelector('.customerName').value = '';
        document.querySelector('.customerNumber').value = '';
        document.querySelector('.customerAddress').value = '';
        document.querySelector('.eventName').value = '';
        document.querySelector('.eventType').style.display = 'grid';
        document.querySelector('.eventDate').value = dateString;
        document.querySelector('.eventTime').value = '';
        document.querySelector('.amountPaid').value = '';
        document.querySelector('.modeOfPayment').value = '';
        document.querySelector('.addEvent').classList.add('addEventIn');
        document.querySelector('.addEvent').classList.remove('addEventOut');
        document.querySelector('.screen').style.display = 'block';
        document.querySelector('.submitButton').innerHTML = 'Add Event';
        document.querySelector('.ceremonySubmitButton').innerHTML = 'Add Ceremony';
        document.querySelector('.eventFormToggle').click();
    })
    document.querySelector('.dayViewClose').addEventListener('click', function(event) {
        event.preventDefault();
        document.querySelector('.main').classList.remove('showDayIn');
        document.querySelector('.main').classList.add('showDayOut');
        document.querySelector('.dayView').style.display = 'none';
    })
    document.querySelector('.poojaFormData').addEventListener('submit', function(event) {
        event.preventDefault();
        const devoteeName = document.querySelector('.customerName').value;
        const devoteePhoneNumber = document.querySelector('.customerNumber').value;
        const devoteeAddress = document.querySelector('.customerAddress').value;
        const eventName = document.querySelector('.eventName').value;
        const eventTime = document.querySelector('.eventTime').value;
        const modeOfPayment = document.querySelector('.modeOfPayment').value;
        const amountPaid = document.querySelector('.amountPaid').value;
        const materialRow = document.querySelectorAll('.materialRow');
        if(materialRow.length === 0 || materialRow === undefined) {
            return false;
        }
        var materials = {"materials": []};
        materialRow.forEach(row=>{
            if(row.querySelector('.materialRequired').checked) {
                var material = {};
                material['materialName'] = row.querySelector('.materialName').innerHTML;
                material['materialQuantity'] = row.querySelector('.materialQuantity').value;
                materials["materials"].push(material);
            }
        })

        const updateId = document.querySelector('.eventId').value;
        if(!updateEventTrigger) {
            $.ajax({
                url: 'controllers/events.php',
                type: 'post',
                data: {
                    action: 'addEvent',
                    devoteeName: devoteeName,
                    devoteePhoneNumber: devoteePhoneNumber,
                    devoteeAddress: devoteeAddress,
                    eventName: eventName,
                    eventDate: `${dateString.toString()}`,
                    eventTime: eventTime,
                    amountPaid: amountPaid,
                    modeOfPayment: modeOfPayment,
                    materials: JSON.stringify(materials),
                }, beforeSend: function() {
                    console.log("Adding Event");
                }, success: function(response) {
                    if(JSON.parse(response).text === 'true') {
                        window.location.reload();
                    } else {
                        console.log(response);
                    }
                }, error: function(error) {
                    console.log(error);
                }
            })
        } else {
            $.ajax({
                url: 'controllers/events.php',
                type: 'post',
                data: {
                    action: 'updateEvent',
                    id: updateId,
                    devoteeName: devoteeName,
                    devoteePhoneNumber: devoteePhoneNumber,
                    devoteeAddress: devoteeAddress,
                    eventName: eventName,
                    eventDate: `${dateString.toString()}`,
                    eventTime: eventTime,
                    amountPaid: amountPaid,
                    modeOfPayment: modeOfPayment,
                    materials: JSON.stringify(materials),
                }, beforeSend: function() {
                    console.log("Updaing Event");
                }, success: function(response) {
                    if(JSON.parse(response).text === 'true') {
                        window.location.reload();
                    } else {
                        console.log(response)
                    }
                }, error: function(error) {
                    console.log(error);
                }
            })
        }
    })
    document.querySelector('.ceremonyFormData').addEventListener('submit', function(event) {
        event.preventDefault();
        const updateId = document.querySelector('.ceremonyEventId').value,
              customerName = document.querySelector('.ceremonyCustomerName').value,
              customerPhoneNumber = document.querySelector('.ceremonyCustomerPhoneNumber').value,
              ceremonyType = document.querySelector('.ceremonyType').value,
              peopleGathering = document.querySelector('.ceremonyPeopleGathering').value,
              accomodationRequired = document.querySelector('.accomodationRequired').checked,
              amountPaid = document.querySelector('.ceremonyAmountPaid').value,
              modeOfPayment = document.querySelector('.ceremonyModeOfPayment').value;
        var tinyAccomodationRequired = 0;
        if(accomodationRequired) {
            tinyAccomodationRequired = 1;
        } else {
            tinyAccomodationRequired = 0;
        }
        if(!ceremonyUpdateTrigger) {
            $.ajax({
                url: 'controllers/events.php',
                type: 'post',
                data: {
                    action: 'addCeremony',
                    customerName: customerName,
                    customerPhoneNumber: customerPhoneNumber,
                    ceremonyType: ceremonyType,
                    ceremonyDate: `${dateString.toString()}`,
                    peopleGathering: peopleGathering,
                    accomodationRequired: tinyAccomodationRequired,
                    amountPaid: amountPaid,
                    modeOfPayment: modeOfPayment,
                }, beforeSend: function() {
                    console.log("Adding Ceremony");
                }, success: function(response) {
                    if(JSON.parse(response).text === 'true') {
                        console.log(response);
                        window.location.reload();
                    } else {
                        console.log(response);
                    }
                }, error: function(error) {
                    console.log(error);
                }
            })
        } else {
            $.ajax({
                url: 'controllers/events.php',
                type: 'post',
                data: {
                    action: 'updateCeremony',
                    id: updateId,
                    customerName: customerName,
                    customerPhoneNumber: customerPhoneNumber,
                    ceremonyType: ceremonyType,
                    ceremonyDate: `${dateString.toString()}`,
                    peopleGathering: peopleGathering,
                    accomodationRequired: tinyAccomodationRequired,
                    amountPaid: amountPaid,
                    modeOfPayment: modeOfPayment,
                }, beforeSend: function() {
                    console.log("Updaing Ceremony");
                }, success: function(response) {
                    if(JSON.parse(response).text === 'true') {
                        window.location.reload();
                    } else {
                        console.log(response)
                    }
                }, error: function(error) {
                    console.log(error);
                }
            })
        }
    })
    </script>
</body>
</html>