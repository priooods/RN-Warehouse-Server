<?php

namespace Modules\Manage\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Manage\Database\Factories\MTypeTabFactory;

class MTypeTab extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['title','chemical'];

    protected static function newFactory()
    {
        // Create
    }
}
