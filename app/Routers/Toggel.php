<?php

namespace App\Routers;

use App\Models\MikrotikApi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Toggel
{
    /*********************************/
    /*          Toggel  SERVER        */
    public static function toggleServer($request)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            foreach ($request->input('secret_ids', []) as $id) {
                $action = $request->input('action');
                if ($action === 'enable') {
                    $API->comm("/interface/pppoe-server/server/enable", [
                        ".id" => $id,
                    ]);
                    $status = $API->comm("/interface/pppoe-server/server/print", ["?id" => $id])[0]['disabled'] == 'false' ? 'active' : 'inactive';
                    Alert::success('Success', 'PPPoE Server has been enabled successfully. Status: ' . $status);
                } elseif ($action === 'disable') {
                    $API->comm("/interface/pppoe-server/server/disable", [
                        ".id" => $id,
                    ]);
                    $status = $API->comm("/interface/pppoe-server/server/print", ["?id" => $id])[0]['disabled'] == 'false' ? 'active' : 'inactive';
                    Alert::success('Success', 'PPPoE Server has been disabled successfully. Status: ' . $status);
                }
            }
            return true;
        } else {
            Alert::error('Error', 'Failed to connect to the Mikrotik API. Please check your connection settings.');
            return false;
        }
    }
    /*          END  Toggel        */
    /*********************************/

    /*********************************/
    /*          Toggel  Profile        */
   
    /*          END  Toggel        */
    /*********************************/
}
error_reporting(0);
