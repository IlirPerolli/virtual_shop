<div class="container" style="margin-top:150px">
<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Emri</th>
        <th scope="col">Mbiemri</th>
        <th scope="col">username</th>
        <th scope="col">email</th>
        <th scope="col">Opsionet</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
    <tr>
        <th scope="row">{{$user->id}}</th>
        <td>{{$user->name}}</td>
        <td>{{$user->surname}}</td>
        <td>{{$user->username}}</td>
        <td>{{$user->email}}</td>
        <td> <form action="{{route('user.destroy', $user->slug)}}" method="POST" style="display: inline-block;margin:5px">
                @csrf
                @method('delete')
                <button class="genric-btn danger-border circle" type="submit" >Fshij profilin</button>
            </form></td>
    </tr>
    @endforeach

    </tbody>
</table>
</div>
