<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PhotoController extends Controller
{
    public function index()
    {
        $photos=Photo::where("freelancer_id",auth()->user()->id)->get();
        return view("freelancer.showphotos",compact("photos"));
    }

    public function create()
    {
        return view("freelancer.addphoto");
    }


    public function store(Request $request)
    {
        $request->validate([
            "photo"=>['required','image',"max:200"],
            "name"=>['required'],
            "description"=>['required'],
            "camerabrand"=>['nullable'],
            "lens"=>['nullable'],
            "sizewidth"=>['required','numeric'],
            "sizeheight"=>['required',"numeric"],
            "sizetype"=>['required'],
            "location"=>['nullable'],
        ]);

        $file_extention = $request->file("photo")->getCLientOriginalExtension();
        $photo_name=time(). ".".$file_extention;
        $request->file("photo")->move(public_path('assets/images/photo/'),$photo_name);
        $photo=Photo::create([
            "name"=>$request->name,
            "freelancer_id"=>auth()->user()->id,
            "description"=>$request->description,
            "camera_brand"=>$request->camerabrand,
            "lens_type"=>$request->lens,
            "size_width"=>$request->sizewidth,
            "size_height"=>$request->sizeheight,
            "size_type"=>$request->sizetype,
            "location"=>$request->location,
            "photo"=>$photo_name
        ]);

        toastr()->success("create susseccfully");
        return redirect()->route('freelanc.photo.index'); 
       }


    public function show(Photo $photo)
    {
        return view("freelancer.photo",compact('photo'));
    }


    public function edit(Photo $photo)
    {
        return view("freelancer.editphoto",compact("photo"));
    }

    public function update(Request $request, Photo $photo)
    {

      
        $request->validate([
            "photo"=>['nullable',"image","max:200"],
            "name"=>['required'],
            "description"=>['required'],
            "camerabrand"=>['nullable'],
            "lens"=>['nullable'],
            "sizewidth"=>['required','numeric'],
            "sizeheight"=>['required',"numeric"],
            "sizetype"=>['required'],
            "location"=>['nullable'],
        ]);


        $photo_name=$photo->photo;
        if($request->hasFile("photo")) {
            $file_extention=$request->file("photo")->getCLientOriginalExtension();
            $photo_name=time(). ".".$file_extention;
            $request->file("photo")->move(public_path('assets/images/photo/'),$photo_name);
        }

        $photo->update([
            "name"=>$request->name,
            "description"=>$request->description,
            "camera_brand"=>$request->camerabrand,
            "lens_type"=>$request->lens,
            "size_width"=>$request->sizewidth,
            "size_height"=>$request->sizeheight,
            "size_type"=>$request->sizetype,
            "location"=>$request->location,
            "photo"=>$photo_name,
        ]);

        
        return redirect()->route("freelanc.photo.show",compact("photo"));
    }


    public function destroy($id)
    {

        $photo=Photo::where('freelancer_id',auth()->user()->id)->where('id',$id);
        $f=$photo->delete();
        if(!$f){
            toastr()->error("Photo Not Found");
            return redirect()->back();
        }
        $photo->delete();
        toastr()->success("deleted susseccfully");
        return redirect()->route("freelanc.photo.index");
    }

   
    public function showPhoto(Request $request, $id)
    {
        $photo = Photo::where('id',$id)->first();
    
        $freelancer = User::find($photo->freelancer_id);

        // $similar=Photo::where(function($q) use($photo){
        //     $q->where('name','LIKE', '%'. $photo->name.'%')->orWhere("location",'LIKE', '%'. $photo->location.'%');
        // })->limit(4)->get();

        $similar=Photo::all();
        return view('visitor.photo', compact('freelancer', 'photo', "similar"));
    }


}
