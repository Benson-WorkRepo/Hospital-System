@extends('admindashboard')
@section('title', 'Admin Login')
@section('content')

<div class = "logindocSection">
<form action = "{{route('adminlogin.post')}}" method = "POST" style = "width: 600px">
@csrf
<div class="idSection">
<label for="workID">Work ID</label><br>
  <input type="text" id="workID" name="workID">
  </div>

  <div class="passwordSection">
    <label for="inputPassword" class="form-label">Password</label>
    <input type="password" class="form-control" id="inputPassword" name="password">
  </div>
  <button type="submit" class="submitButton">Submit</button>
</form>
    </div>
@endsection