<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    public function login(){
        return view('login');
    }
    public function loginAuth(Request $request){
        $request->validate([
            // email:dns : validasi email ada @ nya
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);
        // menyimpan isi form email dan password di variable @user
        $user = $request->only(['email', 'password']);
        // auth::attempt -> cek kecocokan email dan pw (HASH) (verifikasi).kalau cocok simpan data di riwayat login  (di auth )
        if (Auth::attempt($user)) {
            // jika berhasil memverifikasi, arahkan ke landing page
            return redirect()->route('landing_page')->with('success', 'Login Berhasil!');
        } else {
            // jika gagal memverifikasi arahkan kembali dengan pesan
            return redirect()->back()->with('failed', 'Login Gagal!, Silahkan coba kembali  dengan data yang benar!');
        }
        }

        public function logout()
        {
            // menghapus riwayat Login
            Auth::logout();
            // arahkan ke halaman login lagi
            return redirect()->route('login')->with('success', 'Anda Berhasil Logout!');
        }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = User::where('name', 'LIKE', '%'.$request->search.'%')->orderBy('name', 'ASC')->simplePaginate(5);

        // compact : mengirim data ke blade : compact('namavariable')
        return view('halaman.index2', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('halaman.create2');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            "role" =>'required',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>Hash::make($request->password),
            "role" =>$request->role,
        ]);

        return redirect()->route('akun')->with('success', 'Berhasil Menambahkan akun!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('halaman.edit2', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable',
            'email' => 'nullable',
            'password' => 'nullable',
            "role" =>'nullable',
        ]);
        // ambil data sebelumnya, ambil dr id yg dikirim route {id}
        $userBefore = User::findOrFail($id);
        // cek isi input stock jangan lebih kecil dari stock yg uda ada sebelumnya
        // if ((int)$request->stock < (int)$medicineBefore->stock) {
        //     return redirect()->back()->with('failed', 'Stok baru tidak boleh kurang dari stok sebelumnya!');
        // }
        // kalau stok >= dari sebelumnya, data diupdate
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $proses = $userBefore->update($data);

        if ($proses) {
            return redirect()->route('akun')->with('success', 'Data akun berhasil diubah!');
        } else {
            return redirect()->route('akun.edit', $id)->with('failed', 'Gagal mengubah data akun!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // mencari data yg akan dihapus dengan where, lalu hapus dengan delete()
        $proses = User::where('id', $id)->delete();
        if ($proses) {
            // redirect()->back() : kembali ke halaman sebelum destroy dijalanin (halaman button delete berada)
            return redirect()->back()->with('success', 'Data akun berhasil dihapus!');
        } else {
            return redirect()->back()->with('failed', 'Gagal menghapus data akun!');
        }
    }
}
