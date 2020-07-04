<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Task Management</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


  </head>
  <body>
      <div class="container">
        <h1>Task Management</h1>

      <form method="POST" action="task/save">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-10">
                <label for="task_name">Task Name</label>
                <input type="text" name="task_name" class="form-control" id="task_name" placeholder="Task name">
                </div>
                <div class="form-group col-md-2">
                    <label for="exampleFormControlSelect1">Priority</label>
                    <select class="form-control" name="priority" id="exampleFormControlSelect1">
                        <option value="1">Low</option>
                        <option value="2">Medium</option>
                        <option value="3">High</option>
                        <option value="4">Urgent</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                  </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <!-- On rows -->
            <h2 class=" mt-5">Task List</h2>

            <table class="table text-center">
                <th>Id</th>
                <th>Task Name</th>
                <th>Priority</th>
                <th>Description</th>
                <th>Action</th>
                @foreach ($tasks as $task)
                    @if ($task->status == 0)
                        <tr class="bg-light">
                        @php
                            $status = "Pending";
                        @endphp
                    @elseif ($task->status == 1)
                    <tr class="bg-primary">
                        @php
                            $status = "Submit";
                        @endphp
                    @elseif ($task->status == 2)
                    <tr class="bg-success">
                        @php
                            $status = "Done";
                        @endphp
                    @elseif ($task->status == 3)
                    <tr class="bg-warning">
                        @php
                            $status = "CP";
                        @endphp
                    @elseif ($task->status == 4)
                    <tr class="bg-info">
                        @php
                            $status = "HB";
                        @endphp
                    @endif
                    <td class="h4">{{$task->id}}</td>
                    <td class="h4">{{$task->task_name}}</td>
                    <td class="h4">{{$task->priority}}</td>
                    <td class="h4">{{$task->description}}</td>
                    <td>
                        @if  ($task->status == 1)
                            <form action="task/download" method="GET">
                                <div class="form-row">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$task->id}}" />
                                    <button type="submit" class="btn btn-danger col-md-4 mr-2">Download</button>
                                    <button type="button" class="btn btn-dark col-md-4"><a href="/task/done/{{$task->id}}">Done</a></button>
                                </div>
                            </form>
                        @elseif ($task->status == 2)
                        <a href="/task/revisi/{{$task->id}}"><button type="button" class="btn btn-danger col-md-8">Revisi</button></a>

                        @else
                            <form action="task/upload" method="POST" enctype="multipart/form-data">
                                <div class="form-row col-md-12">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$task->id}}" />
                                    <input type="file" name="file_upload" class="form-control col-md-6 mr-2 " />
                                    <button type="submit" class="btn btn-dark col-md-4">Submit</button>
                                </div>
                            </form>
                        @endif
                    </td>
                @endforeach
                </tr>
            </table>

      </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
