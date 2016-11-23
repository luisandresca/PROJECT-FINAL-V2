<?php 
include 'Classes/ClassLanguage.cls.php';
include 'Classes/ClassCategory.cls.php';
include 'Classes/ClassSubCategory.cls.php';
include 'Classes/dbConnection.php';

$conn= new PDO("mysql:host=$host;dbname=$dbname",$user, $pass);

session_start();

$_SESSION['lang']='en';
$_SESSION['catidv']=1;

?>
<!DOCTYPE html>
<html lang="en">
  <head>
  
    <title>Kijiji</title>    


    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">      
    <link rel="stylesheet" href="assets/css/main.css" type="text/css">       
    <link rel="stylesheet" href="assets/extras/owl.carousel.css" type="text/css"> 
  </head>

  <body>  
   

          <!-- Navbar Start -->
          <ul>
  <li><a class="active" href="#home">Home</a></li>
  <li><a href="signup.php?lang=en&catidcbo=1">Register</a></li>
              <li><a href="postanAd.php">Post an ad</a></li>
<li><a href="login.php?lang=en&catidv=1">Login</a></li>
  <li><a href="index.english.php?lang=en&catidv=1">English</a></li>
  <li><a href="index.french.php?lang=fr&catidv=2">Français</a></li>
  <li><a href="index.spanish.php?lang=es&catidv=3">Español</a></li> 
</ul>
          <!-- Navbar End --> 
    

    <!-- Start intro section -->
    <section id="intro" class="section-intro">
      <div class="overlay">
        <div class="container">
          <div class="main-text">
            <h1 class="intro-title">Welcome To <span style="color: #3498DB">Kijiji</span></h1>
            <p class="sub-title">Buy and sell everything from used cars to mobile phones and computers, or search for property, jobs and more</p>

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
          </div>
        </div>
      </div>
    </section>
    <!-- end intro section -->

    <div class="wrapper">      

      <!-- Featured Listings Start -->
      <section class="featured-lis" >
        <div class="container">
          <div class="row">
              <h3 class="section-title">Featured Listings</h3>
              <div id="new-products" class="owl-carousel">              
                <div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <img src="assets/img/product/img3.jpg" alt=""> 
                      <div class="overlay">
                      </div> 
                    </div>
                    <a class="item-name">Apple watch</a>  
                    <span class="price">$300</span>  
                  </div>
                </div>


                <div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <img src="assets/img/product/img4.jpg" alt=""> 
                      <div class="overlay">
                       
                      </div> 
                    </div> 
                    <a class="item-name">Samsung Galaxy S5</a>  
                    <span class="price">$149</span> 
                  </div>
                </div>


                <div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <img src="assets/img/product/img5.jpg" alt=""> 
                      <div class="overlay">
                      </div> 
                    </div>
                    <a class="item-name">MacBook Pro</a>  
                    <span class="price">$900</span> 
                  </div>

                </div>
                <div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <img src="assets/img/product/img6.jpg" alt=""> 
                      <div class="overlay">
                      </div> 
                    </div>                     
                    <a class="item-name">Ipad</a>  
                    <span class="price">$369</span> 
                  </div>

                </div>
                <div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <img src="assets/img/product/img7.jpg" alt=""> 
                      <div class="overlay">
                      </div> 
                    </div>  
                    <a class="item-name">Blackberry </a>  
                    <span class="price">$79</span> 
                  </div>
                </div>
                <div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <img src="assets/img/product/img8.jpg" alt=""> 
                      <div class="overlay">
                      </div> 
                    </div>
                    <a class="item-name">Google Nexus</a>  
                    <span class="price">$749</span>   
                  </div>
                </div>
              </div>
            </div> 
       
        </div>
        
      </section>
      <!-- Featured Listings End -->

        </div>
      <!-- Start Categories Section -->
      <div class="features">
      <?php
      $langTemp=1;
      
      $sqlCmd ="SELECT DISTINCT categories.categoryID, categories.categoryName
		        FROM categories
		        JOIN subcategories
		        ON subcategories.categoryID=categories.categoryID
                JOIN languages
                ON categories.languageID = languages.languageID
                WHERE languages.languageID =:lang;
			   ";
      
      
      $prepQuery = $conn ->prepare($sqlCmd);
      $prepQuery->bindParam(":lang",$langTemp, PDO::PARAM_INT);
      $prepQuery->execute();
      $resultLang= $prepQuery->fetchAll();
      ?>
      
        <div class="container">
          <div class="row">      
      
       <?php 
echo"<ul class='maincats'>";
  foreach ($resultLang as $oneRec)
  {             
    $catid= $oneRec["categoryID"];


    echo"<li>";
    echo"<strong>".$oneRec["categoryName"]."</strong>";

    $sqlCmd2 ="SELECT subcategories.subCatID,subcategories.subCatName
              FROM subcategories
              JOIN categories
              ON subcategories.categoryID=categories.categoryID
              JOIN languages
              ON categories.languageID = languages.languageID
              WHERE languages.languageID =:lang
              AND categories.categoryID=:cboCat";
    $prepQuery2 = $conn ->prepare($sqlCmd2);
    $prepQuery2->bindParam(":lang",$langTemp, PDO::PARAM_INT);
    $prepQuery2->bindParam(":cboCat",$catid, PDO::PARAM_INT);
    $prepQuery2->execute();
    $resultLang2= $prepQuery2->fetchAll();
    if($resultLang2) {
        echo"<ul class='subcats'>";
        foreach ($resultLang2 as $oneRec)
        {
            $subCatid=$oneRec["subCatID"];
            echo"<li>";
            echo "<a href='displaysubcategory.php?subcat=?$subCatid'>".$oneRec["subCatName"]."</a>";
            echo"</li>";
        } 
        echo"</ul>";
    }
    echo"</li>";

  }
echo"</ul>";

?>   
           
           
              </div>
            
        </div>
      </div>
      <!-- End Category Section -->    
      

       <!-- Featured free ads  DONT CONTAIN PICTURE  -->
      <section class="featured-lis" >
        <div class="container">
          <div class="row">
              <h3 class="section-title">FREE ADS</h3>
                        
                  
                   
                <div class="item">
                  <div class="product-item">
                 
                    <a href="ads-details.html" class="item-name">Lorem ipsum dolor sit</a>  
                    <span class="price">$149</span> 
                  </div>
                </div>


                  <div class="item">
                  <div class="product-item">
                 
                    <a class="item-name">Appartment to rent in Côte des Neiges</a>  
                    <span class="price">$490 per month</span> 
                  </div>
                </div>

                 <div class="item">
                  <div class="product-item">
                 
                    <a class="item-name">Honda Civic 1995</a>  
                    <span class="price">$1490</span> 
                  </div>
                </div>

               <div class="item">
                  <div class="product-item">
                 
                    <a class="item-name">Chalet to rent in Ste Adele</a>  
                    <span class="price">$700 par semaine</span> 
                  </div>
                </div>


                 <div class="item">
                  <div class="product-item">
                 
                    <a class="item-name">Serveuse recherchée</a>  
                    <span class="price">TBD</span> 
                  </div>
                </div>

              </div>
            </div> 
       

        
      </section>
      <!-- Featured Listings End -->



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
