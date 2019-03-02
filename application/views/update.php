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
            <?php
          foreach ($data as $key => $value) 
                               { ?>
			<form method="POST" action="<?php echo base_url(); ?>shortlink/update/<?php echo $value['id'];?>">
				
            <div class="form-group">
              <label >Campaign name</label>
              <input type="text" class="form-control" name="campaign_name"  placeholder="Campaign name" value="<?php echo $value['campaign_name']?>">
              
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Long Url</label>
              <input type="text" name="long_url" value="<?php echo $value['long_url']?>" class="form-control" placeholder="Past Long Url">
            </div>

              <div class="form-group">
                <label >Short Url</label>
                <div class="input-group">
                  <input type="text" name="short_url" value="<?php echo $value['short_url']?>" class="form-control" placeholder="Short Url">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><a id="copy" class="btn" alt="copy"><i class="far fa-copy"></i></a></div>
                  </div>
                </div>
              </div>

				    <div class="form-group">
                <label for="exampleInputPassword1">Redirection Url</label>
                <input type="text" name="redirect_url" value="" class="form-control">
            </div>
				   <?php    
               
                              } ?>

            <button type="submit" class="btn btn-primary" id="updt">Update</button>
          </form>

          </div>
        </div>

    </div>
	  
	



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