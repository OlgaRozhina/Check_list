<?php


class Row {
    //put your code here
    public $check_id;
    public $user_id;
    public $product_name;  
    public $price;
    public $guarantee;    
    public $buyingdate;
    public $filecheck ;
    
    public function __construct($check_id,$user_id,$product_name,$price,$guarantee,$buyingdate,$filecheck) {
        $this->check_id = $check_id;
        $this->user_id = $user_id;
        $this->product_name =$product_name;
        $this->price = $price;
        $this->guarantee =$guarantee;
        $this->buyingdate =$buyingdate;
        $this->filecheck =$filecheck;
        
    }
    public function create_row() {
        return '<tr><td>'.$this->product_name.'</td><td>'.$this->price.'</td><td>'.$this->guarantee.'</td><td>'.$this->buyingdate.
                '</td><td>'.$this->filecheck.'</td>';
        
    }

    
}
?>
