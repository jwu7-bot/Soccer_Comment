<?php  

/*******w******** 
    
    Name: Jiahui Wu
    Date: 4/20/2024
    Description: Errors

****************/

// display errors array
if (count($errors) > 0) : ?>
  <div class="error">
  	<?php foreach ($errors as $error) : ?>
  	  <p><?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>