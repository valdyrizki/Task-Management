<h2 class="mt-5">{{$title}}</h2>
<table id="{{$idTable}}" class="table table-striped table-bordered text-center display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Task Name</th>
                            <th>Priority</th>
                            <th>Customer</th>
                            <th>Description</th>
                            @if ($idTable != 'tableActive')
                            <th >File</th>
                            @endif
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            @if ($task->status == 0)
                                <tr class="bg-light">
                            @elseif ($task->status == 1)
                            <tr class="bg-primary">
                            @elseif ($task->status == 2)
                            <tr class="bg-success">
                            @elseif ($task->status == 3)
                            <tr class="bg-warning">
                            @elseif ($task->status == 4)
                            <tr class="bg-info">
                            @elseif ($task->status == 9)
                            <tr class="bg-info">
                            @endif
                            <td >{{$task->id}}</td>
                            <td >{{$task->task_name}}</td>
                            <td >{{getPriority($task->priority)}}</td>
                            <td >{{$task->cust_name}}</td>
                            <td >{{$task->description}}</td>
                            @if ($idTable != 'tableActive')
                            <td>
                                <a href="/task/download/{{$task->id}}" style="color: #anycolor !important;text-decoration:none" class="col-md-5 col-sm-12 mr-2">

                                    <button type="button" class="btn btn-danger">
                                            {{$task->file}}
                                    </button>
                                </a>
                            </td>
                            @endif

                            @if  ($task->status == 1)

                                <td>
                                    <div class="form-row">
                                        <a href="/task/download/{{$task->id}}" class="col-md-5 col-sm-12 mr-2">
                                            <button type="button" class="btn btn-danger">
                                                Download
                                            </button>
                                        </a>

                                        <a href="/task/done/{{$task->id}}" class=" col-md-5 col-sm-12">
                                            <button type="button" class="btn btn-dark">
                                                Done
                                            </button>
                                        </a>
                                    </div>
                                </td>
                            {{-- @elseif ($task->status == 2)
                            <td>
                                <a href="/task/revisi/{{$task->id}}" class="col-md-5 col-sm-12 mr-2"><button type="button" class="btn btn-warning col-md-4">Revisi</button></a>
                                <a href="/task/delete/{{$task->id}}" class="col-md-5 col-sm-12"><button type="button" class="btn btn-danger col-md-4">Delete</button></a>
                            </td> --}}
                            @else
                            <form action="/task/upload" method="POST" enctype="multipart/form-data">
                                <td>
                                    <div class="form-row col-md-12">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$task->id}}" />
                                        <input type="file" name="file_upload" class="form-control col-md-6 col-sm-12 " />
                                        <button type="submit" class="btn btn-dark col-md-2 col-sm-12">Submit</button>
                                        <a href="/task/delete/{{$task->id}}" class="col-md-2 col-sm-12"><button type="button" class="btn btn-danger">Delete</button></a>
                                    </div>
                                </td>
                            </form>
                            @endif

                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <script>
                    $(document).ready(function() {
                        $('#{{$idTable}}').DataTable( {
                            "order": [[ 0, '{{$orderBy}}' ]]
                        } );
                    } );
                </script>
