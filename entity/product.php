<?php declare(strict_types = 1);

class Product implements JsonSerializable {
    private $id;
    private $productName;
    private $productDesc;
    private $productPrice;
    private $productStock;
    private $publishedBy;
    private $updatedDate;

    function __construct($id = NULL, $productName, $productDesc, $productPrice, $productStock, $publishedBy, $updatedDate = NULL) {
        $this->id = $id;
        $this->productName = $productName;
        $this->productDesc = $productDesc;
        $this->productPrice = $productPrice;
        $this->productStock = $productStock;
        $this->publishedBy = $publishedBy;
        $this->updatedDate = $updatedDate;
    }

    function jsonSerialize(): mixed {
        return [
            'id'=> $this->id,
            'productName'=> $this->productName,
            'productDesc'=> $this->productDesc,
            'productPrice'=> $this->productPrice,
            'productStock'=>$this->productStock,
            'publishedBy'=> $this->publishedBy,
            'updatedDate'=> $this->updatedDate
        ];
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

    public function getProductPrice() {
        return $this->productPrice;
    }

    public function setProductPrice($productPrice) {
        $this->productPrice = $productPrice;
    }

    public function getProductStock() {
        return $this->productStock;
    }

    public function setProductStock($productStock) {
        $this->productStock = $productStock;
    }

    public function getPublishedBy() {
        return $this->publishedBy;
    }

    public function setPublishedBy($publishedBy) {
        $this->publishedBy = $publishedBy;
    }

    public function getUpdatedDate(){
        return $this->updatedDate;
    }

    public function setUpdatedDate($updatedDate) {
        $this->updatedDate = $updatedDate;
    }
}

?>