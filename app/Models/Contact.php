<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'is_read'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getStatusBadgeAttribute()
    {
        if ($this->is_read) {
            return '<span class="badge bg-secondary">Lu</span>';
        } else {
            return '<span class="badge bg-success">Nouveau</span>';
        }
    }

    public function getShortMessageAttribute()
    {
        return strlen($this->message) > 50 ? substr($this->message, 0, 50) . '...' : $this->message;
    }
}
