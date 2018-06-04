<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        if ( \Auth::check()){
            $user = \Auth::user();
            $microposts = $user->tasks()->orderBy('created_at', 'desc');
            
            $data = [
                'user' => $user,
                'tasks' => $user->tasks,
            ];
            // $data += $this->counts($user);
            return view('tasks.index', $data);
        }else{
            return view('tasks.index');
        }
        
        // $tasks = Task::all();
        
        // return view('tasks.index', [
        //     'tasks' => $tasks,
        //     ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task;
        
        return view('tasks.create', [
                'task'  => $task,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                'status' => 'required|max:10',
                'content' => 'required|max:191',
            ]);
            
        $request->user()->tasks()->create([
                'content' => $request->content,
                'status' => $request->status,
            ]);
            
        // $task = new Task;
        // $task->status = $request->status;
        // $task->content = $request->content;
        // $task->user_id = $request->user()->user_id;
        // $task->save();
        
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        $user = \Auth::user();
        if ($user == $task->user){
            
        return view('tasks.show', [
                'task' => $task,
            ]);
        }else{
            return redirect("/");
        }
            
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
    
        return view('tasks.edit' , [
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $this->validate($request, [
                'status' => 'required|max:10',
                'content' => 'required|max:191',
            ]);
        
        $task = Task::find($id);
         $user = \Auth::user();
        if ($user == $task->user){
        $task->status = $request->status;
        $task->content = $request->content;
        $task->save();
        }
        
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
         $user = \Auth::user();
        if ($user == $task->user){
            $task->delete();
        }
        return redirect('/');
    }
}
