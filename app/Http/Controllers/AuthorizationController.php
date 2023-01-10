<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorizationController extends Controller
{
    public function login()
{
//     echo 's21sateigor : <input value="'
//  . \Illuminate\Support\Facades\Hash::make('pelmeni123')
//  . '">';
//  exit();
 return view(
 'authorization.login',
 [
 'title' => 'Pieslēgties'
 ]
 );
}
public function authenticate(Request $request)
{
 $credentials = $request->only('name', 'password');
 if (Auth::attempt($credentials)) {
 $request->session()->regenerate();
 return redirect('books');
 }
 return back()->withErrors([
 'name' => 'Pieslēgšanās neveiksmīga',
 ]);
}

public function logout(Request $request)
{
 Auth::logout();
 $request->session()->invalidate();
 $request->session()->regenerateToken();
 return redirect('/');
}

}
