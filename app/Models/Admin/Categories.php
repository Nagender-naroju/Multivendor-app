<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
   protected $table = "categories";

   protected $fillable = [
    'category_name',
    'parent_id'
   ];

   public function parent()
   {
      return $this->belongsTo(Categories::class, 'parent_id');
   }

   public function children()
   {
      return $this->hasMany(Categories::class, 'parent_id');
   }
}
