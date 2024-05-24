<?php

namespace App\Http\Middleware;

use App\Services\UserService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyUser
{
    public function __construct(private UserService $userService)
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->userService->verify(request()->password, auth()->user())) {
            return $next($request);
        } else {
            return response()->json(['message' => 'Invalid Password', 'success' => false]);
        }

    }
}
