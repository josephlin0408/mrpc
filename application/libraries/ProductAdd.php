<?php
Class ProductAdd {
    public $attr_type;
    public $results;    //用以存放中繼結果的陣列
    public $response;   //用以存放結果的陣列
    public  function add_dimension($dimension) {
        $this->attr_type[] = $dimension;
    }
    public function start() {
        $this->build(array_shift($this->attr_type));
        foreach ($this->results as $key => $string){
            $temp_array = explode(";", $string); // String to Array
            foreach ($temp_array as $attr){
                $attr_value = explode(",", $attr);
                $this->response[] = array("product_id" => $key, "attr_type_id" => $attr_value[0], "attr_id" => $attr_value[1]);
            }
        }
        return $this->response;
    }
    public function build($current_dimension, $prefix_string = "") {
        $next_dimension = array_shift($this->attr_type);
        for ($i = 0; $i < count($current_dimension); $i++) {
            if(isset($next_dimension)) {
                $new_string = $prefix_string.$current_dimension[$i].";";
                $this->build($next_dimension, $new_string);
            }else{
                $this->results[] = $prefix_string.$current_dimension[$i];
            }
        }
        if(isset($next_dimension)) $this->attr_type[] = $next_dimension;
    }
}

//$product = new Product();
//$product->add_dimension(array("1,S","1,M","1,L","1,XL"));
//$product->add_dimension(array("2,red","2,green","2,blue"));
//$product->add_dimension(array("3,Male","3,Female"));
//echo "<pre>";
//print_r($product->start());