<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'issue_headline',
        'issue_description',
        'requested_by',
        'status',
        'requested_date',
    ];

}
