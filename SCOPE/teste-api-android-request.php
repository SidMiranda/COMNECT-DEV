<?php
require('HttpRequest.php');

$request = new HttpRequest();
$request->setUrl('http://update2.comnect.com.br:5022/');
$request->setMethod(HTTP_METH_POST);

$request->setHeaders(array(
  'postman-token' => 'd75bb19c-d3ad-ed4e-49b3-c4fcf36eaf81',
  'cache-control' => 'no-cache',
  'content-type' => 'application/x-www-form-urlencoded'
));

$request->setContentType('application/x-www-form-urlencoded');
$request->setPostFields(array(
  'data' => '{"m":"get_settings","u":"14013"}'
));

try {
  $response = $request->send();

  echo $response->getBody();
} catch (HttpException $ex) {
  echo $ex;
}