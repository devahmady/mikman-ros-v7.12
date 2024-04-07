<?php

namespace App\Http\Controllers\Mikrotik;

use App\Models\MikrotikApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Routers\Dashboard;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function dashboard()
    {

        $ip = session()->get('ip');
        $user = session()->get('user');
        $pass = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $pass)) {
            $secret = $API->comm('/ppp/secret/print');
            $profile = $API->comm('/ppp/profile/print');
            $isolirSecrets = array_filter($secret, function ($s) {
                return $s['profile'] === 'isolir';
            });
            $jumisolir = count($isolirSecrets);
            $users = $API->comm('/user/print');
            $clock = $API->comm('/system/clock/print');
            $sys = $API->comm('/system/resource/print');
            $model = $API->comm('/system/routerboard/print');
            $ether1 = $API->comm("/interface/print");
            $ppp_active = $API->comm("/ppp/active/print");
            $ppp_user = $API->comm("/ppp/secret/print");
            $userpppp = [];
            $logsppp = $API->comm("/log/print", array(
                "?topics" => "pppoe,ppp,info"
            ));
            foreach ($logsppp as &$ppp) {
                // Memisahkan pesan ppp menjadi IP Address dan pesan
                $messageParts = explode(':', $ppp['message'], 2);
                if (count($messageParts) === 2) {
                    $ppp['userpppp'] = trim($messageParts[0]);
                    $ppp['message'] = trim($messageParts[1]);
                } else {
                    $ppp['userpppp'] = '';
                    $ppp['message'] = $ppp['message'];
                }
            }

            // Membalikkan urutan log
            $logsppp = array_reverse($logsppp);
            $monitoring = $API->comm('/interface/monitor-traffic', array(
                'interface' => 'ether1',
                'once' => '',
            ));
            $data = [
                // clock
                'date' => $clock[0]['date'],
                'time' => $clock[0]['time'],
                'zone' => $clock[0]['time-zone-name'],
                // resource
                'cpu_load' => $sys[0]['cpu-load'],
                'uptime' => $sys[0]['uptime'],
                'platform' => $sys[0]['platform'],
                'version' => $sys[0]['version'],
                'frequency' => $sys[0]['cpu-frequency'],
                // routerboard
                'model' => $model[0]['model'],
                // interface
                'ether1' => $ether1,
                'rx' => $monitoring[0]['rx-bits-per-second'],
                'tx' => $monitoring[0]['tx-bits-per-second'],
                // log pppoe
                'logppp' => $logsppp,
                // pppoe 
                "ppp_active" => count($ppp_active),
                "ppp_user" => count($ppp_user),
                // users
                'name' => $users[0]['name'],
                'when' => $users[0]['last-logged-in'],
                // client isolir
                'secret' => $isolirSecrets,
                'profile' => $profile,
                'isolir' => $jumisolir

            ];
            return view('home', $data);
        }
    }
}
error_reporting(0);
