<?php
// function που ειδοποιεί τον χρήστη με alert box
$msg = filter_var($_GET['msg'], FILTER_SANITIZE_STRING);
function function_alert($msg)
{
    echo "<script type='text/javascript'>
        alert('$msg');
        </script>";
}
