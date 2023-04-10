<?php
namespace App\Http\Controllers\admin;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\OwnerPercentage;
use App\Http\Controllers\Controller;

class OwnerPercentageController extends Controller
{
    public function index()
    {
        $percentages = OwnerPercentage::all();
        return view('Admin.parts.ownerPercentage', compact('percentages'));    
    }


    public function store(Request $request)
    {
        // return $request;
        $percentages = $request->validate([
            'percentage' => 'required|numeric|unique:owner_percentages',
            'type' => 'required',
        ],[
            'percentage.required' =>'يرجي ادخال اسم رقم العمولة',
            'percentage.unique' =>'نسبة العمولة مسجلة مسبقا',
            'percentage.numeric' =>'نسبة العمولة يجب أن تكون رقم',
            'type.required' =>'يرجي ادخال نوع نسبة العمولة',
        ]);

        OwnerPercentage::create([
            'name' => User::where('type', 'admin')->first()->name,
            'percentage' => $request->percentage,
            'type' => $request->type,
        ]);

        session()->flash('Add', 'تم اضافة نسبة العمولة بنجاح ');
        return back();
    }


    public function update(Request $request, $id)
    {
        // $percentage = $request->validate([
        //     'percentage' => 'required|numeric|unique:owner_percentages',
        //     'type' => 'required',
        // ],[
        //     'percentage.required' =>'يرجي ادخال اسم رقم العمولة',
        //     'percentage.unique' =>'نسبة العمولة مسجلة مسبقا',
        //     'percentage.numeric' =>'نسبة العمولة يجب أن تكون رقم',
        //     'type.required' =>'يرجي ادخال نوع نسبة العمولة',
        // ]);

        $percentage = OwnerPercentage::find($id);
        $percentage->name = User::where('type', 'admin')->first()->name;
        $percentage->percentage = $request->percentage;
        $percentage->type = $request->type;
        $percentage->save();

        session()->flash('Edit', 'تم تعديل نسبة العمولة بنجاح ');
        return back();
    }


    public function destroy(Request $request, $id)
    {
        OwnerPercentage::find($id)->delete();
        session()->flash('Delete' , 'تم حذف نسبة العمولة بنجاج');
        return back();
    }
}

