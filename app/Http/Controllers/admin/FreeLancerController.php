<?php
namespace App\Http\Controllers\admin;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FreeLancerController extends Controller
{
    public function index()
    {
        $freelancers = User::where('type', 'freelancer')->get();
        return view('Admin.users.freelancers', compact('freelancers'));
    }


    public function destroy(Request $request, $id)
    {
        User::find($id)->where('type', 'freelancer')->delete();
        session()->flash('Delete' , 'تم حذف مقدم الخدمة بنجاج');
        return back();
    }
}

