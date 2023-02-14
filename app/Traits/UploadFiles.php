<?php

namespace App\Traits;


use PhpParser\Node\Stmt\Foreach_;

trait UploadFiles
{
    function customerUploadFile($name,$file,$location)
    {
            // Get filename with the extension
            $filenameWithExt = $file->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $file->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $name . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $file->storeAs('public/upload/customer/'.$location, $fileNameToStore);
            return $fileNameToStore;
    }
    function sellerUploadFile($name,$file,$location)
    {
        // Get filename with the extension
        $filenameWithExt = $file->getClientOriginalName();
        //Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $file->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $name . '_' . time() . '.' . $extension;
        // Upload Image
        $path = $file->storeAs('public/upload/seller/'.$location, $fileNameToStore);
        return $fileNameToStore;
    }
    function sellerUploadmultiFile($name,$files,$location)
    {
        $i =0;
        $fileNameStored = [];
        foreach($files as $file){
            // Get filename with the extension
            $filenameWithExt = $file->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $file->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $name .$i. '_' . time() . '.' . $extension;
            // Upload Image
            $path = $file->storeAs('public/upload/seller/'.$location, $fileNameToStore);

            $fileNameStored[] = $fileNameToStore;
            $i++;
        }
        return  $fileNameStored;

    }
    function ProductUploadOneFile($name,$file,$location)
    {
        // Get filename with the extension
        $filenameWithExt = $file->getClientOriginalName();
        //Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $file->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $name . '_' . time() . '.' . $extension;
        // Upload Image
        $path = $file->storeAs('public/upload/product/'.$location, $fileNameToStore);
        return $fileNameToStore;
    }
    function ProductUploadmultiFile($name,$files,$location)
    {
        $i =0;
        $fileNameStored = [];
        foreach($files as $file){
            // Get filename with the extension
            $filenameWithExt = $file->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $file->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $name .$i. '_' . time() . '.' . $extension;
            // Upload Image
            $path = $file->storeAs('public/upload/product/'.$location, $fileNameToStore);

            $fileNameStored[] = $fileNameToStore;
            $i++;
        }
        return  $fileNameStored;

    }
    function serviceUploadFile($name,$file,$location)
    {
        // Get filename with the extension
        $filenameWithExt = $file->getClientOriginalName();
        //Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $file->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $name . '_' . time() . '.' . $extension;
        // Upload Image
        $path = $file->storeAs('public/upload/service/'.$location, $fileNameToStore);
        return $fileNameToStore;
    }
    function orderUploadFile($name,$file,$location)
    {
        // Get filename with the extension
        $filenameWithExt = $file->getClientOriginalName();
        //Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $file->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $name . '_' . time() . '.' . $extension;
        // Upload Image
        $path = $file->storeAs('public/upload/order/'.$location, $fileNameToStore);
        return $fileNameToStore;
    }
    function orderUploadmultiFile($name,$files,$location)
    {
        $i =0;
        $fileNameStored = [];
        foreach($files as $file){
            // Get filename with the extension
            $filenameWithExt = $file->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $file->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $name .$i. '_' . time() . '.' . $extension;
            // Upload Image
            $path = $file->storeAs('public/upload/order/'.$location, $fileNameToStore);

            $fileNameStored[] = $fileNameToStore;
            $i++;
        }
        return  $fileNameStored;

    }


}
