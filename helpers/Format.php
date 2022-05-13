<?php 
 class Format{

 	public function data_validation($data){

 		$data = trim($data);
 		$data = stripslashes($data);
 		return $data;
 	}

    public function text_shorten($text, $limit=400){
        
        $text = $text.' ';
        $text = substr($text,0,$limit);
        $text = $text.'....';
        return $text;
    }


    public function data_length($data){
        
        echo strlen($data);
    }

 }