<?php 
include 'Classes/ClassLanguage.cls.php';
//include 'Classes/ClassCategory.cls.php';
//include 'Classes/ClassSubCategory.cls.php';
include 'Classes/dbConnection.php';
include 'Classes/ClassClient.cls.php';

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
	$urlredirection="index.english.php";
	
}

$sqlCmd ="SELECT DISTINCT categories.categoryID, categories.categoryName
		  FROM categories
		  JOIN subcategories
		  ON subcategories.categoryID=categories.categoryID
          JOIN languages
          ON categories.languageID = languages.languageID
          WHERE languages.languageID =:lang;
			";


$prepQuery = $conn ->prepare($sqlCmd);
$prepQuery->bindParam(":lang",$langid, PDO::PARAM_INT);
$prepQuery->execute();
$resultLang= $prepQuery->fetchAll();



//only subcategories
SELECT subcategories.subCatID,subcategories.subCatName, categories.categoryID
FROM subcategories
JOIN categories
ON subcategories.categoryID=categories.categoryID
JOIN languages
ON categories.languageID = languages.languageID
WHERE languages.languageID =1
AND categories.categoryID=1;

?>

<script>
   $(document).ready(function() {
   $('select[name="comboCategories"]').on("change", function() {
        var selectVal = $('this').val();

        $.ajax({                                      
          url: 'postanAd.php',                         
          data: "comboCategories="+selectVal,                                                     
          type:'post',
          success: function(data) { 
              for (var i in data) {
                 $('select[name="subcategories"]').append('<option value="">'+data+'</option>');
               }
          }
        });
    });
   });
</script>


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
              <h2 class="page-title">Post a new ad</h2>
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
            
              <form role="form" class="login-form">
                  <div class="form-group">
                  <div class="input-icon">
                   
                    <input type="text" id="Title" class="form-control" name="Title" placeholder="Title">
                  </div>
                </div> 

                  <div class="form-group">
                  <div class="input-icon">
                   
                    <a> Select a category </a>
                    
                    
                      <!-- COMBOBOX ALL CATEGORIES  !-->
                      
                      <select name="comboCategories" onchange ='<?php echo "window.location.href='#postanAd.php?comboCategories='"?>'>
  					  <?php
						//$counter=0;
  						foreach ($resultLang as $oneRec)
  						{
 							echo"<option value=".$oneRec["categoryID"].">".$oneRec["categoryName"]."</option>";  			
  						}
  					  ?>
  					  </select>
                      
                      
                          
                  </div>
                </div> 

                  <div class="form-group">
                  <div class="input-icon">
                    
                    <a> Select a subcategory </a>
                       <!-- COMBOBOX ALL SUBCATEGORIES  !-->
                  </div>
                </div> 

                  <div class="form-group">
                  <div class="input-icon">
                    
                    <a> Select a location </a>
                       <!-- COMBOBOX ALL LOCATIONS  !-->
                  </div>
                </div>

                  <div class="form-group">
                  <div class="input-icon">
                    
                    <input type="text" id="Price" class="form-control" name="Price" placeholder="Price">
                  </div>
                </div> 

                  <div class="form-group">
                  <div class="input-icon">
                    
                    
                  Select a file: <input type="file" name="img">
                  </div>
                </div>

                  <div class="form-group">
                  <div class="input-icon">     
                    Select a file: <input type="file" name="img">
                  </div>
                </div>

                  <div class="form-group">
                  <div class="input-icon">  
                   Select a file: <input type="file" name="img">
                  </div>
                </div>

                  <div class="form-group">
                  <div class="input-icon">  
                      <a> Select the type of ads: </a> <br>
                   <input type="radio" name="adType" value="2"> Type 1 : - Ad located on the
top of the website <br>
                    <input type="radio" name="adType" value="3"> Type 2 : - Ad located on the
top of the website
- Has the priority to
be displayed on the
left side before than
the previous
(payment type 1) <br>
                    <input type="radio" name="adType" value="4"> Type 3:  Ad located on the
top of the website
- Has the priority to
be displayed on the
left side before than
the previous
(payment 1, 2)
- Ad will be
published in other
media like (news
paper, youtube <br>
                       <input type="radio" name="adType" value="1"> Free <br>

                  </div>
                </div>
                  


                             
               
                <button class="btn btn-common log-btn">Submit</button>
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
