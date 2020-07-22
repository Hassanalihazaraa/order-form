<?php
declare(strict_types=1);

function delivery()
{
    $time = new DateTime();
    if (isset($_POST['express_delivery'])) {
        try {
            $time->add(new DateInterval('PT' . 45 . 'M'));
            $stamp = $time->format('d-m-y H:i');
        } catch (Exception $e) {
            echo 'Error : ', $e->getMessage(), "\n";
        }
    } else {
        try {
            $time->add(new DateInterval('PT' . 120 . 'M'));
            $stamp = $time->format('d-m-y H:i');
        } catch (Exception $e) {
            echo 'Error : ', $e->getMessage(), "\n";
        }
    }
    echo $stamp;
}

delivery();