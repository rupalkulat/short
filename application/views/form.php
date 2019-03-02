<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


    <title>Url Generator</title>
  </head>
  <body>
    <header>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="#" class="navbar-brand d-flex align-items-center">
            <i class="fas fa-link fa-"></i> <strong>Short Link Generator</strong>
          </a>
          
        </div>
      </div>
    </header>
    <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6">
			<form method="POST" action="<?php echo ($this->input->get('show') && $this->input->get('id'))?base_url('shortlink/reprocess?show='.$this->input->get('show').'&id='.$this->input->get('id')):base_url('shortlink/process'); ?>">
				
            <div class="form-group">
              <label >Campaign name</label>
              <input type="text" class="form-control" name="campaign_name"  placeholder="Campaign name" value="<?php echo @$campaign_name; ?>">
              
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Long Url</label>
              <input type="text" name="long_url" value="<?php echo @$long_url; ?>" class="form-control" placeholder="Past Long Url">
            </div>
            <?php
              if(isset($short_url)){
                ?>
              <div class="form-group">
                <label >Short Url</label>
                <div class="input-group">
                  <input type="text" name="short_url" value="<?php echo base_url(base64_encode($id)); ?>" class="form-control" placeholder="Short Url">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><a id="copy" class="btn" alt="copy"><i class="far fa-copy"></i></a></div>
                  </div>
                </div>
              </div>
				 <?php
                 if(isset($redirect_to)){
                 ?>
                <div class="form-group">
                <label for="exampleInputPassword1">Redirection Url</label>
                <input type="text" name="redirect_url" value="<?php echo $redirect_to; ?>" class="form-control">
              </div>
				<?php
				}
				  else{ ?>
				  <div class="form-group">
                <label for="exampleInputPassword1">Redirection Url</label>
                <input type="text" name="redirect_url" value="" class="form-control">
                 </div>
				  
			 <?php		  
			 }
           
            }
            ?>
            <button type="submit" class="btn btn-primary" id="sub" >Submit</button>

          </form>

          </div>
        </div>

    </div>
	  
	<div class="my-3 my-md-5">
    <div class="container">
        <div class="page-header">
          <h1 class="page-title">
            Shortlink Entries
          </h1>
        </div>
        
       
        <div class="row row-cards">
        	<div class="col-12">
                <div class="card">
                  <div class="table-responsive">
                    <br />
                    <table id="tbl" class="table table-striped table-bordered">
                      <thead>
                        <tr>
						              <th>Action</th>
                          <th>ID</th>
                          <th>Campaign Name</th>
                          <th>Short url</th>
                          <th>Long url</th>
						  <th>Redirection url</th>
                        </tr>
                      </thead>
                      <tbody>
						  <?php
                        
                              foreach ($data as $key => $value) 
                               { ?>
                               
                                     <tr>
										                   <td>
                                        <a href="<?php echo base_url(); ?>shortlink/getUrl/<?php echo $value['id'];?>"><i class="far fa-edit"></i>
                                        </a>
                                        <a data-id="<?php echo $value['id']; ?>" href="javascript:void(0)" onclick="delet(this)"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                        <td><?php echo $value['id']?></td>
                                       <td><?php echo $value['campaign_name']?></td>
                                        <td><?php echo $value['short_url']?></td>
                                        <td><?php echo $value['long_url']?></td>
                                        <td></td>
                                      </tr>
						   <?php	  
							 
                              } ?>
                      </tbody>
                    </table>
                    <br />
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function()
{
  $('#tbl').DataTable({
     "order": [[2, "desc" ]]
  });
  $('head').append('<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" type="text/css" />');
  
});  
</script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
    <script type="text/javascript">
      $(function() {
      $('#copy').click(function() {
        $('input[name="short_url"]').focus();
        $('input[name="short_url"]').select();
          document.execCommand('copy');
        $(".copied").text("Copied to clipboard").show().fadeOut(1200);
          });
    });
    </script>
	  							 
 </body>
</html>