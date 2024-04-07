<?php

namespace App\Routers;

use App\Models\MikrotikApi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Active
{
    public static function active()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $active = $API->comm('/ppp/active/print');
            $data = [
                'active' => $active,
            ];
        } else {
            $data = 'koneksi gagal';
        }
        $API->disconnect();
        return $data;
    }
    public static function dellactive($id)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $API->comm('/ppp/active/remove', [
                '.id' => $id,
            ]);
            $API->disconnect();
            Alert::success('Sucsess!', 'Delete User Active Sucsess')->persistent(true);
            return true;
        } else {
            return false;
        }
    }

}

error_reporting(0);