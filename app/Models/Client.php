<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends User
{
    use HasFactory;

    protected $table = 'clients';

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'author_id');
    }
}
