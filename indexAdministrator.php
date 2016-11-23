<?php 
include 'Classes/ClassAdmin.cls.php';
include 'Classes/dbConnection.php';
$conn= new PDO("mysql:host=$host;dbname=$dbname",$user, $pass);

?>


<!DOCTYPE html>
<html lang="en">
  <head>
  
    <title>Kijiji</title>    


    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">      
    <link rel="stylesheet" href="assets/css/main.css" type="text/css">       
    <link rel="stylesheet" href="assets/extras/owl.carousel.css" type="text/css"> 
      <style type="text/css">
          .auto-style1 {
              width: 100%;
          }
      </style>
  </head>

  <body>  
    

          <!-- Navbar Start -->
          <ul>
  <li><a class="active" href="#home">Home</a></li>
  <li><a href="#register">Register</a></li>
<li><a href="#login">Login</a></li>
  <li><a>French</a></li>
  <li><a>English</a></li>
  <li><a>Spanish</a></li>
</ul>
          <!-- Navbar End --> 
    
       <!-- Start Search box -->
            <div class="row search-bar">
              <div class="advanced-search">
                <form class="search-form" method="get">
                 
                  <div class="col-md-3 col-sm-6 search-col">
                    <input class="form-control keyword" name="keyword" value="" placeholder="Enter Keyword" type="text">
                    <i class="fa fa-search"></i>
                  </div>
                  <div class="col-md-3 col-sm-6 search-col">
                    <button class="btn btn-common btn-search btn-block"><strong>Search</strong></button>
                  </div>
                </form>
              </div>
            </div>
            <!-- End Search box -->
   

    <div class="wrapper">      

    


        <!--MEMBERS -->

      
    
        <div class="container">
          <div class="row">
              <h3 class="section-title">ALL CLIENTS</h3>
              
              <?php           
                   	//Display All Clients
 					//echo "Display all clients";
 					$templ = new Employee();
 					$arr = $templ->listAllClients($conn);
 					$templ->displayClients($conn, $arr, 'all');           

              ?>
              </div>
            </div>

        <button onclick="location.href='signup.php'" id="CreateUser" class="float-left submit-button" >Create an user</button>
        <button onclick="location.href='signupEmployee.php'" id="CreateUser" class="float-left submit-button" >Create an employee</button>
        <!-- END MEMBERS -->

        </div>


      <!-- ALL ADS -->
       <div class="container">
          <div class="row">
              <h3 class="section-title">ALL ADS</h3>
              <button onclick="location.href='postanAd.php'" id="post an ad" class="float-left submit-button" >Create an ad</button>


       </div>
            </div>
      <!-- End ALL ADS Section -->    
  

      <!--employee -->

      
    
        <div class="container">
          <div class="row">
              <h3 class="section-title">ALL EMPLOYEES</h3>
              
              <?php           
                 //Display All Employees
				//echo "Display all employees";
				$templ = new Admin();
				$arr = $templ->listAllEmployees($conn);
				$templ->displayEmployees($conn, $arr, 'all');
          
			   ?>

              </div>
            </div>
       
        <!-- END EMPLOYEES -->


    <!-- Main JS  -->
    <script type="text/javascript" src="assets/js/jquery-min.js"></script>      
    <script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="assets/js/wow.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>
  
  </body>
</html>

<?php 

$t=time();
echo(date("Y-m-d",$t));

?>