<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Str;
use App\Models\Field;
use App\Models\Job;
use App\Models\Degree;
use App\Models\Region;
use App\Models\Department;
use App\Models\Target;
use App\Models\State;

class CustomController extends Controller
{
    public function copy($id, $client)
    {
        if (backpack_user()) {
            $application = Application::findOrFail($id);

            $resumes = [];
            $documents = [];

            $clone = $application->duplicate();
            
            $clone->user_id = $client;

            $clone->save();

            if (count((array)$application->resume)) {
                foreach ((array)$application->resume as $file_path) {
                    $uuid = (string) Str::uuid();
                    $extension = (string) pathinfo($file_path, PATHINFO_EXTENSION);
                    $path = 'copy/resumes/'.$uuid.'.'.$extension;
                    \Storage::disk('local')->copy($file_path, $path);
                    array_push($resumes, $path);
                }
            }

            if (count((array)$application->documents)) {
                foreach ((array)$application->documents as $file_path) {
                    $uuid = (string) Str::uuid();
                    $extension = (string) pathinfo($file_path, PATHINFO_EXTENSION);
                    $path = 'copy/documents/'.$uuid.'.'.$extension;
                    \Storage::disk('local')->copy($file_path, $path);
                    array_push($documents, $path);
                }
            }

            $clone->setResumeAttribute($resumes, true);
            $clone->setDocumentsAttribute($documents, true);

            $clone->save();

            return $clone;
        } else {
            return abort('403');
        }
    }

    public function create(Request $request)
    {
        if (!$this->checkFiles($request)) { 
            return Back(); 
        }

        $application = new Application();

        $application->name = $request->firstname . ' ' . $request->lastname;
        $application->email = $request->email;
        $application->comment = $request->ref;

        // one to many relations

        $application->degree()->associate(Degree::where('id', $request->degree)->first());
        $application->field()->associate(Field::where('id', $request->field)->first());
        $application->job()->associate(Job::where('id', $request->job)->first());
        $application->region()->associate(Region::where('id', $request->region)->first());
        $application->department()->associate(Department::where('id', $request->department)->first());
        $application->state()->associate(State::where('name', 'Nouveau')->first());

        $application->save();

        // many to many relations 

        $application->targets()->attach($request->target);

        $application->save();

        $resumes = [];
        $documents = [];

        $cvPath = 'resumes/' . Str::uuid() . '.pdf';
        \Storage::disk('local')->put($cvPath, file_get_contents($request->file('cv')->getRealPath()));
        array_push($resumes, $cvPath);

        if ($request->hasFile('letter')) {
            $docPath = 'documents/' . Str::uuid() . '.pdf';
            \Storage::disk('local')->put($docPath, file_get_contents($request->file('letter')->getRealPath()));
            array_push($documents, $docPath);
        }
        
        $application->setResumeAttribute($resumes, true);
        $application->setDocumentsAttribute($documents, true);

        $application->save();

        $request->session()->flash('success', 'Merci, votre candidature a bien été envoyée.');

        return Back();
    }

    private function checkFiles($request)
    {
        if ($request->hasFile('cv') && $request->file('cv')->isValid())
        {
            if ($request->cv->extension() != 'pdf')
            {
                $request->session()->flash('error', "Le CV n'est pas au format pdf.");
                return false;
            }

            if (\Validator::make($request->all(), ['cv' => 'max:5120'])->fails())
            {
                $request->session()->flash('error', 'Le CV est trop lourd.');
                return false;
            }

            if ($request->hasFile('lettre') && $request->file('lettre')->isValid())
            {
                if ($request->lettre->extension() != 'pdf')
                {
                    $request->session()->flash('error', "La lettre n'est pas au format pdf.");
                    return false;
                }

                if (\Validator::make($request->all(), ['lettre' => 'max:5120'])->fails())
                {
                    $request->session()->flash('error', 'La lettre est trop lourde.');
                    return false;
                }
            }

            return true;
        }
        else
        {
            $request->session()->flash('error', 'Désolé, un problème est survenu.');
            return false;
        }
    }
}
