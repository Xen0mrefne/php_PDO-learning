<?php

class Product {
    private $id;
    private $productName;
    private $productDesc;
    private $updatedDate;

    function __construct($id = NULL, $productName, $productDesc, $updatedDate = NULL) {
        $this->id = $id;
        $this->productName = $productName;
        $this->productDesc = $productDesc;
        $this->updatedDate = $updatedDate;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getProductName() {
        return $this->productName;
    }

    public function setProductName($productName) {
        $this->productName = $productName;
    }

    public function getProductDesc() {
        return $this->productDesc;
    }

    public function setProductDesc($productDesc) {
        $this->productDesc = $productDesc;
    }

    public function getUpdatedDate(){
        return $this->updatedDate;
    }

    public function setUpdatedDate($updatedDate) {
        $this->updatedDate = $updatedDate;
    }
}

?>