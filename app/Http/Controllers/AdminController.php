<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class AdminController extends Controller
{
    public function index()
    {
       $data = User::with('referrals')->select('id' , 'name' , 'email' ,'created_at')->simplePaginate(10);

       return view('admin')->with(['results' => $data]);
    }
}
