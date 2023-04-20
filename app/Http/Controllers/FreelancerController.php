<?php

namespace App\Http\Controllers;

use  Carbon\Carbon;
use App\Models\Photo;
use App\Models\Selled;
use App\Models\Product;
use Illuminate\Http\Request;

class FreelancerController extends Controller
{


    public function FreelancerFiles(){

        $user_id=auth()->user()->id;
        

        $currentYear = Carbon::now()->year; 
        $currentMonth = Carbon::now()->month;
        $lastMonth = Carbon::now()->subMonth()->month;

        
      $fc=Selled::where('user_id',$user_id)->whereMonth('created_at', $currentMonth)
        ->whereYear('created_at', $currentYear)->get();
        $files_current=[];
        foreach($fc as $f){
            foreach($f->file()->get() as $file){
               
                $files_current[]=$file;
              }
            
   
        }
      
     
        $files_lastmonth=[];
        $fl=Selled::where('user_id',$user_id)->whereMonth('created_at', $lastMonth)
        ->whereYear('created_at', $currentYear)
        ->get();
        foreach($fl as $f){
            foreach($f->file()->get() as $file){      
                $files_lastmonth[]=$file;
              }

        }
       
        $f0=Selled::where('user_id',$user_id)->whereNotBetween('created_at', [
                Carbon::createFromDate($currentYear, $lastMonth,1),
                Carbon::createFromDate($currentYear, $currentMonth,31)
            ])->get();
            $files_old=[];
        foreach($f0 as $f){
            foreach($f->file()->get() as $file){      
                $files_old[]=$file;
              }

        }
    
      
return view('freelancer.files',compact('files_current','files_lastmonth','files_old'));



    }


    public function FreelancerProfile(){
     
        $user_id=auth()->user()->id;
        $top_sell_name=[];
        $top_sell_total=[];
        $product_count=Product::where('freelancer_id',$user_id)->count();
        $photo_count=Photo::where('freelancer_id',$user_id)->count();
        //  $selled_top=Selled::all()->where(function($q) use($user_id) {
        //     return   $q->selledsable->where('freelancer_id',$user_id);
        //  })->sortByDesc(function($e) use($user_id){
        //     return $e->selledsable->count();
        //  })->take(5);
        
         $sell_top=Product::all()->where('freelancer_id',$user_id)->sortByDesc(function ($e){
            return $e->sells()->count();
        })->take(5);


        return view('freelancer.profile',compact('product_count','photo_count','sell_top'));

    }
}
