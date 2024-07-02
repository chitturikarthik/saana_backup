<?php

$itemNumber = "DP12345";
$itemName = "Demo Product";
$itemPrice = 0.02;
$currency = "USD";

define('PAYPAL_SANDBOX', TRUE); //TRUE=Sandbox | FALSE=Production 
define('PAYPAL_SANDBOX_CLIENT_ID', 'AXGcVzYWHnDUC3HJxpgLJ8dsNqemTo4oMPjKx1_ql0CcVeYwXjNucsNVNR0V4tBXw-ETvp9g2KWZ-OA8');
define('PAYPAL_SANDBOX_CLIENT_SECRET', 'EKyBmMkbzelBm5Hm6Ngm1dHvJDAgr4Vt1UDjAWqqcmAhFWcV_FdoDTmVe9u69XjsoQYcWdOacyxlEz-1');
define('PAYPAL_PROD_CLIENT_ID', 'ARi0-1PnYYfdqU-uEibLgzNQ6wygBcvb9DVotmHNhcA4sQbHPpEFCuX_RLbBpSlHBhNYWNB8S_HdYV2u');
define('PAYPAL_PROD_CLIENT_SECRET', 'EOYjn-sgfC9C9kJl2vfs5CKJhVwgkmHgI2f-zpbbm0K7_NE_NAjn7ZfvVXuUXA1Ydm0xbx5n-h8XK22O');

//Localhost Database configuration  
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'saana_test');

//Infinity free database configuration
// define('DB_HOST', 'sql303.infinityfree.com');
// define('DB_USERNAME', 'if0_35878763');
// define('DB_PASSWORD', 'RXrUcwbMGYaQzP');
// define('DB_NAME', 'if0_35878763_saana');
