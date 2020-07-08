@extends('template.master')
@section('title', 'Task Done')

@section('content')
    <!-- On rows -->
    @include('template.task-list', ['tasks' => $tasksDone,'title' => 'Task Done','idTable' => 'tableDone','orderBy' => 'DESC'])
@stop
