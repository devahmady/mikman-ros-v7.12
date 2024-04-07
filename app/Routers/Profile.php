<?php

namespace App\Routers;

use App\Models\MikrotikApi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Profile
{
    public static function profile()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $pprofile = $API->comm('/ppp/profile/print');
            $pool = $API->comm('/ip/pool/print');
            $parent = $API->comm('/queue/simple/print');
            // $filteredProfiles = array_filter($pprofile, function ($profile) {
            //     return $profile['name'] !== 'default' && $profile['name'] !== 'default-encryption';
            // });
            $profileDetails = [];
            foreach ($pprofile as $prof) {
                $uprofname = $prof['name'];
                $getprofile = $API->comm("/ppp/profile/print", array("?name" => "$uprofname"));
                if (!empty($getprofile)) {
                    $profiledetalis = $getprofile[0];
                    $profileDetails[] = [
                        'validity' => explode(",", $profiledetalis['on-up'])[2],
                        'isolirmode' => explode(",", $profiledetalis['on-up'])[1],
                    ];
                }
            }
            $data = [
                'pool' => $pool,
                'parent' => $parent,
                'profile' => $pprofile,
                'detail' => $profileDetails
            ];
        } else {
            $data = 'koneksi gagal';
        }
        $API->disconnect();
        return $data;
    }

    public static function showProfile()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $pprofile = $API->comm('/ppp/profile/print');
            $pool = $API->comm('/ip/pool/print');
            $parent = $API->comm('/queue/simple/print');
            // $filteredProfiles = array_filter($pprofile, function ($profile) {
            //     return $profile['name'] !== 'default' && $profile['name'] !== 'default-encryption';
            // });
            $profileDetails = [];
            foreach ($pprofile as $prof) {
                $uprofname = $prof['name'];
                $getprofile = $API->comm("/ppp/profile/print", array("?name" => "$uprofname"));
                if (!empty($getprofile)) {
                    $profiledetalis = $getprofile[0];
                    $profileDetails[] = [
                        'validity' => explode(",", $profiledetalis['on-up'])[2],
                        'isolirmode' => explode(",", $profiledetalis['on-up'])[1],
                    ];
                }
            }
            $data = [
                'pool' => $pool,
                'parent' => $parent,
                'profile' => $pprofile,
                'detail' => $profileDetails
            ];
        } else {
            $data = 'koneksi gagal';
        }
        $API->disconnect();
        return $data;
    }

    public static function addProfile($request)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $name = $request->input('name');
            $local = $request->input('local');
            $remote = $request->input('remote');
            $parentqq = $request->input('parentqq');
            $ratelimit = $request->input('ratelimit');
            $isolirmode = $request->input('isolirmode');
            $validity = $request->input('validity');
            $randstarttime = now()->setTime(rand(1, 5), rand(10, 59), rand(10, 59))->format('H:i:s');
            $randinterval = now()->setTime(0, 1, rand(10, 59))->format('H:i:s');


            $onlogin = ':put (",' . $isolirmode . ',' . $validity . ',");{:local date [ /system clock get date ];:local year [ :pick $date 7 11 ];:local month [ :pick $date 0 3 ];:local comment [ /ppp secret get [ /ppp secret find where name="$user" ] comment]; :local ucode [:pick $comment 0 5]; :local komen [:pick $comment 6 100];:if ($ucode = "lunas") do={ /sys scheduler add name="$user" disabled=no start-date=$date interval="30d"; :delay 2s; :local exp [ /sys scheduler get [ /sys scheduler find where name="$user" ] next-run]; :local getxp [len $exp]; :if ($getxp = 15) do={ :local d [:pick $exp 0 6]; :local t [:pick $exp 7 16]; :local s "/"; :local exp ("$d$s$year $t"); /ppp secret set comment="$exp | $komen" [find where name="$user"];}; :if ($getxp = 8) do={ /ppp secret set comment="$date $exp | $komen" [find where name="$user"];}; :if ($getxp > 15) do={ /ppp secret set comment="$exp | $komen" [find where name="$user"];}; /sys scheduler remove [find where name="$user"]; }}';

            if ($isolirmode == "isolir") {
                $onlogin = $onlogin . "}}";
            } elseif ($isolirmode == "downgrade") {
                $onlogin = $onlogin . "}}";
            } else {
                $onlogin = "";
            }

            if ($isolirmode == "isolir") {
                $onup = ':local dateint do={:local montharray ( "jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec" );:local days [ :pick $d 4 6 ];:local month [ :pick $d 0 3 ];:local year [ :pick $d 7 11 ];:local monthint ([ :find $montharray $month]);:if ( [len $month] = 1) do={:local zero ("0");:return [:tonum ("$year$zero$month$days")];}};:local timeint do={:local hours [ :pick $t 0 2 ]; :local minutes [ :pick $t 3 5 ];};:local date [ /system clock get date ]; :local time [ /system clock get time ]; :local today [$dateint d=$date] ; :local curtime [$timeint t=$time] ; :foreach i in=[/ppp secret find where disabled=no] do={ delay delay-time=10ms; :local comment [ /ppp secret  get $i comment]; :local nama [ /ppp secret get $i name]; :local gettime [ :pick $comment 12 20]; :local isolir "0"; :set isolir [ /ppp secret get $i remote-address]; :local profiles [ /ppp secret get $i profile]; :if ( [len $isolir] > 3) do={:if ([:pick $comment 0 5]~"lunas") do={/ip firewall address-list remove [find where address=$isolir];/ip proxy access remove [find where src-address="$isolir"];/ppp active remove [find where name=$nama] ;}} else={:if ([:pick $comment 0 6] = "isolir") do={ /ppp secret set $i profile=isolir ; /ppp active remove [find where name=$nama] ;  /ppp secret set $i comment="BELUM BAYAR | pelanggan: $profiles " ;}; :if ([:pick $comment 0 5] = "lunas") do={/ppp active remove [find where name=$nama] ;}; :if ([:pick $comment 3] = "/" and [:pick $comment 6] = "/") do={:local expd [$dateint d=$comment] ; :local expt [$timeint t=$gettime] ; :if (($expd < $today and $expt < $curtime) or ($expd < $today and $expt > $curtime) or ($expd = $today and $expt < $curtime)) do={ /ppp secret set $i profile=isolir ; /ppp active remove [find where name=$nama] ;  /ppp secret set $i comment="BELOM BAYAR | pelanggan: $profiles " ;}}}}}';
            } elseif ($isolirmode == "downgrade") {
                $onup = ':local day [:pick [/system clock get date] 4 6]; :if (day = "' . $validity . '") do={:local userppp; foreach v in=[/ppp secret find comment="DOWNGRADE"] do={:set userppp ( userppp [/ppp secret get $v name]);/ppp active remove [find name=$userppp];/ppp secret set profile="PAKET DOWNGRADE" [find name=$userppp]; }}';
            } else {
                $onup = "";
            }

            $API->comm('/ppp/profile/add', [
                'name' =>  $name,
                "local-address" => $local,
                "remote-address" => $remote,
                "parent-queue" => $parentqq,
                "rate-limit" => $ratelimit,
                "on-up" => $onlogin,
                "only-one" => "yes",
            ]);

            $monid = $request->input('monid');

            if ($isolirmode != "0") {
                if (empty($monid)) {
                    $API->comm("/system/scheduler/add", [
                        "name" => $name,
                        "start-time" => $randstarttime,
                        "interval" => $randinterval,
                        "on-event" => $onup,
                        "disabled" => "no",
                        "comment" => "Monitor Isolir $name",
                    ]);
                } else {
                    $API->comm("/system/scheduler/set", [
                        ".id" => $monid,
                        "name" => $name,
                        "start-time" => $randstarttime,
                        "interval" => $randinterval,
                        "on-event" => $onup,
                        "disabled" => "no",
                        "comment" => "Monitor Isolir $name",
                    ]);
                }
            }
            // dd($request);
            $API->disconnect();
            Alert::success('Hore!', 'Add Profile Pppoe Sucsess')->persistent(true);
            return true;
        } else {
            return false;
        }
    }
    public static function profileUpdate($id)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $pprofile = $API->comm('/ppp/profile/print', array(
                "?.id" => '*' . $id,
            ));
            $pool = $API->comm('/ip/pool/print');
            $parent = $API->comm('/queue/simple/print');
            // $filteredProfiles = array_filter($pprofile, function ($profile) {
            //     return $profile['name'] !== 'default' && $profile['name'] !== 'default-encryption';
            // });
            $profileDetails = [];
            foreach ($pprofile as $prof) {
                $uprofname = $prof['name'];
                $getprofile = $API->comm("/ppp/profile/print", array("?name" => "$uprofname"));
                if (!empty($getprofile)) {
                    $profiledetalis = $getprofile[0];
                    $profileDetails[] = [
                        'validity' => explode(",", $profiledetalis['on-up'])[2],
                        'isolirmode' => explode(",", $profiledetalis['on-up'])[1],
                    ];
                }
            }
            $data = [
                'pool' => $pool,
                'parent' => $parent,
                'profile' => $pprofile[0],
                'detail' => $profileDetails
            ];
        } else {
            $data = 'koneksi gagal';
        }
        $API->disconnect();
        return $data;
    }

    public static function updateProfile($request)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $id = $request->input('id');
            $name = $request->input('name');
            $local = $request->input('local');
            $remote = $request->input('remote');
            $parentqq = $request->input('parentqq');
            $ratelimit = $request->input('ratelimit');
            $isolirmode = $request->input('isolirmode');
            $validity = $request->input('validity');
            $randstarttime = now()->setTime(rand(1, 5), rand(10, 59), rand(10, 59))->format('H:i:s');
            $randinterval = now()->setTime(0, 1, rand(10, 59))->format('H:i:s');


            $onlogin = ':put (",' . $isolirmode . ',' . $validity . ',");{:local date [ /system clock get date ];:local year [ :pick $date 7 11 ];:local month [ :pick $date 0 3 ];:local comment [ /ppp secret get [ /ppp secret find where name="$user" ] comment]; :local ucode [:pick $comment 0 5]; :local komen [:pick $comment 6 100];:if ($ucode = "lunas") do={ /sys scheduler add name="$user" disabled=no start-date=$date interval="' . $validity . '"; :delay 2s; :local exp [ /sys scheduler get [ /sys scheduler find where name="$user" ] next-run]; :local getxp [len $exp]; :if ($getxp = 15) do={ :local d [:pick $exp 0 6]; :local t [:pick $exp 7 16]; :local s "/"; :local exp ("$d$s$year $t"); /ppp secret set comment="$exp | $komen" [find where name="$user"];}; :if ($getxp = 8) do={ /ppp secret set comment="$date $exp | $komen" [find where name="$user"];}; :if ($getxp > 15) do={ /ppp secret set comment="$exp | $komen" [find where name="$user"];}; /sys scheduler remove [find where name="$user"]; }}';

            if ($isolirmode == "isolir") {
                $onlogin = $onlogin . "}}";
            } elseif ($isolirmode == "downgrade") {
                $onlogin = $onlogin . "}}";
            } else {
                $onlogin = "";
            }

            if ($isolirmode == "isolir") {
                $onup = ':local dateint do={:local montharray ( "jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec" );:local days [ :pick $d 4 6 ];:local month [ :pick $d 0 3 ];:local year [ :pick $d 7 11 ];:local monthint ([ :find $montharray $month]);:if ( [len $month] = 1) do={:local zero ("0");:return [:tonum ("$year$zero$month$days")];}};:local timeint do={:local hours [ :pick $t 0 2 ]; :local minutes [ :pick $t 3 5 ];};:local date [ /system clock get date ]; :local time [ /system clock get time ]; :local today [$dateint d=$date] ; :local curtime [$timeint t=$time] ; :foreach i in=[/ppp secret find where disabled=no] do={ delay delay-time=1ms; :local comment [ /ppp secret  get $i comment]; :local nama [ /ppp secret get $i name]; :local gettime [ :pick $comment 12 20]; :local isolir "0"; :set isolir [ /ppp secret get $i remote-address]; :local profiles [ /ppp secret get $i profile]; :if ( [len $isolir] > 3) do={:if ([:pick $comment 0 5]~"lunas") do={/ip firewall address-list remove [find where address=$isolir];/ip proxy access remove [find where src-address="$isolir"];/ppp active remove [find where name=$nama] ;}} else={:if ([:pick $comment 0 6] = "isolir") do={ /ppp secret set $i profile=isolir ; /ppp active remove [find where name=$nama] ;  /ppp secret set $i comment="BELUM BAYAR | pelanggan: $profiles " ;}; :if ([:pick $comment 0 5] = "lunas") do={/ppp active remove [find where name=$nama] ;}; :if ([:pick $comment 3] = "/" and [:pick $comment 6] = "/") do={:local expd [$dateint d=$comment] ; :local expt [$timeint t=$gettime] ; :if (($expd < $today and $expt < $curtime) or ($expd < $today and $expt > $curtime) or ($expd = $today and $expt < $curtime)) do={ /ppp secret set $i profile=isolir ; /ppp active remove [find where name=$nama] ;  /ppp secret set $i comment="BELOM BAYAR | pelanggan: $profiles " ;}}}}}';
            } elseif ($isolirmode == "downgrade") {
                $onup = ':local day [:pick [/system clock get date] 4 6]; :if (day = "' . $validity . '") do={:local userppp; foreach v in=[/ppp secret find comment="DOWNGRADE"] do={:set userppp ( userppp [/ppp secret get $v name]);/ppp active remove [find name=$userppp];/ppp secret set profile="PAKET DOWNGRADE" [find name=$userppp]; }}';
            } else {
                $onup = "";
            }
            $data = [];

            $API->comm('/ppp/profile/set', [
                '.id' => $id,
                'name' =>  $name,
                "local-address" => $local,
                "remote-address" => $remote,
                "parent-queue" => $parentqq,
                "rate-limit" => $ratelimit,
                "on-up" => $onlogin,
                "only-one" => "yes",
            ] + $data);

            // Selalu mengatur scheduler, baik saat membuat profil baru atau memperbarui yang sudah ada
            $API->comm('/system/scheduler/set', [
                '.id' => $id, // Jika memperbarui profil, gunakan ID yang diberikan
                "name" => $name,
                "start-time" => $randstarttime,
                "interval" => $randinterval,
                "on-event" => $onup,
                "disabled" => "no",
                "comment" => "Monitor Isolir $name",
            ] + $data);

            // Jika $id adalah 0, berarti sedang membuat profil baru
            if ($id) {
                // Dapatkan ID baru yang telah diatur untuk profil yang baru
                $response = $API->comm('/ppp/profile/print', ['?id' => $name]);
                $id = $response[0]['.id'];
            }
          
            // Mengirim perintah ke MikroTik
            $API->disconnect();
            Alert::success('Hore!', 'Add Profile Pppoe Sucsess')->persistent(true);
            return true;
        }
    }

    public static function dellProfile($id)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $API->comm('/ppp/profile/remove', [
                '.id' => $id,
            ]);
        }
        Alert::success('Yes!', 'delete sever sucsess')->persistent(true);

        $API->disconnect();
    }

    public static function profileDetails($id)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');

        $API = new MikrotikApi();
        $API->debug = false;

        $data = [];

        if ($API->connect($ip, $user, $password)) {
            // Ambil semua profil yang memiliki nama "pake1harian"
            $getProfiles = $API->comm("/ppp/profile/print", array("?.id" => $id));

            if (!empty($getProfiles)) {
                $profilesData = [];

                foreach ($getProfiles as $profile) {
                    // Ambil secret yang sesuai dengan profil ini
                    $secrets = $API->comm('/ppp/secret/print', array("?profile" => $profile['name']));

                    $profilesData[] = [
                        'detail' => $profile,
                        'secrets' => $secrets
                    ];
                }

                $API->disconnect();
                $data = $profilesData;
            } else {
                // Profil tidak ditemukan
                $data['error'] = 'Profil tidak ditemukan';
            }
        } else {
            // Koneksi gagal
            $data['error'] = 'Koneksi gagal';
        }

        return $data;
    }
}
error_reporting(0);
