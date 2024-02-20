<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [
        'id',
        // 'created_at',
        // 'updated_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Assign a super user
    // public function superUser()
    // {
    //     return $this->belongsTo(User::class, 'user_id', 'id');
    // }

}
