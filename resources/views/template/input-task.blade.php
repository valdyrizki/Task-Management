<form method="POST" action="/task/save">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
        <label for="task_name">Task Name</label>
        <input type="text" name="task_name" class="form-control" id="task_name" placeholder="Task name">
        </div>
        <div class="form-group col-md-4">
            <label for="task_name">Customer Name</label>
            <input type="text" name="customer_name" class="form-control" id="customer_name" placeholder="Customer name">
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
