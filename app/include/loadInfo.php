<?php 


$acDao = new Generic($pdo, 'access_control');

$ac = new AccessControlDataAccess($pdo);
$acInfo = $ac->checkToken();

if($acInfo == false){
    //não pode ter inserido nada na pagina antes
    header("Location: ".$url_auth."index.php");
    exit;
}else{
    $u = new UserDataAccess($pdo);
    $userInfo = $u->findUserById($acInfo->userId);
    
    $appDao = new Generic($pdo, 'apps');
    $appData = $appDao->findValue($acInfo->appId, 'app_id');
    
    $addrDao = new Generic($pdo, 'address');
    $addrData = $addrDao->findValue($acInfo->appId, 'app_id');

    $deliveryDao = new Generic($pdo, 'delivery_config');
    $deliveryData = $deliveryDao->findValue($appData['client_id'], 'client_id');
    
    $clientDao = new Generic($pdo, 'clients');
    $clientData = $clientDao->findValue($acInfo->userId, 'user_id');
}

$initial = '';

?>

<script> 
	var valFrete    = '<?= $deliveryData['delivery_fee_km'] ?? 0 ?>'
	var urlAdmin    = '<?= $url_admin ?>'
	var urlActions  = '<?= $url_admin.'actions/' ?>'
	var urlAuth     = '<?= $url_auth ?>'
	var _lojaOn     = '<?= $appData['status']?>'
</script>