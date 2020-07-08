<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
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
        $task->cust_name = $req->customer_name;
        $task->priority = $req->priority;
        $task->save();
        return redirect('/');
    }

    public function index(){
        $tasksActive = Task::where('status',0)->orWhere('status',3)->get();
        $tasksSubmit = Task::where('status',1)->get();
        return view('home',compact('tasksActive','tasksSubmit'));
    }

    public function showTasksDone(){
        $tasksDone = Task::where('status',2)->get();
        return view('tasks-done',compact('tasksDone'));
    }

    public function showTasksDeleted(){
        $tasksDeleted = Task::where('status',9)->get();
        return view('tasks-deleted',compact('tasksDeleted'));
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

    public function taskdelete($id){
        $task = Task::find($id);
        $task->status = 9;
        $task->update();
        return redirect('/');
    }
}
