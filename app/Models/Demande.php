<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
<<<<<<< HEAD
        'objet',
        'contenu',
=======
        'contenu',
        'objet',
        'feedback',
>>>>>>> a0db9d6fd5a31e336cf23ebf81d7f00d697d1195
        'auteur_id',
        'admin_id',
    ];

<<<<<<< HEAD
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'auteur_id' => 'integer',
        'admin_id' => 'integer',
    ];


=======

    /**
     * Get the user that owns the Demande
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }
>>>>>>> a0db9d6fd5a31e336cf23ebf81d7f00d697d1195

}
