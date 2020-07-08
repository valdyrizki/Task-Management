@extends('template.master')
@section('title', 'Task Deleted')

@section('content')
    @include('template.task-list', ['tasks' => $tasksDeleted,'title' => 'Task Deleted','idTable' => 'tableDeleted','orderBy' => 'DESC'])
@stop
