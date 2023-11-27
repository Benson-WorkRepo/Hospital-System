@extends('layout')
@section('title', 'Sign Up')
@section('content')

<div class = "signupSection">
@if ($errors->any())<div class="alert alert-danger"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach @endif
<form action = "{{route('signup.post')}}" method = "POST" style = "width: 600px"> //display validation messages
@csrf
<div class = "firstName">
    <label for>First Name</label><br>
    <input type ="text" id="firstName" name="firstName">
</div>
<div class = "lastName">
    <label for>Last Name</label><br>
    <input type ="text" id="lastName" name="lastName">
</div>
<div class = "emailAddress">
    <label for>Email</label><br>
    <input type ="text" id="emailAddress" name="emailAddress">
</div>
<div class = "phoneNo">
    <label for>Phone Number</label><br>
    <input type ="tel" id="phoneNo" name="phoneNo">
</div>
<div class="idSection">
<label for="idNumber">ID No</label><br>
  <input type="text" id="idNumber" name="ID">
  </div>

  <div class="passwordSection">
    <label for="inputPassword" class="form-label">Password</label>
    <input type="password" class="form-control" id="inputPassword" name="password">
  </div>
  <button type="submit" class="submitButton">Submit</button>
</form>
    </div>
@endsection