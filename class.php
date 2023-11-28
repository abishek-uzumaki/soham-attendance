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
  <!-- <link rel="stylesheet" href="css/style.css"/> -->
  <title>Edit Class</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="css/bootstrap-theme.min.css"> -->
   <!-- Custom styles for this template -->
    <link href="css/offcanvas.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/class.js"></script>
  <style>.form-control{display:inline-block !important; width: 185px !important; margin:5px !important;}.details{padding:5px 10px;margin-bottom:30px;border: 1px solid lightgrey;border-top: none;}}</style>
 </head>
 <!-- <body>
  <div id="header" class="clearfix">
    <h1>RCC Institute of Information Technology</h1>
    <h3>Edit Class</h3>	
  </div>
  <nav class="navbar navbar-default" id="sub-menu">  
    <div class="navbar-header">    
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">      
        <span class="sr-only">Toggle navigation</span>      
        <span class="icon-bar"></span>      
        <span class="icon-bar"></span>      
        <span class="icon-bar"></span>    
      </button>  
    </div>  
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">    
      <ul class="nav navbar-nav navbar-left">      
        <li><a href="teacher.php">Home</a></li>
        <li><a href="profile.php">Profile</a></li>
        <li class="active"><a href="class.php">Classes</a></li>
        <li><a href="statistics.php">Statistics</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>  
    </div>  
  </nav>  -->

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
            <a class="nav-link" href="teacher.php">Home</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="class.php">Edit Classes</a>
          </li>
           <li class="nav-item ">
            <a class="nav-link" href="profile.php">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="statistics.php">Statistics</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
         
        </ul>
      
      </div>
    </nav>



<br><br><br>

  <div class="container">
    <h2> You can edit details of your classes here. </h2>
    <?php
      $classes = $_SESSION['classes'];
      $teacher_id = $_SESSION['teacher_id'];
      if(!$classes) echo '<h4> You haven\'t taken any classes yet. </h4>';
      else {
        foreach($classes as $class_id) {
          $n = new Node;
          $node = $n->retrieveObjecti($class_id,$teacher_id) or die("No such record");
          $code = $node->getCode();
          $section = $node->getSection();
          $year = $node->getYear();
          $semester = $node->getSemester();
          
          echo '<ul class="nav nav-tabs">
                  <li class="active"><a href="#"><strong>'.$code . ' ( '.$section.' ) , '.$year.'</strong></a></li>
                </ul>';
          echo '<div class="details" id="_'.$class_id.'_">';
          echo 'Code : <input class="form-control" name="code" value="'.$code.'" placeholder="Enter code , eg COE-123">';
          echo 'Year : <input class="form-control" name="year" value="'.$year.'" placeholder="Enter Year">';
          echo 'Section : <input class="form-control" name="section" value="'.$section.'" placeholder="Enter Section">';
          echo 'Semester : <input class="form-control" name="semester" value="'.$semester.'" placeholder="Enter Semester">';
          echo '<button class="btn btn-success update">Update</button>';
          echo '</div>';
        }
      }
    ?>
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
