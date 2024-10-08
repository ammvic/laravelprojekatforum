<?php

namespace App\Http\Controllers\Auth;

use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeEmail;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        // Kreiranje korisnika
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Slanje verifikacionog koda na mejl korisnika
        $verification_code = mt_rand(100000, 999999);
        Mail::to($data['email'])->send(new VerificationCodeEmail($verification_code));
        session(['verification_code' => $verification_code]);

        return $user;
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'verification_code' => ['required', 'string'],
        ]);

        $input_code = $request->verification_code;
        $saved_code = session('verification_code');

        if ($input_code == $saved_code) {
            // Verifikacioni kod je ispravan, registrujte korisnika
            $this->guard()->login($user);

            return redirect($this->redirectPath());
        } else {
            // Verifikacioni kod nije ispravan, vratite korisnika nazad na formu sa porukom o grešci
            return back()->withErrors(['verification_code' => 'Verifikacioni kod nije ispravan.']);
        }
    }
}
