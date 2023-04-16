<?php
namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone'=>['required','min:9',Rule::unique('users', 'phone')->where(function ($query) {
                return $query;
            })],
            
            'policy'=>['required']
        ]);

        $user = User::create([
            'name' => $request->name,
            'phone'=> $request->phone,
            'email' => $request->email,
            "profile_image"=> "default.png",
            'password' => Hash::make($request->password),
        ]);

        Wallet::create([
        'user_id'=> $user->id,
        'total'=>0,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->back()->with("message", "sucessfully login");
    }
}
