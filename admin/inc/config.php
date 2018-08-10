<?php
const SITE_URL = 'http://goshopping.com';
const ADMIN_URL = SITE_URL."/admin/";

define('INC_PATH', $_SERVER['DOCUMENT_ROOT']."/admin/");

const ASSETS_URL = ADMIN_URL."assets/";
const CSS_URL = ASSETS_URL."css/";
const JS_URL = ASSETS_URL."js/";
const PLUGINS_URL = ASSETS_URL."plugins/";
const FONTAWESOME_URL = ASSETS_URL."font-awesome/";

const SITE_NAME = "Go Shopping || Admin";

const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'goshopping';

const UPLOAD_URL = SITE_URL."/uploads/";
const PRODUCT_URL = SITE_URL."/upload/product/";
define('PRODUCT_DIR', $_SERVER['DOCUMENT_ROOT']."/upload/product/");

$allowed_exts = array('jpeg','jpg','png','gif','bmp');

