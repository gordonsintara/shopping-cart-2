<?php
session_start();
$status="";
if (isset($_POST['action']) && $_POST['action']=="remove"){
if(!empty($_SESSION["shopping_cart"])) {
    foreach($_SESSION["shopping_cart"] as $key => $value) {
      if($_POST["code"] == $key){
      unset($_SESSION["shopping_cart"][$key]);
      $status = "<div class='box' style='color:red;'>
      Product is removed from your cart!</div>";
      }
      if(empty($_SESSION["shopping_cart"]))
      unset($_SESSION["shopping_cart"]);
      }		
}
}

if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["shopping_cart"] as &$value){
    if($value['code'] === $_POST["code"]){
        $value['quantity'] = $_POST["quantity"];
        break; // Stop the loop after we've found the product
    }
}
  	
}
?>

<div class="cart">
<?php
    if(isset($_SESSION['shopping_cart'])){
        $total_price = 0;
?>


    <table class="table">
    <tbody>
        <tr>
            <td></td>
            <td>Product Name</td>
            <td>Qty</td>
            <td>Unit Price</td>
            <td>Total</td>
        </tr>

        <?php
            foreach ($_SESSION['shopping_cart'] as $product){
        ?>

        <tr>
            <td>
                <img src = '<?php echo $product["image"]; ?>' width="50" height="40" /> 
            </td>

            <td>
                <?php echo $product["name"]; ?> <br>

                <form action='' method='post'>
                    <input type='hidden' name='code' value="<?php echo $product['code']; ?>" >
                    <input type='hidden' name='action' value="remove">
                    <input type='submit' class='remove' value="Remove Item">
                    <select name='quantity' class='quantity' onChange="this.form.submit()">
                        <option <?php if($product['quantity']==1) echo "selected";?> value="1">1</option>
                        <option <?php if($product['quantity']==2) echo "selected";?> value="2">3</option>
                        <option <?php if($product['quantity']==3) echo "selected";?> value="3">3</option>
                        <option <?php if($product['quantity']==4) echo "selected";?> value="4">4</option>
                        <option <?php if($product['quantity']==5) echo "selected";?> value="5">5</option>
                    </select>

                </form>
            </td>
            <td>
                <?php echo "R".$product["price"]; ?>
            </td>
            <td>
                <?php echo "R".$product["price"]*$product["quantity"]; ?>
            </td>
        </tr>
        <?php
        $total_price += ($product["price"] * $product["quantity"]);
            }
        ?>

        <tr>
            <td colspan="5">
            <strong>
                Total: <?php echo "R".$total_price; ?>
            </strong>
            </td>
        </tr>
    </tbody>
    </table>
    <?php
            }else{
                echo "<h3>Cart is empty</h3>";
            }
    ?>

</div>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px">
    <php
         echo $status;
    ?>
</div>