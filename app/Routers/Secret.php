<?php

namespace App\Routers;

use App\Models\MikrotikApi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Secret
{

    public static function secret()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            // Ambil informasi secret PPP
            $secret = $API->comm('/ppp/secret/print');
            // Filter secret PPPoE untuk pengguna yang bukan menggunakan profil "ISOLIR"
            $filteredSecrets = array_filter($secret, function ($s) {
                return $s['profile'] !== 'isolir' && $s['profile'] !== 'PAKET DOWNGRADE';
            });
            $pprofile = $API->comm('/ppp/profile/print');
            // $filteredProfiles = array_filter($pprofile, function ($profile) {
            //     return $profile['name'] !== 'default' && $profile['name'] !== 'default-encryption';
            // });

            // Data yang diperoleh
            $data = [
                'secret' => $filteredSecrets,
                'profile' => $pprofile,
            ];
        } else {
            $data = 'Koneksi gagal';
        }

        $API->disconnect();
        return $data;
    }
    public static function showsecret()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            // Ambil informasi secret PPP
            $secret = $API->comm('/ppp/secret/print');
            // Filter secret PPPoE untuk pengguna yang bukan menggunakan profil "ISOLIR"
            $filteredSecrets = array_filter($secret, function ($s) {
                return $s['profile'] !== 'isolir' && $s['profile'] !== 'PAKET DOWNGRADE';
            });
            $pprofile = $API->comm('/ppp/profile/print');
            // $filteredProfiles = array_filter($pprofile, function ($profile) {
            //     return $profile['name'] !== 'default' && $profile['name'] !== 'default-encryption';
            // });

            // Data yang diperoleh
            $data = [
                'secret' => $filteredSecrets,
                'profile' => $pprofile,
            ];
        } else {
            $data = 'Koneksi gagal';
        }

        $API->disconnect();
        return $data;
    }
    public static function addsecret($request)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $comment = $request->input('comment');
            $name = $request->input('name');
            $pass = $request->input('pass');
            $profile = $request->input('profilee');
            $service = $request->input('servicee');
            $data = [];
            if ($request->filled('local')) {
                $data["local-address"] = $request->input('local');
            }
            if ($request->filled('remote')) {
                $data["remote-address"] = $request->input('remote');
            }
            $API->comm('/ppp/secret/add', [
                'name' =>  $name,
                'password' =>  $pass,
                'profile' => $profile,
                'service' => $service,
                'comment' => $comment,
            ] + $data);
            $API->disconnect();
            Alert::success('Hore!', 'add Secret Pppoe Sucsess')->persistent(true);
            return true;
        } else {
            return false;
        }
    }

    public static function updateSecret($id)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $getuser = $API->comm('/ppp/secret/print', [
				"?.id" => '*' . $id,
			]);
            $secret = $API->comm('/ppp/secret/print');
			$profile = $API->comm('/ppp/profile/print');
            $data = [
				'user' => $getuser[0],
				'secret' => $secret,
				'profile' => $profile,
			];
        } else {
            $data = 'Koneksi gagal';
        }
        $API->disconnect();
        return $data;
    }

    public static function secretUpdate(Request $request)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $id = $request->input('id');
            $comment = $request->input('comment');
            $name = $request->input('name');
            $pass = $request->input('pass');
            $profile = $request->input('profilee');
            $service = $request->input('servicee');
            $data = [];
            if ($request->filled('local')) {
                $data["local-address"] = $request->input('local');
            }
            if ($request->filled('remote')) {
                $data["remote-address"] = $request->input('remote');
            }
            $API->comm("/ppp/secret/set", [
                ".id" => $id,
                'name' =>  $name,
                'password' =>  $pass,
                'profile' => $profile,
                'service' => $service,
                'comment' => $comment,
            ] +$data);
            $API->disconnect();
            Alert::success('Hore!', 'Update Secret Pppoe Success')->persistent(true);
            return true;
        } else {
            return false;
        }
    }
    public static function dellsecret($id)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $API->comm('/ppp/secret/remove', [
                '.id' => $id,
            ]);
            $API->disconnect();
            Alert::success('Hore!', 'Delete Secret Pppoe Sucsess')->persistent(true);
            return true;
        } else {
            return false;
        }
    }
}