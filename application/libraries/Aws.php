<?php

/*
 * 'AKIAJBWRU6YO5DBLYCVA'
 * 'acWMJRLHPr3XfA1Ja66a/OYuxeKKdrrqA8iL41JP'
 */

class Aws {
    
    private $accessKey, $secretKey, $country, $associateTag, $aws;
    
    public function __construct() {
        
        $this->accessKey    = "AKIAJBWRU6YO5DBLYCVA";
        $this->secretKey    = "acWMJRLHPr3XfA1Ja66a/OYuxeKKdrrqA8iL41JP";
        $this->country      = "com";
        $this->associateTag = "aaaaabbbbcccc";
        
        require_once( APPPATH . 'third_party/aws/lib/AmazonECS.class.php');
        $this->aws = new AmazonECS($this->accessKey, $this->secretKey, $this->country, $this->associateTag);
        
//        echo "<pre>";
//        print_r($this->asin('B004HO6I4M'));
//        echo "</pre>";
    }
    
    public function asin($asin) {
        $result = $this->aws->lookup($asin);
        return $result->Items;
    }
    
}