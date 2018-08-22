<!DOCTYPE html>
<html data-whatinput="keyboard" data-whatintent="keyboard" class=" whatinput-types-initial whatinput-types-keyboard"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Assignment</title>
            <link rel="icon" type="image/x-icon" href="favicon.ico" />
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
            <link rel="stylesheet" href="{{ asset('pickadate/lib/themes/default.css') }}">
            <link rel="stylesheet" href="{{ asset('pickadate/lib/themes/default.date.css') }}">
    <body class="bg-light">

    
    
    <div class="container">
    @yield('content')    
    </div>

    
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('pickadate/lib/picker.js') }}"></script>
        <script src="{{ asset('pickadate/lib/picker.date.js') }}"></script>
        <script>
            $('.datepicker').pickadate(
              { 
                format: 'yyyy-mm-dd',
                formatSubmit: 'yyyy-mm-dd' 
              }
              );
        </script>
        <script>
        $(document).ready(function () {
    $('#form-user').on('submit', function (e) {
      e.preventDefault();
      console.log("checking user1")
      var name = $('#inputName').val()
      var email = $('#inputEmail').val()
      var last_name = $('#inputLastName').val()
      var password = $('#inputPassword').val()
      var is_admin = $('#chkbxIsAdmin:checked').val() ? 1: 0
      var token = localStorage.getItem('assignmentToken')
      token = token ? token : "USER";

      var data = {
                    name: name,
                    last_name: last_name,
                    is_admin: is_admin,
                    email: email,
                    password: password,
                    token: token
      }
      console.log("data", data)
      var host = 'http://127.0.0.1:8000'
      $.ajax({
                url: host + '/api/create-user',
                method: "POST",
                dataType: "json",
                data: {
                    ...data
                }
            })
            .done(function (data) {
                console.log('success', data)
            })
            .fail(function (xhr) {
                console.log('error', xhr.responseText);
            });
    
    });
    $('#form-signin').on('submit', function (e) {
      e.preventDefault();
      var email = $('#inputEmail').val()
      var password = $('#inputPassword').val()
      console.log("email:", email)
      console.log("password:", password)
      var host = 'http://127.0.0.1:8000'
      $.ajax({
                url: host + '/api/login',
                method: "POST",
                dataType: "json",
                data: {
                    email:email,
                    password:password,
                }
            })
            .done(function (data) {
                console.log('success', data)
                var token = data.token ? data.token : "USER";    
                localStorage.setItem('assignmentToken', token)
      
            })
            .fail(function (xhr) {
                console.log('error', xhr.responseText);
            });
    
    });
  });
        </script>
    </body>
</html>

