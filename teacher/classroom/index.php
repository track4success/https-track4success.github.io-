<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<style type="text/css">
.Iclass {
    font-size: 1.3rem;
    cursor: pointer;
    font-weight: 500;
}

ul.pagination {
    display: inline-block;
    padding: 0;
    margin: 0;
}

ul.pagination li {
    cursor: pointer;
    display: inline;
    color: #3a4651 !important;
    font-weight: 600;
    padding: 4px 8px;
    border: 1px solid #CCC;
}

.pagination li:first-child {
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
}

.pagination li:last-child {
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
}

ul.pagination li:hover {
    background-color: #3a4651;
    color: white !important;
}

.pagination .active {
    background-color: #3a4651;
    color: white !important;
}

.table thead th,
.table th {
    background-color: #9e9e9e !important;
}

.swal2-icon {
    margin-bottom: 10px !important;
}

.modalpaddingnew {
    padding-left: 5px;
    margin-bottom: 10px;
}
</style>

<!-- <div class="row">
    <div class="col-12">
        <div class="card" style="margin-bottom: 0px;">
            <div class="card-body" style="padding-top: .5rem; padding-bottom: .5rem; border-radius: 5px; box-shadow: 2px 3px 5px rgb(126, 142, 159);">
                <div class="row page-titles rowpageheaderpadd" style="padding-bottom: 0px;">
                    <div class="col-md-6 col-6 align-self-center" style="padding-left:10px;">
                        <h3 class="mb-0 mt-0 headerfontfont" style="font-weight: 600;">Announcements</h3>
                    </div>
                </div>
            
                <div class="row">
                    <div class="col-12 text-center" style="margin-top: 20px;">
                        <img src="..//assets/images/admin/newpost.png" alt="">
                        <button class="btn" style="background: #2C4E80; border-radius: 10px; color: #FFFFFF; margin-top: 10px;">New Post</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="row">
    <div class="col-12">
        <div class="card" style="margin-bottom: 0px;">
            <div class="card-body" style="padding-top: .5rem; padding-bottom: .5rem; border-radius: 5px; box-shadow: 2px 3px 5px rgb(126, 142, 159);">
                <div class="row page-titles rowpageheaderpadd" style="padding-bottom: 0px;">
                    <div class="col-md-6 col-6 align-self-center" style="padding-left:10px;">
                        <h3 style="font-weight: 400; font-family: 'Poppins'; font-size: 1.75rem;">Classroom</h3>
                    </div>
                </div>
                <!-- Centered Image and Button -->
                <div class="row">
                    <div class="col-12 text-center" style="margin-top: 80px;">
                        <img src="assets/images/no-classroom.png" alt="">
                    </div>
                    <div class="col-12 text-center">
                        <p>Add a class to get started</p>
                    </div>
                    <div class="col-12 text-center"style="margin-bottom: 100px;">
                    <button class="btn" style="background: #2C4E80; border-radius: 10px; color: #FFFFFF; margin-top: 10px;">Create Class</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
include("classroom/modal.php");
include("classroom/script.php");
?>