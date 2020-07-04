<?php

namespace App\Http\Controllers;

use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function store(Request $req){
        $task = new Task();
        $task->task_name = $req->task_name;
        $task->status = 0;
        $task->description = $req->description;
        $task->priority = $req->priority;
        $task->save();
        return redirect('/');

    }

    public function index(){
        $tasks = Task::orderBy('id', 'DESC')->get();
        return view('home',compact('tasks'));
    }

    public function upload(Request $req){
        $filename  = $req->file_upload;
        $file = $req->file('file_upload');
        $mytime = Carbon::now();

        if($file){
            // Save to disk
            Storage::putFile('file', $file);
            // Rename the Name
            Storage::move('file/'.$file->hashName(), 'file/'.$req->id.'-'.$mytime->toDateString().'-'.$file->getClientOriginalName());
        }

        $task = Task::find($req->id);
        $task->status = '1';
        $task->file = 'file/'.$req->id.'-'.$mytime->toDateString().'-'.$file->getClientOriginalName();
        $task->update();

        return redirect('/');
    }

    public function getFile(Request $req){
        $task = Task::find($req->id);
        $file = $task->file;
        return response()->download($file);
    }

    public function taskdone($id){
        $task = Task::find($id);
        $task->status = 2;
        $task->update();
        return redirect('/');
    }

    public function taskrevisi($id){
        $task = Task::find($id);
        $task->status = 3;
        $task->update();
        return redirect('/');
    }
}
