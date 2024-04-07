<?php

namespace App\Http\Controllers\Mikrotik;

use App\Routers\Server;
use App\Routers\Toggel;
use App\Models\MikrotikApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Routers\Active;
use App\Routers\Isolir;
use App\Routers\Profile;
use App\Routers\Secret;
use RealRashid\SweetAlert\Facades\Alert;

class PPPoEController extends Controller
{
  /*********************************/
  /*          START  SERVER        */
  public function server()
  {
    $data = Server::server();
    return view('pppoe.get.server', $data);
  }
  public function showServer()
  {
    $data = Server::showServer();
    return view('pppoe.post.server', $data);
  }
  public function ServerUpdate($id)
  {
    $data = Server::ServerUpdate($id);
    return view('pppoe.get.editserver', $data);
  }

  public function toggleServer(Request $request)
  {
    $success = Toggel::toggleServer($request);
    if ($success) {
      return redirect()->route('server.toggle');
    } else {
      return 'Koneksi gagal';
    }
  }
  public function addServer(Request $request)
  {
    if (Server::addServer($request)) {
      return redirect()->route('pppoe.server');
    } else {
      return 'Gagal menambahkan server PPPoE.';
    }
  }
  public function dellServer($id)
  {
    Server::dellServer($id);
    return redirect()->route('pppoe.server');
  }
  public function updateServer(Request $request)
  {
    if (Server::updateServer($request)) {
      return redirect()->route('pppoe.server');
    } else {
      return 'Gagal menambahkan secret PPPoE.';
    }
  }

  /*          END  SERVER        */
  /*********************************/



  /*********************************/
  /*          START  Profile        */

  public function profile()
  {
    $data = Profile::profile();
    if (is_string($data)) {
      return $data;
    } else {
      return view('pppoe.get.profile', $data);
    }
  }
  public function showProfile()
  {
    $data = Profile::showProfile();
    return view('pppoe.post.profile', $data);
  }

  public function addProfile(Request $request)
  {
    if (Profile::addProfile($request)) {
      return redirect()->route('pppoe.profile');
    } else {
      return 'Gagal menambahkan server PPPoE.';
    }
  }

  public function profileUpdate($id)
  {
    $data = Profile::profileUpdate($id);
    return view('pppoe.get.editprofile', $data);
  }
  public function updateProfile(Request $request)
  {
    if (Profile::updateProfile($request)) {
      return redirect()->route('pppoe.profile');
    } else {
      return 'Gagal menambahkan secret PPPoE.';
    }
  }
  public function profileDetails($id)
  {
    $data = Profile::profileDetails($id);
    return view('pppoe.get.profiledetails', compact('data'));
  }

  public function dellProfile($id)
  {
    Profile::dellProfile($id);
    return redirect()->route('pppoe.profile');
  }

  /*          END  Profile        */
  /*********************************/

  public function secret()
  {
    $data = Secret::secret();
    if (is_string($data)) {
      return $data;
    } else {
      return view('pppoe.get.secret', $data);
    }
  }
  public function showsecret()
  {
    $data = Secret::showsecret();
    return view('pppoe.post.secret', $data);
  }
  public function addsecret(Request $request)
  {
    if (Secret::addsecret($request)) {
      return redirect()->route('secret.pppoe');
    } else {
      return 'Gagal menambahkan server PPPoE.';
    }
  }
  public function updateSecret($id)
  {
    $data = Secret::updateSecret($id);
    return view('pppoe.get.editsecret', $data);
  }
  public function secretUpdate(Request $request)
  {
    if (Secret::secretUpdate($request)) {
      return redirect()->route('secret.pppoe');
    } else {
      return 'Gagal menambahkan secret PPPoE.';
    }
  }
  public function dellsecret($id)
  {
    if (Secret::dellsecret($id)) {
      return redirect()->route('secret.pppoe');
    } else {
      return 'Gagal menghapus secret PPPoE.';
    }
  }

  public function active()
  {
    $data = Active::active();
    if (is_string($data)) {
      return $data;
    } else {
      return view('pppoe.get.active', $data);
    }
  }
  public function dellactive($id)
  {
    if (Active::dellactive($id)) {
      return redirect()->route('active.pppoe');
    } else {
      return 'Gagal menghapus PPPoE active.';
    }
  }
  public function isolir()
  {
    $data = Isolir::isolir();
    if (is_string($data)) {
      return $data;
    } else {
      return view('pppoe.isolir.ppp', $data);
    }
  }
}
error_reporting(0);
