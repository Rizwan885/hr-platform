<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div> 

     <h1>{{ $data->name }}</h1>
     <h1>{{ $data->email }}</h1>
     <h1>{{ $data->degree}}</h1>
   <br>
     <img src="{{ $data->avatar }}" alt="avatar" width="100" height="100">        
    </div>
  <br><br>
    <form action="{{ route('post_linked') }}" method="POST">
               @csrf
      <input type="submit" value="postjob">
    </form>

    {{-- indeed --}}

    {{-- @if (Session::has('username'))

     <h1>Username: <span style="color:red;">{{Session::get('username') }}</span> </h1>
      
    @endif --}}


    {{-- indeed --}}
   
</body>
</html>