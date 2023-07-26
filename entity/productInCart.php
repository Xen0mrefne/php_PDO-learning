<?php declare(strict_types = 1);

class ProductInCart implements JsonSerializable {
    private int $user_id;
    private Product $product;
    private int $amount;

    function __construct(int $user_id, Product $product, int $amount) {
        $this->user_id = $user_id;
        $this->product = $product;
        $this->amount = $amount;
    }

    function jsonSerialize(): mixed {
        return [
            'userId'=> $this->user_id,
            'product'=> $this->product,
            'amount'=> $this->amount
        ];
    }

    public function getUserId(): int {
        return $this->user_id;
    }

    public function setUserId($user_id): void {
        $this->user_id = $user_id;
    }

    public function getProduct(): Product {
        return $this->product;
    }

    public function setProduct($product): void {
        $this->product = $product;
    }

    public function getAmount(): int {
        return $this->amount;
    }

    public function setAmount($amount): void {
        $this->amount = $amount;
    }
}

?>