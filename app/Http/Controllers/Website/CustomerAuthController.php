<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Notifications\SendOtpMobileNotify;
use Ichtrojan\Otp\Otp;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class CustomerAuthController extends Controller
{
    /** ================= LOGIN & LOGOUT================= */
    public function showLoginForm()
    {
        return view('website.auth.login.index');
    }

    public function login(Request $request)
    {
        //  Validation
        $request->validate([
            'mobile' => ['required', 'regex:/^05[0-9]{8}$/', 'size:10'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        //  Credentials
        $credentials = $request->only('mobile', 'password');

        //  Failed Login
        if (!Auth::guard('customer')->attempt($credentials, $request->filled('remember'))) {
            return back()
                ->withErrors(['general' => 'رقم الجوال أو كلمة المرور غير صحيحة'])
                ->withInput();
        }

        // Get User
        $user = Auth::guard('customer')->user();

        // User Not Active
        if (!$user->is_active) {
            Auth::guard('customer')->logout();

            return back()
                ->withErrors(['general' => 'حسابك غير مُفعل'])
                ->withInput();
        }

        // Regenerate Session
        $request->session()->regenerate();


        return redirect()->intended(route('home'));
    }
    public function logout(Request $request)
    {
        auth('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    /** ================= REGISTER ================= */
    public function showRegisterForm()
    {
        Session::forget('pending_register_user');
        return view('website.auth.register.index');
    }
    public function register(Request $request)
    {
        // Step 1
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'mobile' => ['required', 'string', 'unique:customers,mobile'],
                'password' => ['required', 'string', 'min:6'],
                'agree' => ['required', 'in:1'],
            ],
            [
                'agree.required' => 'يجب الموافقة على الشروط والأحكام',
                'agree.in' => 'يجب الموافقة على الشروط والأحكام',
            ],
        );

        // Step 2

        $data = [
            'name' => $request->name,
            'mobile' => $request->mobile,
            'password' => $request->password,
        ];

        // Step 3

        Session::put('pending_register_user', $data);

        // Step 4
        $notification = new SendOtpMobileNotify();
        $tempUser = (object) ['mobile' => $data['mobile']];
        $notification->toSms($tempUser);

        return redirect()->route('customer.verify.show');
    }

    /** ================= VERIFY OTP ================= */
    public function showVerifyForm()
    {
        return view('website.auth.register.verify');
    }
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'numeric'],
        ]);

        if (!Session::has('pending_register_user')) {
            return redirect()->route('customer.register.show');
        }

        $data = Session::get('pending_register_user');

        $otp = app(Otp::class)->validate($data['mobile'], $request->otp);

        if (!$otp->status) {
            return back()->withErrors([
                'otp' => 'كود التحقق غير صحيح أو منتهي',
            ]);
        }

        $customer = Customer::create([
            'name' => $data['name'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
            'is_mobile_verified' => true,
            'mobile_verified_at' => now(),
            'is_active' => true,
        ]);

        auth('customer')->login($customer);

        Session::forget('pending_register_user');

        return redirect()->route('home');
    }

    /** ================= FORGOT PASSWORD ================= */
    public function showForgotPasswordForm() {}
    public function sendResetOtp(Request $request) {}

    /** ================= RESET PASSWORD ================= */
    public function showResetPasswordForm() {}
    public function resetPassword(Request $request) {}
}
