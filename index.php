<?php
session_start();
if (!isset($_SESSION['email'])) {
  header("Location: login.php");
  echo $_SESSION['email'];
  exit;
}
$email = $_SESSION['email'];
$greetings = "";
$minute = date('H:i');
    $time = date('H');
    if ($time < "12") {
        $greetings = "Good morning ";
    } else

    if ($time >= "12" && $time < "17") {
        $greetings = "Good afternoon ";
    } else
    if ($time >= "17" && $time < "19") {
        $greetings = "Good evening ";
    } else
    if ($time >= "19") {
        $greetings = "Good night ";
    }
$servername = "";
$username = "";
$password = "";
$dbname = "";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['addNotesButton'])){
$title = $_POST['notestitle'];
$notes = $_POST['notest'];
$sql = "INSERT INTO notes (title, notes, email) VALUES ('$title', '$notes', '$email')";
if ($conn->query($sql) === TRUE) {
    $message = "Note added successfully";
} else {
    $message = "Error: " . $sql . "<br>" . $conn->error;
}
header("Location: index.php");
}
if(isset($_POST['submitButton'])){ 
$title = $_POST['title'];
$description = $_POST['description'];
$deadline = $_POST['deadline'];
$time = $_POST['time'];
$email = $_SESSION['email'];
$sql = "INSERT INTO homework (email, homework, deadline, detail1, detail2) VALUES ('$email', '$title', '$deadline', '$description', '$time')";
if ($conn->query($sql) === TRUE) {
    echo "<script>Swal.fire({
  title: 'Success!',
  text: 'Homework added successfully!',
  icon: 'success',
  confirmButtonText: 'OK'
})</script>";
} else {
    echo "<script>Swal.fire({
  title: 'Error!',
  text: 'Something went wrong!',
  icon: 'error',
  confirmButtonText: 'OK'
})</script>";
}
header("Location: index.php");
}

if (isset($_POST['assignmentDone'])) {
$queryofsql = "DELETE FROM homework WHERE hwID = '$_POST[assignmentDone]'";
if ($conn->query($queryofsql) === TRUE) {
    echo "<script>Swal.fire({
  title: 'Success!',
  text: 'Homework deleted successfully!',
  icon: 'success',
  confirmButtonText: 'OK'
})</script>";
} else {
    echo "<script>Swal.fire({
  title: 'Error!',
  text: 'Something went wrong!',
  icon: 'error',
  confirmButtonText: 'OK'
})</script>";
header("Location: index.php");
}
}


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>dreLearn - Panel</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/index.css">
        <script src="https://kit.fontawesome.com/bc89b66626.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@500&display=swap" rel="stylesheet"> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
        <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    </head>
    <body>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<div class="container-fluid" style="margin: 10px 10px;">
    <section id="header" style="background-color: white;">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
              <h1 id="title">dreLearn</h1>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav" style="margin-left: auto;">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#widget">DASHBOARD</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#feature">FEATURE</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa-solid fa-user"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <li><a class="dropdown-item" href="logout.php">Log out</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
    </section>
    <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" class="scrollspy-example" tabindex="0">
      <div class="container">
      <h1 style="margin: 10px;"><?php echo $greetings; ?></h1>
</div>
    <section id="widget">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="box">
              <div class="container">
                <div class="row">
                    <div class="col">
                      <div class="column">
                        <div class="col-1">
                          <h4>Homework</h4>
                        </div>
                        </div>
                      </div>
                      <div class="col-1">
            <button type="button" class="btn" data-toggle="modal" data-target="#addHomeWork"  style="position: absolute; margin: 0px -37px;"><i class="fa-solid fa-plus"></i></button>
            </div>
                    </div>
            </div>
            <div class="container style="padding-left: 10px;">
            <div class="col" id="homework">
<div class="vertical carousel slide" data-ride="carousel" data-bs-ride="carousel" id="homeworks">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="col">
          <div class="row">
            <div class="col-10" style="padding-left: 0;">
            <?php  
          $sql1 = "SELECT * FROM homework WHERE email = '$email'";
          $result = $conn->query($sql1);
          if ($result->num_rows == 0) {
          echo "No homework";
          } else {
            echo "<p>You got homework.</p>
            <p>swipe or scroll to see, click on the title to view more</p>
            ";
          }
          ?>
            </div>
            <div class="col-1">
            <?php 
            ?>
            </div>
          </div>
      </div>
    </div>
        <?php
                    if ($result->num_rows == 0) {
                    } else {
          while ($row = $result->fetch_array()) {
            echo "<div class='carousel-item'>";
            echo "<div class='col'>";
            echo "<div class='row'>";
            echo "<div class='col-10' style='padding-left: 0;'>";
            $homework = $row['homework'];
            $deadline = $row['deadline'];
            $time = $row['detail2'];
            $description = $row['detail1'];
            $id = $row['hwID'];
            echo "<button data-toggle='modal' data-target='#$id' class='btn' style='margin: 1px;'><h4>$homework</h4></button>";
            echo "<p>$deadline $time</p>";
            echo "</div>";
            echo "<div class='col-1'>";
            echo "<form action='' method='post'>";
            echo "<button class='btn' style='position: absolute; margin: 0px -13px;' name='assignmentDone' value='$id'><i class='fa-solid fa-check' style='margin: 0px;'></i></button>";
            echo "</form>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "<div class='modal fade' id='$id' tabindex='-1' role='dialog' aria-labelledby='$id' aria-hidden='true'>";
            echo "<div class='modal-dialog modal-dialog-centered' role='document'>";
            echo "<div class='modal-content'>";
            echo "<div class='modal-header'>";
            echo "<h5 class='modal-title' id='$id'>$homework</h5>";
            echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
            echo "<span aria-hidden='true'>&times;</span>";
            echo "</button>";
            echo "</div>";
            echo "<div class='modal-body'>
            <p>$description</p>
            <div style='margin: 10px;'>
            </div>         
";
            echo "<p>$deadline $time</p>";
            echo "</div>";
            echo "<div class='modal-footer'>";
            echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
          }
        }

        ?>
  </div>
            </div>
          </div>
          </div>
          </div>
          </div>
          <div class="col-md-4">
            <div class="box">
              <div class="container">
                <div class="row">
                  <div class="col">
                    <h4>Time spent on HW</h4>
                    <p style="position: absolute; margin: -15px 0px;">Today vs yesterday</p>
                    <div class="column">
                      <div class="col">
                        <h2>n/a</h2>
                      </div>
                    </div>
                  </div>
                  <div class="col-2">
                    <i class="fas fa-caret-up" style="font-size: 35px;"></i>
                    <p>??%</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="box">
              <div class="container">
                <h4>Update</h3>
                  <h1>n/a</h1>
              </div>
            </div>
          </div>
        </div>
</div>
    </section>
    <section id="feature">
      <div class="container">
        <h1>Feature</h1>
        <div class="container-fluid">
          <div class="row" >
          <div class="col-md-4" style="margin: 15px 0px">
                <div class="card h-100">
                  <a data-toggle='modal' data-target='#notes' href="/notes.php"><img datadata-toggle='modal' data-target='#notes' href="/notes.php" style="" src="https://searchengineland.com/wp-content/seloads/2018/05/adwords-notes-type-note.jpg" style="height: 250px; width: 250px;   margin-left: auto; margin-right: auto;" class="card-img-top notes" alt="..."></a>
                  <div class="card-body">
                    <h5 class="card-title"><a data-toggle='modal' data-target='#notes' href="notes.php">Notes <span class="badge bg-secondary">Experimental</span></a></h5>
                    <a data-toggle='modal' data-target='#notes' href="/notes.php"">Add your simple notes here, to help you organize your notes.</a>
                  </div>
                </div>
          </div>
          <div class="col-md-8">
          </div>
          </div>
        </div>

      </div>
    </section>
    </div>
</div>
<div class="modal fade" id="notes" tabindex="-1" role="dialog" aria-labelledby="notes" aria-hidden="true">
<div class='modal-dialog modal-dialog-centered' role='document'>
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Your Notes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <button  data-toggle='modal' data-target='#notesMenu' class="btn btn-primary" style="margin: 5px;">Add a note</button>
        <div id='carouselExampleControls' class='carousel slide' data-bs-ride='carousel'>
          <div class='carousel-inner'>
          <div class='carousel-item active'>
                <div class='card h-100'>
                  <div class='card-body'>
                    <h5 class='card-title'>Developer Update</h5>
                    <p>- Added notes feature, still on experimental mode, functionality may depend on luck.</p>
                    <p>- Fixed homework widget not displaying bug.</p>
                  </div>
              </div>
            </div>
<?php
$sql4 = "SELECT * FROM notes";
$result4 = mysqli_query($conn, $sql4);
if (mysqli_num_rows($result4) > 0) {
  while($row = mysqli_fetch_assoc($result4)) {
    $title = $row['title'];
    $content = $row['notes'];
echo "       <div class='carousel-item'>
              <div class='col'>
                <div class='card h-100'>
                  <div class='card-body'>
                    <h5 class='card-title'>$title</h5>
                    <p>$content</p>
                  </div>
                </div>
              </div>
            </div>
        ";
  }} else {
    echo "No notes found, consider creating one!";
  }
        ?>
                  </div>
          <button class='carousel-control-prev' type='button' data-bs-target='#carouselExampleControls' data-bs-slide='prev'>
            <span class='carousel-control-prev-icon' aria-hidden='true'></span>
            <span class='visually-hidden'>Previous</span>
          </button>
          <button class='carousel-control-next' type='button' data-bs-target='#carouselExampleControls' data-bs-slide='next'>
            <span class='carousel-control-next-icon' aria-hidden='true'></span>
            <span class='visually-hidden'>Next</span>
          </button>
        </div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal menu for notes !-->
<div class="modal fade" id="notesMenu" tabindex="-1" role="dialog" aria-labelledby="notesMenu" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Notes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
          <div class="form-group">
          <label for="exampleInputEmail1">Title</label>
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter title" name="notestitle" required>
            <label for="exampleFormControlTextarea1">Notes</label>
            <textarea class="form-control" name="notest" id="exampleInputPassword1" placeholder="Enter description" required></textarea>
            <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="addNotesButton" >Add</button>
      </div>
          </div>
        </form>
      </div>
</div>
</div>


<!-- Modal menu for add homework-->
<div class="modal fade" id="addHomeWork" tabindex="-1" role="dialog" aria-labelledby="addHomeWork" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Homework</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
      <div class="modal-body">
      <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter title" required maxlength="15">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Description</label>
            <textarea class="form-control" name="description" id="exampleInputPassword1" placeholder="Enter description"></textarea>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Deadline</label>
            <input type="date" class="form-control" name="deadline" id="exampleInputPassword1" placeholder="Enter deadline" required>
            <label for="exampleInputPassword1">Time</label>
            <input type="time" class="form-control" name="time" id="exampleInputPassword1" placeholder="Enter time" required>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="submitButton" >Add</button>
      </div>
    </form>
    </div>
  </div>
</div>
<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("header");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= 80) {
    navbar.classList.add("fixed-top")
  } else {
    navbar.classList.remove("fixed-top");
  }
}




  $(document).ready(function(){
    $('#myCarousel').carousel({
      interval:6000
    });
$('#homeworks').bind('mousewheel DOMMouseScroll', function(e){

        if(e.originalEvent.wheelDelta > 0 || e.originalEvent.detail < 0) {
            $(this).carousel('prev');
			
			
        }
        else{
            $(this).carousel('next');
			
        }
    });
 	$("#homeworks").on("touchstart", function(event){
 
        var yClick = event.originalEvent.touches[0].pageY;
    	$(this).one("touchmove", function(event){

        var yMove = event.originalEvent.touches[0].pageY;
        if( Math.floor(yClick - yMove) > 1 ){
            $(".carousel").carousel('next');
        }
        else if( Math.floor(yClick - yMove) < -1 ){
            $(".carousel").carousel('prev');
        }
    });
    $(".carousel").on("touchend", function(){
            $(this).off("touchmove");
    });
});
});


</script>



        
        <script src="" async defer></script>
    </body>
</html>
