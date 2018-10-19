<?php
$card = $_GET['card'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>CALI Time Trial || CALI - Your partner in legal education and technology</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/bootstrap-glyphicons.css">
<link rel="stylesheet" href="assets/css/carousel.css">

</head>
<body>
    <div class="navbar navbar-fixed-top">
      <div class="container">
        <div class="navbar navbar-static-top">
          
    	    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
    	      <span class="icon-bar"></span>
    	      <span class="icon-bar"></span>
    	      <span class="icon-bar"></span>
    	    </button>
            <a class="navbar-brand" href="#">CALI Time Trial</a>
            <div class="nav-collapse collapse">
              <ul class="nav navbar-nav">
                <li><a href="http://www.cali.org/">CALI</a> </li>
                <li><a href="http://www.cali.org/lesson"> Lessons </a></li>
                <li><a href="http://elangdell.cali.org/"> eLangdell </a></li>
                <li><a href="http://www.cali.org/timetrial/js/CALITimeTrial.php"> Time Trial </a></li>
                <li><a href="http://spotlight.cali.org/"> Blog </b></a></li>
              </ul>
            </div>

        </div>
      </div>
    </div>

    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
           
          <div class="carousel-banner">
                 <a href="/TimeTrial/js/CALITimeTrial.php?card=<?php echo $card; ?>"><img class="img-responsive" src="assets/img/TTbanner.jpg" alt="Banner" /></a>
            </div>
          <div class="container">
            <div class="carousel-caption">
              <h1> CALI<sup>&reg;</sup> Lessons<br />
                  Hundreds of tutorials in dozens of legal topics </h1>
              <p>Every day thousands of law students across the country run CALI Lessons to learn more about the law. Do you?</p>
              <p><a class="btn btn-large btn-primary" href="http://www.cali.org/register">Register Now!</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          
         <div class="carousel-banner">
                  <a href="/TimeTrial/js/CALITimeTrial.php?card=<?php echo $card; ?>"><img class="img-responsive" src="assets/img/TTbanner.jpg" alt="Banner" /></a>
            </div>
          <div class="container">
            <div class="carousel-caption">
              <h1>CALI eLangdell<sup>&reg;</sup><br />
                  Free casebooks and supplements</h1>
              <p> CALI fights the high cost of casebooks with eLangdell Press: free casebooks, statutory
                  and regulatory supplements. eLangdell titles are available in a number of popular electronic formats.</p>
              <p><a class="btn btn-large btn-primary" href="http://elangdell.cali.org/">Learn more</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          
          <div class="carousel-banner">
                  <a href="/TimeTrial/js/CALITimeTrial.php?card=<?php echo $card; ?>"><img class="img-responsive" src="assets/img/TTbanner.jpg" alt="Banner" /></a>
            </div>
          <div class="container">
            <div class="carousel-caption">
              <h1> CALI<sup>&reg;</sup> Time Trial<br />
                  Because sometimes you just need a break. </h1>
              <p> CALI Time Trial is the card game that challenges your knowledge of legal history. Draw a card and fit it into the time line based on the
                  information on the card. How much do you know about NLRB vs. Jones & Laughlin Steel Corp.?  </p>
              <p><a class="btn btn-large btn-primary" href="/TimeTrial/js/CALITimeTrial.php?card=<?php echo $card; ?>">Play Now!</a></p>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->

<div class="container marketing">
      <div class="text-center">
            <h1> Introducing<br />CALI Time Trial!</h1>
              
            <p class="lead"> CALI Time Trial is the card game that challenges your knowledge of legal history. Draw a card and fit it into the time line based on the
            information on the card. <br />
            Sound easy? <br />
            How much do you know about NLRB vs. Jones & Laughlin Steel Corp.? </p>
            <p class="lead"><a href="/TimeTrial/js/CALITimeTrial.php?card=<?php echo $card; ?>" class="bigbtn">Play Online Now!</a></p>
            <hr class="soften">
      </div>
    <div class="row">
      <div class="col-lg-4"> <img class="img-responsive" src="assets/img/Lessons_Icon_Color.png" alt="Lessons">
        <h2>CALI Lessons</h2>
        <p class="features">In the early 1980s, CALI set the precedent for creation and use of computer-assisted legal instruction exercises.
        CALI pioneered pre-packaged, interactive, computer-based legal education materials in text form with its CALI Lessons.
        Today's CALI Lessons are web-based tutorials covering a variety of legal topics.
        Currently there are over 950 Lessons in over 35 law school topics in the CALI Lesson Library.
        CALI Lessons are free to all students at CALI member schools. </p>
      </div>
      <div class="col-lg-4"> <img class="img-responsive" src="assets/img/eLangdell_Icon_Color.png" alt="eLangdell">
        <h2>CALI eLangdell</h2>
        <p> CALI's eLangdell® Press offers free legal casebooks, supplements, and chapters. eLangdell content has a
        nonrestrictive license that allows for free digital and e-book downloads, cheap printing, and easy editing.</p>
      </div>
      <div class="col-lg-4"> <img class="img-responsive" src="assets/img/logo_box_green.jpg" alt="About">
        <h2>About CALI</h2>
        <p> The Center for Computer-Assisted Legal Instruction, also known as CALI, is a 501(c)(3) non-profit consortium of mostly US law schools
        that conducts applied research and development in the area of computer-mediated legal education. The organization is best known in law schools
        for CALI Lessons, online interactive tutorials in legal subjects, and CALI Excellence for the Future Awards® (CALI Awards), given to the
        highest scorer in a law school course at many CALI member law schools. Nearly every US law school is a member of CALI.</p>
      </div>
    </div>
    
    
  
</div>
<!-- Footer
    ================================================== -->
<footer id="footer">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <h4>CALI</h4>
        <ul class="footer-links">
          <li><a href="http://www.cali.org/content/about-cali">About</a></li>
          <li><a href="http://www.cali.org/legal/termsofservice">Legal</a></li>
          <li><a href="http://www.cali.org/contact">Contact</a></li>
          <li><a href="http://spotlight.cali.org/">Blog</a></li>
        </ul>
      </div>
      <div class="col-lg-4">
        <h4>CALI Resources</h4>
        <ul class="footer-links">
          <li><a href="http://www.cali.org/lesson">Lessons</a></li>
          <li><a href="http://elangdell.cali.org/">eLangdell</a></li>
          <li><a href="http://www.classcaster.net/">Classcaster</a></li>
          <li><a href="http://www.cali.org/webinars">Webinars</a></li>
        </ul>
      </div>
      <div class="col-lg-4">
        <h4>CALI Images from Flickr</h4>
        <div id="flickr-wrapper"> 
          <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?show_name=1&count=5&display=random&size=s&layout=x&source=user_set&user=63316539%40N03&set=72157626854399746&context=in%2Fset-72157626854399746%2F"></script> 
        </div>
      </div>
      
    </div>
    <div class="row-fluid copyright">
      <div class="span12">Copyright &copy; 2013 Center for Computer-Assisted Legal Instruction</div>
    </div>
  </div>
</footer>

<!-- Placed at the end of the document so the pages load faster --> 
<script src="http://code.jquery.com/jquery.js"></script>
</script>
<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/js/bootstrap.min.js"></script>

</body>
</html>
