<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use App\Repositories\Interfaces\ModuleRepositoryInterface;

class ModularMiddleware
{
    public function __construct(ModuleRepositoryInterface $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $module)
    {
        $user = $request->user();
        if (!$user) {
            throw new AuthenticationException;
        }
        
        if ($user->modules) {
            $modules = unserialize($user->modules);
            $userModule = $this->moduleRepository->getModulesById($modules)->pluck('name')->toArray();
            for($i = 0; $i < count($userModule); $i++) {
                if ($userModule[$i] != $module) {
                    throw new AuthorizationException;
                }
            }
        }

        return $next($request);
    }
}
