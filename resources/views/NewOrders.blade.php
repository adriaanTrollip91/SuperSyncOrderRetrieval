<?php
$url = 'https://scs-widget-warehouse.myshopify.com/admin/api//2020-10/orders.json?key=a47fbb47c703349509c9ab877373b456&access_token=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&fulfillment_status=null';
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
$result = curl_exec($ch);
curl_close($ch);
$resultArray = json_decode($result, true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campaign Exclude App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <h1>New Orders</h1><br>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Email Address</th>
                <th scope="col">First name</th>
                <th scope="col">Last name</th>
                <th scope="col">Fulfillment status</th>
                <th scope="col">Current total price</th>
                <th scope="col">Current total tax</th>
                <th scope="col">Checkout ID</th>
                <th scope="col">Product</th>
                <th scope="col">Address</th>
            </tr>
            <?php
            foreach ($resultArray['orders'] as $orders) {
                if ( $orders['financial_status'] = 'paid' && $orders['fulfillment_status'] <> 'partial'){

            ?>
            <?php
            try {
                $Costmarinfo = $orders['customer'];
            } catch (\Throwable $th) {
                //throw $th;
            }
            try {
                $adress = $Costmarinfo['default_address'];
            } catch (\Throwable $th) {
                throw $th;
            }
            ?>
            <?php
            try {
                $fulfill = $orders['fulfillments'];
            } catch (\Throwable $th) {
                throw $th;
            }
            ?>
            <?php
            try {
                $line_item = $orders['line_items'];
            } catch (\Throwable $th) {
                throw $th;
            }
            ?>
            <tr>
                <td scope="col"><?php echo $orders['order_number']; ?> </td>
                <td scope="col"><?php echo $orders['email']; ?></td>
                <td scope="col"><?php echo $Costmarinfo['first_name']; ?></td>
                <td scope="col"><?php echo $Costmarinfo['last_name']; ?></td>
                <td scope="col"><?php echo $orders['financial_status']; ?></td>
                <td scope="col">$<?php echo $orders['current_total_price']; ?></td>
                <td scope="col">$<?php echo $orders['current_total_tax']; ?></td>
                <td scope="col"><?php echo $orders['checkout_id']; ?></td>
                <td scope="col">
                    Product
                    <br />
                    <?php
                    try {
                        echo $line_item['name'];
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                    try {
                        echo $fulfill['name'];
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                    ?>
                    <br />
                    Sku
                    <br />
                    <?php try {
                        echo $line_item['sku'];
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                    try {
                        echo $fulfill['sku'];
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                    ?>
                    <br />
                    Color
                    <br />
                    <?php try {
                        echo $line_item['variant_title'];
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                    try {
                        echo $fulfill['variant_title'];
                    } catch (\Throwable $th) {
                        //throw $th;
                    } ?>
                    <br />
                    Qty
                    <br />
                    <?php try {
                        echo $line_item['quantity'];
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                    try {
                        echo $fulfill['quantity'];
                    } catch (\Throwable $th) {
                        //throw $th;
                    } ?>
                </td>
                <td scope="col">
                    address:
                    <br />
                    <?php try {
                        echo $adress['address1'];
                    } catch (\Throwable $th) {
                        //throw $th;
                    } ?>
                    <br />
                    city:
                    <br />
                    <?php try {
                        echo $adress['city'];
                    } catch (\Throwable $th) {
                        //throw $th;
                    } ?>
                    <br />
                    province:
                    <br />
                    <?php try {
                        echo $adress['province'];
                    } catch (\Throwable $th) {
                        //throw $th;
                    } ?>
                    <br />
                    zip:
                    <br />
                    <?php try {
                        echo $adress['zip'];
                    } catch (\Throwable $th) {
                        //throw $th;
                    } ?>
                    <br />
                    country:
                    <br />
                    <?php try {
                        echo $adress['country'];
                    } catch (\Throwable $th) {
                        //throw $th;
                    } ?>
                </td>
            </tr>
            <?php }
            } ?>
        </thead>
    </table>


</body>

</html>
