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
              <?=base_url('assets/images/favicon/sti_45x45.png')?>" sizes="45x45">
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
    <!-- Start Page Loading  -->
    <div id="loader-wrapper">
      <div id="loader"></div>
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div>
    <!-- End Page Loading -->
    <div class="col s12 m8 l6 card-panel rpf-stripe vote-container">
      <div class="row">
        <div class="input-field col s12 center">
          <img src="
                                  <?=base_url('assets/images/logo.jpg')?>" alt="rpf_logo_flag" class="responsive-img valign">
          <p class="center login-form-text"> <?=$site_title?> </p>
        </div>
      </div> <?=form_open_multipart('vote', array('id'=>'votingForm'))?> <?php if($positions):
              foreach($positions as $pos): ?> <h4 class="header">Abakandida <?php if ($pos['title'] == 'Female') : ?> Gore <?php else : ?> Gabo <?php endif; ?> </h4>
      <table class="striped scroll candidate-list" id="Position_<?= str_replace(' ', '_', $pos['title'])  ?>">
        <thead>
          <tr>
            <th>#</th>
            <th>Amazina Y'umukandida</th>
            <th></th>
            <th>Igikorwa</th>
          </tr>
        </thead>
        <tbody> <?php 
                  $index=0;
                  if($pos['candidates']):
                  foreach($pos['candidates'] as $can): 
                  ?> <tr>
            <td> <?= $index = $index+1;?> </td>
            <td style="font-weight: bold;"> <?=$can['name']?> </td>
            <td></td>
            <td>


              <input class="with-gap" data-name="vote[<?=cleancrypt($pos['title'])?><?= $index ?>]" name="vote[<?=cleancrypt($pos['title'])?>]" type="radio" id="<?=$can['id']?>" value="<?=$this->encryption->encrypt($can['id'])?>">
              <label class="tora_btn" for="<?=$can['id']?>">TORA! </label>
            </td>
          </tr> <?php endforeach; endif; ?> </tbody>
      </table>
      <hr class="style-one"> <?php endforeach;
          endif; ?> <div class="row valign-wrapper">
        <button type="submit" id="submitVote" class="btn btn_lg waves-effect green darken-1 col s5 offset-s3">Tanga Amajwi</button>
      </div> <?=form_close()?>
      <!-- Modal Structure -->
      <div id="vote_error_modal" class="modal darken-1">
        <div class="modal-content">
          <h4 class="center-align header">
            <i class="mdi-alert-warning prefix"></i> Icyitonderwa <i class="mdi-alert-warning prefix"></i>
          </h4>
          <p id='vote_error'>Please Choose a Candidate from each segment</p>
        </div>
        <div class="modal-footer border-bottom-rpf-stripe">
          <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
        </div>
      </div> <?php $this->load->view('inc/copy_footer');?>
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