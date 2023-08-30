<?php
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Str ;
use Illuminate\Support\Facades\File;

if (!function_exists('uploadImage')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function uploadImage($photo, $folder, $name)
    {
        $file_name = Str::slug($name).".".$photo->getClientOriginalExtension();
            $path = public_path('/images/'.$folder.'/' .$file_name);
            Image::make($photo->getRealPath())->resize(500,null,function($constraint){
                $constraint->aspectRatio();
            })->save($path,100);
            return $file_name;
    }


    function UnlinkImage($folder, $name, $value){
        if(File::exists('images/'.$folder.'/'.$name) && $name) {
            unlink('images/'.$folder.'/'.$name);
            $name = null ;
            $value->save();
        }

    }
}
