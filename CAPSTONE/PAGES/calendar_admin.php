<?php
session_start();

if (isset($_SESSION['user_email'])) {
    $user_email = $_SESSION['user_email'];
    $allowed_roles = array("Admin");
    $user_type = $_SESSION['user_type'];

    if (!in_array($user_type, $allowed_roles)) {
        header("Location: unauthorized.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scheduler";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scheduler</title>
    <link rel="stylesheet" href="css/font_1.css">
    <link rel="stylesheet" href="css/practice.css">
	<link rel="stylesheet" href="css/profile.css">
	<link rel="stylesheet" href="css/notif.css">
	<link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="css/officials.css">
    <link href="/CAPSTONE/PAGES/css/fullcalendar.min.css" rel="stylesheet" />
	<script src="/CAPSTONE/PAGES/javascript/jquery.min.js"></script>
	<script src="/CAPSTONE/PAGES/javascript/moment.min.js"></script>
	<script src="/CAPSTONE/PAGES/javascript/fullcalendar.min.js"></script>
	<script src="/CAPSTONE/PAGES/javascript/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/calendar.css">
    <link rel="stylesheet" href="css/clock.css">
	<script src="javascript/fetch_department_members.js"></script>
</head>
<body>
    <div class="web">
        <div class="navigation">
            <ul>
                <li>
                    <a href="">
                        <span class="title"><img src="icon/ceit.png" style="margin-top: -85px; margin-left: -10px; height: 239px; width: 210px;"></span>
                    </a>
                    <hr class="hr">
                </li>
                <li>
                    <a href="calendar_admin.php" id="active">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" height="30" width="30" viewBox="0 0 448 512" fill="#FC6A03"><path d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z"/></svg>
                        </span>
                        <span class="title" style="color: #FC6A03;">Calendar</span>
                    </a>
                </li>
                <li>
                    <a class="sub-btn">
                        <span class="icon" id="settings">
                        <svg xmlns="http://www.w3.org/2000/svg" height="30" width="30" viewBox="0 0 512 512" fill="#f2f2f2"><path d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z"/></svg>
                        </span>
                        <span class="title">Settings</span>
                        <svg class="dropdown" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 256 512"><path d="M246.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-9.2-9.2-22.9-11.9-34.9-6.9s-19.8 16.6-19.8 29.6l0 256c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l128-128z" style="fill: #f2f2f2;"/></svg>
                    </a>
                    <div class="sub-menu">
                        <a href="registration.php" class="sub-item">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 384 512" fill="#f2f2f2"><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM80 64h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16s7.2-16 16-16zm16 96H288c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V256c0-17.7 14.3-32 32-32zm0 32v64H288V256H96zM240 416h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H240c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
                            <div class="text">Register</div>
                        </a>
                        <a href="information_admin.php" class="sub-item">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512" fill="#f2f2f2"><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                            <div class="text">Information</div>
                        </a>
                        <a href="promote.php" class="sub-item">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 640 512" fill="#f2f2f2"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H322.8c-3.1-8.8-3.7-18.4-1.4-27.8l15-60.1c2.8-11.3 8.6-21.5 16.8-29.7l40.3-40.3c-32.1-31-75.7-50.1-123.9-50.1H178.3zm435.5-68.3c-15.6-15.6-40.9-15.6-56.6 0l-29.4 29.4 71 71 29.4-29.4c15.6-15.6 15.6-40.9 0-56.6l-14.4-14.4zM375.9 417c-4.1 4.1-7 9.2-8.4 14.9l-15 60.1c-1.4 5.5 .2 11.2 4.2 15.2s9.7 5.6 15.2 4.2l60.1-15c5.6-1.4 10.8-4.3 14.9-8.4L576.1 358.7l-71-71L375.9 417z"/></svg>
                            <div class="text">Promote</div>
                        </a>
                        <a href="status.php" class="sub-item">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 640 512" fill="#f2f2f2"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H392.6c-5.4-9.4-8.6-20.3-8.6-32V352c0-2.1 .1-4.2 .3-6.3c-31-26-71-41.7-114.6-41.7H178.3zM528 240c17.7 0 32 14.3 32 32v48H496V272c0-17.7 14.3-32 32-32zm-80 32v48c-17.7 0-32 14.3-32 32V480c0 17.7 14.3 32 32 32H608c17.7 0 32-14.3 32-32V352c0-17.7-14.3-32-32-32V272c0-44.2-35.8-80-80-80s-80 35.8-80 80z"/></svg>
                            <div class="text">Status</div>
                        </a>
                        <a href="members_admin.php" class="sub-item">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 384 512" fill="#f2f2f2"><path d="M64 48c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16h80V400c0-26.5 21.5-48 48-48s48 21.5 48 48v64h80c8.8 0 16-7.2 16-16V64c0-8.8-7.2-16-16-16H64zM0 64C0 28.7 28.7 0 64 0H320c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64zm88 40c0-8.8 7.2-16 16-16h48c8.8 0 16 7.2 16 16v48c0 8.8-7.2 16-16 16H104c-8.8 0-16-7.2-16-16V104zM232 88h48c8.8 0 16 7.2 16 16v48c0 8.8-7.2 16-16 16H232c-8.8 0-16-7.2-16-16V104c0-8.8 7.2-16 16-16zM88 232c0-8.8 7.2-16 16-16h48c8.8 0 16 7.2 16 16v48c0 8.8-7.2 16-16 16H104c-8.8 0-16-7.2-16-16V232zm144-16h48c8.8 0 16 7.2 16 16v48c0 8.8-7.2 16-16 16H232c-8.8 0-16-7.2-16-16V232c0-8.8 7.2-16 16-16z"/></svg>
                            <div class="text">Departments</div>
                        </a>
                    </div>
                    <script>
                        $(document).ready(function(){
                            $('.sub-btn').click(function(){
                                $(this).next('.sub-menu').slideToggle();
                                $(this).find('.dropdown').toggleClass('rotate');
                                $(this).find('#settings').toggleClass('rotate');
                            });
                        });
                    </script>
                </li>
                <li>
                    <a href="profile_admin.php">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" height="30" width="30" viewBox="0 0 512 512" fill="#f2f2f2"><path d="M399 384.2C376.9 345.8 335.4 320 288 320H224c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256 16a72 72 0 1 0 0-144 72 72 0 1 0 0 144z"/></svg>
                        </span>
                        <span class="title">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="homepage_admin.php">
                        <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="30" width="30" viewBox="0 -960 960 960" fill="#f2f2f2"><path d="M520-600v-240h320v240H520ZM120-440v-400h320v400H120Zm400 320v-400h320v400H520Zm-400 0v-240h320v240H120Zm80-400h160v-240H200v240Zm400 320h160v-240H600v240Zm0-480h160v-80H600v80ZM200-200h160v-80H200v80Zm160-320Zm240-160Zm0 240ZM360-280Z"/></svg>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" height="30" width="30" viewBox="0 0 512 512" fill="#f2f2f2"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg>
                        </span>
                        <span class="title">Logout</span>
                    </a>
                </li>
                <li>
                    <a href="about_admin.php" class="bottom">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" height="30" width="30" viewBox="0 0 512 512" fill="#f2f2f2"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                        </span>
                        <span class="title">About Us</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="mains">
            <div class="topbar">
                <div class="toggle">
                  <svg xmlns="http://www.w3.org/2000/svg" height="25" width="25" viewBox="0 0 448 512"><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
                </div>
                <div class="card_2">
                        <div class="backg"></div>
                        <div class="clocks_container">
                            <div class="clocks__content grid">
                                <div class="clocks__text">
                                    <div class="clocks__text-hour" id="text-hour"></div>
                                    <div class="clocks__text-minutes" id="text-minutes"></div>
                                    <div class="clocks__text-ampm" id="text-ampm"></div>
                                </div>
                                <div class="clocks__date">
                                    <span id="dates-day"></span>
                                    <span id="dates-month"></span>
                                    <span id="dates-year"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script src="javascript/clock.js"></script>
                <div class="notify">
                    <button class="button" onclick="toggleActivities()">
                        <svg viewBox="0 0 448 512" class="bell">
                            <path d="M224 0c-17.7 0-32 14.3-32 32V49.9C119.5 61.4 64 124.2 64 200v33.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416H424c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4V200c0-75.8-55.5-138.6-128-150.1V32c0-17.7-14.3-32-32-32zm0 96h8c57.4 0 104 46.6 104 104v33.4c0 47.9 13.9 94.6 39.7 134.6H72.3C98.1 328 112 281.3 112 233.4V200c0-57.4 46.6-104 104-104h8zm64 352H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z"></path>
                        </svg>
                        <?php
                        $query = "SELECT COUNT(*) AS schedule_count FROM table_sched WHERE user_email = '$user_email'";
                        $result = mysqli_query($conn, $query);

                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            $schedule_count = $row['schedule_count'];

                            if ($schedule_count > 0) {
                                echo '<span class="schedule-count">' . $schedule_count . '</span>';
                            }
                        }
                        ?>
                    </button>
                    <div class="popup" id="activityPopup">
                        <div class="popup-content">
                            <ul>
                                <?php
                                    if ($schedule_count > 0) {
                                        $query = "SELECT activity, start_time, date FROM table_sched WHERE user_email = '$user_email'";
                                        $result = mysqli_query($conn, $query);

                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $start_time_24hour = $row['start_time'];
                                            $start_time_12hour = date("h:i A", strtotime($start_time_24hour));
                                            $activity = $row['activity'];
                                            $date = date("F j, Y", strtotime($row['date']));
                                        
                                            echo '<li style="padding: 5px">You have a ' . $activity . ' at ' . $start_time_12hour . ' on ' . $date;
                                            echo '</li>';
                                            echo '<hr>';
                                        }
                                    } else {
                                        echo '<li>No Meeting Today</li>';
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <script>
                    function toggleActivities() {
                        var popup = document.getElementById('activityPopup');
                        popup.style.display = (popup.style.display === 'block') ? 'none' : 'block';
                    }

                    var activityPopup = document.getElementById('activityPopup');
                    var notifyButton = document.querySelector('.notify .button');

                    function toggleActivities() {
                        activityPopup.classList.toggle('show');
                    }

                    document.addEventListener('click', function(event) {
                        if (!activityPopup.contains(event.target) && event.target !== notifyButton) {
                            activityPopup.classList.remove('show');
                        }
                    });
                </script>
                <?php
                    $userEmail = $_SESSION['user_email'];

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "scheduler";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    $sql = "SELECT nickname, user_type, image FROM user_form WHERE user_email = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $userEmail);
                    $stmt->execute();
                    $stmt->store_result();

                    if ($stmt->num_rows > 0) {
                        // If a record is found, retrieve the details
                        $stmt->bind_result($nickname, $userType, $image);
                        $stmt->fetch();

                        // Display user information
                        echo '<div class="info">
                                <p>Hello, <b>'.$nickname.'</b></p>
                                <small class="text-muted">'.$userType.'</small>
                            </div>';

                        // Check if image field is empty
                        if (!empty($image)) {
                            // Display the image from the database
                            echo '<div class="user">
                                    <img src="img/'.$image.'" alt="">
                                </div>';
                        } else {
                            // If image field is empty, display a default image
                            echo '<div class="user">
                                    <img src="img/img.png" alt="">
                                </div>';
                        }
                    } else {
                        echo "User details not found";
                    }
                ?>
            </div>
            <div class="details_4">
                <div class="card">
                    <div class="row">
                        <div class="col-lg-13">
                            <div id="calendar"></div>
                        </div>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="modal fade" id="event_entry_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel">Create Event</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="img-container">
                                            <div class="rows">
                                                <div class="col-sm-6">  
                                                    <div class="form-group">
                                                    <label for="date"></label>
                                                    <input type="hidden" name="date" id="date" class="form-control onlydatepicker" placeholder="Event start date">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">  
                                                    <div class="form-group">
                                                    <label for="end_date"></label>
                                                    <input type="hidden" name="end_date" id="end_date" class="form-control onlydatepicker" placeholder="Event end date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="rows" style="margin-top: -40px;">
                                                <div class="col-sm-6">  
                                                    <div class="form-group">
                                                    <label for="start_time">Event Time</label>
                                                    <input type="time" name="start_time" id="start_time" class="form-control " placeholder="Start Time" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">  
                                                    <div class="form-group">
                                                    <label for="end_time">End</label>
                                                    <input type="time" name="end_time" id="end_time" class="form-control" placeholder="End Time" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="location">Event Place</label>
                                                <input type="text" name="location" id="location" class="form-control" placeholder="Enter event place" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="activity">Agenda</label>
                                                <input type="text" name="activity" id="activity" class="form-control" placeholder="Enter agenda">
                                            </div>
                                            <div class="form-group">
                                                <label for="attachment">Attachment:</label><br>
                                                <input type="file" id="attachment" name="attachment">
                                            </div>
                                            <div class="container">
                                                
                                            <?php
                                                $departments = array(
                                                    'Chairperson' => 'c',
                                                    'Officials' => 'i',
                                                    'DIT' => 'it',
                                                    'DIET' => 'et',
                                                    'DAFE' => 'fe',
                                                    'DCEE' => 'ee',
                                                    'DCEA' => 'ea'
                                                );

                                                foreach ($departments as $department => $abbrev) {
                                                    ?>
                                                    <div class="dropdowns">
                                                        <button class="dropbtn" id="dropdownBtn_<?php echo $abbrev; ?>" onclick="rotateSVG('<?php echo $abbrev; ?>')">
                                                            <?php echo $department; ?><span id="selectedCount_<?php echo $abbrev; ?>" class="count"></span>
                                                        </button>
                                                        <!-- Search input for the department -->
                                                        <input type="text" id="search_<?php echo $abbrev; ?>" class="form-control" placeholder="Search <?php echo $department; ?>">
                                                        <div class="dropdown-content" id="dropdownContent_<?php echo $abbrev; ?>">
                                                            <?php
                                                            $sql = "SELECT id, name, user_email FROM user_form WHERE ";
                                                            if ($department === 'Chairperson' || $department === 'Officials') {
                                                                $sql .= "position = '$department'";
                                                            } else {
                                                                $sql .= "department = '$department'";
                                                            }
                                                            $result = $conn->query($sql);

                                                            if ($result->num_rows > 0) {
                                                                echo '<label><input type="checkbox" name="select_all" id="select-all_' . $abbrev . '">Select All</label>';
                                                                while ($row = $result->fetch_assoc()) {
                                                                    echo '<label><input type="checkbox" name="' . ($department === 'Chairperson' ? 'dit' : strtolower($department)) . '[]" value="' . $row["id"] . '" data-user-email="' . $row["user_email"] . '">' . $row["name"] . '</label>';
                                                                }
                                                            } else {
                                                                echo "No $department found in the database.";
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <script>
                                                        // Function to filter options based on search input
                                                        function filterOptions_<?php echo $abbrev; ?>() {
                                                            var input, filter, dropdown, options, i, txtValue;
                                                            input = document.getElementById('search_<?php echo $abbrev; ?>');
                                                            filter = input.value.toUpperCase();
                                                            dropdown = document.getElementById('dropdownContent_<?php echo $abbrev; ?>');
                                                            options = dropdown.getElementsByTagName('label');
                                                            for (i = 0; i < options.length; i++) {
                                                                txtValue = options[i].textContent || options[i].innerText;
                                                                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                                                    options[i].style.display = "";
                                                                } else {
                                                                    options[i].style.display = "none";
                                                                }
                                                            }
                                                        }

                                                        // Attach an event listener to the search input field
                                                        document.getElementById('search_<?php echo $abbrev; ?>').addEventListener('input', filterOptions_<?php echo $abbrev; ?>);
                                                    </script>
                                                    <?php
                                                }
                                                ?>
                                                
                                            </div>
                                            <script>
                                                var selectedEmailsMap = {};

                                                // Function to count checked checkboxes and update count display
                                                function updateCheckedCount(category) {
                                                    var checkboxes = document.querySelectorAll(`#dropdownContent_${category} input[type="checkbox"]`);
                                                    var checkedCount = 0;
                                                    var selectAllCheckbox = document.getElementById(`select-all_${category}`);
                                                    var countingStarted = false;

                                                    checkboxes.forEach(function (checkbox) {
                                                        if (!countingStarted && checkbox === selectAllCheckbox) {
                                                            countingStarted = true;
                                                            return;
                                                        }

                                                        if (countingStarted && checkbox.checked) {
                                                            checkedCount++;
                                                        }
                                                    });

                                                    var countSpan = document.getElementById(`selectedCount_${category}`);
                                                    countSpan.textContent = checkedCount > 0 ? `(${checkedCount})` : '';

                                                    // Update the global variable with the selected emails for this category
                                                    updateSelectedEmails(category);
                                                }

                                                function handleSelectAllChange(category) {
                                                    var checkboxes = document.querySelectorAll(`#dropdownContent_${category} input[type="checkbox"]:not(#select-all_${category})`);
                                                    var selectAllCheckbox = document.getElementById(`select-all_${category}`);
                                                    var selectedEmails = [];

                                                    checkboxes.forEach(function (checkbox) {
                                                        checkbox.checked = selectAllCheckbox.checked;
                                                        if (checkbox.checked && checkbox.value !== 'select-all') {
                                                            selectedEmails.push(checkbox.getAttribute('data-user-email'));
                                                        }
                                                    });

                                                    updateCheckedCount(category);

                                                    // Store the selected emails in the global variable
                                                    selectedEmailsMap[category] = selectedEmails;
                                                }

                                                function updateSelectedEmails(category) {
                                                    var selectedUserEmails = [];
                                                    var checkboxes = document.querySelectorAll(`#dropdownContent_${category} input[type="checkbox"]:checked`);
                                                    checkboxes.forEach(function (checkbox) {
                                                        if (checkbox.value !== 'select-all') {
                                                            selectedUserEmails.push(checkbox.getAttribute('data-user-email'));
                                                        }
                                                    });

                                                    // Update the global variable with the selected emails for this category
                                                    selectedEmailsMap[category] = selectedUserEmails;
                                                }

                                                function handleDropdownBtnClick(category) {
                                                    var dropdownContent = document.getElementById(`dropdownContent_${category}`);
                                                    dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
                                                }

                                                function handleIndividualCheckboxChange(category) {
                                                    var checkboxes = document.querySelectorAll(`#dropdownContent_${category} input[type="checkbox"]:not(#select-all_${category})`);
                                                    var selectAllCheckbox = document.getElementById(`select-all_${category}`);

                                                    checkboxes.forEach(function (checkbox) {
                                                        checkbox.addEventListener('change', function () {
                                                            var allChecked = true;
                                                            checkboxes.forEach(function (chk) {
                                                                if (chk !== selectAllCheckbox && !chk.checked) {
                                                                    allChecked = false;
                                                                }
                                                            });
                                                            selectAllCheckbox.checked = allChecked;
                                                            updateCheckedCount(category);
                                                        });
                                                    });
                                                }

                                                // Usage example
                                                ['i', 'c', 'it', 'et', 'fe', 'ee', 'ea'].forEach(function (category) {
                                                    var dropdownContent = document.getElementById(`dropdownContent_${category}`);
                                                    dropdownContent.style.display = 'block'; // Show the dropdown content initially

                                                    var checkboxes = dropdownContent.querySelectorAll('input[type="checkbox"]');

                                                    checkboxes.forEach(function (checkbox) {
                                                        checkbox.addEventListener('change', function () {
                                                            updateCheckedCount(category);
                                                        });
                                                    });

                                                    document.getElementById(`select-all_${category}`).addEventListener('change', function () {
                                                        handleSelectAllChange(category);
                                                    });

                                                    handleIndividualCheckboxChange(category);
                                                });

                                                // Function to handle dropdown button click
                                                function handleDropdownBtnClick(category) {
                                                    var dropdownContent = document.getElementById(`dropdownContent_${category}`);
                                                    dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
                                                }

                                                // Function to filter Chairperson options based on search input
                                                function filterChairperson() {
                                                    var input, filter, dropdown, options, i, txtValue;
                                                    input = document.getElementById('searchChairperson');
                                                    filter = input.value.toUpperCase();
                                                    dropdown = document.getElementById('dropdownContent_c');
                                                    options = dropdown.getElementsByTagName('label');
                                                    for (i = 0; i < options.length; i++) {
                                                        txtValue = options[i].textContent || options[i].innerText;
                                                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                                            options[i].style.display = "";
                                                        } else {
                                                            options[i].style.display = "none";
                                                        }
                                                    }
                                                }

                                                // Attach an event listener to the search input field
                                                document.getElementById('searchChairperson').addEventListener('input', filterChairperson);

                                            </script>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="button" value="Save" onclick="saveEvent()">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                        <div class="modal fade" id="eventDetailsModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content-view">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel">Event Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Date:</strong> <span id="date_details"></span></p>
                                        <p><strong>Time:</strong> <span id="start_time_display"></span></p>
                                        <p><strong>Location:</strong> <span id="location_display"></span></p>
                                        <p><strong>Activity:</strong> <span id="activity_display"></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="javascript/smtps.js"></script>
<script src="javascript/sidebar.js"></script>
<script src="https://smtpjs.com/v3/smtp.js"></script>
<script>
	$(document).ready(function() {
		display_events();
	});

	function display_events() {
		var events = new Array();

		$.ajax({
			url: 'display_event.php',
			dataType: 'json',
			success: function (response) {
				var result = response.data;
				$.each(result, function (i, item) {
					events.push({
						event_id: result[i].event_id,
						title: result[i].title,
						start: result[i].start,
						end: result[i].end,
						color: result[i].color,
						url: result[i].url,
						activity: result[i].title,
                   		date: moment(result[i].start).format('YYYY-MM-DD'),
						start_time: result[i].start_time,
						end_time: result[i].end_time,
						location: result[i].location,
					});
				})

				var calendar = $('#calendar').fullCalendar({
					defaultView: 'month',
					timeZone: 'local',
					editable: true,
					selectable: true,
					selectHelper: true,
					select: function (start, end) {
						var currentDate = moment(); // Get the current date
						if (start.isBefore(currentDate) && !start.isSame(currentDate, 'day')) {
							return;
						}
						$('#date').val(moment(start).format('YYYY-MM-DD'));
						$('#end_date').val(moment(end).format('YYYY-MM-DD'));
						$('#event_entry_modal').modal('show');
					},
					events: events,
					header: {
						left: 'prev',
						center: 'title',
						right: 'next'
					},
                    eventClick: function (calEvent, jsEvent, view) {
                        $('#eventDetailsModal').modal('show');
                        $('#date_details').text(moment(calEvent.date).format('MMMM D YYYY')); // Formats date without ordinal indicator
                        $('#start_time_display').text(moment(calEvent.start_time, 'HH:mm').format('hh:mm A')); // Formats time in 12-hour format
                        $('#location_display').text(calEvent.location);
                        $('#activity_display').text(calEvent.activity);
                    },
				});
			},
			error: function (xhr, status) {
				alert(response.msg);
			}
		});
	}

    // Function to send invitations to selected attendees
    function sendInvitations(eventData) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'send_invitations.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    // Directly use the response text (plain text)
                    var response = xhr.responseText;

                    // Log the response for debugging
                    console.log('Response from send_invitations.php:', response);

                    // Show a confirmation message
                    alert(response);

                    window.location.href = 'calendar_admin.php';
                } else {
                    // Handle errors, if any
                    console.error('Error: ' + xhr.status);
                }
            }
        };

        // Send the event data
        xhr.send(JSON.stringify(eventData));
    }

    // Function to save event details and send invitations
    function saveEvent() {
        // Retrieve form data
        var date = document.getElementById('date').value;
        var endDate = document.getElementById('end_date').value;
        var startTime = document.getElementById('start_time').value;
        var endTime = document.getElementById('end_time').value;
        var activity = document.getElementById('activity').value;
        var location = document.getElementById('location').value;

        // Retrieve selected user emails from the global variable
        var selectedUserEmails = [];
        Object.values(selectedEmailsMap).forEach(function (categoryEmails) {
            selectedUserEmails = selectedUserEmails.concat(categoryEmails);
        });

        // Handle file upload
        var attachmentInput = document.getElementById('attachment');
        var attachmentFile = attachmentInput.files[0]; // Get the first file selected by the user

        // Read the file content
        var reader = new FileReader();
        reader.onload = function(event) {
            var attachmentData = event.target.result; // File content as base64 string

            // Prepare data to be sent
            var eventData = {
                date: date,
                end_date: endDate,
                start_time: startTime,
                end_time: endTime,
                activity: activity,
                location: location,
                selected_emails: selectedUserEmails,
                attachment_data: attachmentData, // Add attachment data here
                attachment_name: attachmentFile.name // Add attachment name here
            };

            // Send data to save_event.php using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'save_event.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        // Directly use the response text (plain text)
                        var response = xhr.responseText;

                        // Log the response for debugging
                        console.log('Response from save_event.php:', response);

                        // Send event data to send_invitations.php
                        sendInvitations(eventData);

                        // Show a confirmation message for saving event
                        alert(response);
                    } else {
                        // Handle errors, if any
                        console.error('Error: ' + xhr.status);
                    }
                }
            };

            // Send the request
            xhr.send(JSON.stringify(eventData));
        };

        // Read the file as a Data URL
        reader.readAsDataURL(attachmentFile);
    }
</script>
</html>