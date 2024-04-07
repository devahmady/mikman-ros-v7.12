<?php

namespace App\Routers;

use App\Models\MikrotikApi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Isolir
{
    public static function isolir()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $secret = $API->comm('/ppp/secret/print');
            $profile = $API->comm('/ppp/profile/print');
            $isolirSecrets = array_filter($secret, function ($s) {
                return $s['profile'] === 'isolir';
            });

            // Data yang diperoleh
            $data = [
                'secret' => $isolirSecrets,
                'profile' => $profile,
            ];
        } else {
            $data = 'Koneksi gagal';
        }
        $API->disconnect();
        return $data;
    }

    
}