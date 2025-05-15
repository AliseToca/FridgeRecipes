<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email_or_username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();
    
        $user = filter_var($this->input('email_or_username'), FILTER_VALIDATE_EMAIL)
            ? User::where('email', $this->input('email_or_username'))->first()
            : User::where('username', $this->input('email_or_username'))->first();
    
        if (! $user) {
            throw ValidationException::withMessages([
                'email_or_username' => trans('auth.failed'),
            ]);
        }
    
        $credentials = [
            'email' => $user->email,
            'password' => $this->input('password'),
        ];
    
        $authenticated = Auth::attempt($credentials, $this->boolean('remember'));
    
        // ✅ Now safe to debug after
        \Log::info('AUTH ATTEMPT', [
            'credentials' => $credentials,
            'success' => $authenticated,
        ]);
    
        if (! $authenticated) {
            RateLimiter::hit($this->throttleKey());
    
            throw ValidationException::withMessages([
                'email_or_username' => trans('auth.failed'),
            ]);
        }
    
        RateLimiter::clear($this->throttleKey());
    }
    
    

    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email_or_username' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email_or_username')).'|'.$this->ip());
    }
}
