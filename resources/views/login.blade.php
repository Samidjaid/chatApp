@extends ('layout')
@section('content')

<div class="container" style="width: 50%;">

    <div class="mt-5">
        @if ($errors->any())

         <div class="col-12">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
            @endforeach
         </div>
            
        @endif

        @if(session()->has('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
         @endif

         @if(session()->has('success'))
        <div class="alert alert-danger">{{session('success')}}</div>
         @endif
    </div>
    


<form action="{{route('loginPost')}}" method="POST">
    @csrf
    <div class="mb-3">
      <label class="form-label">Email address</label>
      <input type="email" class="form-control" aria-describedby="emailHelp" name="email">
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" class="form-control" name="password">
    </div>
    <div class="mb-3 form-check">
      <a href="{{route('register')}}">I don't have an account</a>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

</div>
    
@endsection