<!DOCTYPE html>
<html data-whatinput="keyboard" data-whatintent="keyboard" class=" whatinput-types-initial whatinput-types-keyboard"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="UTF-8">
        <title>Assignment</title>
            <link rel="icon" type="image/x-icon" href="favicon.ico" />
            <link rel="stylesheet" href="css/foundation.css">
            <link rel="stylesheet" href="css/app.css">
            <link rel="stylesheet" href="pickadate/lib/themes/default.css">
            <link rel="stylesheet" href="pickadate/lib/themes/default.date.css">
    <meta class="foundation-mq"></head>
    <body>

        <!-- Start Top Bar -->
    <!-- <div class="top-bar">
      <div class="row">
        <div class="top-bar-left">
          <ul class="dropdown menu" data-dropdown-menu="tckp8q-dropdown-menu" role="menubar">
            <li role="menuitem"><a href="./home.html">Home</a></li>
            <li role="menuitem"><a href="./clients.html">Clients</a></li>
            <li role="menuitem"><a href="./reservations.html">Reservations</a></li>
          </ul>
        </div>
      </div>
    </div> -->
    <!-- End Top Bar -->

    <br>
    
    
    <div class="row">
      <div class="medium-12 large-12 columns">
      
        <form id="categoryformid" method="POST">
          <div class="row">
            <div class="medium-1 columns">
                <label>Category</label>
              </div>
              <div class="medium-10  columns">
                  <input id="categoryText" name="category" type="text">
              </div>
              <div class="medium-1  columns">
              <input value="ADD" id="addCategory" class="button success hollow" type="submit">
            </div>  
          </div>
        </form>
        <!-- <div class="medium-4  columns" id="ajaxResponse"></div> -->
        @if(0)
        <form action="/api/todo/new" method="post" id="todoformid">
          <div class="medium-4  columns">
            <label>Category</label>
            <select name="form[title]">
                <option value="work" selected="selected">Work</option>
                <option value="personal">Personal</option>
                <option value="bills">Bills</option>
            </select>
          </div>
          <div class="medium-4  columns">
            <label>Priority</label>
            <select name="form[title]">
                <option value="high" selected="selected">High</option>
                <option value="medium">Medium</option>
                <option value="low">Low</option>
            </select>
          </div>
          <div class="medium-4  columns">
            <label>Name</label>
            <input name="form[name]" type="text">
          </div>
          <div class="medium-4  columns">
            <label>Last Name</label>
            <input name="form[lastName]" type="text">
          </div>
          <div class="medium-8  columns">
            <label>Title</label>
            <input name="form[title]" type="text">
          </div>
          <div class="medium-4  columns">
            <label>Description</label>
            <input name="form[description]" type="text">
          </div>
          <div class="medium-4  columns">
            <label>City</label>
            <input name="form[city]" type="text">
          </div>
          <div class="medium-4  columns">
            <label>State</label>
            <input name="form[state]" type="text">
          </div>
          <div class="medium-12  columns">
            <label>Email</label>
            <input name="form[email]" type="text">
          </div>
          <div class="medium-12  columns">
            <input value="SAVE" class="button success hollow" type="submit">
          </div>
        </form>
        @endif
        @if(0)
        <form action="/api/admin/new" method="post" id="adminformid">
          <div class="medium-4  columns">
            <label>Category</label>
            <select name="form[title]">
                <option value="work" selected="selected">Work</option>
                <option value="personal">Personal</option>
                <option value="bills">Bills</option>
            </select>
          </div>
          <div class="medium-4  columns">
            <label>Priority</label>
            <select name="form[title]">
                <option value="high" selected="selected">High</option>
                <option value="medium">Medium</option>
                <option value="low">Low</option>
            </select>
          </div>
          <div class="medium-4  columns">
            <label>Name</label>
            <input name="form[name]" type="text">
          </div>
          <div class="medium-4  columns">
            <label>Last Name</label>
            <input name="form[lastName]" type="text">
          </div>
          <div class="medium-8  columns">
            <label>Title</label>
            <input name="form[title]" type="text">
          </div>
          <div class="medium-4  columns">
            <label>Description</label>
            <input name="form[description]" type="text">
          </div>
          <div class="medium-4  columns">
            <label>City</label>
            <input name="form[city]" type="text">
          </div>
          <div class="medium-4  columns">
            <label>State</label>
            <input name="form[state]" type="text">
          </div>
          <div class="medium-12  columns">
            <label>Email</label>
            <input name="form[email]" type="text">
          </div>
          <div class="medium-12  columns">
            <input value="SAVE" class="button success hollow" type="submit">
          </div>
        </form>
        @endif
      </div>
    </div>

    

    <div class="row column">
      <hr>
      <ul class="menu">
        <li class="float-right">Copyright 2017</li>
      </ul>
    </div>

    <script>
      $(document).foundation();
    </script>

        <script>
      $(document).foundation();
    </script>

        <script src="js/vendor/jquery.js"></script>
        <script src="js/vendor/what-input.js"></script>
        <script src="js/vendor/foundation.js"></script>
        <script src="js/app.js"></script>
        <script src="pickadate/lib/picker.js"></script>
        <script src="pickadate/lib/picker.date.js"></script>
        <script>
            $('.datepicker').pickadate(
              { 
                format: 'yyyy-mm-dd',
                formatSubmit: 'yyyy-mm-dd' 
              }
              );
        </script>
        <script>
            $(document).ready(function() {
                $('#categoryformid').on('submit', function (e) {
                    e.preventDefault();
                    console.log("adding category")
                    var host = 'http://127.0.0.1:8000'
                    var category = $('#categoryText').val();
                    $.ajax({
                        type: "POST",
                        url: host + '/api/category',
                        data: {category: category},
                        dataType : "json",
                        success: function( msg ) {
                            $("#ajaxResponse").append("<div>"+msg+"</div>");
                        }
                    });
                });
            });
        </script>
    </body>
</html>