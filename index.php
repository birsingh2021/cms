<?php
// index.php - Frontend page with header, footer, live clock, and calendar
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #96D3D6;
        }
        .header {
            background-color: #21498a;
            color: #fff;
            padding: 15px 0;
        }
        .footer {
            background-color: #21498a;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
        .clock {
            font-size: 2rem;
            font-weight: bold;
            color: #FF26F8;
        }
        .calendar-container {
            margin-top: 0px;
            color : #042E61;
            
        }

        .Login {
            position: absolute;
            top: 350px;
            left: 400px;
            font-size: 34px;
            font-weight: bold;
            font-style: italic;
        }

        .logo {
            position: absolute; 
            top: -50px;  
            left: 50%;  
        
        }

    </style>
</head>
<body>

<!-- Header -->
<header class="header">
    <div class="logo">
    <img src="logo.png" alt="Logo" class="logo" width="100">
    </div>
    <div class="container text-center">
        <h1>COMPLAINT MANAGEMENT SYSTEM </h1>
        <p class="lead">BSNL AHMEDABAD COMPLAINT MANAGMENT SYSTEM</p>
    </div>
    <div class="Login">
        <a href="login.php">Login</a>
    </div>
</header>

<!-- Main Content -->
<main class="container">
    <div class="row">
        <div class="col-md-6 text-center">
            <!-- Clock Display -->
            <div class="clock" id="clock"></div>
        </div>

        <div class="col-md-6">
            <!-- Calendar Display -->
            <div class="calendar-container" id="calendar"></div>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="footer">
    <p>&copy; 2025 Developed by : JTO ATD Bir Singh . All rights reserved.</p>
</footer>

<!-- JavaScript (Clock and Calendar) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.js"></script>

<script>
    // Clock Functionality
    function updateClock() {
        const now = moment().format('HH:mm:ss');
        document.getElementById('clock').textContent = now;
    }

    setInterval(updateClock, 1000); // Update every second
    updateClock(); // Initial call to display clock immediately

    // Calendar Functionality
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            height: 500, 
            events: [
                {
                    title: 'Sample Event',
                    start: '2025-01-31T10:00:00',
                    end: '2025-01-31T12:00:00'
                },
                {
                    title: 'Another Event',
                    start: '2025-02-01T14:00:00',
                    end: '2025-02-01T16:00:00'
                }
            ]
        });
    });
</script>

</body>
</html>
