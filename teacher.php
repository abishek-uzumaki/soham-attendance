<?php
  session_start();
  $isIndex = 0;
  if(!(array_key_exists('teacher_id',$_SESSION) && isset($_SESSION['teacher_id']))) {
    session_destroy();
    if(!$isIndex) header('Location: index.php');
  }
?>
<?php include 'php/node_class.php'; ?>
<html>
 <head>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
  <link rel="stylesheet" href="css/style.css"/>
  <title>Teacher</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!--<link rel="stylesheet" href="css/bootstrap.theme.min.css">-->
  <script src="js/jquery.min.js"></script>
  <!--<script src="js/bootstrap.min.js"></script>-->
  <script src="js/login.js"></script>
   <!-- Custom styles for this template -->
    <link href="css/offcanvas.css" rel="stylesheet">
  <script src="js/teacher.js"></script>
  
 </head>
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
            <a class="nav-link" href="student.php">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="class.php">Edit Class</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="statistics.php">Statistics</a>
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
    </nav></br></br></br></br>
 
  <div class="container">
    <?php
      $name = $_SESSION['name'];
      $classes = $_SESSION['classes'];
      $teacher_id = $_SESSION['teacher_id'];
      echo '<h2>Welcome , '.$name.'.</h2>';
      echo '<div class="wrapper">';
      // FOR EACH CLASS , GET IT'S INFO AND PREPARE A LINK
      $n = new Node;
       
      if(!$classes) {
        echo '<h3 class="no-classes">You haven\'t taken any class yet!</h3>';
      } else { 
        echo '<h3 class="no-classes">Click on a class to take attendance.</h3>';
        foreach($classes as $class_id) {
          $node = $n->retrieveObjecti($class_id,$teacher_id) or die("No such record");
          $code = $node->getCode();
          $section = $node->getSection();
          $year = $node->getYear();
          $numClasses = $node->getDays();
          $link = 'take.php?cN='.$class_id;
          echo '<div class="class"> 
            <button class="btn btn-danger delete-class-warning" data-toggle="modal" data-target=".delete-warning">&times;</button>
            <a class="no-decoration" href="'.$link.'">
            <div><strong>Code</strong> : <span class="code">'.$code.'</span></div> 
            <div><strong>Section</strong> : <span class="section">'.$section.'</span></div> 
            <div><strong>Year</strong> : <span class="year">'.$year.'</span></div> 
            <div><strong>Classes</strong> : '.$numClasses.'</div> 
          </div></a>';
        }
      }
      echo '<div class="class" data-toggle="modal" data-target=".bs-example-modal-lg" id="addClass">
          <span class=" glyphicon glyphicon-plus"></span>
          <img src="img/ic_add_box.svg" alt="icon name">
        </div>
      </div>';   
    ?>
    
  </div>
  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="addClass" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <h2 class="text-center"> Add Class </h2>
          <hr>
            <div id="add_class_form">
              <select class="form-control" name="year">
              <?php foreach(range(date('Y',time()),1983) as $r) echo '<option>'.$r.'</option>'; ?>
              </select>
              <input class="form-control" name="code" placeholder="Code , Eg : COE-322">
              <select class="form-control" name="section">
              <option value="-1">Choose Section</option>
              <?php foreach(range(1,3) as $r) echo '<option>'.$r.'</option>'; ?>
              </select>
              <select class="form-control" name="semester">
              <option value="-1">Choose Semester</option>
              <?php foreach(range(1,8) as $r) echo '<option>'.$r.'</option>'; ?>
              </select>
              <input class="form-control" name="start" placeholder="Starting Roll Number (Eg. 201/CSE/12)">
              <input class="form-control" name="end" placeholder="Ending Roll Number (Eg. 265/CSE/12)">
              <button class="btn btn-primary" id="add">Add Class</button>
              <button class="btn" id="cancel">Cancel</button>
            </div>
        </div>
    </div>
  </div>
  <div class="modal fade delete-warning" tabindex="-1" role="dialog" aria-labelledby="delete-warning" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <h2 class="text-center"> Do you really want to delete <br> <span class="warning-class"></span> ?</h2>
        <hr>
        <div class="text-center">
          <p>
            Are you sure you want to delete <span class="warning-class"></span> ? <br>
            You can't undo this action.
          </p>
          <button class="btn btn-danger delete-class-code">Delete</button> <button class="btn btn-primary" onclick="$('.delete-warning').modal('hide');">Cancel</button>
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
