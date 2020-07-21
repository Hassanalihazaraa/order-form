<?php
declare(strict_types=1);

function delivery()
{
    $time = new DateTime();
    if (isset($_POST['express_delivery'])) {
        $time->add(new DateInterval('PT' . 45 . 'M'));
        $stamp = $time->format('d-m-y H:i');
        echo $stamp;
    } else {
        $time->add(new DateInterval('PT' . 120 . 'M'));
        $stamp = $time->format('d-m-y H:i');
        echo $stamp;
    }
}
delivery();