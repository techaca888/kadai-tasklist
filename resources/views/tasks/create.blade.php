@extends('layouts.app')

@section('content')

    <h1>タスク新規追加ページ</h1>
    
    {!! Form::model($task, ['route' => 'tasks.store']) !!}
    
        {!! Form::label('content', 'タスク:') !!}
        {!! Form::text('content')  !!}
        
        {!! Form::label('status', 'ステータス:') !!}
        {!! Form::select('status', array('Complete' => 'Complete', 'Incomplete' => 'Incomplete'), 'Incomplete'); !!}
        
        {!! Form::submit('追加') !!}
    
    {!! Form::close() !!}

@endsection