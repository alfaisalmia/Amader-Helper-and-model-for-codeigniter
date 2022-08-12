<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'syeed';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'syeed/login';
$route['login/check'] = 'syeed/check';
$route['register'] = 'syeed/register';
$route['logout'] = 'syeed/logout';
$route['add-to-cart'] = 'cart/add';
$route['checkout'] = 'cart/checkout';
$route['cart-update'] = 'cart/update';
$route['cart-remove/(:num)'] = 'cart/remove';
$route['place-orders'] = 'cart/place_orders';
$route['order-details/(:num)'] = 'cart/order_details';
$route['your-order'] = 'cart/orders';
$route['change-password'] = 'cart/change_password';



//Admin Panel
$controller = array(
    "adm_category_management" => "category-management",
    "adm_subcategory_management" => "subcategory-management",
    "adm_product_management" => "product-management",
    "adm_slider_management" => "slider-management"
);

foreach ($controller as $key => $value) {
   $route[$value] = $key;
   $route[$value . '/insert'] = $key . '/insert';
   $route[$value . '/view'] = $key . '/view';
   $route[$value . '/view/(:num)'] = $key . '/view/$1';
   $route[$value . '/edit/(:num)'] = $key . '/edit/$1';
   $route[$value . '/update'] = $key . '/update';
   $route[$value . '/delete/(:num)'] = $key . '/delete/$1';
}
//Author Routes
define('EXT', '.php');
require_once( BASEPATH . 'database/DB' . EXT );
$db = & DB();

$db->select("c.name as cname, sc.name scname");
$db->from("category as c");
$db->join("subcategory as sc", "sc.categoryid = c.id");

$result = $db->get()->result();
foreach ($result as $value) {
   $route[RouteReplace($value->cname) . "/" . RouteReplace($value->scname) . "/(:num)/(:any)"] = "syeed/details/$1/$1";
   $route[RouteReplace($value->cname) . "/" . RouteReplace($value->scname) . "/(:num)"] = "syeed/subcategory/$1";
   $route[RouteReplace($value->cname) . "/(:num)"] = "syeed/category/$1";
}

function RouteReplace($data) {
   $data = trim($data);
   $data = str_replace("'", "", $data);
   $data = str_replace("!", "", $data);
   $data = str_replace("@", "", $data);
   $data = str_replace("#", "", $data);
   $data = str_replace("$", "", $data);
   $data = str_replace("%", "", $data);
   $data = str_replace("^", "", $data);
   $data = str_replace("&", "", $data);
   $data = str_replace("*", "", $data);
   $data = str_replace("(", "", $data);
   $data = str_replace(")", "", $data);
   $data = str_replace("+", "", $data);
   $data = str_replace("=", "", $data);
   $data = str_replace(",", "", $data);
   $data = str_replace(":", "", $data);
   $data = str_replace(";", "", $data);
   $data = str_replace("|", "", $data);
   $data = str_replace("'", "", $data);
   $data = str_replace('"', "", $data);
   $data = str_replace("?", "", $data);
   $data = str_replace("'", "", $data);
   $data = str_replace(".", "-", $data);
   $data = str_replace("অ", "�", $data); //Only Onubad
   $data = strtolower(str_replace("  ", "-", $data));
   $data = strtolower(str_replace(" ", "-", $data));
   $data = strtolower(str_replace("__", "-", $data));
   $data = strtolower(str_replace("_", "-", $data));
   $data = strtolower(str_replace("--", "-", $data));

   return $data;
}