<?php

namespace App\Models\Panel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthGroupUsers extends Model
{
    use HasFactory;

    protected $fillable = [
        'aguUserId',
        'aguGroupId',
    ];

    public function groupName()
    {
        return $this->belongsTo(AuthGroups::class, 'aguGroupId', 'id');
    }

    public static function getGroupIdByUserId($userId)
    {
        $groupUser = self::where('aguUserId', $userId)->first();
        return $groupUser ? $groupUser->aguGroupId : null;
    }

    public static function getGroupNameByUserId($userId)
    {
        $groupUser = self::with('groupName')->where('aguUserId', $userId)->first();
        return $groupUser ? $groupUser->groupName->agName : null;
    }
}
