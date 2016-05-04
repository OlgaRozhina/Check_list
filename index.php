<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link  rel="stylesheet"  href="style.css">
        <title></title>
    </head>
    <body>
        <?php
        
         require_once('connectvars.php');
         require_once('appvars.php');

      // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Error connecting to database');
  
  if (isset($_POST['submitAdd'])) {
    // Grab the check data from the POST
    $user_id = mysqli_real_escape_string($dbc, trim($_POST['user_id']));
    $product_name = mysqli_real_escape_string($dbc, trim($_POST['product_name']));
    
     //Validate price
    if (ereg("[[:alpha:]]",$_POST['price'])){
        echo '<p>Please,attend! Price must contain only numbers and simbols "," or "-" or "." .</p>';
        $price =0;
    }
       
    elseif (ereg("[,]|[-]", $_POST['price'])) {
        //change simbols [,] or [-] to "."
        $new_price = ereg_replace("[,]|[-]", ".", $_POST['price']);
        $price =  floatval($new_price);
      }
    else {
         $price =  floatval($_POST['price']); 
    }
    
    $guarantee = $_POST['guarantee'];
    $buyingdate =$_POST['buyingdate'];
    $filecheck = mysqli_real_escape_string($dbc, trim($_FILES['filecheck']['name']));
    $filecheck_type = $_FILES['filecheck']['type'];
    $filecheck_size = $_FILES['filecheck']['size']; 
    list($filecheck_width, $filecheck_height) = @getimagesize($_FILES['filecheck']['tmp_name']);
//   var_export($_FILES); //this line is just for  checking information
   
    // Validate and move the uploaded picture file, if necessary
     if (!empty($filecheck)) {
        if ((($filecheck_type == 'image/gif') || ($filecheck_type == 'image/jpeg') || ($filecheck_type == 'image/pjpeg') ||
            ($filecheck_type == 'image/png')) && ($filecheck_size > 0) && ($filecheck_size <= MM_MAXFILESIZE) &&
            ($filecheck_width <= MM_MAXIMGWIDTH) && ($filecheck_height <= MM_MAXIMGHEIGHT)) {

            if ($_FILES['filecheck']['error'] == 0) {
              // Move the file to the target upload folder
              echo $target = MM_UPLOADPATH . $filecheck;
              
                if (move_uploaded_file($_FILES['filecheck']['tmp_name'], $target)) {
                 // The  checkPhoto file move was successful, now make sure 
                echo' The  checkPhoto file move was successful';               
                }
                else {
                      // The new checkPhoto file move failed, so delete the temporary file  
                    @unlink($_FILES['filecheck']['tmp_name']);
                    echo '<p>Sorry, there was a problem uploading your checkPhoto.</p>';
                }
            }
            
        }
        elseif ($filecheck_size > MM_MAXFILESIZE||$_FILES['filecheck']['error']==1) {
            // The new checkPhoto file is not valid, so delete the temporary file 
            @unlink($_FILES['filecheck']['tmp_name']);
            echo '<p>Your picture must be a GIF, JPEG, or PNG image file no greater than ' . (MM_MAXFILESIZE / (1024*1024)) .
            ' MB and ' . MM_MAXIMGWIDTH . 'x' . MM_MAXIMGHEIGHT . ' pixels in size.</p>';
    }
   }
   
   // Проверяем все ли необходимые данные пользователь ввел в форму
   if(($product_name != '')&&($price != '')&&($buyingdate != '')){
          //        Validate guarantee date
        if(!empty($guarantee)){
            $datetime1 = new DateTime($guarantee);
            $datetime2 = new DateTime($buyingdate);
            $interval = $datetime2 ->diff($datetime1);
//        echo $interval->format('%R%a');
        
        }
        if ((empty($guarantee))||($interval->format('%R%a')> 0)) {
         
       // Set data to database  
         $query = "INSERT INTO `check_table` (`user_id`, `product_name`, `price`, `guarantee`, `buyingdate`,`filecheck`)"
            . " VALUES ($user_id, '$product_name', $price, '$guarantee', '$buyingdate','$filecheck')";
         $result = mysqli_query($dbc, $query)or die('Error querying database');
         echo '<p>Check has been successfully added </p>';
         //  обнуляем переменные. чтобы стереть значения  value 
         $product_name = "";
        $price = "";
        $guarantee = "";
        $buyingdate ="";
        $filecheck ="";
         
       }
       elseif ($interval->format('%R%a')< 0) {
           echo '<p>Guarantee date can`t be earlier than check date! </p>';
       
       }
   }
 else {
      echo '<p>Sorry, You must enter  the check data, including the Product name , Price and  Date. Price must contain only numbers and simbols "," ,"-", "." .</p>'; 
   }
   
  
  }
  
        ?>
        <table class="homeCheckTab">
        <tr>
        <td></td>
        <td>Product name</td>
        <td>Price</td>
        <td>Guarantee</td>
        <td>Date</td>
        <td>Upload Check</td>
        <td></td>

        </tr>
        <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <tr>
            
            <td><input type="hidden" name="user_id" value="<?php echo MM_USER_ID; ?> "></td>
            <td><input type="text" name="product_name" class="checkProduct" value="<?php if (!empty($product_name)) echo $product_name; ?>"   /></td>
            <td><input type="text" name="price" class="productPrice" value="<?php if (!empty($price)) echo $price; ?>"/></td>
            <td><input type="date" name="guarantee" class="productGuarantee" value="<?php if (!empty($guarantee)) echo $guarantee; ?>" /></td>
            <td><input type="date" name="buyingdate" class="checkDate" value="<?php if (!empty($buyingdate)) echo $buyingdate; ?>" ></td>
            <td><input type="file" name="filecheck" class="checkPhoto"/></td>
            <td><input type="submit" name="submitAdd" value="Add a check" class="addCheck"/></td>
        </tr>
        </form>
        </table>
        <br>
        <?php
        require_once('create_table.php');
        ?>
    </body>
</html>
