<?php
namespace App\Utils; 

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class Image{

    // اسم الصوره
    public function genarateImageName($image){
        $file_name = Str::uuid() . time() . '.' . $image->getClientOriginalExtension();
        return $file_name;
    }

    // store new image in local
    public function storeImageInLocal($image , $path, $file_name , $disk){
        // $path =  $image->storeAs('uploads/posts',$file,['disk'=>'uploads']);
        $image->storeAs($path , $file_name , ['disk'=>$disk] );

    }

    public function uploadSingleImage($path , $image , $disk){
        // اسم الصوره
        $file_name = $this->genarateImageName($image);

        // store new image in local
        self::storeImageInLocal($image , $path , $file_name , $disk);
        return $file_name;
    }

    public function uploadImages($images , $modal ,$disk){

        foreach ($images as $image) {
            // اسم الصوره
            $file_name = $this->genarateImageName($image);
            $this->storeImageInLocal($image , '/' , $file_name , $disk);

            $modal->images()->create([
                'file_name'=>$file_name,
            ]);
        }
    }

    public function deleteImageFromLocal($image_path){
        // هل مسار الصوره موجود 
        if(File::exists(public_path($image_path))){ // 
            File::delete(public_path($image_path));
        }
    }

}



