<?php
include("../connect.php");
session_start();

// Check if user is logged in (you should implement your own authentication logic)
if (!isset($_SESSION['teachers_id'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit();
}

// Get firstname from session
$firstname = $_SESSION['firstname'];
?>
<head>
<link rel="stylesheet" type="text/css" href="dashboard/dashboard.css" />
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }
        .banner-container {
            position: relative;
            width: 100%;
            height: auto;
            margin: -20px 0 50px;
        }
        .banner-container img {
            width: 100%;
            height: auto;
            display: block;
        }
        .overlay {
            position: absolute;
            top: 50%;
            left: 5%;
            transform: translateY(-50%);
            color: white;
            font-size: 30px;
            text-align: left;
        }
        .profile {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .profile img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 5px solid white;
            object-fit: cover;
        }
        .profile-info {
            display: flex;
            flex-direction: column;
        }
        .username {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .map-marker {
            margin-top: 5px;
            font-size: 20px; /* Adjust this value to make the map marker smaller */
        }
        @media (max-width: 768px) {
            .overlay {
                font-size: 24px;
            }
            .profile img {
                width: 80px;
                height: 80px;
            }
        }
        @media (max-width: 480px) {
            .overlay {
                font-size: 18px;
            }
            .profile img {
                width: 60px;
                height: 60px;
            }
        }
    </style>
</head>
<body>
    <div class="banner-container">
        <img src="../assets/images/banner.png" alt="banner">
        <div class="overlay">
            <div class="profile">
                <img src="assets/images/profile2.png" alt="User Image">
                <div class="profile-info">
                    <div class="username">
                        <?php echo htmlspecialchars($firstname); ?> <i class="fas fa-edit"></i>
                    </div>
                    <i class="fas fa-map-marker-alt map-marker" style="color: #FFFFFF;"></i>
                </div>
            </div>
        </div>
    </div>


<div class="col-xs-12">
        <div class="card" style="margin-bottom: 15px;">
            <div class="box bg-info1" style="background: #FFFFFF; box-shadow: 2px 3px 5px rgb(126, 142, 159);">
                <h5 style="color: #000000; font-size: 20px">Personal Information</h5>
                <hr style="border: .5px solid #817F7F;">
                <div class="infos">
                    <ul style="columns: 2; -webkit-columns: 2; -moz-columns: 2; list-style-type: none; padding-left: 20px; color: #000000;">
                        <li style="margin-bottom: 10px;"><i class="fas fa-calendar-alt" style="color: #5D9EFE;"></i> Date of Birth:</li>
                        <li style="margin-bottom: 10px;"><i class="fas fa-city" style="color: #5D9EFE;"></i> Place of Birth:</li>
                        <li style="margin-bottom: 10px;"><i class="fas fa-map-marker-alt" style="color: #5D9EFE;"></i> Address:</li>
                        <li style="margin-bottom: 10px;"><i class="fas fa-flag" style="color: #5D9EFE;"></i> Nationality:</li>
                        <li style="margin-bottom: 10px;"><i class="far fa-user" style="color: #5D9EFE;"></i> Sex:</li>
                        <li style="margin-bottom: 10px;"><i class="fas fa-mobile-alt" style="color: #5D9EFE;"></i> Mobile Number:</li>
                        <li style="margin-bottom: 10px;"><i class="fas fa-envelope-open-text" style="color: #5D9EFE;"></i> Personal Email:</li>
                    </ul>
                </div>
            </div>
        </div>
</div>

</body>

<script src="assets/plugins/Chart.js/Chart.min.js"></script>
<?php
include("user/modal.php");
include("user/dashboardscript.php");
?>
