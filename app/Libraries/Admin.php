<?php

namespace App\Libraries;

class Admin
{

    public function title($params)
    {
        if ($params['title'])
            return view('admin_lte/cmps/title', $params);
    }
    public function breadcrumb()
    {

        return view('admin_lte/cmps/breadcrumb');
    }
}
