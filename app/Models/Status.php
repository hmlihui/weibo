<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
	protected $fillable = ['content'];
	/**
	 * [user 一条微博属于一个用户]
	 * @Author   larry1.li
	 * @DateTime 2020-04-27T13:40:57+0800
	 * @return   [type]                   [description]
	 */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
