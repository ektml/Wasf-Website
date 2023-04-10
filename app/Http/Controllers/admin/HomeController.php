<?php
namespace App\Http\Controllers\admin;
use App\Models\User;
use App\Models\AboutUs;
use App\Models\Requests;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Models\OwnerPercentage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function payments_details()
    {
        $payments = DB::table('payments_details')->get();
        return view('Admin.parts.payments_details', compact('payments'));
    }


    public function manage_cash_withdrawal(){
        $cashs = DB::table('cash_withdrawals')->get();
        return view('Admin.parts.cash_withdrawal', compact('cashs'));
    }

    public function changeStatus(Request $request , $id)
    {
        $cash = DB::table('cash_withdrawals')->find($id);
        DB::table('cash_withdrawals')->where('id' , $id)->update(['status' => $request->status]);
        return back();
    }


    public function public_requests()
    {
        $public_requests = Requests::where('type', 'public')->get();
        return view('Admin.requests.public_requests', compact('public_requests'));
    }


    public function private_requests()
    {
        $private_requests = Requests::where('type', 'private')->get();
        return view('Admin.requests.private_requests', compact('private_requests'));
    }


    public function contact_us()
    {
        $contact_requests = ContactUs::all();
        return view('Admin.users.contact_us', compact('contact_requests'));
    }
}
