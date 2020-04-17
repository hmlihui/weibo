<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    /**
     * [home description]
     * @Author   larry1.li
     * @DateTime 2020-04-17T17:31:44+0800
     * @return   [type]                   [description]
     */
    public function home(){
    	return view('static_pages/home');
    }
    /**
     * [help description]
     * @return [type] [description]
     */
    public function help(){
    	return view('static_pages/help');
    }
    /**
     * [about description]
     * @Author   larry1.li
     * @DateTime 2020-04-17T17:32:34+0800
     * @return   [type]                   [description]
     */
    public function about(){
    	return view('static_pages/about');
    }
}
