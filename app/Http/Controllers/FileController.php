<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{
    public function view(Request $request)
    {
        if (backpack_user()) {
            if ($request->has('path')) {
                $path = $request->query('path');
                $full_path = storage_path().'/app/'.$path;
    
                if (file_exists($full_path)) {
                    return response()->file($full_path);
                } else {
                    return abort('404');
                }
            } else {
                return abort('403');
            }
        } else {
            return abort('403');
        }
    }
}
