<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Events\Registered;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Redirect;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ログアウトした後に特定のURLへ誘導
        $this->app->singleton(LogoutResponse::class, function ($app) {
            return new class implements LogoutResponse
            {
                public function toResponse($request)
                {
                    return redirect('/');
                }
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);

        $this->app->singleton(RegisterResponse::class, function ($app) {
            return new class implements RegisterResponse
            {
                public function toResponse($request)
                {
                    return redirect('/login')->with('status', '登録が完了しました。ログインしてください。');
                }
            };
        });

        Event::listen(Registered::class, function ($event) {
            return Redirect::to('/login');
        });

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }

            throw ValidationException::withMessages([
                'email' => ['提供された認証情報が記録と一致しません。'],
            ]);
        });

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email . $request->ip());
        });

        Fortify::loginView(function () {
            return view('auth.login');
        });

        Fortify::registerView(function () {
            return view('auth.register');
        });


    }
}

