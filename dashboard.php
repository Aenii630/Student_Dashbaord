<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

/* Layout */
body{
    display:flex;
    min-height:100vh;
    background:#f1f5f9;
}

/* Sidebar */
.sidebar{
    width:250px;
    background:#0f172a;
    color:white;
    padding:25px 15px;
}

.logo{
    font-size:20px;
    font-weight:600;
    margin-bottom:30px;
    text-align:center;
}

.menu a{
    display:block;
    padding:12px 15px;
    margin:6px 0;
    border-radius:8px;
    color:#cbd5e1;
    text-decoration:none;
    transition:.3s;
}

.menu a:hover{
    background:#2563eb;
    color:white;
}

/* Main */
.main{
    flex:1;
    padding:25px;
}

/* Topbar */
.topbar{
    background:white;
    padding:15px 20px;
    border-radius:12px;
    box-shadow:0 4px 15px rgba(0,0,0,0.08);
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.logout{
    background:#ef4444;
    color:white;
    padding:8px 14px;
    border-radius:6px;
    text-decoration:none;
}

/* Sections */
.section{
    display:none;
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 6px 20px rgba(0,0,0,0.08);
}

.section.active{
    display:block;
}

/* Cards */
.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
    gap:15px;
}

.card{
    background:#2563eb;
    color:white;
    padding:20px;
    border-radius:12px;
}

/* Table */
table{
    width:100%;
    border-collapse:collapse;
    margin-top:15px;
}

th, td{
    padding:10px;
    border-bottom:1px solid #ddd;
    text-align:left;
}

th{
    background:#2563eb;
    color:white;
}
</style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="logo">🎓 Student Portal</div>

    <div class="menu">
        <a href="#" onclick="showSection('home')">Home</a>
        <a href="#" onclick="showSection('info')">Personal Info</a>
        <a href="#" onclick="showSection('timetable')">Timetable</a>
        <a href="#" onclick="showSection('transcript')">Transcript</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<!-- Main -->
<div class="main">

    <!-- Topbar -->
    <div class="topbar">
        <h3>Welcome, <?php echo $_SESSION['fullname']; ?> 👋</h3>
        <span><?php echo date("d M Y"); ?></span>
    </div>

    <!-- HOME -->
    <div id="home" class="section active">
        <h2>Dashboard Overview</h2><br>

        <div class="cards">
            <div class="card">
                <h4>Enrolled Courses</h4>
                <p>5</p>
            </div>

            <div class="card">
                <h4>Current GPA</h4>
                <p>3.45</p>
            </div>

            <div class="card">
                <h4>Attendance</h4>
                <p>92%</p>
            </div>
        </div>
    </div>

    <!-- PERSONAL INFO -->
    <div id="info" class="section">
        <h2>Personal Information</h2>

        <p><strong>Full Name:</strong> <?php echo $_SESSION['fullname']; ?></p>
        <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
        <p><strong>Username:</strong> <?php echo $_SESSION['username']; ?></p>
        <p><strong>Phone:</strong> <?php echo $_SESSION['phone']; ?></p>
    </div>

    <!-- TIMETABLE -->
    <div id="timetable" class="section">
        <h2>Class Timetable</h2>

        <table>
            <tr>
                <th>Day</th>
                <th>Subject</th>
                <th>Time</th>
            </tr>
            <tr>
                <td>Monday</td>
                <td>OOP</td>
                <td>9:00 - 10:30</td>
            </tr>
            <tr>
                <td>Tuesday</td>
                <td>DBMS</td>
                <td>11:00 - 12:30</td>
            </tr>
            <tr>
                <td>Wednesday</td>
                <td>OS</td>
                <td>1:00 - 2:30</td>
            </tr>
        </table>
    </div>

    <!-- TRANSCRIPT -->
    <div id="transcript" class="section">
        <h2>Academic Transcript</h2>

        <table>
            <tr>
                <th>Subject</th>
                <th>Grade</th>
                <th>Credit Hours</th>
            </tr>
            <tr>
                <td>OOP</td>
                <td>A</td>
                <td>3</td>
            </tr>
            <tr>
                <td>DBMS</td>
                <td>B+</td>
                <td>3</td>
            </tr>
            <tr>
                <td>Operating System</td>
                <td>A-</td>
                <td>4</td>
            </tr>
        </table>
    </div>

</div>

<script>
function showSection(id){
    document.querySelectorAll('.section').forEach(sec=>{
        sec.classList.remove('active');
    });
    document.getElementById(id).classList.add('active');
}
</script>

</body>
</html>

