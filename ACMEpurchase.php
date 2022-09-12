<?php
include 'ACMEarray.php';
error_reporting(0);
session_start();

if (isset($_POST['submit'])) {
    $item = $_POST['item'];
    $retail = "$" .$_POST['retail'];
    $discount =  $_POST['discount'];
    $total =  $_POST['total'];

    // Find the $cost(is the key of item name) in array $inventory1
    $inventory1 = array(225 => "mandolin", 568 => "classical guitar", 365 => "acoustic guitar", 3.25 => "kazoo", 123 => "djembe", 378 => "sitar", 15 => "bamboo flute");
    $cost = array_search("$item", $inventory1);

    if ($total > $cost) {
        if (empty($_SESSION['cart'])) {
            $_SESSION['cart'] = array($_POST['item'], $_POST['retail'], $_POST['discount'], $_POST['total']);
            $arr =  $_SESSION['cart'];
        } else {
            $count = count($_SESSION['cart']);
            $_SESSION['cart'][$count] = $count;
            $_SESSION['item'][$count] = $item;
            $_SESSION['retail'][$count] = $retail;
            $_SESSION['discount'][$count] = $discount;
            $_SESSION['total'][$count] = $total;
        }
        $arr =  $_SESSION['cart'];
    } else {
        echo "<script>alert('Sorry:( The discount is toooooooooooo much, We are going Broke!')</script>";
    }
}

if (isset($_GET['reset'])) {
    if ($_GET['reset'] === 'true') {
        unset($_SESSION["cart"]);
        unset($_SESSION["item"]);
        unset($_SESSION["retail"]);
        unset($_SESSION["discount"]);
        unset($_SESSION["total"]);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Chi Zhang">
    <link rel="stylesheet" href="ACMEpurchase.css">
    <title>ACME Customer Care Portal</title>
</head>

<body>
    <header>
        <h1>ACME Corporation</h1>
        <div class="tagline">yes we deliver!</div>
    </header>

    <main>
        <h2>Customer Invoice</h2>
        <table class="invoice" id="my-table">
            <tr>
                <th class="invoiceheader">Item</th>
                <th class="invoiceheader">Retail Cost</th>
                <th class="invoiceheader">Discount</th>
                <th class="invoiceheader">Total</th>
            </tr>

            <?php
            $total = 0;
            foreach ($_SESSION['cart'] as $n) {
            ?>
                <tr>
                    <td><?php echo ($_SESSION["item"][$n]); ?></td>
                    <td class="centered"><?php echo ($_SESSION["retail"][$n]); ?></td>
                    <td class="centered"><?php echo ($_SESSION["discount"][$n]); ?></td>
                    <td class="centered"><?php echo ($_SESSION["total"][$n]); ?></td>
                </tr>
            <?php
                $total = $total + $_SESSION["total"][$n];
            } ?>

            <tr class="totalline">
                <td colspan="3">Invoice total</td>
                <td class="centered" id="td_total">$<?php echo ($total); ?></td>
            </tr>

        </table>

        <div class="likebtn" id="purchase">
            <a class="pur-btn" href=<?php echo "ACMEpurchase.php?reset=true " ?>>Purchase</a>
        </div>

        <hr>

        <form method="POST" action="<?= $_SERVER['PHP_SELF']; ?>">
            <fieldset class="additem">
                <legend>Add Item to Order</legend>
                <select id="newitem" onchange="change(this)">
                    <option value=""> <?php echo ($inventory[0][0]) ?> </option>
                    <option value=""> <?php echo ($inventory[1][0]) ?> </option>
                    <option value=""> <?php echo ($inventory[2][0]) ?> </option>
                    <option value=""> <?php echo ($inventory[3][0]) ?> </option>
                    <option value=""> <?php echo ($inventory[4][0]) ?> </option>
                    <option value=""> <?php echo ($inventory[5][0]) ?> </option>
                    <option value=""> <?php echo ($inventory[6][0]) ?> </option>
                </select>

                <div class="itemdetails">
                    <label for="item">Item:</label>
                    <input type="text" name="item" id="item" readonly="readonly" class="disabled">
                </div>
                <div class="itemdetails">
                    <label for="retail">Price:</label>
                    <input type="text" name="retail" id="retail" readonly="readonly" class="disabled">
                    <label for="discount">Discount:</label>
                    <input type="text" name="discount" id="discount" class="auto">
                    <label for="total">Total:</label>
                    <input type="text" name="total" id="total" readonly="readonly" class="disabled">
                </div>

                <div class="purchase">
                    <button type="submit" name="submit" class="add">Add to Invoice</button>
                </div>

                <p class="centered">
                    Attention, all discounts will be verified by our software.
                </p>

            </fieldset>
        </form>

        <footer>ACME Coporation for all that you can scheme up!</footer>
    </main>

    <script src="script1.js"></script>

</body>

</html>