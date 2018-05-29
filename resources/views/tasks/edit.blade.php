@extends('layouts.app')

@section('content')

       <h1>id: {{ $task->id }}のタスク編集ページ</h1> 
       
       {!! Form::model($task, ['route' => ['tasks.update', $task->id], 'task' => 'put']) !!}
       
              {!! Form::label('content', 'タスク') !!}
              {!! Form::text('content') !!}
              
              {!! Form::submit('更新') !!}
       
       {!! Form::close() !!}

@endsection