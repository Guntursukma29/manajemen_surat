<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\User;
use App\Models\Prodi;
use Illuminate\Http\Request;

class UsermanajemenController extends Controller
{
    public function __construct()
    {
        $this->middleware('CheckRole');
    }
    public function index(){
        $title = "Manajemen User";

        $users = User::all();
        return view('user.index', compact('users' , 'title'));
    }

    public function store(Request $request)
{
    try {
        $request->validate([
            'prodi_id' => 'required|exists:prodi,id',
            'password' => 'required|string|min:8|confirmed',
            'nip' => 'required|string|regex:/^[0-9]+$/|max:255|unique:users,nip',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'role_id' => 'required|exists:roles,id',
        ], [
            'password.confirmed' => 'The password confirmation does not match.',
        ]);

        User::create($request->all());
        return redirect()->route('user.index')->with('success', 'User created successfully');
    } catch (\Illuminate\Database\QueryException $ex) {
        return redirect()->route('user.create')->with('error', 'NIP atau Email sudah terdaftar.');
    }
}


    public function edit($id)
    {
        $title = "Edit User";
        $user = User::findOrFail($id);
        $prodi = Prodi::all();
        $roles = Role::all();
        return view('user.edit', compact('user', 'prodi', 'roles' , 'title'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'nip' => 'required|string|regex:/^[0-9]+$/|max:255|unique:users,nip,'.$id,
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|max:255',
            'prodi_id' => 'required|exists:prodi,id',
            'role_id' => 'required|exists:roles,id',
        ]);
    
        $user = User::findOrFail($id);
        $user->update([
            'nip' => $request->nip,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'prodi_id' => $request->prodi_id, // Perbaikan di sini
            'role_id' => $request->role_id, // Perbaikan di sini
        ]);
    
        return redirect()->route('user.index')->with('success', 'User updated successfully');
    }

    public function create()
    {
        $title = "Tambah User";
        $prodi = Prodi::all();
        $roles = Role::all();
        return view('user.create', compact('prodi', 'roles', 'title'));
    }


    public function destroy($id)
{
    $user = User::findOrFail($id);

    // Cek apakah user memiliki surat terkait sebagai pengirim atau penerima
    if ($user->suratsDikirim()->count() > 0 || $user->suratsDiterima()->count() > 0) {
        // Jika ada surat terkait, kembalikan dengan pesan error
        return redirect()->route('user.index')->with('error', 'User cannot be deleted because they have related surat data.');
    }

    // Jika tidak ada surat terkait, hapus user
    $user->delete();

    return redirect()->route('user.index')->with('success', 'User deleted successfully');
}


}
