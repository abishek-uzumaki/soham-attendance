<?php
  $isIndex = 0;
  session_start();
  if(!(array_key_exists('teacher_id',$_SESSION) && isset($_SESSION['teacher_id']))) {
    session_destroy();
    if(!$isIndex) header('Location: index.php');
  }
?>
<?php include 'php/node_class.php'; ?>
<?php
  /*
  login -> session ave iomething season identify teacher
  addClass -> we will get a link , which will have cN as an identifier of the class
  we use these to find the 'object' of this particular class
  then we show the list of students , with their attendance and stuff 
  then we have javascript which will function on the buttons next to each student
  then we have a save button
  */
  $teacher_id = $_SESSION['teacher_id'];
  $classes = $_SESSION['classes'];
  $name = $_SESSION['name'];
  
  if(!isset( $_GET['cN'] ) || empty( $_GET['cN'] )) {
    die('<h1>Invalid Request</h1>');
  }
  $class_id = $_GET['cN'];
  
  if(!in_array($class_id,$classes)) die( "No such record." );
  // Assuming that we have validated and thrown errors if any , we proceed 
  // By finding the particular object we are talking about 
  
  // Connecting to the database 
  $classNode = new Node;
  $node = $classNode->retrieveObjecti($class_id,$teacher_id) or die("No such record");

  // Intimating the teacher about Number of Classes , and student list
  // A foreach loop which will go on till all students are covered 
  $records = $node->getRecords();
?>
<html>
 <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
  <link rel="stylesheet" href="css/style.css"/>
  <title><?php echo $name. ' - '.$node->getCode(). ' ('.$node->getSection().') '.$node->getYear(); ?></title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!--<link rel="stylesheet" href="css/bootstrap.theme.min.css">-->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!--<link rel="stylesheet" href="css/bootstrap.theme.min.css">-->
  <script src="js/jquery.min.js"></script>
  <!--<script src="js/bootstrap.min.js"></script>-->
  <script src="js/login.js"></script>
   <!-- Custom styles for this template -->
    <link href="css/offcanvas.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
  
  <script src="js/bootstrap.min.js"></script>
  <!-- Custom styles for this template -->
    <!-- <link href="navbar-fixed-top.css" rel="stylesheet"> -->
  <script>
    var numberOfDays = <?php echo $node->getDays(); ?>;
    var class_id = <?php echo $class_id;?>;
    var teacher_id = <?php echo $teacher_id; ?>;
  </script>
  <script src="js/take.js"></script>
 </head>
 <!-- <body>
  
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Online Attendance</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
			<li><a href="teacher.php">Dashboard</a></li>
			<li><a href="profile.php">Profile</a></li>
            
			<li><a href="statistics.php">Statistics</a></li>
			<li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
			<li><a href="logout.php">Logout</a></li>
          
          </ul>
        </div>
      </div>
    </nav></br></br></br></br> --> 
    <body class="bg-light">

    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
      <a class="navbar-brand mr-auto mr-lg-0" href="index.php">RCC Online Attandance</a>
      <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#"> <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="teacher.php">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="profile.php">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
          <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li> -->
        </ul>
      <!--   <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form> -->

      </div>
    </nav>
    
  
  <div class="container"> 
    <?php 
      echo '<h1>Welcome , '.$name.'</h1>';
      echo '<h3>Class : '.$node->getCode(). ' ('.$node->getSection().') '.$node->getYear().'</h3>';
      echo '<h3>Number of Classes conducted : '.$node->getDays().'</h3>';
      echo '<button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Help me!</button> <button id="submit" class="btn btn-success">Send</button>';
    ?>
    <div id="studentRecords">
    <?php
      foreach($records as $roll => $data) {
        echo '<div class="student-record">
          <span class="roll"><a href="student.php?roll='.str_replace("/","-",$roll).'&code='.$node->getCode().'&year='.$node->getYear().'&section='.$node->getSection().'">'.$roll.'</a></span>: 
          <span class="present">'.$data['present'].'</span>'.
          ' <button class="marker btn">A</button> <button class="btn btn-danger delete-roll" data-toggle="modal" data-target=".delete-warning">&times;</button>
        </div>';
      }      
    ?>
    </div>
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <h2 class="text-center"> Instructions </h2>
          <hr>
          <ol class="text-left">
            <li>Click on any student's roll number to see his/her records, attendance percentage etc.</li>
            <li>The number next to any student shows the number of days he/she has attended your class</li>
            <li>Click the <button class="btn">A</button> button next to that roll number to mark that student as present</li>
            <li>Click the <button class="btn btn-success">P</button> button if you have accidentally marked that student as present</li>
            <li>Click the <button class="btn btn-danger">&times;</button> button to delete that roll number (can't undo this action)</li>
            <li>Click the <button class="btn btn-success">Send</button> button at top to save your attendance details</li>
          </ol>
        </div>
      </div>
    </div>
    <div class="modal fade delete-warning" tabindex="-1" role="dialog" aria-labelledby="delete-warning" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <h2 class="text-center"> Do you really want to delete <span class="warning-roll"></span> ?</h2>
          <hr>
          <div class="text-center">
            <p>
              Are you sure you want to delete <span class="warning-roll"></span> ? <br>
              You can't undo this action.
            </p>
            <button class="btn btn-danger delete-rollnumber">Delete</button> <button class="btn btn-primary" onclick="$('.delete-warning').modal('hide');">Cancel</button>
          </div>
        </div>
      </div>
    </div> 
  </div>

      <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script>window.jQuery || document.write('<script src="js/jquery-slim.min.js"><\/script>')</script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/holder.min.js"></script>
    <script src="js/offcanvas.js"></script>
 </body>
</html>
