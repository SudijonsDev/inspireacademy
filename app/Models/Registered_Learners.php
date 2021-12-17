<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registered_Learners extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'registered_learners';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['noOfLearners', 'regCourseId'];
}