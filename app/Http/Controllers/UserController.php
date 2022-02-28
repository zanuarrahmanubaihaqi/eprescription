<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Level;
use App\UserStruktur;
use DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
      $levels = Level::all();
      $users = DB::table('users')
            ->join('level as level', 'users.level', '=', 'level.id')
            ->select('users.*', 'level.level')->get();
      return view('user.index', compact('users', 'levels'));
    }

    public function store(Request $request) {
      $nama = $request->nama;
      $username = $request->username;
      $password_text = $request->password;
      $level = $request->level;

      $get_last_id = User::select('id')
                      ->orderByDesc('id')
                      ->first();
      if ($get_last_id != null) {
          $id = $get_last_id->id;
      } else {
          $id = 0;
      }

      $data_user = [
        'id' => $id + 1,
        'nama' => $nama,
        'username' => $username,
        'password' => Hash::make($password_text),
        'level' => (int)$level
      ];
      User::create($data_user);
      
      return redirect()->back()->with(['message' => 'User berhasil ditambahkan']);
    }

    public function update(Request $request, $user_id) {
      $nama = $request->nama;
      $username = $request->username;
      $level = $request->level;

      $user = User::find($user_id);
      $user->update([
        'nama' => $nama,
        'username' => $username,
        'password' => Hash::make($password_text),
        'level' => (int)$level
      ]);
      return redirect()->back()->with(['message' => 'User berhasil diupdate']);
    }

    public function delete($id) {
      $user = User::findOrFail($id);
      if (isset($user->id)) {
        DB::delete("DELETE from usres WHERE id = " . $user->id);
        return redirect()->back()->with(['message' => 'User berhasil dihapus']);
      } else {
        return redirect()->back()->with(['message' => 'User gagal dihapus']);
      }
    }
}
