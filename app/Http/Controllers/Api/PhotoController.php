<?php
namespace App\Http\Controllers\Api;
use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Api\ApiResponseTrait;

class photoController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        try{
            $photos = Photo::get();
            foreach ($photos as $photo) {
                $photo->photo =  asset('assets/images/photo/'.$photo->photo);
            }
            return $this->returnData(200, 'Photos Returned Successfully', $photos);
        }catch(\Exception $e){
            return $this->returnError(400, 'Photos Returned Failed');
        }
    }





    public function createPhoto(Request $request)
    {
        try {
            $request->validate([
                'photo' => 'required',
                'name' => 'required',
                'description' => 'required',
                'price' => 'required',
                'camera_brand' => 'required',
                'lens_type' => 'required',
                'size_width' => 'required',
                'size_height' => 'required',
                'size_type' => 'required',
                'location' => 'nullable',
            ]);

            $file_extension = $request->file("photo")->getCLientOriginalExtension();
            $photo_name = time(). "." .$file_extension;
            $request->file("photo")->move(public_path('assets/images/photo/'), $photo_name);

            $photo = Photo::create([
                "freelancer_id" => auth()->user()->id,
                "photo" => $photo_name,
                "name" => $request->name,
                "description" => $request->description,
                "price" => $request->price,
                "camera_brand" => $request->camera_brand,
                "lens_type" => $request->lens_type,
                "size_width" => $request->size_width,
                "size_height" =>$request->size_height,
                "size_type" => $request->size_type,
                "location" => $request->location,
            ]);
            $photo->photo =  asset('assets/images/photo/'.$photo->photo);
            return $this->returnData(201, 'Photo Created Successfully', $photo);

        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Photo Created Failed');
        }
    }




    public function show($id)
    {
        
      
        $photo = Photo::where('id',$id)->with(['likes'])->first();
        if(!$photo){
            return $this->returnError('404', 'Photo Not Found');
        }
        $photo->photo =  asset('assets/images/photo/'.$photo->photo);
        return $this->returnData(200, 'Photo Returned Successfully', $photo);
    }



    public function update(Request $request, $id)
    {
        try {
            $photo = Photo::find($id);
            if(!$photo)
                return $this->returnError('404', 'Photo Not Found');

            $photo->update($request->all());
            return $this->returnData(200, 'Photo Updated Successfully', $photo);
        }catch(\Exception $e){
            echo $e;
            return $this->returnError('404', 'Photo Not Found');
        }
    }



    public function destroy($id)
    {
        try {
        $photo = Photo::find($id)->delete();
        if(!$photo){
            return $this->returnError('404', 'Photo Not Found');
        }
            return $this->returnSuccess(200, 'Photo Deleted Successfully');
        }catch(\Exception $e){
            echo $e;
            return $this->returnError('404', 'Photo Not Found');
        }
    }



    public function addOrRemovePhotoLikes(Request $request, $id)
    {
        try{
            $flag = false;
            $action = "append";
            $photo = Photo::findOrFail($id);

        if($photo->likes->where("user_id", auth()->user()->id)->count() == 0){
            $photo->likes()->create([
                "user_id" => auth()->user()->id,
                "type" => "photo",
            ]);
            $action = "add";
        }else{
            $photo->likes()->where("user_id", auth()->user()->id)->delete();
            $action = "delete";
            return $this->returnSuccess(200, 'Remove Like Successfully');
            }
        $flag = true;
            return $this->returnSuccess(200, 'Add Like Successfully');
        }catch(\Exception $e){
            echo $e;
            return $this->returnSuccess(400, 'There is an error');
        }
    }
}
