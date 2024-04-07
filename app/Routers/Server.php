<?php

namespace App\Routers;

use App\Models\MikrotikApi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Server
{

    /*********************************/
    /*          Pppoe  SERVER        */
    public static function server()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $interface = $API->comm('/interface/print');
            $pprofile = $API->comm('/ppp/profile/print');
            $server = $API->comm('/interface/pppoe-server/server/print');
            $data = [
                'interface' => $interface,
                'server' => $server,
                'pprofile' => $pprofile,
            ];
        } else {
            return 'koneksi gagal';
        }

        return $data;
    }

    public static function showServer()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $interface = $API->comm('/interface/print');
            $pprofile = $API->comm('/ppp/profile/print');
            $server = $API->comm('/interface/pppoe-server/server/print');
            $data = [
                'interface' => $interface,
                'server' => $server,
                'pprofile' => $pprofile,
            ];
        } else {
            return 'koneksi gagal';
        }

        return $data;
    }

    public static function dellServer($id)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $API->comm('/interface/pppoe-server/server/remove', [
                '.id' => $id, 
            ]);
        }
        Alert::success('Yes!', 'delete sever sucsess')->persistent(true);

        $API->disconnect();
    }

    public static function addServer(Request $request)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $service = $request->input('service');
            $name = $request->input('name');
            $monid = $request->input('monid');
            if (empty($monid)) {
                $API->comm('/interface/pppoe-server/server/add', [
                    'service-name' =>  $service,
                    'interface' =>  $name,
                    "disabled" => "no",
                    "keepalive-timeout" => 10,
                    "default-profile" => "default",
                ]);
            } else {
                $API->comm('/interface/pppoe-server/server/set', [
                    '.id' => $monid,
                    'service-name' =>  $service,
                    'interface' =>  $name,
                    "disabled" => "no",
                    "keepalive-timeout" => 10,
                    "default-profile" => "default",
                ]);
            }
            Alert::success('Hore!', 'Add Server Pppoe Sucsess')->persistent(true);
        } else {
            Alert::error('Oops!', 'Error.')->persistent(true);
            return 'koneksi gagal';
        }
        return redirect()->route('pppoe.server');
    }

    public static function ServerUpdate($id)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $getinterface = $API->comm('/interface/pppoe-server/server/print', [
                "?.id" => '*' . $id,
            ]);
            $pprofile = $API->comm('/ppp/profile/print');
            $server = $API->comm('/interface/print');
            $data = [
                'interface' => $getinterface[0],
                'server' => $server,
                'pprofile' => $pprofile,
            ];
        } else {
            $data = 'Koneksi gagal';
        }
        $API->disconnect();
        return $data;
    }

    public static function updateServer(Request $request)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $id = $request->input('id');
            $service = $request->input('servicee');
            $interface = $request->input('name');
            $data = [];
            $API->comm("/interface/pppoe-server/server/set", [
                ".id" => $id,
                'service-name' =>  $service,
                'interface' =>  $interface,
            ] + $data);
            Alert::success('Hore!', 'Add Server Pppoe Sucsess')->persistent(true);
        } else {
            Alert::error('Oops!', 'Error.')->persistent(true);
            return 'koneksi gagal';
        }
        return redirect()->route('pppoe.server');
    }

    /*          END  SERVER        */
    /*********************************/
}
error_reporting(0);
