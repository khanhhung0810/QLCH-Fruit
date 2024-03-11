<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Page</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="vh-100" style="background-color: #4CAF50;">
<div class="container py-5 h-100">
  <div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
      <div class="card shadow-2-strong" style="border-radius: 1rem;">
        <div class="card-body p-5 text-center">
          <h3 class="mb-5">Sign in</h3>
          <div class="form-outline mb-4">
            <input type="text" id="username" name="username" class="form-control form-control-lg" placeholder="Username">
          </div>
          <div class="form-outline mb-4">
            <input type="password" id="typePasswordX-2" class="form-control form-control-lg" placeholder="Password">
          </div>
          <!-- Checkbox -->
          <div class="form-check d-flex justify-content-start mb-4">
            <input class="form-check-input" type="checkbox" value="" id="form1Example3">
            <label class="form-check-label" for="form1Example3"> Remember password </label>
          </div>
          <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
          <hr class="my-4">
          <button class="btn btn-lg btn-block btn-primary" style="background-color: #dd4b39;" type="submit"><i class="fab fa-google me-2"></i> Sign in with google</button>
          <button class="btn btn-lg btn-block btn-primary mb-2" style="background-color: #3b5998;" type="submit"><i class="fab fa-facebook-f me-2"></i>Sign in with facebook</button>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
  var usernameInput = document.getElementById("username");
  var defaultPlaceholder = "Username";
  
  // Xử lý sự kiện khi ô input được focus
  usernameInput.addEventListener("focus", function() {
    if (this.value === defaultPlaceholder) {
      this.value = "";
    }
  });

  // Xử lý sự kiện khi ô input mất focus
  usernameInput.addEventListener("blur", function() {
    if (this.value === "") {
      this.value = defaultPlaceholder;
    }
  });
});
</script>
</body>
</html>
