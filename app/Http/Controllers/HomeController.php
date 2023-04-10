<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index()
    {
        $categories = Category::all();
        $freelancers = User::where('type', 'freelancer')->get();
        $freelancers = $freelancers->sortByDesc(function ($item) {
            if ($item->review()->count() > 0) {
                return $item->review()->sum('rate') / $item->review()->count();
            } else {
                return $item->review()->count();
            }
        })->take(10);
        return view('visitor.home', compact('categories', 'freelancers'));
    }
}
