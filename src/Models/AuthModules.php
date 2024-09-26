<?php

namespace App\Models\Panel;

use App\Models\Panel\AuthGroups;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Panel\AuthModules;

class AuthModules extends Model
{
    use HasFactory;

    protected $fillable = [
        'amName',
        'amSlug',
        'amIcon',
        'amParentMenuId',
        'amStatus',
        'amShowMenu',
        'amOrder',
    ];

    // AuthModule modeli için ilişki fonksiyonu
    public function groups()
    {
        return $this->belongsToMany(AuthGroups::class, 'auth_group_modules', 'id', 'agmModuleId');
    }

    public function childModules()
    {
        return $this->hasMany(AuthModules::class, 'amParentMenuId', 'id');
    }

    public function hasPermission($groupId)
    {
        // Belirli bir grup için belirli bir modülün yetkisini kontrol etmek için burada gerekli kontrolü yapabilirsiniz
        // Örneğin, AuthGroupModules tablosundan ilgili kaydı kontrol edebilirsiniz
        return $this->groups()->where('agmGroupId', $groupId)->exists();
    }
}
