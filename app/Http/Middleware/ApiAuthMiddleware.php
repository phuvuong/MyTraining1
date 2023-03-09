<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;

class ApiAuthMiddleware
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $apiToken = $request->header('Authorization');

        if (!$apiToken) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = $this->userRepository->findByApiToken($apiToken);

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        Auth::login($user);

        return $next($request);
    }

}
