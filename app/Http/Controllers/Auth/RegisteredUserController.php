<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Utility;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use app\Models\Plan;
use App\Models\GenerateOfferLetter;
use App\Models\JoiningLetter;
use App\Models\ExperienceCertificate;
use App\Models\NOC;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function create($lang = '')
    {
        if ($lang == '') {
            $lang = \App\Models\Utility::getValByName('default_language');
        }

        \App::setLocale($lang);
        return view('auth.register', compact('userData','lang'));
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
        $settings = \App\Models\Utility::settings();
        if (env('RECAPTCHA_MODULE') == 'yes') {
            $validation['g-recaptcha-response'] = 'required|captcha';
        } else {
            $validation = [];
        }
        $this->validate($request, $validation);

        $default_language = \DB::table('settings')->select('value')->where('name', 'default_language')->first();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'company',
            'lang' => !empty($default_language) ? $default_language->value : '',
            'plan' => 1,
            'created_by' => 1,
        ]);

        // event(new Registered($user));

        Auth::login($user);

        if ($settings['email_verification'] == 'off') {
            try {
                $uArr = [
                    'email' => $request->email,
                    'password' => $request->password,
                ];
                Utility::sendEmailTemplate('new_user', [$user->email], $uArr);
            } catch (\Throwable $th) {
                
            }

        }

        if ($settings['email_verification'] == 'on') {

            try {
                event(new Registered($user));
                $role_r = Role::findByName('company');
                $user->assignRole($role_r);
                $user->userDefaultData($userData['id']);
                $user->userDefaultDataRegister($userData['id']);
                GenerateOfferLetter::defaultOfferLetterRegister($userData['id']);
                ExperienceCertificate::defaultExpCertificatRegister($userData['id']);
                JoiningLetter::defaultJoiningLetterRegister($userData['id']);
                NOC::defaultNocCertificateRegister($userData['id']);
            } catch (\Exception $e) {

                $user->delete();

                return redirect('/register/lang?')->with('status', __('Email SMTP settings does not configured so please contact to your site admin.'));
            }

            return view('auth.verify-email');
        } else {

            $user->email_verified_at = date('h:i:s');
            $user->save();
            $role_r = Role::findByName('company');

            $user->assignRole($role_r);
            $user->userDefaultData($userData['id']);
            $user->userDefaultDataRegister($userData['id']);
            GenerateOfferLetter::defaultOfferLetterRegister($userData['id']);
            ExperienceCertificate::defaultExpCertificatRegister($userData['id']);
            JoiningLetter::defaultJoiningLetterRegister($userData['id']);
            NOC::defaultNocCertificateRegister($userData['id']);
            return redirect(RouteServiceProvider::HOME);
        }
    }

    public function showRegistrationForm($lang = '')
    {
        if (empty($lang)) {
            $lang = Utility::getValByName('default_language');
        }

        \App::setLocale($lang);
        if (Utility::getValByName('disable_signup_button') == 'on') {
            return view('auth.register', compact('userData','lang'));
        } else {
            return abort('404', 'Page not found');
        }
    }
}
