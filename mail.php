<?php
declare(strict_types=1);

function sendMail()
{
    $to = "hassanalihazaraa@gmail.com";
    $subject = "Thank you for your order";
    $message = "
<html>
<head>
    <title>Orders</title>
</head>
<body>
<p style='font-size: 1rem;
font-family: sans-serif;
font-weight: bold'>THANK YOU FOR YOUR ORDER. YOUR ORDER IS UNDER WAY</p>
<table>
<tr>
<th>Products</th>
<th>Price</th>
</tr>
<tr>
<td></td>
<td>Drinks</td>
</tr>
</table>
</body>
</html>
";
// Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    mail($to, $subject, $message, $headers);
}


