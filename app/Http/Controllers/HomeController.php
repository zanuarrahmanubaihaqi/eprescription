<?php

namespace App\Http\Controllers;

use App\User;
use App\Log;
use App\Resep;
use App\Pasien;
use App\PembayaranStatus;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();
        $resep = Resep::getData();
        $level = auth()->user()->level;
        $user_name = auth()->user()->name;
        switch ($level) {
          case 1:
            $user_level = 'Admin';
            break;

          case 2:
            $user_level = 'Operator';
          
          default:
            $user_level = 'Guest';
            break;
        }
        $user = [
          'user_name' => $user_name,
          'user_level' => $user_level
        ];

        return view('home', compact('resep', 'user'));
    }

    public function get_notification_data() {
      $user_id = auth()->user()->id;
      $log = Log::where('id', $user_id)->orderBy('id', 'DESC')->get();
      return $log;
    }

    public function get_notification_detail($user_id) {
      $logs = Log::where('id', $user_id)->orderBy('id', 'DESC')->get();
      return view('notification_detail', compact('logs'));
    }

    public function notification_seen($user_id) {
      $log = Log::where('id', $user_id)->update([
        'aksi' => 'hit notification_seen'
      ]);
      return 'success';
      // return $user_id;
    }

    public function welcome() {
      return view('welcome');
    }

}
