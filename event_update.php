<?php
include("connect.php");
include('session_management.php');
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $matter = $_POST['matter'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $sql = "INSERT INTO events_update (title, matter, location, date) VALUES ('$title', '$matter', '$location', '$date')";
    mysqli_query($con, $sql);

    
        echo '
        <div class="container-fluid">
                <div class="container-fluid alert alert-success alert-dismissible fade show" role="alert" style="width:25%;margin-top:50px;position:relative;">
                Event Details Added Successfully!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        </div>';
    
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link rel="icon" href="favicon.ico" type="image/ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Update Event Details</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500&display=swap');
    
    body{
        font-family: 'Space Grotesk', sans-serif;
    }

    </style>
</head>

<body>

<div style="width: 50%;height: 50%;margin: auto;position: absolute;top: 0;bottom: 0;left: 0;right: 0;">
<form action="#" method="post" class="w-50 mx-auto">
    <div class="form-group">
    <h2 style="float: left;text-transform: uppercase;"><b>Update Event Details</b></h2><BR>
    </div>
    <div class="form-group">
    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" autocomplete="off" required>
    </div><br>
    <div class="form-group">
    <input type="text" class="form-control" id="matter" name="matter" placeholder="Enter Description" autocomplete="off" required>
    </div><br>
    <div class="form-group">
    <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location" autocomplete="off" required>
    </div><br>
    <div class="form-group">
    <input type="date" class="form-control" id="date" name="date" placeholder="Enter Date" autocomplete="off" required>
    </div><br>
    <button type="submit" name="submit" class="btn btn-success">POST EVENT DETAILS</button>
</form>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>  

</body>
</html>


