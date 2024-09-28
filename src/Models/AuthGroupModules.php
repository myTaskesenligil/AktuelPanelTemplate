<?php

namespace App\Models;

use App\Models\AuthGroups;
use App\Models\AuthModules;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AuthGroupModules extends Model
{
    use HasFactory;

    protected $fillable = [
        'agmModuleId',
        'agmGroupId',
    ];

    public function hasPermissionBySlug($moduleSlug, $groupId)
    {
        return $this->whereHas('modules', function ($query) use ($moduleSlug) {
            $query->where('amSlug', $moduleSlug);
        })->where('agmGroupId', $groupId)->exists();
    }

    public function hasPermission($moduleId, $groupId)
    {
        // Belirli bir grupta belirli bir modülün yetkisinin olup olmadığını kontrol etmek için burada gerekli kontrolü yapabilirsiniz
        // Örneğin, AuthGroupModules tablosundan ilgili kaydı kontrol edebilirsiniz
        return $this->where('agmModuleId', $moduleId)->where('agmGroupId', $groupId)->exists();
    }

    public function modules()
    {
        return $this->belongsTo(AuthModules::class, 'agmModuleId', 'id');
    }

    public function groups()
    {
        return $this->belongsTo(AuthGroups::class, 'agmGroupId', 'id');
    }
}
