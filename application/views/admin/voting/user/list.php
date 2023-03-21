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
                    <li><a href="#">Administrative Options</a></li>         
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
                //SUCCESS ACTION                          
                  if($this->session->flashdata('success')) { ?>
                    <div class="card-panel green message-div">
                        <span class="white-text"><i class="mdi-action-done tiny"></i> <?php echo $this->session->flashdata('success'); ?></span>
                    </div>
              <?php } ?>             
              <?php
                //FORM VALIDATION ERROR
                    $this->form_validation->set_error_delimiters('<p><i class="mdi-alert-warning tiny"></i> ', '</p>');
                      if(validation_errors()) { ?>
                    <div class="card-panel yellow amber message-div">
                        <span class="white-text"> <?php echo validation_errors(); ?></span>
                    </div>
              <?php } ?> 
              </div>
            </div>
            
          <div class="section">
             <div class="row">
               <div class="col s12 ">
                 <table class="striped bordered highlight">
                  <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Acess</th>
                    </tr>
                  </thead>

                  <tbody>                    
                    <?php if($results):
                      foreach($results as $row): ?>
                    <tr>
                      <td>
                        <a href="<?=base_url('sys/users/update/' . $row['username'])?>">
                        <?php if(filexist($row['img']) && $row['img']): ?>
                          <img src="<?=base_url('uploads/'.$row['img'])?>" alt="" class="circle responsive-img valign candidate-img">
                        <?php else: ?>
                          <img src="<?=base_url('assets/images/no_image.gif')?>" alt="" class="circle responsive-img valign candidate-img">
                        <?php endif; ?>
                        </a>
                      </td>
                      <td><a href="<?=base_url('sys/users/update/' . $row['username'])?>"><?=$row['name']?></a></td>
                      <td><?=$row['username']?></td>                 
                      <td><?=$row['usertype']?></td>                 
                    </tr> 
                    <?php endforeach; 
                      endif; ?>            
                  </tbody>
                </table>
                <div class="right">
                    <?php foreach ($links as $link) { echo $link; } ?>
                </div>
            <div class="input-field col s12">
            <a class="btn waves-effect rpf-blue darken-3 col s12 modal-trigger" id="create-admin-user" href="#modal1">Create new Admin user</a>
          </div>
               </div><!-- /.col s12 l7 -->





  <!-- Modal Structure -->
  <div id="new-admin-user-modal" class="modal modal-fixed-footer">
    <?=form_open_multipart('sys/users',  array('id'=>'add-admin-Form', 'autocomplete'=>'off' ))?>
    <div class="modal-content">
      <h4>Register User</h4>
                             <div class="row">
                         <div class="input-field col s12">
                            <input id="username" name="username" type="text" class="validate" value="<?=set_value('username')?>" required>
                            <label for="username">Username</label>
                         </div>                         
                       </div><!-- /.row -->
                       <div class="row">
                         <div class="input-field col s12">
                            <input id="name" name="name" type="text" class="validate" value="<?=set_value('name')?>" required>
                            <label for="name">Full Name</label>
                         </div>                         
                       </div><!-- /.row -->

 <div class='row'>
    <div class='input-field col s12'>
      <input class='validate' type='password' name='admin-password' id='admin-password' value="<?=set_value('admin-password')?>" required  />
      <label for='admin-password'>Password</label>
      <span toggle="#admin-password" class="field-icon toggle-password"><span class="material-icons">visibility</span></span>
    </div>
 </div>


                       <div class="row">
                         <div class="input-field col s12">
                           <div class="file-field input-field">
                            <div class="btn">
                              <span>IMG</span>
                              <input type="file" name="img">
                            </div>
                            <div class="file-path-wrapper">
                              <input class="file-path validate" type="text">
                            </div>
                          </div>
                         </div><!-- /.input-field col s12 l3 -->
                       </div><!-- /.row -->


                                              <div class="row">
                         <div class="input-field col s12">                        
                            <div class="select-wrapper">  
                              <select class="browser-default" name="usertype" required>
                                  <option value="" disabled="" selected="">Select Usertype...</option>
                                  <?php 
                                    if($usertypes):
                                    foreach($usertypes as $usr):
                                  ?>
                                  <option value="<?=$usr['title']?>"><?=$usr['title']?></option>
                                  <?php
                                    endforeach;
                                    endif;
                                  ?>
                              </select>
                            </div><!-- /.select-wrapper -->
                            <label>Usertype</label>
                          </div><!-- /.input-field col s12 -->
                       </div><!-- /.row -->   

    </div>
<div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-red btn-flat">close</a>
            <a href="#!" class="modal-close waves-effect waves-green btn-flat" id='submit-admin-user' >Submit</a>
          </div>
          <input type="hidden" name="key" value="<?=$this->encryption->encrypt('candidate')?>" />
          <?=form_close()?>
  </div>



             </div><!-- /.row -->
           </div><!-- /.section --> 
         
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