<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        # code...
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }

    public function photoEdit()
    {
        $user = Auth::user();
        return view('user.photo', compact('user'));
    }

    public function updatePhoto(Request $request)
    {
        # dd($request->all());
        if (isset($_FILES['photo']) && !empty($_FILES['photo']['tmp_name'])) {
            $permitidos = array('image/jpeg', 'image/jpg', 'image/png');
            if (in_array($_FILES['photo']['type'], $permitidos)) {
                $nome = time() . rand(0, 9999) . '.jpg';

                $user = User::findOrFail(Auth::user()->id);
                if(!null == $user->avatar && file_exists('uploads/avatar/'.$user->avatar)) {
                    if(unlink('uploads/avatar/'.$user->avatar)) {
                        # dd('imagem removida com sucesso');
                    }
                }

                if (move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/avatar/' . $nome)) {

                    $save = DB::table('users')
                        ->where('id', Auth::user()->id)
                        ->update([
                            'avatar' => $nome
                        ]);

                    if ($save) {
                        $request->session()->flash('success', 'Foto actualizada com sucesso.');
                        return redirect('/profile');
                    } else {
                        echo "Algo correu mal...";
                    }
                }
            }
        } else {
            dd('algo correu mal');
            $request->session()->flash('error', 'Alguma coisa correu mal...');
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        # $user = User::findOrFail(Auth::user()->id);

        # dd($user);

        Validator::extend('username', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });

        $data = request()->validate([
            'name' => 'required|string|min:5',
            'username' => 'required|string|min:5|username',
            'gender' => '',
            'birth_day' => '',
            'phone' => '',
        ]);

        // $user->name = $request->get('name');
        $username = $request->get('username');

        $countUsers = DB::select('select * from users where username = :username', 
            ['username' => $username]);
        
        // dd(count($countUsers));

        if($username != Auth::user()->username && count($countUsers) > 0) {
            $request->session()->flash('warning', 'O nome de usuário não está disponível.');
            return redirect()->back();
        } else {
            $save = DB::table('users')
            ->where('id', Auth::user()->id)
            ->update($data);
        }

        

        if ($save) {
            $request->session()->flash('success', 'Perfil actualizada com sucesso.');
            return redirect('/profile');
        } else {
            echo "Algo correu mal...";
        }
    }

    public function changePassword(Request $request)
    {

        $request->validate([
            'password' => 'required|string|min:5',
            'cpassword' => 'required|string|min:5',
            'npassword' => 'required|string|min:5',
        ]);

        if (!(Hash::check($request->get('password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("warning","A palavra passe actual está incorreta.");
        }

        if($request->get('npassword') !== $request->get('cpassword')) {
            return redirect()->back()->with("warning","Por favor confirme a sua senha nova.");
        }

        $save = DB::table('users')
        ->where('id', Auth::user()->id)
        ->update([
            'password' => Hash::make($request->get('npassword')),
        ]);
        
        if ($save) {
            $request->session()->flash('success', 'Senha actualizada com sucesso.');
            return redirect('/profile');
        } else {
            echo "Algo correu mal...";
        }


    }

    public function changeToAdmin(User $user, Request $request) {
        // dd($user->id);
        if($user->role == 1) {
            $role = 3;
            $message = "O utlizador já não é administrador.";
        } else {
            $role = 1;
            $message = "O utlizador agora é administrador.";
        }

        $save = DB::table('users')
        ->where('id', $user->id)
        ->update([
            'role' => $role,
        ]);
        
        if ($save) {
            $request->session()->flash('success', $message);
            return redirect()->back();
        } else {
            echo "Algo correu mal...";
        }
    }

    public function activeToggle(User $user, Request $request)
    {
        if(null == $user->email_verified_at) {

            $date = date('Y-m-d H:i:s');
          
            $save = DB::table('users')
            ->where('id', $user->id)
            ->update([
                'email_verified_at' => $date,
            ]);

            if($save) {
                return redirect()->back()->with("success","Conta Activada com Sucesso.");
            }

        } else {
            $date = null;
          
            $save = DB::table('users')
            ->where('id', $user->id)
            ->update([
                'email_verified_at' => $date,
            ]);

            if($save) {
                return redirect()->back()->with("warning","Conta Desactivada com Sucesso.");
            }
        }
    }
}
