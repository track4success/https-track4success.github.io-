<link rel="stylesheet" type="text/css" href="dashboard/dashboard.css" />
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
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
    .row {
        margin-top: -20px;
        margin-bottom: 50px;
        position: relative;
    }
    .row img {
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
    }
    .welcome-message {
        position: absolute;
        top: 50%;
        left: 5%;
        transform: translateY(-50%);
        color: white;
        font-size: 30px;
        font-family: 'Poppins', sans-serif;
        text-align: left;
    }
    .welcome-message span {
        font-size: 18px;
    }
    @media (max-width: 768px) {
        .welcome-message {
            font-size: 24px;
            left: 5%;
        }
        .welcome-message span {
            font-size: 16px;
        }
    }
    @media (max-width: 480px) {
        .welcome-message {
            font-size: 18px;
            left: 5%;
        }
        .welcome-message span {
            font-size: 14px;
        }
    }
</style>
</head>
<body>
    <div class="row">
        <img src="..//assets/images/admin/admin-banner.png" alt="banner">
        <div class="welcome-message">
            Welcome back, Teacher <?php echo htmlspecialchars($firstname); ?>!<br>
            <span>Manage users accounts and announcements.</span>
        </div>
    </div>



<div class="row">
    <div class="col-md-12">
        <div class="row" style="">
            <div class="col-xs-12 col-md-4">
                <a href="index.php?url=seller">
                    <div class="card" style="margin-bottom: 15px;">
                            <div class="box bg-info" style="background: #FFFFFF;  box-shadow: 2px 3px 5px rgb(126, 142, 159);">
                                <h5 class="font-light textdashboardboxes2" style="color: #4C644B ;">Total Users</h5>
                                <div class="dboxicon">
                                    <!-- <i class="fas fa-users"></i> -->
                                </div>
                            </div>
                    </div>
                </a>
            </div>
            <div class="col-xs-12 col-md-4">
                <a href="index.php?url=customer">
                    <div class="card" style="margin-bottom: 15px; ">
                            <div class="box bg-info" style="box-shadow: 2px 3px 5px rgb(126, 142, 159);">
                                <!-- <h1 class="textdashboardboxes" id="txtTotcustomer" style="color: #4C644B ;">0</h1> -->
                                <h5 class="font-light textdashboardboxes2" style="color: #4C644B ;">Announcements</h5>
                                <div class="dboxicon">
                                    <!-- <i class="fas fa-user-friends"></i> -->
                                </div>
                            </div>
                    </div>
                </a>
            </div>
            <div class="col-xs-12 col-md-4">
                <a href="index.php?url=products">
                    <div class="card" style="margin-bottom: 15px;">
                        <div class="box bg-info" style="box-shadow: 2px 3px 5px rgb(126, 142, 159);">
                            <!-- <h1 class="textdashboardboxes" id="txtTotproduct" style="color:#4C644B ;">0</h1> -->
                            <h5 class="font-light textdashboardboxes2" style="color:#4C644B ;">Upcoming Events</h5>
                            <div class="dboxicon">
                                <!-- <i class="fas fa-boxes"></i> -->
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<script src="assets/plugins/Chart.js/Chart.min.js"></script>
<?php
include("dashboard/modal.php");
include("dashboard/dashboardscript.php");
?>
<script>
    $('#selectchart').change(function() {
        if ($(this).val() == 'weekly') {
            $('.weekly').css('display', 'block')
            $('.monthly').css('display', 'none')
            $('.yearly').css('display', 'none')
        } else if ($(this).val() == 'monthly') {
            $('.monthly').css('display', 'block')
            $('.weekly').css('display', 'none')
            $('.yearly').css('display', 'none')
        } else if ($(this).val() == 'yearly') {
            $('.yearly').css('display', 'block')
            $('.weekly').css('display', 'none')
            $('.monthly').css('display', 'none')
        }
    })
</script>