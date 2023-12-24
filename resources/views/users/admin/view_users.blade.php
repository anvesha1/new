<div class="container">
    <h1 style="text-align: center" class="mt-4">User List</h1>

    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">S.N</th>
            <th scope="col">UserName</th>
            <th scope="col">Email</th>
        </tr>
        </thead>
        <tbody>
        @php
            $i=1;
        @endphp
        @foreach ($users as $data )
            <tr>
                <th>{{$i++}}</th>
                <td>{{$data->name}}</td>
                <td>{{$data->email}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

