<!DOCTYPE html>
<html data-whatinput="keyboard" data-whatintent="keyboard" class=" whatinput-types-initial whatinput-types-keyboard">

<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="UTF-8">
  <title>Assignment</title>
  <link rel="icon" type="image/x-icon" href="favicon.ico" />
  <link rel="stylesheet" href="css/foundation.css">
  <link rel="stylesheet" href="css/app.css">
  <link rel="stylesheet" href="pickadate/lib/themes/default.css">
  <link rel="stylesheet" href="pickadate/lib/themes/default.date.css">
  <meta class="foundation-mq">
</head>

<body>


  <form>
    <div class="grid-x grid-padding-x">
      <div class="small-3 cell">
        <label for="right-label" class="text-right">Label</label>
      </div>
      <div class="small-9 cell">
        <input type="text" id="right-label" placeholder="Right-aligned text input">
      </div>
    </div>
  </form>

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
    $('.datepicker').pickadate({
      format: 'yyyy-mm-dd',
      formatSubmit: 'yyyy-mm-dd'
    });
  </script>
  <script>
    $(document).ready(function () {
      $('#categoryformid').on('submit', function (e) {
        e.preventDefault();
        console.log("adding category")
        var host = 'http://127.0.0.1:8000'
        var category = $('#categoryText').val();
        $.ajax({
          type: "POST",
          url: host + '/api/category',
          data: {
            category: category
          },
          dataType: "json",
          success: function (msg) {
            $("#ajaxResponse").append("<div>" + msg + "</div>");
          }
        });
      });
    });
  </script>
</body>

</html>