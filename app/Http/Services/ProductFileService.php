<?php

namespace App\Http\Services;

use App\Http\Requests\Products\StoreRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductFileService
{

    public function storeRequestFile(StoreRequest $request)
    {
        if (!$request->hasFile('photo'))
            return '';

        $file = $request->file('photo');
        $hashDirectory = $file->hashName();
        $hashDirectoryName = Str::of($hashDirectory)->before('.');
        $file->move(public_path() . '/uploads/products/'. $hashDirectoryName, 
            $file->getClientOriginalName()
        );
        // $url = Storage::path($hashDirectoryName . '/' . $file->getClientOriginalName());
        // dd($url);
        return $hashDirectoryName . '/' . $file->getClientOriginalName();

        
        return $request->photo->storeAs(
            '/public/uploads/products/' . $hashDirectoryName,
            $file->getClientOriginalName()
        );
        
    }
}
