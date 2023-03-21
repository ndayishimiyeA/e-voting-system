<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <title><?=$title?> &middot; <?=$site_title?></title>

    <?php $this->load->view('inc/css'); ?>


</head>

<body>
    
    <?php $this->load->view('inc/header'); ?>

    <!-- //////////////////////////////////////////////////////////////////////////// -->


  <!-- START MAIN -->
  <div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">

      <?php $this->load->view('inc/left_nav'); ?>

      <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- START CONTENT -->
      <section id="content">
        
        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper" class=" grey lighten-3">
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title"><?=$title?></h5>
                <ol class="breadcrumb">
                    <li><a href="#">Voting System</a></li>
                    <li class="active"><?=$title?></li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->
        

        <!--start container-->
        <div class="container">
          <div class="section">
            <div class="row hideMe">
              <div class="col s12">
                <?php
                //ERROR ACTION                          
                  if($this->session->flashdata('error')) { ?>
                    <div class="card-panel deep-orange darken-3">
                        <span class="white-text"><i class="mdi-alert-warning tiny"></i> <?php echo $this->session->flashdata('error'); ?></span>
                    </div>
              <?php } ?> 
              <?php
                //SUCCESS ACTION                          
                  if($this->session->flashdata('success')) { ?>
                    <div class="card-panel green">
                        <span class="white-text"><i class="mdi-action-done tiny"></i> <?php echo $this->session->flashdata('success'); ?></span>
                    </div>
              <?php } ?>             
              <?php
                //FORM VALIDATION ERROR
                    $this->form_validation->set_error_delimiters('<p><i class="mdi-alert-warning tiny"></i> ', '</p>');
                      if(validation_errors()) { ?>
                    <div class="card-panel yellow amber">
                        <span class="white-text"> <?php echo validation_errors(); ?></span>
                    </div>
              <?php } ?> 
              </div>
            </div>

            <section>
            <div class="row">
              <div class="col s12 m12 l12 center-align header results-header">
                <h4>Voting Results</h4>
                <h4><span><span class="strong">Claimed Passes</span> <?=$total_passUsed?>/<?=$total_passes?></span> </h4>
              </div>

            </div>
            </section>


<div class="section">
  <div class="row">
    <div class="col s12 m12 l12">
<table id="myTable" class="striped responsive-table results_table ">
  <tr>
    <th>Name</th>
    <th>Votes</th>
    <th></th>
  </tr> <?php if($positions):
              foreach($positions as $pos): ?> <?php 
                if($pos['candidates']):
                foreach($pos['candidates'] as $can): ?> <tr>
    <td> <?=$can['name']?> </td>
    <td> <?=$can['votes']?> </td>
    <td style="width:25%;">                    <div class="progress">
                      <div class="determinate" style="width: <?=round(($can['votes']/$total_passUsed)*100)?>%"></div>   
                    </div>  </td>
  </tr> 

<?php endforeach;
              endif; ?> <?php endforeach;
              endif; ?>
</table>
</div>
</div>
</div>



            <?php if($positions):
              foreach($positions as $pos): ?>
            <div class="section">
              <h4 class="header"><?=$pos['title']?></h4><!-- /.header -->
              <?php 
                if($pos['candidates']):
                foreach($pos['candidates'] as $can): ?>
                <div class="row">
                  <div class="col s4 m6 l1">
                    <?php if(filexist($can['img']) && $can['img']): ?>
                          <img src="<?=base_url('uploads/'.$can['img'])?>" alt="" class="circle responsive-img valign materialboxed" data-caption="<?=$can['name']?>">
                        <?php else: ?>
                          <img src="<?=base_url('assets/images/no_image.gif')?>" alt="" class="circle responsive-img valign ">
                    <?php endif; ?>
                  </div><!-- /.col s4 m6 l1 -->
                  <div class="col l10 s6">
                    <h6 class="strong"><?=$can['name']?> </h6>
                    <div class="progress">
                      <div class="determinate" style="width: <?=round(($can['votes']/$total_passUsed)*100)?>%"></div>   
                    </div>                    
                  </div><!-- /.col l10 s6 -->
                  <div class="col l1 s2">
                    <h3><?=$can['votes']?></h3>
                  </div><!-- /.col l1 s2 -->
                </div><!-- /.row -->
              <?php endforeach;
              endif; ?>
            </div><!-- /.section -->
          <?php endforeach;
          endif; ?>
            

         
          </div>
        </div>
        <!--end container-->
      </section>
      <!-- END CONTENT -->

    </div>
    <!-- END WRAPPER -->

  </div>
  <!-- END MAIN -->



     <!-- //////////////////////////////////////////////////////////////////////////// -->

    <?php $this->load->view('inc/footer'); ?>

    <?php $this->load->view('inc/js'); ?>
   
</body>
</html>