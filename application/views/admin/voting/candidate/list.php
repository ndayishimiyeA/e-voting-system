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

            <div class="row">
                    
             


            </div>
            
          <div class="section">
             <div class="row">
               <div class="col s12 l6">
                 <table class="striped bordered highlight">
                  <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Segment / Position</th>
                    </tr>
                  </thead>

                  <tbody>                    
                    <?php if($results):
                      foreach($results as $row): ?>
                    <tr>
                      <td>
                        <a href="<?=base_url('sys/candidates/update/' . $row['id'])?>">
                        <?php if(filexist($row['img']) && $row['img']): ?>
                          <img src="<?=base_url('uploads/'.$row['img'])?>" alt="" class="circle responsive-img valign candidate-img">
                        <?php else: ?>
                          <img src="<?=base_url('assets/images/no_image.gif')?>" alt="" class="circle responsive-img valign candidate-img">
                        <?php endif; ?>
                        </a>
                      </td>
                      <td><a href="<?=base_url('sys/candidates/update/' . $row['id'])?>"><?=$row['name']?></a></td>
                      <td><?=$row['position']?></span></td>
                    </tr> 
                    <?php endforeach; 
                      endif; ?>            
                  </tbody>
                </table>
                <div class="right">
                    <?php foreach ($links as $link) { echo $link; } ?>
                </div>
               </div><!-- /.col s12 l7 -->


               <div class="col s12 l6">  


<div class="card-panel">
 <div class="card-content">
   <h6 class="strong">Import Candidate List <span style='font-size: 12px;'>(.CSV file)</span></h6>

                        <div class="row">
                         <div class="col s12 m12 l12">
                            <?=form_open_multipart('sys/candidates/import')?>

            
                <input type="file" name="file" />
                <input type="submit" class="btn btn-primary rpf-blue" name="importSubmit" value="IMPORT">
            

                      <?=form_close()?>
                         </div>
                       </div><!-- /.row -->
 </div>
</div>
                

<!-- ADD segment -->

                 <div class="card-panel">
                   <div class="card-content">
                     <h6 class="strong">
                       Segment/Position
                     </h6><!-- /.strong -->
                     <?=form_open('sys/candidates')?>
                     <div class="row">
                       <div class="col s9 input-field">
                         <input type="text" name="segment" id="title" class="validate" placeholder="Create New Segment/Position" required />
                         <label for="title">New Segment/Position</label>                      
                       </div><!-- /.col s5 input-field -->
  
                         <div class="input-field col s3">
                           <button class="btn cyan waves-effect waves-light right" type="submit" name="action">SAVE
                                <i class="mdi-content-send right"></i>
                           </button>
                         </div><!-- /.input-field col s3 -->             
                     </div><!-- /.row -->
                       <input type="hidden" name="key" value="<?=$this->encryption->encrypt('segment')?>" />                     
                     <?=form_close()?>
                     <div class="divider"></div><!-- /.divider -->

                     <table class="bordered striped">
                       <tbody class="add-seg-btns">
                         <?php if($positions):
                         foreach ($positions as $seg): ?>
                         <tr>
                           <td>
                              <span><?=$seg['title']?></span>
                            </td> 
                            <td>
                              <a id="update-segment-<?=safelink($seg['title'])?>" name ="#Update<?=safelink($seg['title'])?>" class="modal-trigger amber-text">[<i class="mdi-editor-mode-edit tiny"></i>]</a>
                              <a name="#Delete<?=safelink($seg['title'])?>" id="delete-segment-<?=safelink($seg['title'])?>" class="modal-trigger red-text">[<i class="mdi-action-delete tiny"></i>]</a>
                            </td>                         
                         </tr>
                         <?php endforeach;
                         endif; ?>
                       </tbody>
                     </table><!-- /.bordered striped -->
                   </div><!-- /.card-content -->
                 </div><!-- /.card-panel -->

<!-- End ADD segment -->


                 <div class="card-panel">
                   <div class="card-content">
                     <h6 class="strong">Register Candidate</h6><!-- /.strong -->
                     <?=form_open_multipart('sys/candidates')?>
                       <div class="row">
                         <div class="input-field col s12 l9">
                            <input id="name" name="name" type="text" class="validate" required>
                            <label for="name">Full Name</label>
                         </div>
                         <div class="input-field col s12 l3">
                           <div class="file-field input-field">
                            <div class="btn rpf-blue">
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
                         <div class="input-field col s6">
                           <div class="select-wrapper">  
                              <select class="browser-default" id="segment" name="segment" required>
                                  <option value="" disabled="" selected="">Segment/Position Desired</option>
                                  <?php 
                                    if($positions):
                                    foreach($positions as $seg):
                                  ?>
                                  <option value="<?=$seg['title']?>"><?=$seg['title']?></option>
                                  <?php
                                    endforeach;
                                    endif;
                                  ?>
                              </select>
                            </div><!-- /.select-wrapper -->
                            <label>Segment / Position</label>
                         </div><!-- /.input-field col s6 -->
                       </div><!-- /.row -->
                       <div class="row">
                          <div class="input-field col s12">
                              <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                                <i class="mdi-content-send right"></i>
                              </button>
                           </div>
                       </div><!-- /.row -->

                       <input type="hidden" name="key" value="<?=$this->encryption->encrypt('candidate')?>" />
                     <?=form_close()?>
                   </div><!-- /.card-content -->
                 </div><!-- /.card-panel -->





                 <!-- Modals -->
                 <?php if($positions):
                  foreach ($positions as $seg): ?>

                    <div id="Update<?=safelink($seg['title'])?>" class="modal">
                    <?=form_open('sys/candidates/update_segment')?>
                      <div class="modal-content">
                          <p>Please update the segment/position accordingly.</p>
                          <div class="row">
                            <div class="input-field col s8">
                              <input type="text" name="title" id="" class="validate" value="<?=$seg['title']?>" />
                              <label for="">Segment/Position</label>
                            </div><!-- /.input-field col s8 -->

                          </div><!-- /.row -->
                          <input type="hidden" name="id" value="<?=$this->encryption->encrypt($seg['title'])?>" />
                        </div>
                        <div class="modal-footer">
                          <a href="#" class="waves-effect waves-amber btn-flat modal-action modal-close">Cancel</a>
                          <button type="submit" class="waves-effect waves-amber btn amber modal-action">Update</button>
                        </div>
                    <?=form_close()?>
                  </div>




                 <div id="Delete<?=safelink($seg['title'])?>" class="modal">
                    <?=form_open('sys/candidates/delete_segment')?>
                      <div class="modal-content">
                          <p>Are you sure to delete <span class="strong"><?=$seg['title']?></span>?</p>
                          <p>Deleting this segment/position will <span class="strong">DELETE ALL Candidates</span> within this segment/position.</p>
                          <p>You <span class="strong">CANNOT UNDO</span> this action.</p>
                          <input type="hidden" name="id" value="<?=$this->encryption->encrypt($seg['title'])?>" />
                        </div>
                        <div class="modal-footer">
                          <a href="#" class="waves-effect waves-red btn-flat modal-action modal-close">Cancel</a>
                          <button type="submit" class="waves-effect waves-red btn red modal-action">Delete</button>
                        </div>
                    <?=form_close()?>
                  </div>





                  <?php endforeach;
                   endif; ?>

               </div><!-- /.col s12 l5 -->
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