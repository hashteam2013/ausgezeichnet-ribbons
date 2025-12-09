<?php

header('Access-Control-Allow-Origin: *');

$conf_rewrite_url = array(
    '404' => '404',
    'home' => '',
        /*
          'account' => 'account',
          'product' => 'product',
          'shop' => 'shop',
          'logout' => 'logout',
          'login' => 'login',
          //'blog'=>'blog',
          'brand' => 'brand',
          'forgot_password' => 'forgot_password',
          'category' => 'category',
          'order' => 'order',
          'register' => 'register',
          'verify_account' => 'verify_account',
          'checkout' => 'checkout',
          'cart' => 'cart',
          'sitemap' => 'sitemap',
          'wishlist' => 'wishlist',
          'thank_you' => 'thank-you',
          'contact' => (URL_SLUG_CONTACT_US_PAGE != '') ? urlencode(URL_SLUG_CONTACT_US_PAGE) : "contact",
          'content' => (URL_SLUG_CONTENT_PAGE != '') ? urlencode(URL_SLUG_CONTENT_PAGE) : "page",
          'new_products' => (URL_SLUG_NEW_PRODUCTS_PAGE != '') ? urlencode(URL_SLUG_NEW_PRODUCTS_PAGE) : 'new_products',
          'top_products' => (URL_SLUG_TOP_PRODUCTS_PAGE != '') ? urlencode(URL_SLUG_TOP_PRODUCTS_PAGE) : 'top_products',
          'on_sale' => (URL_SLUG_ON_SALE_PAGE != '') ? urlencode(URL_SLUG_ON_SALE_PAGE) : 'on_sale'
         */
);

function make_url($page="", $query = array(),$cartrec = false) {
    global $conf_rewrite_url;
    if ($page!="" && isset($conf_rewrite_url[strtolower($page)]) && URL_REWRITE):
        return _makeurl($page, $query);
    else:
        $url = WS_PATH;
        $url .= ($page!='') ? '?page=' . $page : "";
        if(!empty($query)){
            foreach($query as $key => $value){
                $url .= "&".$key.'='.urldecode($value);
            }
        }if($cartrec){
             $url .= urldecode($cartrec);            
        }
        return $url;
    endif;
}

function verify_string($string) {
    if ($string != '')
        if (substr($string, -1) == '/')
            return substr($string, 0, strlen($string) - 1);
    return $string;
}

function load_url() {
    global $conf_rewrite_url;
    $prefix = str_replace(HTTP_SERVER, '', WS_PATH);
    $URL = $_SERVER['REQUEST_URI'];
    if (strpos($URL, '?') === false):
        $string = substr($URL, -(strlen($URL) - strlen($prefix)));
        $string = verify_string($string);
        $string_parts = explode('/', $string);

        $url_array = array_flip($conf_rewrite_url);

        if (isset($url_array[$string_parts['0']])):
            _load($url_array[$string_parts['0']], $string_parts);
        else:
            if (count($string_parts) > 0) {
                $URLREWRITE = url_rewrite::getUrlByUrlName($string_parts['0']);
                if (is_object($URLREWRITE)) {
                    $string_parts['0'] = $URLREWRITE->module_id;
                    _load($URLREWRITE->page, $string_parts);
                } elseif (substr($string_parts[0], 0, 1) != '?' AND substr($string_parts[0], 0, 5) != 'index') {
                    $_REQUEST['page'] = $string_parts['0'];
                } else {
                    $_REQUEST['page'] = '404';
                }
            } elseif (count($string_parts) == 1) {
                if (substr($string_parts[0], 0, 1) != '?' AND substr($string_parts[0], 0, 5) != 'index') {
                    $_REQUEST['page'] = $string_parts['0'];
                } else {
                    $_REQUEST['page'] = '404';
                }
            } else {
                $_REQUEST['page'] = '404';
            }
        endif;
    endif;
}

function _makeurl($page, $string) {
    switch ($page) {
        case 'home':
            return WS_PATH;
            break;

        case 'thank_you':
            return WS_PATH . 'thank-you';
            break;

        case '404':
            return WS_PATH . '404/';
            break;

        case 'wishlist':
            if (isset($string['remove'])):
                return WS_PATH . 'wishlist/' . $string['remove'];
            else:
                return WS_PATH . 'wishlist/';
            endif;
            break;

        case 'sitemap':
            return WS_PATH . 'sitemap/';
            break;

        case 'category':
            return WS_PATH . 'category/';
            break;

        case 'product':
            if (isset($string['id'])):
                $object = url_rewrite::getUrlname('product', $string['id']);
                if ($object):
                    return WS_PATH . $object . '/';
                endif;
            endif;
            return WS_PATH . '404/';
            break;

        case 'shop':
            /*
              $shop_defailt_id = (isset($string['id']))?$string['id']:"0";
              $shop_defailt_p = (isset($string['p']))?$string['p']:"1";
              if(isset($string['id'])):
              $object = cwebc::getUrlname('category', $string['id']);
              if($object):
              $shop_defailt_id = $object;
              else:
              $shop_defailt_id = '0';
              endif;
              endif;
              return WS_PATH.'shop/'.$shop_defailt_id."/".$shop_defailt_p."/";

              if(isset($string['id']) && $string['id']!='0'):
              $object=cwebc::getUrlname('category', $string['id']);
              $querry = '';
              if($object):
              unset($string['id']);
              if(!empty($string)):
              foreach($string as $kk=>$vv):
              $querry .= '&'.$kk.'='.$vv;
              endforeach;
              endif;
              return WS_PATH.'shop/'.$object.'/'.$querry;
              endif;
              else:
              $querry ='';
              foreach($string as $kk=>$vv):
              $querry .= '&'.$kk.'='.$vv;
              endforeach;
              return WS_PATH.'shop/'.$querry;
              endif;
             */
            if (isset($string['id'])):
                $object = url_rewrite::getUrlname('category', $string['id']);
                if ($object):
                    return WS_PATH . $object . '/';
                endif;
            endif;
            return WS_PATH . 'shop/';
            break;

        case 'login':

            if (isset($string['redirect'])):
                return WS_PATH . 'login/' . $string['redirect'] . '/';
            endif;

            return WS_PATH . 'login/';

            break;

        case 'logout':
            return WS_PATH . 'logout/';
            break;

        case 'content':
            if (isset($string['id'])):
                $object = url_rewrite::getUrlname('content', $string['id']);
                if ($object):
                    return WS_PATH . $object . '/';
                endif;
            endif;
            return WS_PATH . '404/';
            break;

        case 'blog':
            if (isset($string['id'])):
                $object = url_rewrite::getUrlname('blog', $string['id']);
                if ($object):
                    return WS_PATH . $object . '/';
                endif;
            elseif (isset($string['p'])):
                return WS_PATH . 'blog/page/' . $string['p'] . '/';
            else:
                return WS_PATH . 'blog/';
            endif;
            break;

        case 'brand':
            if (isset($string['id'])):
                $object = url_rewrite::getUrlname('brand', $string['id']);
                if ($object):
                    return WS_PATH . $object . '/';
                endif;
            endif;
            return WS_PATH . 'brand/';
            break;

        case 'contact':
            if (URL_SLUG_CONTACT_US_PAGE != ''):
                return WS_PATH . urlencode(URL_SLUG_CONTACT_US_PAGE) . '/';
            else:
                return WS_PATH . 'contact/';
            endif;
            break;

        case 'forgot_password':

            if (isset($string['req'])):
                return WS_PATH . 'forgot_password/' . $string['req'] . '/';
            endif;
            return WS_PATH . 'forgot_password/';
            break;

        case 'order':
            if (isset($string['success'])):
                return WS_PATH . 'order/account/id/' . $string['id'] . '/success/';
            elseif (isset($string['id'])):
                return WS_PATH . 'order/' . $string['id'] . '/';
            elseif (isset($string['order_id'])):
                return WS_PATH . 'order/order_id/' . $string['order_id'] . '/';
            elseif (isset($string['account'])):
                return WS_PATH . 'order/account/id/' . $string['account'] . '/';
            else:
                return WS_PATH . 'order/';
            endif;
            break;

        case 'register':
            return WS_PATH . 'register/';
            break;

        case 'verify_account':
            if (isset($string['key'])):
                return WS_PATH . 'verify_account/' . $string['key'] . '/';
            else:
                return WS_PATH . '404/';
            endif;
            break;

        case 'account':
            $default_id = (isset($string['id'])) ? $string['id'] : "0";
            $default_section = (isset($string['section'])) ? $string['section'] : "dashboard";
            $default_redirect = (isset($string['redirect'])) ? $string['redirect'] : "account";

            if (isset($string['resend'])):
                return WS_PATH . 'account/' . $default_section . '/' . $default_id . '/1/' . $default_redirect . '/' . $string['resend'] . '/';
            elseif (isset($string['redirect'])):
                return WS_PATH . 'account/' . $default_section . '/' . $default_id . '/1/' . $string['redirect'] . '/';
            elseif (isset($string['p'])):
                return WS_PATH . 'account/' . $default_section . '/' . $default_id . '/' . $string['p'] . '/';
            elseif (isset($string['id'])):
                return WS_PATH . 'account/' . $default_section . '/' . $string['id'] . '/';
            elseif (isset($string['section'])):
                return WS_PATH . 'account/' . $string['section'] . '/';
            endif;
            return WS_PATH . 'account/';
            break;

        case 'checkout':

            if (isset($string['view'])):
                return WS_PATH . 'checkout/' . $string['view'] . '/';
            elseif (isset($string['action'])):
                return WS_PATH . 'checkout/action/' . $string['action'] . '/';
            endif;

            return WS_PATH . 'checkout/';

            break;

        case 'new_products':
            $querry = '';
            foreach ($string as $kk => $vv):
                $querry .= '&' . $kk . '=' . $vv;
            endforeach;
            if (trim($querry) != ''):
                $querry = $querry . '/';
            endif;
            if (URL_SLUG_NEW_PRODUCTS_PAGE != ''):
                return WS_PATH . urlencode(URL_SLUG_NEW_PRODUCTS_PAGE) . '/' . $querry;
            else:
                return WS_PATH . 'new_products/' . $querry;
            endif;

            break;

        case 'top_products':
            $querry = '';
            foreach ($string as $kk => $vv):
                $querry .= '&' . $kk . '=' . $vv;
            endforeach;
            if (trim($querry) != ''):
                $querry = $querry . '/';
            endif;
            if (URL_SLUG_TOP_PRODUCTS_PAGE != ''):
                return WS_PATH . urlencode(URL_SLUG_TOP_PRODUCTS_PAGE) . '/' . $querry;
            else:
                return WS_PATH . 'top_products/' . $querry;
            endif;
            break;

        case 'on_sale':
            $querry = '';
            foreach ($string as $kk => $vv):
                $querry .= '&' . $kk . '=' . $vv;
            endforeach;
            if (trim($querry) != ''):
                $querry = $querry . '/';
            endif;
            if (URL_SLUG_ON_SALE_PAGE != ''):
                return WS_PATH . urlencode(URL_SLUG_ON_SALE_PAGE) . '/' . $querry;
            else:
                return WS_PATH . 'on_sale/' . $querry;
            endif;
            break;

        case 'cart':
            if (isset($string['update'])):

                return WS_PATH . 'cart/' . $string['update'] . "/" . $string['row'] . '/';

            elseif (isset($string['remove_coupon'])):

                return WS_PATH . 'cart/remove/';

            else:
                return WS_PATH . 'cart/';
            endif;
            break;
        default: break;
    }
}

function _load($page, $string_parts) {

    global $conf_rewrite_url;

    switch ($page) {
        case 'home':
            return WS_PATH;
            break;

        case 'thank_you':
            $_REQUEST['page'] = 'thank_you';
            break;

        case '404':
            $_REQUEST['page'] = '404';
            break;

        case 'wishlist':
            /* only product id is passed with the URL */
            if (count($string_parts) == 2):
                $_GET['remove'] = $string_parts['1'];
            endif;
            $_REQUEST['page'] = 'wishlist';
            break;

        case 'sitemap':
            $_REQUEST['page'] = 'sitemap';
            break;

        case 'category':
            $_REQUEST['page'] = 'category';
            break;

        case 'product':

            if (count($string_parts)) {
                foreach ($string_parts as $kk => $vv):
                    if ($kk == 0):
                        $_GET['id'] = $vv;
                    else:
                        $queries = explode('&', $vv);
                        foreach ($queries as $kkk => $vvv):
                            $query = explode('=', $vvv);
                            if (isset($query[0]) && $query[0] != ''):
                                $_GET[trim($query[0], '&')] = $query[1];
                            endif;
                        endforeach;
                    endif;
                endforeach;
                $_REQUEST['page'] = 'product';
            }
            else {
                $_REQUEST['page'] = '404';
            }
            break;

        case 'shop':
            if (count($string_parts)) {
                foreach ($string_parts as $kk => $vv):
                    if ($kk == 0 && $vv != 'shop'):
                        $_GET['id'] = $vv;
                    else:
                        $queries = explode('&', $vv);
                        foreach ($queries as $kkk => $vvv):
                            $query = explode('=', $vvv);
                            if (isset($query[0]) && $query[0] != '' && isset($query[1])):
                                $_GET[trim($query[0], '&')] = $query[1];
                            endif;
                        endforeach;
                    endif;
                endforeach;
            }
            $_REQUEST['page'] = 'shop';
            break;

        case 'login':
            if (count($string_parts) == 2):
                $_GET['redirect'] = $string_parts['1'];
            endif;
            $_REQUEST['page'] = 'login';
            break;

        case 'logout':
            $_REQUEST['page'] = 'logout';
            break;
        case 'content':
            if (count($string_parts)) {
                foreach ($string_parts as $kk => $vv):
                    if ($kk == 0):
                        $_GET['id'] = $vv;
                    else:
                        $queries = explode('&', $vv);
                        foreach ($queries as $kkk => $vvv):
                            $query = explode('=', $vvv);
                            if (isset($query[0]) && $query[0] != ''):
                                $_GET[trim($query[0], '&')] = $query[1];
                            endif;
                        endforeach;
                    endif;
                endforeach;
                $_REQUEST['page'] = 'content';
            }
            else {
                $_REQUEST['page'] = '404';
            }
            break;
        case 'blog':
            if (count($string_parts) == 3):
                $_GET['p'] = $string_parts['2'];
            endif;
            if (is_numeric($string_parts)) {
                $_GET['id'] = $string_parts;
            }
            $_REQUEST['page'] = 'blog';
            break;

        case 'brand':
            if (count($string_parts)) {
                foreach ($string_parts as $kk => $vv):
                    if ($kk == 0):
                        $_GET['id'] = $vv;
                    else:
                        $queries = explode('&', $vv);
                        foreach ($queries as $kkk => $vvv):
                            $query = explode('=', $vvv);
                            if (isset($query[0]) && $query[0] != ''):
                                $_GET[trim($query[0], '&')] = $query[1];
                            endif;
                        endforeach;
                    endif;
                endforeach;
            }
            $_REQUEST['page'] = 'brand';
            break;

        case 'contact':
            $_REQUEST['page'] = 'contact';
            break;

        case 'forgot_password':
            if (count($string_parts) == 2):
                $_GET['req'] = $string_parts['1'];
            endif;
            $_REQUEST['page'] = 'forgot_password';
            break;

        case 'order':
            if (count($string_parts) == 2):
                $_GET['id'] = $string_parts['1'];
            elseif (count($string_parts) == 3):
                $_GET['order_id'] = $string_parts['2'];
            elseif (count($string_parts) == 4):
                $_GET['account'] = $string_parts['3'];
            elseif (count($string_parts) == 5):
                $_GET['id'] = $string_parts['3'];
                $_GET['success'] = 1;
            endif;
            $_REQUEST['page'] = 'order';
            break;

        case 'register':
            $_REQUEST['page'] = 'register';
            break;

        case 'verify_account':
            if (count($string_parts) == 2):
                $_GET['key'] = $string_parts['1'];
                $_REQUEST['page'] = 'verify_account';
            else:
                $_REQUEST['page'] = '404';
            endif;
            break;

        case 'account':
            if (count($string_parts) == 6):
                $_GET['resend'] = $string_parts['5'];
                $_GET['redirect'] = $string_parts['4'];
                $_GET['p'] = $string_parts['3'];
                $_GET['id'] = $string_parts['2'];
                $_GET['section'] = $string_parts['1'];
            elseif (count($string_parts) == 5):
                $_GET['redirect'] = $string_parts['4'];
                $_GET['p'] = $string_parts['3'];
                $_GET['id'] = $string_parts['2'];
                $_GET['section'] = $string_parts['1'];
            elseif (count($string_parts) == 4):
                $_GET['p'] = $string_parts['3'];
                $_GET['id'] = $string_parts['2'];
                $_GET['section'] = $string_parts['1'];
            elseif (count($string_parts) == 3):
                $_GET['id'] = $string_parts['2'];
                $_GET['section'] = $string_parts['1'];
            elseif (count($string_parts) == 2):
                $_GET['section'] = $string_parts['1'];
            endif;
            $_REQUEST['page'] = 'account';
            break;

        case 'checkout':
            if (count($string_parts) == 3):
                $_GET['action'] = $string_parts['2'];
            elseif (count($string_parts) == 2):
                $_GET['view'] = $string_parts['1'];
            endif;
            $_REQUEST['page'] = 'checkout';
            break;

        case 'new_products':
            if (count($string_parts) > 1):
                $last_parts = explode('&', $string_parts['1']);
                foreach ($last_parts as $key => $part):
                    if ($part != ''):
                        $get_variables = explode('=', $part);
                        $_GET[$get_variables[0]] = $get_variables[1];
                    endif;
                endforeach;
            endif;
            $_REQUEST['page'] = 'new_products';
            break;

        case 'top_products':

            if (count($string_parts) > 1):
                $last_parts = explode('&', $string_parts['1']);
                foreach ($last_parts as $key => $part):
                    if ($part != ''):
                        $get_variables = explode('=', $part);
                        $_GET[$get_variables[0]] = $get_variables[1];
                    endif;
                endforeach;
            endif;
            $_REQUEST['page'] = 'top_products';

            break;

        case 'on_sale':

            if (count($string_parts) > 1):
                $last_parts = explode('&', $string_parts['1']);
                foreach ($last_parts as $key => $part):
                    if ($part != ''):
                        $get_variables = explode('=', $part);
                        $_GET[$get_variables[0]] = $get_variables[1];
                    endif;
                endforeach;
            endif;
            $_REQUEST['page'] = 'on_sale';

            break;

        case 'cart':
            if (count($string_parts) == 3):

                $_GET['update'] = $string_parts['1'];
                $_GET['row'] = $string_parts['2'];

            elseif (count($string_parts) == 2):

                $_GET['remove_coupon'] = '1';

            endif;

            $_REQUEST['page'] = 'cart';

            break;

        default:
    }
}

?>