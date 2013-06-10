<?php
$card = $_GET['card'];
//echo "<h2> You requested card number ".$card.".</h2>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>CALI Time Trial || CALI - Your partner in legal education and technology</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<!-- Le styles -->
<link href="assets/css/bootstrap.css" rel="stylesheet">
<link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
<link href="assets/css/docs.css" rel="stylesheet">
<link href="assets/js/google-code-prettify/prettify.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
    <![endif]-->
<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="assets/ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
<!-- Navbar
    ================================================== -->
<div class="jumbotron masthead">
  <div class="splash"> <img src="assets/img/CALILessons-bg.jpg" alt="Banner" /> </div>
  <div class="splash"> <img src="assets/img/CALIeLangdell-bg.jpg" alt="Banner" /> </div>
  <div class="splash"> <img src="assets/img/CALITimeTrialBG.jpg" alt="Banner" /> </div>
  <div class="nav-agency">
    <div class="navbar navbar-static-top"> 
      <!-- navbar-fixed-top -->
      <div class="navbar-inner">
        <div class="container"> <a class="brand" href="http://www.cali.org/"><img src="assets/img/CALIlogogold20130610.png" alt="Logo"></a>
          <div id="main-nav">
            <div class="nav-collapse collapse">
              <ul class="nav">
                <li class="active"><a href="http://www.cali.org/">CALI</a> </li>
                <li><a href="http://www.cali.org/lesson"> Lessons </a></li>
                <li><a href="http://elangdell.cali.org/"> eLangdell </a></li>
                <li><a href="http://www.cali.org/timetrial/online/CALITimeTrial.php"> Time Trial </a></li>
                <li><a href="http://spotlight.cali.org/"> Blog </b></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container show-case-item">
    <h1> CALI Lessons<br />
      Hundreds of tutorials in dozens of legal topics </h1>
    <p>Every day thousands of law students across the country run CALI Lessons to learn more about the law. Do you?</p>
    <a href="http://www.cali.org/register" class="bigbtn">Register Now!</a><a href="http://www.cali.org/lesson" class="bigbtn">Find Out More</a>
    <div class="clearfix"> </div>
  </div>
  <div class="container show-case-item">
    <h1>CALI eLangell<br />
     Free casebooks and supplements</h1>
    <p> CALI helps fight the high cost of casebooks and supplements with eLangdell Press, a series of casebooks and statutory
    and regulatory supplements. eLangdell titles are availabe in a number of popular electronic formats.</p>
    <a href="http://www.cali.org/register" class="bigbtn">Register Now!</a> <a href="http://elangdell.cali.org/" class="bigbtn">Find Out More</a>
    <div class="clearfix"> </div>
  </div>
  <div class="container show-case-item">
    <h1> CALI Time Trial<br />
      Because sometimes you just need a break. </h1>
    <p> CALI Time Trial is the card game that challenges your knowledge of legal history. Draw a card and fit it into the time line based on the
    information on the card. Sound easy? How much do you know about NLRB vs. Jones & Laughlin Steel Corp.?  </p>
    <a href="http://www.cali.org/register" class="bigbtn">Register Now!</a> <a href="http://www.cali.org/timetrial/online/CALITimeTrial.php?card=<?php echo $card; ?>" class="bigbtn">Play Online</a>

    <div class="clearfix"> </div>
  </div>
  <div id="banner-pagination">
    <ul>
      <li><a href="#" class="active" rel="0"> <img src="assets/img/slidedot-active.png" alt="" /></a></li>
      <li><a href="#" rel="1"> <img src="assets/img/slidedot.png" alt="" /></a></li>
      <li><a href="#" rel="2"> <img src="assets/img/slidedot.png" alt="" /></a></li>
    </ul>
  </div>
</div>
<div class="container">
  <div class="marketing">
    <h1> Introducing<br />CALI Time Trial!</h1>
    <p class="marketing-byline"> CALI Time Trial is the card game that challenges your knowledge of legal history. Draw a card and fit it into the time line based on the
    information on the card. Sound easy? How much do you know about NLRB vs. Jones & Laughlin Steel Corp.? </p>
    <a href="http://www.cali.org/timetrial/online/CALITimeTrial.php?card=<?php echo $card; ?>" class="bigbtn">Play Online</a>
    <hr class="soften">
    <div class="row-fluid">
      <div class="span4"> <img src="assets/img/responsive.png" alt="Lessons">
        <h2> <span class="firstword">CALI</span> Lessons</h2>
        <p class="features">In the early 1980s, CALI set the precedent for creation and use of computer-assisted legal instruction exercises.
        CALI pioneered pre-packaged, interactive, computer-based legal education materials in text form with its CALI Lessons.
        CALI Lessons are web-based tutorials on a variety of legal subjects known as CALI Lessons.
        Currently there are over 950 lessons in over 35 law school subjects in CALI's library of lessons.
        The lessons are free to all CALI member schools' students. </p>
      </div>
      <div class="span4"> <img src="assets/img/think-creative.png" alt="eLangdell">
        <h2> <span class="firstword">CALI</span> eLangdell</h2>
        <p> CALI's eLangdell® Press offers free legal casebooks, supplements, and chapters. eLangdell content has a
        nonrestrictive license that allows for free digital and e-book downloads, cheap printing, and easy editing.</p>
      </div>
      <div class="span4"> <img src="assets/img/core-values.png" alt="About">
        <h2> <span class="firstword">About</span> CALI</h2>
        <p> The Center for Computer-Assisted Legal Instruction, also known as CALI, is a 501(c)(3) non-profit consortium of mostly US law schools
        that conducts applied research and development in the area of computer-mediated legal education. The organization is best known in law schools
        for CALI Lessons, online interactive tutorials in legal subjects, and CALI Excellence for the Future Awards (CALI Awards), given to the
        highest scorer in a law school course at many CALI member law schools. Nearly every US law school is a member of CALI.</p>
      </div>
    </div>
    <hr class="soften">
    
  </div>
</div>
<!-- Footer
    ================================================== -->
<footer class="footer">
  <div class="container">
    <div class="row-fluid">
      <div class="span3">
        <h4>CALI</h4>
        <ul class="footer-links">
          <li><a href="http://www.cali.org/content/about-cali">About</a></li>
          <li><a href="http://www.cali.org/legal/termsofservice">Legal</a></li>
          <li><a href="http://www.cali.org/contact">Contact</a></li>
          <li><a href="http://spotlight.cali.org/">Blog</a></li>
        </ul>
      </div>
      <div class="span3 MT70">
        <h4>CALI Resources</h4>
        <ul class="footer-links">
          <li><a href="http://www.cali.org/lesson">Lessons</a></li>
          <li><a href="http://elangdell.cali.org/">eLangdell</a></li>
          <li><a href="http://www.classcaster.net/">Classcaster</a></li>
          <li><a href="http://www.cali.org/webinars">Webinars</a></li>
        </ul>
      </div>
      <div class="span3 MT70">
        <h4>Something from Flickr</h4>
        <div id="flickr-wrapper"> 
          <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?show_name=1&count=5&display=random&size=s&layout=x&source=user_set&user=63316539%40N03&set=72157626854399746&context=in%2Fset-72157626854399746%2F"></script> 
        </div>
      </div>
      
    </div>
    <hr class="soften1 copyhr">
    <div class="row-fluid copyright">
      <div class="span12">Copyright &copy; 2012. CALI</div>
    </div>
  </div>
</footer>
<!-- Le javascript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script> 
<script src="assets/js/jquery.js" type="text/javascript"></script> 
<script src="assets/js/google-code-prettify/prettify.js" type="text/javascript"></script> 
<script src="assets/js/bootstrap-transition.js" type="text/javascript"></script> 
<script src="assets/js/bootstrap-alert.js" type="text/javascript"></script> 
<script src="assets/js/bootstrap-modal.js" type="text/javascript"></script> 
<script src="assets/js/bootstrap-dropdown.js" type="text/javascript"></script> 
<script src="assets/js/bootstrap-scrollspy.js" type="text/javascript"></script> 
<script src="assets/js/bootstrap-tab.js" type="text/javascript"></script> 
<script src="assets/js/bootstrap-tooltip.js" type="text/javascript"></script> 
<script src="assets/js/bootstrap-popover.js" type="text/javascript"></script> 
<script src="assets/js/bootstrap-button.js" type="text/javascript"></script> 
<script src="assets/js/bootstrap-collapse.js" type="text/javascript"></script> 
<script src="assets/js/bootstrap-carousel.js" type="text/javascript"></script> 
<script src="assets/js/bootstrap-typeahead.js" type="text/javascript"></script> 
<script src="assets/js/bootstrap-affix.js" type="text/javascript"></script> 
<script src="assets/js/application.js" type="text/javascript"></script> 
<script src="assets/js/superfish.js" type="text/javascript"></script> 
<script src="assets/js/custom.js" type="text/javascript"></script> 
<script type="text/javascript">
        $(document).ready(function () {

            var showCaseItems = $('.show-case-item').hide();

            var splashes = $('.splash').hide();
            //get each image for each slide and set it as a background of the slide
            //            splashes.each(function () {
            //                var img = $(this).find('img');
            //                var imgSrc = img.attr('src');
            //                img.css('visibility', 'hidden');
            //                $(this).css({ 'background-image': 'url(' + imgSrc + ')', 'background-repeat': 'no-repeat' });
            //            });

            splashes.eq(0).show();
            showCaseItems.eq(0).show();

            var prevIndex = -1;
            var nextIndex = 0;
            var currentIndex = 0;

            $('#banner-pagination li a').click(function () {

                nextIndex = parseInt($(this).attr('rel'));

                if (nextIndex != currentIndex) {
                    $('#banner-pagination li a').html('<img src="assets/img/slidedot.png" alt="slide"/>');
                    $(this).html('<img src="assets/img/slidedot-active.png" alt="slide"/>');
                    currentIndex = nextIndex;
                    if (prevIndex < 0) prevIndex = 0;

                    splashes.eq(prevIndex).css({ opacity: 1 }).animate({ opacity: 0 }, 500, function () {
                        $(this).hide();
                    });
                    splashes.eq(nextIndex).show().css({ opacity: 0 }).animate({ opacity: 1 }, 500, function () { });

                    showCaseItems.eq(prevIndex).css({ opacity: 1 }).animate({ opacity: 0 }, 500, function () {
                        $(this).hide();
                        showCaseItems.eq(nextIndex).show().css({ opacity: 0 }).animate({ opacity: 1 }, 200, function () { });
                    });

                    prevIndex = nextIndex;
                }

                return false;
            });

        });
    </script>
</body>
</html>
