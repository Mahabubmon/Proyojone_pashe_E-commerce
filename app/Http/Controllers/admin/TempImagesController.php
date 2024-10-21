<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Image;

class TempImagesController extends Controller
{
    //

     /**
 * 
 * @author Mahabub Mon<mahabubmon@gmail.com>
 */
    public function create(Request $request)
    {
        $image = $request->image;

        if (!empty($image)) {
            $ext = $image->getClientOriginalExtension();
            $newName = time() . "." . $ext;

            $temImage = new TempImage();
            $temImage->name = $newName;
            $temImage->save();

            $image->move(public_path() . '/temp', $newName);


            // Generate thumbnel
            $sourcePath = public_path() . '/temp/' . $newName;
            $destPath = public_path() . '/temp/thumb/' . $newName;

            $image = Image::make($sourcePath);
            $image->fit(300, 275);
            $image->save($destPath);

            return response()->json([
                'status' => true,
                'image_id' => $temImage->id,
                'ImagePath' => asset('/temp/thumb/' . $newName),
                'message' => 'Image uploaded successfully'
            ]);
        }









        // if ($request->image) {

        //     $image = $request->image;
        //     $extenstion = $image->getClientOriginalExtension();
        //     $newFileName = time() . "." . $extenstion;


        //     $temImage = new TempImage();
        //     $temImage->name = $newFileName;
        //     $temImage->save();

        //     $image->move(public_path() . '/temp', $newFileName);


        //     return response()->json([
        //         'status' => true,
        //         'name' => $newFileName,
        //         'id' => $temImage->id
        //     ]);
        // }
    }

}
