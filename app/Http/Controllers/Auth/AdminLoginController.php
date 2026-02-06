<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminLoginController extends Controller
{
    /**
     * Display the admin login view.
     */
    public function create(): View
    {
        return view('auth.admin-login');
    }

    /**
     * Handle an incoming admin authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        // Check if the authenticated user is an admin
        $user = Auth::user();
        if (!$user->is_admin) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors([
                'email' => 'Akses ditolak. Anda bukan administrator.',
            ])->onlyInput('email');
        }

        // Do not regenerate session yet, wait for PIN verification
        // But we need to mark that they have passed the first factor
        $request->session()->put('admin_auth_passed', true);

        return redirect()->route('admin.verify-pin');
    }

    /**
     * Show the PIN verification form.
     */
    public function showPinForm(Request $request): View|RedirectResponse
    {
        if (!$request->session()->has('admin_auth_passed') || !Auth::check()) {
            return redirect()->route('admin.login');
        }

        return view('auth.verify-pin');
    }

    /**
     * Verify the admin PIN.
     */
    public function verifyPin(Request $request): RedirectResponse
    {
        $request->validate([
            'pin' => ['required', 'string', 'size:6'],
        ]);

        $user = Auth::user();

        if ($request->pin !== $user->admin_pin) {
            return back()->withErrors([
                'pin' => 'PIN Keamanan salah.',
            ]);
        }

        // Mark as 2FA verified
        $request->session()->put('admin_2fa_verified', true);
        $request->session()->forget('admin_auth_passed');
        $request->session()->regenerate();

        session()->flash('success', 'Login admin berhasil!');

        return redirect()->intended(route('admin.dashboard'));
    }

    /**
     * Destroy an authenticated admin session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
