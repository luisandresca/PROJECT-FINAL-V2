<?php 
include 'Classes/ClassLanguage.cls.php';
include 'Classes/ClassCategory.cls.php';
include 'Classes/ClassSubCategory.cls.php';
include 'Classes/dbConnection.php';

$conn= new PDO("mysql:host=$host;dbname=$dbname",$user, $pass);

session_start();

$_SESSION['lang']='es';
$_SESSION['catidv']=3;

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
  <li><a class="active" href="#home">Inicio</a></li>
  <li><a href="signup.php?lang=es&catidcbo=3">Registrese</a></li>
              <li><a href="postanAd.php">Publique un anuncio</a></li>
<li><a href="login.php?lang=es&catidv=3">Login</a></li>
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
            <h1 class="intro-title">Bienvenido a <span style="color: #3498DB">Kijiji</span></h1>
            <p class="sub-title">Compre y venda cualquier cosa  desde  carros usados hasta telefonos moviles y  computadores, o busque una propiedad, trabajo y mucho mas</p>

            <!-- Start Search box -->
            <div class="row search-bar">
              <div class="advanced-search">
                <form class="search-form" method="get">
                 
                  <div class="col-md-3 col-sm-6 search-col">
                    <input class="form-control keyword" name="keyword" value="" placeholder="Entre una palabra clave" type="text">
                    <i class="fa fa-search"></i>
                  </div>
                  <div class="col-md-3 col-sm-6 search-col">
                    <button class="btn btn-common btn-search btn-block"><strong>Busqueda</strong></button>
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
              <h3 class="section-title">Listas futuras</h3>
              <div id="new-products" class="owl-carousel">              
                <div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <img src="assets/img/product/img3.jpg" alt=""> 
                      <div class="overlay">
                        <a href="ads-details.html"></a>
                      </div> 
                    </div>
                    <a href="ads-details.html" class="item-name">Feugiat nulla facilisis</a>  
                    <span class="price">$300</span>  
                  </div>
                </div>


                <div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <img src="assets/img/product/img4.jpg" alt=""> 
                      <div class="overlay">
                        <a href="ads-details.html"></a>
                      </div> 
                    </div> 
                    <a href="ads-details.html" class="item-name">Lorem ipsum dolor sit</a>  
                    <span class="price">$149</span> 
                  </div>
                </div>


                <div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <img src="assets/img/product/img5.jpg" alt=""> 
                      <div class="overlay">
                        <a href="ads-details.html"></a>
                      </div> 
                    </div>
                    <a href="ads-details.html" class="item-name">Sed diam nonummy</a>  
                    <span class="price">$90</span> 
                  </div>

                </div>
                <div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <img src="assets/img/product/img6.jpg" alt=""> 
                      <div class="overlay">
                        <a href="ads-details.html"></a>
                      </div> 
                    </div>                     
                    <a href="ads-details.html" class="item-name">Praesent luptatum zzril</a>  
                    <span class="price">$169</span> 
                  </div>

                </div>
                <div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <img src="assets/img/product/img7.jpg" alt=""> 
                      <div class="overlay">
                        <a href="ads-details.html"></a>
                      </div> 
                    </div>  
                    <a href="ads-details.html" class="item-name">Lorem ipsum dolor sit</a>  
                    <span class="price">$79</span> 
                  </div>
                </div>
                <div class="item">
                  <div class="product-item">
                    <div class="carousel-thumb">
                      <img src="assets/img/product/img8.jpg" alt=""> 
                      <div class="overlay">
                        <a href="ads-details.html"></a>
                      </div> 
                    </div>
                    <a href="ads-details.html" class="item-name">Sed diam nonummy</a>  
                    <span class="price">$149</span>   
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
              <h3 class="section-title">Publicaciones gratis</h3>
                        
                  
                   
                <div class="item">
                  <div class="product-item">
                 
                    <a href="ads-details.html" class="item-name">Lorem ipsum dolor sit</a>  
                    <span class="price">$149</span> 
                  </div>
                </div>


                  <div class="item">
                  <div class="product-item">
                 
                    <a href="ads-details.html" class="item-name">Lorem ipsum dolor sit</a>  
                    <span class="price">$149</span> 
                  </div>
                </div>

                 <div class="item">
                  <div class="product-item">
                 
                    <a href="ads-details.html" class="item-name">Lorem ipsum dolor sit</a>  
                    <span class="price">$149</span> 
                  </div>
                </div>

               <div class="item">
                  <div class="product-item">
                 
                    <a href="ads-details.html" class="item-name">Lorem ipsum dolor sit</a>  
                    <span class="price">$149</span> 
                  </div>
                </div>


                 <div class="item">
                  <div class="product-item">
                 
                    <a href="ads-details.html" class="item-name">Lorem ipsum dolor sit</a>  
                    <span class="price">$149</span> 
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


