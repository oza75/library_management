<?php
session_start();
require_once 'database.php';
if (!function_exists('auth_user')) {
    function auth_user()
    {
        $user = session_get('user');
        $db_user = selectWithSql('select * from users where id=?', [(int)$user['id']]);
        session_set('user', $db_user);
        return $db_user;
    }
}
if (!function_exists('admin_user')) {
    function admin_user()
    {
        $user = session_get('admin_user');
        $db_user = selectWithSql('select * from users where id=?', [(int)$user['id']]);
        session_set('admin_user', $db_user);
        return $db_user;
    }
}

if (!function_exists('session_has')) {
    function session_has($key)
    {
        return session_get($key, false) ? true : false;
    }
}
if (!function_exists('user_is_logged')) {
    function user_is_logged()
    {
        return session_has('user');
    }
}
if (!function_exists('admin_is_logged')) {
    function admin_is_logged()
    {
        return session_has('admin_user');
    }
}
if (!function_exists('session_get')) {
    function session_get($key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }
}
if (!function_exists('session_set')) {
    function session_set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}

if (!function_exists('session_flash')) {
    function session_flash($type, $value)
    {
        $flashs = session_get('flash', []);
        $flashs[] = ['type' => $type, 'value' => $value];
        session_set('flash', $flashs);
    }
}

if (!function_exists('session_forget')) {
    function session_forget($key)
    {
        $data = session_get($key);
        $_SESSION = array_filter($_SESSION, function ($k) use ($key) {
            return $k !== $key;
        }, ARRAY_FILTER_USE_KEY);
        return $data;
    }
}


