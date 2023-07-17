<?php
$url = 'https://scs-widget-warehouse.myshopify.com/admin/api//2020-10/customers.json?key=a47fbb47c703349509c9ab877373b456&access_token=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';
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
                <th scope="col">Customar ID</th>
                <th scope="col">Email</th>
                <th scope="col">First name</th>
                <th scope="col">Last name</th>
                <th scope="col">Orders count</th>
                <th scope="col">Total spent</th>
            </tr>
            <?php
            $today = date('Y-m-d h:i:s');
            $lastmonth = date('Y-m-d h:i:s', strtotime('-1 months', strtotime($today)));
            foreach ($resultArray['customers'] as $customers) {
                 {

            ?>
            <tr>
                <td scope="col"><?php echo $customers['id']; ?> </td>
                <td scope="col"><?php echo $customers['email']; ?></td>
                <td scope="col"><?php echo $customers['first_name']; ?></td>
                <td scope="col"><?php echo $customers['last_name']; ?></td>
                <td scope="col"><?php echo $customers['orders_count']; ?></td>
                <td scope="col"><?php echo $customers['total_spent']; ?></td>
            </tr>
            <?php }
            } ?>
        </thead>
    </table>


</body>

</html>
