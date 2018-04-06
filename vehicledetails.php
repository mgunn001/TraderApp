<!DOCTYPE html>
<html lang="en">
<head>
  <title>Buyer Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="./resource/scripts/sitescript.js"></script>
  <link rel="stylesheet" href="./resource/css/site.css">
  <link rel="stylesheet" href="./resource/css/buyerpage.css">
</head>
<body>
 <nav class="navbar navbar-inverse">
            <div class="container-fluid">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>                        
                </button>
                <a class="navbar-brand" href="#">Logo</a>
              </div>
              <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                  <li class="active"><a href="#">Buy</a></li>
                  <li><a href="#">Sell</a></li>
                </ul>
               <!--  <ul class="nav navbar-nav navbar-right">
                  <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul> -->
              </div>
            </div>
  </nav>
  <br/>
   <?php
      include_once "./service/SearchService.php";
      include_once "./models/Vehicle.php";
      include_once "./models/MetaData.php";

      if(isset($_GET['vehicleID'])){
        //echo "Echoing details for vehicle with ID: -> ".$_GET['vehicleID'];
        $search_service = new SearchService();
        $resultObj= $search_service->getASpecificVehicle($_GET['vehicleID']);
        $vehicle = $resultObj[0];
        //echo var_dump($vehicle->getImages());
        constructVehicleDetailsHTML($vehicle);
      }     

      // this method build the HTML content required for Carousel and stuff
      function constructVehicleDetailsHTML($vehicle){
        //echo var_dump($vehicle->getImages());
        //return;
        if($vehicle != null){

          $htmlContent ="";
          $htmlContent .= '<div class="container-fluid vehicle-detail-outer-wrapper">
                <div class="row filtered-vehicles-wrapper">
                <div class="carousel-container col-lg-7 col-lg-offset-1">  
                  <div class="carousel-description-wrapper">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">';
          $imagesList = $vehicle->getImages();
          // echo var_dump($imagesList);
          // return;
          $i=0;
           foreach ($imagesList as $image){
             if($i==0){
                $htmlContent .= '<li data-target="#myCarousel" data-slide-to="'.$i.'" class="active"></li>';
             }else{
                $htmlContent .= '<li data-target="#myCarousel" data-slide-to="'.$i.'"></li>';
             }
              $i++;        
           }
           $htmlContent .= '</ol>
            <div class="carousel-inner" role="listbox">';

            $i=0;
           foreach ($imagesList as $image){
             if($i==0){
                $htmlContent .= '<div class="item active">';
             }else{
                $htmlContent .= '<div class="item">';
             }
             $htmlContent .= '<img src="'.$image.'" alt="Image"></div>';
              $i++;        
           }

            $htmlContent .= '</div><a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>';
            $htmlContent .='<div class="description-container">
                     <h3>Description</h3>
                     <p>'.$vehicle->getDescription().'</p>
                    </div>
                  </div>
                </div>'; 

                $htmlContent .=' <div class="col-lg-3">
                    <div class="row vehicle-main-details"> 
                      <ul>
                        <li> <span class="price"> $'.$vehicle->getPrice().' </span></li>
                        <li><span class="make">'.$vehicle->getMake().'</span> <span class="model">'.$vehicle->getModel().'</span> <span class="year">('.$vehicle->getYear().')</span></li>
                        <li> <input type="button" class="btn btn-primary" value="Email Seller" sellerid="1"/></li>
                      </ul>

                    </div>
                    <div class="row vehicle-entire-details-list">
                      <h3> Vehicle Details </h3>
                      <table class="table table-striped">
                        <tbody>';
                  $metaDataList = $vehicle->getMetaData();

                foreach ($metaDataList as  $metaDataObj ){
                        $htmlContent .='<tr>
                            <td class="attribute">'.$metaDataObj->getProperty().'</td>
                            <td class="value">'.$metaDataObj->getPropertyValue().'</td>
                          </tr>';
                 }

                $htmlContent .='</tbody>
                                </table>

                               </div>
                          </div>
                  </div>
              </div>
              <br/>';
              echo $htmlContent;
        }
      }

    ?>


    <div class="container seller-reviews-wrapper">
      <div class="panel-group">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" href="#collapse1">Reviews On Seller</a>
            </h4>
          </div>
          <div id="collapse1" class="panel-collapse collapse">
            <div class="panel-body">
              <div class="row review-by-buyer" reviewid="1"> 
                <div class="col-lg-1"> <img src="https://s.gravatar.com/avatar/5a576a6969e99ea0652c734ca15c4cc5?s=80" class="img-responsive img-circle" alt="Cinque Terre"> </div> 
                <div class="col-lg-11"><div class="reviewtext-container"> </div></div> 
              </div>
            </div>
            <div class="panel-footer">
               <form class="form-inline" action="#"> 
                <div class="form-group" style="width:90%">         
                  <textarea class="commenttext-topost-buyer" name="commenttexttopost" style="width:100%"></textarea>
                </div>
                <button type="submit" class="btn btn-default commenttext-submitBtn">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>


