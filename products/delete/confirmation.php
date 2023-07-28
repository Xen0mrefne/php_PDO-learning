<?php

try {
    require(__DIR__."/../../db/connection.php");
    require(__DIR__."/../../utils/security.php");
    
    $stmt = $conn->prepare("SELECT * FROM Products WHERE id=:productId");
    $stmt->bindParam(":productId", $productId);
    
    $productId = sanitize($_GET["PDelete"]);

    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $product = $stmt->fetch();

    $_SESSION["product-delete"] = $productId;

} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<div class="delete-confirm">
    <p>Are you sure you want to delete product <?php echo $product["productName"] ?>?</p>
    <a class="btn btn-black btn-hover" href="http://localhost/products">Cancel</a>
    <a class="btn btn-red btn-fill" href="http://localhost/products/delete/action.php">Delete</a>
</div>