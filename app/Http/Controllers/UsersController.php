<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function validateAdmin()
    {
        if(auth()->user()->role != "Administrador"){

            return false;
        }

        return true;
    }


    public function indexUsers()
    {
        $isAdmin = $this->validateAdmin();
        if (!$isAdmin) return view('home');

        $users = User::all();

        return view('usersViews.showUsers')->with('users', $users);
    }


    public function upload(Request $request)
    {
        $isAdmin = $this->validateAdmin();
        if (!$isAdmin) return view('home');

        if($request->hasFile("url")){

            $file = $request->file("url");
            $name = $request->file("url")->getClientOriginalName();
            $path = public_path("storage/".$name);

            copy($file, $path);

            $user = DB::table('users')
                        ->where('email','=', $request->userEmail)
                        ->get();

            $idUser = $user[0]->id;        
            $nameUser =$user[0]->name;

            DB::table('files')->insert([
                'idUser' => $idUser,
                'nameUser' => $nameUser,
                'file' => $name
            ]);

            return redirect('ShowUsers')->with('FileUploaded', 'OK');

        }

        return redirect('ShowUsers')->with('ErrorUploaded', 'OK');
    }


    public function createIndex()
    {
        $isAdmin = $this->validateAdmin();
        if (!$isAdmin) return view('home');

        return view('usersViews.createUser');
    }


    public function createUser(Request $request)
    {
        $isAdmin = $this->validateAdmin();
        if (!$isAdmin) return view('home');

        $validate = request()->validate([

            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect('ShowUsers')->with('UserCreated', 'OK');
    }


    public function editUser($id)
    {

        $isAdmin = $this->validateAdmin();
        if (!$isAdmin) return view('home');

        $isAdmin = $this->validateAdmin();
        
        if(!$isAdmin){

            return view('home');
        }

        $users = User::all();
        $user = User::find($id);

        return view('usersViews.editUser', compact('users','user'));
    }


    public function updateUser(Request $request, $id)
    
    {

        $user = DB::table('users')
                ->where('email', '=', $request->email)
                ->get();

        if($user->isEmpty()){

            $validate = request()->validate([

                'name' => ['required'],
                'email' => ['required', 'email', 'unique:users']

            ]);

            DB::table('users')->where('id', $id)->update(['name' => $request->name, 'email' => $request->email, 'role' => $request->role]);

        }

        $validate = request()->validate([

            'name' => ['required']

        ]);

        DB::table('users')->where('id', $id)->update(['name' => $request->name, 'role' => $request->role]);

        return redirect('ShowUsers')->with('UserEdited', 'OK');

    }
    

    public function destroy($id)
    {
        $isAdmin = $this->validateAdmin();
        if (!$isAdmin) return view('home');

        $user = User::find($id);
                
        User::destroy($id);

        return redirect('ShowUsers')->with('UserDeleted', 'OK');
    }



}
