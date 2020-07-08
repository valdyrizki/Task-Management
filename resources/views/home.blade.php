@extends('template.master')
@section('title', 'Task Management')

@section('content')

        @include('template.input-task')
        <!-- On rows -->
        @include('template/task-list', [
            'tasks' => $tasksActive,
            'title' => 'Task Aktif',
            'idTable' => 'tableActive',
            'orderBy' => 'ASC'])

        @include('template/task-list', [
            'tasks' => $tasksSubmit,
            'title' => 'Task Selesai',
            'idTable' => 'tableDone',
            'orderBy' => 'desc'])
@stop
