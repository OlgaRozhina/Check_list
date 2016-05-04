<?php


 // Grab the profile data from the database
   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Error connecting to database');
  $query2 ="SELECT * FROM check_table WHERE user_id=". MM_USER_ID;
  $result2 = mysqli_query($dbc, $query2) or die('Erorr querying database');
  $check_table = array();
  while ($row = mysqli_fetch_array($result2)) {
      array_push($check_table, $row);
      
  }
  ?>
<div class="checkList">
<table class="checkListTab" >
    <tr>
        <td>Product name</td>
        <td>Price</td>
        <td>Guarantee</td>
        <td>Date</td>
        <td>Check</td>
        <td>Delete</td>
        <td>Print</td>
        <td>Upgrade</td>
    </tr>
    
<?php
  require_once ('row.php');
  
  for($i=0;$i<count($check_table); $i++){    
      
        $check_id =$check_table[$i]['check_id'];
        $user_id = $check_table[$i]['user_id'];
        $product_name = $check_table[$i]['product_name'];
        $price = $check_table[$i]['price'];
        //$guarantee = $check_table[$i]['guarantee'];
        $check_table[$i]['guarantee'] =='0000-00-00'? $guarantee='':$guarantee = $check_table[$i]['guarantee'];
        $buyingdate = $check_table[$i]['buyingdate'];
        $filecheck = $check_table[$i]['filecheck'];
        
        $table_row = new Row($check_id, $user_id, $product_name, $price, $guarantee, $buyingdate, $filecheck);
        echo $table_row->create_row();
        
          echo '<td></td>';
          echo '<td></td>';
          echo '<td></td>';
          echo '</tr>';     
 
  }
  ?>
    
<?php
//   echo '<pre>';
//   var_export($check_table);
//   echo '</pre>';
?>
          
</table>
</div>