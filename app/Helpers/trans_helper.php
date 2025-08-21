<?php

if (!function_exists('trans_title')) {
    function trans_title($view)
    {
        if (is_null($view) || empty($view))
            return '';
        return  trans_view_sub($view, 'title', $view);
    }
}
if (!function_exists('trans_role_title')) {
    function trans_role_title($role)
    {
        try {
            if (is_null($role) || empty($role))
                return '';
            $val = trans_view_sub($role, 'title', $role);
            if (is_array($val))
                return json_encode($val);
            return $val;
        } catch (\Throwable $th) {
            //throw $th;
        }
        return $role;
    }
}
if (!function_exists('trans_permission_title')) {
    function trans_permission_title($permission)
    {
        try {
            if (is_null($permission) || empty($permission))
                return '';
            $val =  trans_view_sub('permission', $permission, $permission);
            if (is_array($val))
                return json_encode($val);
            return $val;
        } catch (\Throwable $th) {
            //throw $th;
        }
        return $permission;
    }
}
if (!function_exists('trans_vname')) {
    function trans_vname($view)
    {
        if (is_null($view) || empty($view))
            return '';
        return  trans_view_sub($view, 'name', $view);
    }
}

if (!function_exists('trans_add')) {
     /**
     * Translate the given message.
     *
     * @param  string|null  $key
     * @return string|null
     */
    function trans_add($view)
    {
        if (is_null($view) || empty($view))
            return 'Add ' . $view;
        $msg = app('translator')->get('m.add_view');
        $s_name = trans_view_sub($view, 's_name', $view);
        $val = str_replace('view', $s_name, $msg);
        return $val;
    }
}
if (!function_exists('trans_edit')) {
    function trans_edit($view)
    {
        if (is_null($view) || empty($view))
            return 'Edit ' . $view;
        $msg = app('translator')->get('m.edit_view');
        $s_name = trans_view_sub($view, 'name', $view);
        $val = str_replace('view', $s_name, $msg);
        return $val;
    }
}
if (!function_exists('trans_choose')) {
    function trans_choose($view)
    {
        if (is_null($view) || empty($view))
            return 'Choose ' . $view;
        $msg = app('translator')->get('m.choose_view');
        $s_name = trans_view_sub($view, 'name', $view);
        $val = str_replace('view', $s_name, $msg);
        return $val;
    }
}
if (!function_exists('trans_show_details')) {
    function trans_show_details($view)
    {
        if (is_null($view) || empty($view))
            return   'Show ' . $view . ' data ';
        $msg = app('translator')->get('m.trans_show_details');
        $s_name = trans_view_sub($view, 'name', $view);
        $val = str_replace('view', $s_name, $msg);
        return $val;
    }
}
if (!function_exists('trans_view_sub')) {
    function trans_view_sub($view, $sub, $def = '')
    {
        if (is_null($view) || empty($view) || is_null($sub) || empty($sub))
            return $def;
        $key = 'm.' . $view . '.' . $sub;
        $val =  app('translator')->get($key);
        if ($key == $val)
            $val = $def;
        return $val;
    }
}
if (!function_exists('trans_details')) {
    function trans_details($view)
    {
        if (is_null($view) || empty($view))
            return   $view . ' details ';
        $msg = app('translator')->get('m.view_details');
        $s_name = trans_view_sub($view, 'name', $view);
        $val = str_replace('view', $s_name, $msg);
        return $val;
    }
}
if (!function_exists('view_add_succ')) {
    function view_add_succ($view)
    {
        if (is_null($view) || empty($view))
            return  'تم إضافة ' . $view . '  بنجاح';
        $msg = app('translator')->get('m.view_add_succ');
        $s_name = trans_view_sub($view, 'name', $view);
        $val = str_replace('view', $s_name, $msg);
        return $val;
    }
}
if (!function_exists('view_edit_succ')) {
    function view_edit_succ($view)
    {
        if (is_null($view) || empty($view))
            return  'تم تعديل  ' . $view . '  بنجاح';
        $msg = app('translator')->get('m.view_edit_succ');
        $s_name = trans_view_sub($view, 'name', $view);
        $val = str_replace('view', $s_name, $msg);
        return $val;
    }
}
if (!function_exists('view_delete_succ')) {
    function view_delete_succ($view)
    {
        if (is_null($view) || empty($view))
            return  'تم حذف  ' . $view . '  بنجاح';
        $msg = app('translator')->get('m.view_delete_succ');
        $s_name = trans_view_sub($view, 'name', $view);
        $val = str_replace('view', $s_name, $msg);
        return $val;
    }
}
