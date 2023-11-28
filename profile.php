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
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
  <!-- <link rel="stylesheet" href="css/style.css"/> -->
  <title>Profile</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!--<link rel="stylesheet" href="css/bootstrap.theme.min.css">-->
  <script src="js/jquery.min.js"></script>
  <!--<script src="js/bootstrap.min.js"></script>-->
  
   <!-- Custom styles for this template -->
    <link href="css/offcanvas.css" rel="stylesheet">
  <script src="js/profile.js"></script>
  
    <!-- <link href="navbar-fixed-top.css" rel="stylesheet"> -->
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
            <a class="nav-link" href="teacher.php">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="statistics.php">Statistics</a>
          </li>
          
        </ul>
      
      </div>
    </nav>
</br></br></br></br>
  
  <div class="container">
    <?php
      $name = $_SESSION['name'];
      $phone = $_SESSION['phone'];
      $email = $_SESSION['email'];
      $classes = $_SESSION['classes'];
      $teacher_id = $_SESSION['teacher_id'];
      echo '<h2>Welcome , '.$name.'. Edit your profile here.</h2><br>';
    ?>
    <!-- <div class="wrapper">
      <dl class="dl-horizontal">
        <dt>Name : </dt>
        <dd>
          <div class="input-group">
          <span class="input-group-addon"></span></span>
          <input class="form-control" name="name" placeholder="Enter your name" value="<?php //echo $name; ?>">
          </div>
        </dd>
        <dt>Phone : </dt>
        <dd>
          <div class="input-group">
          <span class="input-group-addon"></span>
          <input class="form-control" name="phone" placeholder="Enter your phone" value="<?php //echo $phone; ?>">
          </div>
        </dd>
        <dt>Email : </dt>
        <dd>
          <div class="input-group">
          
          <input class="form-control" name="email" placeholder="Enter your email"  value="<?php //echo $email; ?>">
          </div>
        </dd>
        <dt>Classes : </dt>
        <dd><?php// echo $classes == 0? 0 : count($classes); ?></dd>
     </dl>
     </div>
    </div>
    <button class="btn btn-success update-profile">Save</button> -->

    <div class="form-group">
      <label for="usr">Name:</label>
        <input type="text" class="form-control" name="name" placeholder="Enter your name" value="<?php echo $name; ?>">
    </div>
    <div class="form-group">
      <label for="phn">Phone:</label>
      <input type="phone" class="form-control" name="phone" placeholder="Enter your phone" value="<?php echo $phone; ?>" >
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" placeholder="Enter your email" value="<?php echo $email; ?>">
    </div>
   <div class="form-group">
      <label for="class">Classes:</label>
       <h4><?php echo $classes == 0? 0 : count($classes); ?></h4>
    </div>
    <div class="form-group">
      <!-- <label for="class">Classes:</label> -->
        <!-- <button class="btn btn-success update-profile">Save</button> -->
        <button type="button" class="btn btn-success update-profile">Save</button>
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
