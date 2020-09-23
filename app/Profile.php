<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function profileImage()
    {
        $imagePath = ($this->profileImage) ? $this->profileImage : 'profile/bN1uQxE7OvqaF4VTV9gKWizF9U1yKdM4E1de4V6P.png';
        return '../../storage/' . $imagePath;
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
