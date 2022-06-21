<?php
    require(getenv('tilevu'));

    $_SESSION['userId'] = '';
    $_SESSION['clientId'] = '';
    $_SESSION['appId'] = '';
    $_SESSION['acToken'] = '';
    $_session['acLevel'] = '';
    
    setcookie('acToken', '', '', '/');

    header("Location: ".$url_auth);
    exit;

?>