<?php

namespace App\Http\Controllers;

use App\Models\CarneSimples;
use App\models\Category;
use App\models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $meusCarnes = CarneSimples::where('user_id', Auth::user()->id)->get();
        return view('home' , compact('meusCarnes'));
    }
}
