<?php

namespace App\Http\Controllers\Mikrotik;

use App\Models\MikrotikApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RealtimeController extends Controller
{
    public function getData()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $pass = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        
        if ($API->connect($ip, $user, $pass)) {
            $sys = $API->comm('/system/resource/print');
            $clock = $API->comm('/system/clock/print');
            $data = [
                'free_memory' => $sys[0]['free-memory'],
                'free_hdd' => $sys[0]['free-hdd-space'],
                'total_hdd' => $sys[0]['total-hdd-space'],
                'cpu_load' => $sys[0]['cpu-load'],
                'uptime' => $sys[0]['uptime'],
                'time' => $clock[0]['time'],
                
            ];
            
            return response()->json($data);
        }
    }
}
