<?php
namespace App\Http\Controllers\admin;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutUsController extends Controller
{
    public function index()
    {
        $infos = AboutUs::all();
        return view('Admin.parts.about_us', compact('infos'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'paragraph' => 'required|unique:about_us|min:50',
        ],[
            'paragraph.required' => 'يجب ادخال معلومات عن الموقع',
            'paragraph.unique' => 'معلومات الموقع التي ادخلتها موجوده سابقا',
            'paragraph.min' => 'يجب ادخال اكثر من 50 حرف لمعلومات الموقع',
        ]);

        $data = $request->only('paragraph');
        AboutUs::create($data);

        session()->flash('Add', 'تم اضافة معلومات الموقع بنجاح ');
        return back();
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'paragraph' => 'required|unique:about_us|min:50',
        ]);

        $data = $request->only('paragraph');
        AboutUs::find($id)->update($data);

        session()->flash('Edit', 'تم تعديل معلومات الموقع بنجاح ');
        return back();
    }

    public function destroy(Request $request, $id)
    {
        AboutUs::find($id)->delete();

        session()->flash('Delete', 'تم حذف معلومات الموقع بنجاح ');
        return back();
    }
}
