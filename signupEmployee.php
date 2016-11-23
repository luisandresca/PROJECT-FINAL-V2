<?php 
include 'Classes/ClassLanguage.cls.php';
include 'Classes/ClassCategory.cls.php';
include 'Classes/ClassSubCategory.cls.php';
include 'Classes/dbConnection.php';
include 'Classes/ClassAdmin.cls.php';

session_start();

$conn= new PDO("mysql:host=$host;dbname=$dbname",$user, $pass);

//Diferent names for load the pages

if (isset($_GET['lang'])&& isset($_GET['catidv']))
{
	$lang =$_GET['lang'];
	$langid=$_GET['catidv'];
}
else 
{
	$lang=$_SESSION['lang'];
	$langid=$_SESSION['catidv'];
}


if ($lang == 'es')
{
	$phname="Nombre";
	$phaddr="Direccion";
	$phcity="Ciudad";
	$phstat="Estado";
	$phphon="Telefono";
	$phretypepass="Confirmar Password";
	$phbtnreg="Registrarse";
	$phbtnback="Ir al inicio";
	$urlredirection="index.spanish.php";
	//echo "Espanol";
}
elseif ($lang=='fr')
{
	//TO DO TRANSLATE TO FRENCH
	
	$phname="Nom";
	$phaddr="Adresse";
	$phcity="Ville";
	$phstat="Province";
	$phphon="Téléphone";
	$phretypepass="Confirmez le mot de passe";
	$phbtnreg="Enregistrement";
	$phbtnback="Retour";
	$urlredirection="index.french.php";
	
	//echo "Frances";
}
else
{
	//echo "Ingles";
	$phname="Name";
	$phaddr="Address";
	$phcity="City";
	$phstat="State";
	$phphon="Phone";
	$phretypepass="Retype Password";
	$phbtnreg="Register";
	$phbtnback="Go to Home";
	$urlredirection="index.english.php";
	
}


if (isset($_GET['name'])&&isset($_GET['address'])&&isset($_GET['city'])&&
		isset($_GET['state'])&&isset($_GET['phone'])&&isset($_GET['phone'])&&
		isset($_GET['email'])&&isset($_GET['password']))
{
	echo "register";
	//membertype $mtype =$_GET['membertype'];
	$name=$_GET['name'];
	$address=$_GET['address'];
	$city=$_GET['city'];
	$state=$_GET['state'];
	$phone=$_GET['phone'];
	$email=$_GET['email'];
	$password=$_GET['password'];

	$temployee = new Admin(null, "$name", "$address", 3, "$city", "$state", "$phone","$email", "$password");
	$result = $temployee->createEmployee($conn);

	$newURL="login.php";
	if (empty ($result)){ header('Location: '.$newURL);}
	else{
		echo"ERROR TO INSERT THE CLIENT";
		$arr =$conn -> errorInfo();
		echo $arr[2]."<br/>";
	}
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    
    <title>Sign up</title> 
    <link rel="stylesheet" href="assets/css/main.css" type="text/css">

  </head>

  <body>  
   

    <!-- Page Header Start -->
    <div class="page-header" style="background: url(assets/img/banner1.jpg);">
      <div class="container">
        <div class="row">         
          <div class="col-md-12">
            <div class="breadcrumb-wrapper">
              <h2 class="page-title">Join Us</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page Header End --> 

    <!-- Content section Start --> 
    <section id="content">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <div class="page-login-form box">
              <h3>
                Register
              </h3>
              <form role="form" class="login-form" action="#" method="get">
                  <div class="form-group">
                  <div class="input-icon">
                   
                    <input type="text" id="Name" class="form-control" name="name" placeholder='<?php echo $phname;?>'>
                  </div>
                </div> 

                  <div class="form-group">
                  <div class="input-icon">
                   
                    <input type="text" id="Address" class="form-control" name="address" placeholder='<?php echo $phaddr;?>'>
                  </div>
                </div> 

                  <div class="form-group">
                  <div class="input-icon">
                    
                    <input type="text" id="City" class="form-control" name="city" placeholder="<?php echo $phcity?>">
                  </div>
                </div> 

                  <div class="form-group">
                  <div class="input-icon">
                   
                    <input type="text" id="State" class="form-control" name="state" placeholder="<?php echo $phstat;?>">
                  </div>
                </div> 

                  <div class="form-group">
                  <div class="input-icon">
                    
                    <input type="text" id="Phone" class="form-control" name="phone" placeholder='<?php echo $phphon;?>'>
                  </div>
                </div> 

               
                <div class="form-group">
                  <div class="input-icon">
                  
                    <input type="text" id="email" class="form-control" name="email" placeholder="Email Address">
                  </div>
                </div> 
                <div class="form-group">
                  <div class="input-icon">
                   
                    <input type="password" class="form-control" name="password" placeholder="Password">
                  </div>
                </div>  
                <div class="form-group">
                  <div class="input-icon">
                   
                    <input type="password" class="form-control" placeholder='<?php echo $phretypepass?>'>
                  </div>
                </div>                 
               
                <input type="submit" class="btn btn-common log-btn" value='<?php echo $phbtnreg;?>'>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Content section End --> 

    

      
  
    
  </body>
</html>

<?php 
$t=time();
echo(date("Y-m-d",$t));
?>