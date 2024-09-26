<?php

namespace Myusuft\MyLaravelTemplate\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Panel\AuthGroupModules;
use Symfony\Component\HttpFoundation\Response;
use function App\Http\Middleware\abort;
use function App\Http\Middleware\session;

class CheckModulePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }

    public function handle(Request $request, Closure $next)
    {
        // Burada, isteği işleyerek kullanıcının erişim yetkisini kontrol edin
        $moduleSlug = explode('/', $request->path())[1];
        $groupId = session()->get('group_id');

        $authGroupModules = new AuthGroupModules();
        // Modül yetkisini kontrol et
        if($moduleSlug != 'logout'){
            if (!$authGroupModules->hasPermissionBySlug($moduleSlug, $groupId)) {
                abort(403, 'YETKİSİZ ERİŞİM');
            }
        }

        return $next($request);
    }
}
