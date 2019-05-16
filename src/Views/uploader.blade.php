<h1>Upload</h1>
<hr>
<form action="{{url("uploader/upload")}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="text" name="title" placeholder="Enter File Title">
    <br><br>
    <input type="file" name="src">
    <br><br>
    <input type="submit" value="upload" name="upload">
</form>
<h3>
    @if($errors)
        @foreach($errors->errorFile->all() as $message)
            {{$message}}
            <br>
        @endforeach
    @endif
    @if(session("errorFile"))
        {{session("errorFile")}}
    @endif
</h3>
<hr>
<table border="1">
    <tr>
        <th>id</th>
        <th>src</th>
        <th>title</th>
        <th>del</th>
    </tr>
    @if(isset($files))
        @foreach($files as $value)
            <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->src}}</td>
                <td>{{$value->title}}</td>
                <td><a href="{{url("uploader/delete")}}/{{$value->id}}">delete</a></td>
            </tr>
        @endforeach
    @endif
</table>