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
      if(isset($_GET['vehicleID'])){
        echo "Echoing details for vehicle with ID: -> ".$_GET['vehicleID'];
      }     
    ?>

    <div class="container-fluid vehicle-detail-outer-wrapper">
        <div class="row filtered-vehicles-wrapper">
                <div class="carousel-container col-lg-7 col-lg-offset-1">  
                  <div class="carousel-description-wrapper">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                      </ol>

                      <!-- Wrapper for slides -->
                      <div class="carousel-inner" role="listbox">
                        <div class="item active">
                          <img src="https://placehold.it/800x400?text=IMAGE" alt="Image">
                          <div class="carousel-caption">
                            <h3>Sell $</h3>
                            <p>Money Money.</p>
                          </div>      
                        </div>

                        <div class="item">
                          <img src="https://placehold.it/800x400?text=Another Image Maybe" alt="Image">
                          <div class="carousel-caption">
                            <h3>More Sell $</h3>
                            <p>Lorem ipsum...</p>
                          </div>      
                        </div>

                        <div class="item">
                          <img src="https://placehold.it/800x400?text=IMAGE" alt="Image">
                          <div class="carousel-caption">
                            <h3>Sell $</h3>
                            <p>Money Money.</p>
                          </div>      
                        </div>

                      </div>

                      <!-- Left and right controls -->
                      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                    <div class="description-container">
                     <h3>Description</h3>
                     <p> This is my color i love, hope to find some one to take care of my baby </p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3">
                    <div class="row vehicle-main-details"> 
                      <ul>
                        <li> <span class="price">$50000</span></li>
                        <li><span class="make">Hundai</span> <span class="model">I20</span> <span class="year">(2018)</span></li>
                        <li> <input type="button" class="btn btn-primary" value="Email Seller"/></li>
                      </ul>

                    </div>
                    <div class="row vehicle-entire-details-list">
                      <h3> Vehicle Details </h3>
                      <table class="table table-striped">
                        <tbody>
                          <tr>
                            <td class="attribute">City</td>
                            <td class="value">Norfolk</td>
                          </tr>
                          <tr>
                            <td class="attribute">Year</td>
                            <td class="value">2018</td>
                          </tr>
                        </tbody>
                      </table>

                     </div>
                </div>
        </div>
    </div>
    <br/>
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


