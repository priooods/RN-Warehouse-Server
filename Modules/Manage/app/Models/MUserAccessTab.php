<?php

namespace Modules\Manage\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Manage\Database\Factories\MUserAccessTabFactory;

class MUserAccessTab extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['m_user_access_tabs'];

    protected static function newFactory()
    {
        // Create
    }
}
