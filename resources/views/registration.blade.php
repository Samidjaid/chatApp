@extends ('layout')
@section('content')

<div class="container" style="width: 50%;">

<form action="{{route('registerPost')}}" method="POST">
 @csrf
    <div class="mb-3">
        <label class="form-label">Firstname</label>
        <input type="text" class="form-control" name="firstname">
      </div>
      <div class="mb-3">
        <label class="form-label">Lastname</label>
        <input type="text" class="form-control" name="lastname">
      </div>
    <div class="mb-3">
      <label class="form-label">Email address</label>
      <input type="email" class="form-control" aria-describedby="emailHelp" name="email">
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" class="form-control" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
  </form>

</div>
    
@endsection