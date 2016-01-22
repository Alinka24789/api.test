<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    
    
    /**
     * Create new category and return it {id};
     * 
     * @param array $data 
     * @return int
     */
    protected function addGetId($data) {
        
        $id = DB::table($this->table)->insertGetId($data);
        
        return $id;
        
    }
    
}
