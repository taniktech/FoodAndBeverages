<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container">

    <h1>Hello, world!</h1>
    <form method="POST" action="createRequest">
        {{ csrf_field() }}
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="input0">Purpose</label>
            <input type="text" class="form-control" id="input0" placeholder="Purpose" name="purpose" value="Demo">
          </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="input1">Amount</label>
              <input type="text" class="form-control" id="input1" placeholder="Amount" name="amount" value="500">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="input2">Phone</label>
              <input type="text" class="form-control" id="input2" placeholder="Phone" name="phone" value="9470668481">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="input3">Username</label>
              <input type="text" class="form-control" id="input3" placeholder="User Name" name="username" value="NikhilVats">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="input4">Email</label>
              <input type="text" class="form-control" id="input4" placeholder="Email" name="email" value="emailnkv@gmail.com">
            </div>
          </div>
        <button type="submit" class="btn btn-primary">Sign in</button>
      </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>