<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'category_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    
    
    /**
     * Create new product and return it {id};
     * 
     * @param array $data 
     * @return int
     */
    protected function addGetId($data) {
        
        $id = DB::table($this->table)->insertGetId($data);
        
        return $id;
        
    }
    
}
