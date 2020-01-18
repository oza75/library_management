<?php
if (!function_exists('view')) {
    function view($view, $data = [])
    {
        extract($data);
        require "../views/" . $view . "-view.php";
    }
}
if (!function_exists('admin_view')) {
    function admin_view($view, $data = [], $sub = '')
    {
        extract($data);
        require "../..$sub/views/admin/" . $view . "-view.php";
    }
}
if (!function_exists('admin_component')) {
    function admin_component($view, $data = [], $sub = '')
    {
        extract($data);
        require "../..$sub/views/components/" . $view . ".php";
    }
}
if (!function_exists('component')) {
    function component($component, $data = [])
    {
        extract($data);
        require "../views/components/" . $component . ".php";
    }
}

if (!function_exists('bookImage')) {
    function bookImage()
    {
        $urls = [
            "https://images.unsplash.com/photo-1578241561880-0a1d5db3cb8a?ixlib=rb-1.2.1&auto=format&fit=crop&w=365&h=523",
            "https://images.unsplash.com/photo-1576685541369-9eefd8208d5f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=365&h=523",
            "https://images.unsplash.com/photo-1574913682995-8237c20b0edd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=365&h=523",
            "https://images.unsplash.com/photo-1574970600484-2df50a2e9169?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=365&h=523&",
            "https://images.unsplash.com/photo-1575487426366-079595af2247?ixlib=rb-1.2.1&auto=format&fit=crop&w=365&h=523",
            "https://images.unsplash.com/photo-1574296000164-ebf9009c35d6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=365&h=523",
            "https://images.unsplash.com/photo-1572627614330-fb84a9d40556?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=365&h=523",
            "https://images.unsplash.com/photo-1569289522127-c0452f372d46?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=365&h=523",
            "https://images.unsplash.com/photo-1569305818376-9fbd2cc1234c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=365&h=523"
        ];

        return $urls[rand(0, count($urls) - 1)];
    }
}

if (!function_exists('slugify')) {
    function slugify($string, $delimiter = '-')
    {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', $delimiter, $string), '-'));
//        // replace non letter or digits by -
//        $text = preg_replace('~[^\pL\d]+~u', '-', $string);
//
//        // transliterate
//        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
//
//        // remove unwanted characters
//        $text = preg_replace('~[^-\w]+~', '', $text);
//
//        // trim
//        $text = trim($text, '-');
//
//        // remove duplicate -
//        $text = preg_replace('~-+~', '-', $text);
//
//        // lowercase
//        $text = strtolower($text);
//
//        if (empty($text)) {
//            return null;
//        }
//
//        return $text;
    }
}
if (!function_exists('str_replace_first')) {
    function str_replace_first($search, $replaceValue, $subject)
    {
        $pos = strpos($subject, $search);
        $newstring = $subject;
        if ($pos !== false) {
            $newstring = substr_replace($subject, $replaceValue, $pos, strlen($search));
        }
        return $newstring;
    }
}
if (!function_exists('imageUrl')) {
    function imageUrl($url)
    {
        return "/assets/images/$url";
    }
}

if (!function_exists('paginationPage')) {
    function paginationPage($p, $page)
    {
        $pieces = array_merge($_GET, ['page' => $page]);
        $s = [];
        foreach ($pieces as $k => $g) {
            $s[] = "$k=$g";
        }
        $q = implode("&", $s);
        return $p . '?' . $q;
    }
}

if (!function_exists('redirect')) {
    function redirect($url, $oldData = [])
    {
        session_set('_old', $oldData);
        header('Status: 301 Moved Permanently', false, 301);
        header('Location: ' . $url);
        exit();
    }
}

if (!function_exists('session_old_value')) {
    function session_old_value($key, $default = null)
    {
        $old = session_get('_old', []);
        return $old[$key] ?? $default;
    }
}
if (!function_exists('clear_session')) {
    function clear_session()
    {
        session_set('flash', []);
        session_set('_old', []);
    }
}

if (!function_exists('redirect_to_previous_page')) {
    function redirect_to_previous_page($oldData = [])
    {
        $referer = $_SERVER['HTTP_REFERER'] ?? '/';
        redirect($referer, $oldData);
    }
}