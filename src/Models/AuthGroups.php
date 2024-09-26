<?php

namespace App\Models\Panel;

use App\Models\Panel\AuthModules;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AuthGroups extends Model
{
    use HasFactory;

    protected $fillable = [
        'agName',
        'agDesc',
    ];

    // public function users()
    // {
    //     return $this->belongsToMany(AuthUser::class, 'auth_group_users', 'aguGroupId', 'aguUserId');
    // }

    public function hasPermission($moduleId)
    {
        // Belirli bir grupta belirli bir modülün yetkisinin olup olmadığını kontrol etmek için burada gerekli kontrolü yapabilirsiniz
        // Örneğin, AuthGroupModules tablosundan ilgili kaydı kontrol edebilirsiniz
        return $this->modules()->where('agmModuleI', $moduleId)->exists();
    }

    public function modules()
    {
        return $this->belongsToMany(AuthModules::class, 'auth_group_modules', 'id', 'agmModuleId');
    }
}
