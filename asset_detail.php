<?php include_once('layouts/header.php'); ?>
  <!-- Start Content -->
  <div class="main" role="main">
    <div id="content" class="content full">
      <div class="container">
        <div class="row">
          <div class="col-md-9">
          <header class="single-post-header clearfix">
          <nav class="btn-toolbar pull-right"> 
          <?php
              $current_page_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            
          ?>
         <a href="<?php echo $current_page_url; ?>" download="notice-detail.html" class="btn btn-default" data-placement="bottom" data-toggle="tooltip" data-original-title="Download Page"><i class="fa fa-download"></i></a>
          <a href=" contact.php" class="btn btn-default" data-placement="bottom" data-toggle="tooltip" data-original-title="Contact us"><i class="fa fa-phone"></i></a>
          <a href="javascript:void(0);" onclick="sharePage();" class="btn btn-default" data-placement="bottom" data-toggle="tooltip" data-original-title="Share event"><i class="fa fa-location-arrow"></i></a>
            

                  <script>
                  function sharePage() {
                    // URL of the current page
                    var url = window.location.href;
                    
                    // Text to share
                    var text = "Check out this page: " + url;
                    
                    // Share on Facebook
                    window.open("https://www.facebook.com/sharer.php?u=" + encodeURIComponent(url));
                    
                    // Share on Twitter
                    window.open("https://twitter.com/intent/tweet?url=" + encodeURIComponent(url) + "&text=" + encodeURIComponent(text));
                    
                    /* // Share on Whatsapp
                    window.open("https://www.Whatsapp.com/shareArticle?url=" + encodeURIComponent(url) + "&title=" + encodeURIComponent(document.title)); */

                    // Share on Instagram
                    window.open("https://www.Instagram.com/shareArticle?url=" + encodeURIComponent(url) + "&title=" + encodeURIComponent(document.title));
                  }
                  </script>

                          

          </nav>
              <h2 class="post-title"><?php echo $row['title']; ?></h2>
            </header>
         

            <article class="post-content">
              <div class="event-description"> 
                <div class="spacer-20"></div>
                <div class="row">
                  <div class="col-md-8">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Event details</h3>
                      </div>
                      <div class="panel-body">
                        <ul class="info-table">
                          <li><i class="fa fa-calendar-xmark"></i> <strong><?php echo $row['date']; ?></strong></li>
                          <li><i class="fa fa-clock-o"></i> <?php echo $row['time']; ?></li>
                          <li><i class="fas fa-map-marker-alt"></i> <?php echo $row['venue']; ?></li>
                          <li><i class="fa fa-phone"></i> <?php echo $row['phone']; ?></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  
                </div>
                <?php echo $row['detail']; ?>
	
		  <?php } ?>
      </br>
  </br>
  </br>
  </br>
      <div class="btn-group">
   <a class="btn btn-default" href="notices.php"><i class="">Back to Notices<<<</i></a>
    </div>	
    </br>
  </br>
                </div>
                </div>
             
  
 	 <!-- Start Side-Bar -->
    <?php include "side-bar.php"; ?>

  <!-- Start Footer -->
  <?php include "footer.php"; ?>