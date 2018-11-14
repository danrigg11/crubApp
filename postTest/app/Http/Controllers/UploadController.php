<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller {

	public function upload(){

		if(Input::hasFile('file')){

			echo 'Uploaded';
			$file = Input::file('file');
			$file->move('uploads', $file->getClientOriginalName());
			echo '';
		}

	}

	public function deletePhoto($filename){
		Storage::disk('public')->delete('uploads/'.$filename);

		return redirect()->route('posts.index');
	}
}
