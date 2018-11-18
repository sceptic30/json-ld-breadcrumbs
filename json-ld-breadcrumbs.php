<?php
function jsonbreadcrumbs($home = 'Home') {
$itemNumber = 1;
$jsonbreadcrumb .= '<script type="application/ld+json">';
$jsonbreadcrumb .= '{';
$jsonbreadcrumb .= '"@context": "http://schema.org",';
$jsonbreadcrumb .= '"@type": "BreadcrumbList",';
$root_domain = ($_SERVER['HTTPS'] ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'].'/';
$jsonbreadcrumbs = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));
$jsonbreadcrumb .= '"itemListElement": [{';
$jsonbreadcrumb .= '"@type": "ListItem",';
$jsonbreadcrumb .= '"position":' .$itemNumber++.',';
$jsonbreadcrumb .= "\"name\": \"{$home}\",";
$jsonbreadcrumb .= "\"item\": \"{$root_domain}\"},";
foreach ($jsonbreadcrumbs as $crumb) {
  $link = ucwords(str_replace(array(".php","-","_"), array(""," "," "), $crumb));
  $root_domain .=  $crumb . '/';
  $jsonbreadcrumb .= '{"@type": "ListItem",';
  $jsonbreadcrumb .= '"position":' . $itemNumber++ . ',';
  $jsonbreadcrumb .= "\"name\": \"{$link}\",";
  $jsonbreadcrumb .= "\"item\": \"{$root_domain}\"},";
  }
$jsonbreadcrumb = trim($jsonbreadcrumb,",");
$jsonbreadcrumb .= ']}</script>';
return $jsonbreadcrumb;
}
echo jsonbreadcrumbs();
?>
