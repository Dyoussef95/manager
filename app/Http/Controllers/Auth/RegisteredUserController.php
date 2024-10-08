<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */

     public function index()
     {
        $users = User::all();
         return view('administracion.colaboradores.index')
                ->with('users', $users);;
     }

    public function create()
    {
        return view('administracion.colaboradores.create');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        /*$request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);*/

     
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        /*
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
        */
        return redirect()->route('users');
    }

    public function edit(User $user)
     {
      
         return view('administracion.colaboradores.edit')
                ->with('user',$user);;
     }

     public function update(Request $request, User $user)
     {
       
        if(isset($request->password)){
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required'],
            ]);

            $user->name= $request->name;
            $user->email= $request->email;
            $user->password= Hash::make($request->password);
            $user->save();
        }else{
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
    
            $user->name= $request->name;
            $user->email= $request->email;
            $user->save();
            
        }
      
        return redirect()->route('users');
     }

     public function destroy(User $user)
     {
       
        $user->delete();
        return redirect()->route('users');
     }

     
}
