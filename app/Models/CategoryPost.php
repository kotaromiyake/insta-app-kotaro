<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;

    protected $table = 'category_posts';
    protected $fillable = ['category_id','post_id'];

    public $timestamps = false;

    // relationship to category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
