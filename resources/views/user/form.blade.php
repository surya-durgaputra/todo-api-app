@extends('layouts.app')

@section('content')
    <div class="text-center">
        <form class="form-user" id="form-user" method="POST">
            <h1 class="h3 mb-3 font-weight-normal">Create User</h1>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
            <label for="name" class="sr-only">Name</label>
            <input type="text" id="inputName" class="form-control" placeholder="First name" required>
            <label for="lastName" class="sr-only">Last Name</label>
            <input type="text" id="inputLastName" class="form-control" placeholder="Last name" required>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <div class="checkbox mb-3">
                <label>
                <input type="checkbox" value="1" id="chkbxIsAdmin"> Is Admin
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Create User</button>
        </form>
    </div>
@endsection