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
    <h1>Clients</h1><br>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">order_number</th>
                <th scope="col">email</th>
                <th scope="col">current total price</th>
                <th scope="col">current total tax</th>
                <th scope="col">fulfillment status</th>
                <th scope="col">checkout id</th>
            </tr>
            <?php
            $today = date('Y-m-d h:i:s');
            $lastmonth = date('Y-m-d h:i:s', strtotime('-1 months', strtotime($today)));
            foreach ($resultArray['orders'] as $orders) {
                if ($orders['fulfillment_status'] <> 'partial'){

            ?>
            <tr>
                <td scope="col"><?php echo $orders['order_number']; ?> </td>
                <td scope="col"><?php echo $orders['email']; ?></td>
                <td scope="col"><?php echo $orders['current_total_price']; ?></td>
                <td scope="col"><?php echo $orders['current_total_tax']; ?></td>
                <td scope="col"><?php echo $orders['fulfillment_status']; ?></td>
                <td scope="col"><?php echo $orders['checkout_id']; ?></td>
            </tr>
            <?php }
            } ?>
        </thead>
    </table>


</body>

</html>
