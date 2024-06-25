<?php

namespace Modules\Manage\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Manage\Database\Factories\TTabungTabFactory;

class TTabungTab extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'm_tabung_tabs_id',
        'm_user_access_tabs_id',
        'type_transaction',
        'condition',
        'no_po',
        'surat_jalan',
        'm_type_tabs_id',
        'sender',
        'receiver',
    ];

    protected static function newFactory()
    {
        // Create
    }
}
