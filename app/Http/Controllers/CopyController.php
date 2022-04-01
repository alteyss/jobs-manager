<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;

class CopyController extends Controller
{
    public function copy($id, $client)
    {
        if (backpack_user()) {
            $application = Application::findOrFail($id);

            $clone = $application->duplicate();
            $clone->user_id = $client;
            $clone->save();

            return $clone;
        } else {
            return abort('403');
        }
    }
}
