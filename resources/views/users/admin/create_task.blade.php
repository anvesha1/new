<!-- resources/views/users/admin/create_task.blade.php -->

<div class="container">
    <h1 style="text-align: center" class="mt-4">Create Task</h1>

    <div class="container">
        <div class="row justify-content-center">
            <form action="{{ route('users.admin.task.submit') }}" method="POST" class="col-md-6 text-center">
                @csrf
                <div class="form-group">
                    <label for="task_heading">Task Heading</label>
                    <input type="text" name="heading" class="form-control" id="task_heading"
                           placeholder="Task Heading" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description"
                              placeholder="Task Description" required></textarea>
                </div>

                <div class="form-group">
                    <label for="priority">Priority</label>
                    <input type="text" name="priority" class="form-control" id="priority"
                           placeholder="Task Priority" required>
                </div>

                <div class="form-group">
                    <label for="due_date">Due Date</label>
                    <input type="date" name="due_date" class="form-control" id="due_date" required>
                </div>

                <button type="submit" class="btn btn-primary mx-auto" style="width: 150px;">Submit</button>
            </form>
        </div>
    </div>

    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">S.N</th>
            <th scope="col">Task Heading</th>
            <th scope="col">Status</th>
            <th scope="col">Created At</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @php
            $i=1;
        @endphp
        @foreach ($tasks as $data )
            @if ($data->status == 'pending')
                <tr>
                    <th>{{$i++}}</th>
                    <td>{{$data->task_heading}}</td>
                    <td>{{$data->status}}</td>
                    <td>{{$data->created_at}}</td>
                    <td>
                        <form action="{{ route('users.admin.task.delete', $data->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>


                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>
