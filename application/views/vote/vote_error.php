<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <title> <?=$title?> &middot; <?=$site_title?> </title>
    <!-- Favicons-->
    <link rel="icon" href="
              <?=base_url('assets/images/favicon/favicon-32x32.png')?>" sizes="32x32">
    <link href="
                <?=base_url('assets/css/page.css')?>" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- CORE CSS-->
    <link href="
                  <?=base_url('assets/css/materialize.css')?>" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="
                    <?=base_url('assets/css/style.css')?>" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="
                      <?=base_url('assets/css/page-center.css')?>" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="
                        <?=base_url('assets/css/prism.css')?>" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="
                          <?=base_url('assets/js/plugins/perfect-scrollbar/perfect-scrollbar.css')?>" type="text/css" rel="stylesheet" media="screen,projection">
  </head>
  <body class="grey lighten-5">
    <!-- Start Page Loading -->
    <div id="loader-wrapper">
      <div id="loader"></div>
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div>
    <!-- End Page Loading -->
    <div class="col s12 m8 l6 z-depth-4 card-panel rpf-stripe  vote-container">
      <div class="row">
        <div class="input-field col s12 center">
          <img src="
                                  <?=base_url()?>assets/images/logofooter.png" alt="" class="responsive-img valign">
          <p class="center login-form-text"> <?=$site_title?> </p>
        </div>
      </div>
      <h1 class="center col s12" style="color:red;"> <?=$page_data['title']?> </h1>
      <div class="center"> <?=$page_data['value']?> <p class="counter-txt">This Window will close in <span id='redirect-countdown'></span>
        </p>
      </div>
      <!-- /.text-center --> <?php $this->load->view('inc/copy_footer');?>
    </div>
    <!-- ================================================
    Scripts
    ================================================ -->
    <!-- jQuery Library -->
    <script type="text/javascript" src="
                              <?=base_url('assets/js/jquery-1.11.2.min.js')?>">
    </script>
    <!--materialize js-->
    <script type="text/javascript" src="
                              <?=base_url('assets/js/materialize.js')?>">
    </script>
    <!--prism-->
    <script type="text/javascript" src="
                              <?=base_url('assets/js/prism.js')?>">
    </script>
    <!--scrollbar-->
    <script type="text/javascript" src="
                              <?=base_url('assets/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js')?>">
    </script>
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="
                              <?=base_url('assets/js/plugins.js')?>">
    </script>
  </body>
</html>