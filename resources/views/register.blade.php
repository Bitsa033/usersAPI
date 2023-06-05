<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <script src="dist/js/bootstrap.min.css"></script>
    <script src="dist/js/jquery.min.css"></script>
    <script src="dist/js/popper.min.css"></script>

    <title>Register</title>
</head>
<body>
    <div class="offset-3 col-md-4">
        <br>
        <br>
        <form id="form" class="needs-validation" novalidate action="{{url('register')}}" method="POST">
            @csrf
            <div class="form-row">
              <div class="col-md-4 mb-3">
                <label for="validationTooltip01">First name</label>
                <input type="text" name="first-name" class="form-control" id="validationTooltip01" placeholder="First name" value="Mark" required>
                <div class="valid-tooltip">
                  Looks good!
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationTooltip02">Last name</label>
                <input type="text" name="last-name" class="form-control" id="validationTooltip02" placeholder="Last name" value="Otto" required>
                <div class="valid-tooltip">
                  Looks good!
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationTooltipUsername">Username</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                  </div>
                  <input type="text" name="user-name" class="form-control" id="validationTooltipUsername" placeholder="Username" aria-describedby="validationTooltipUsernamePrepend" required>
                  <div class="invalid-tooltip">
                    Please choose a unique and valid username.
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationTooltipEmail">Email</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="validationTooltipEmailPrepend">@</span>
                  </div>
                  <input type="text" name="user-email" class="form-control" id="validationTooltipEmailPrepend" placeholder="Email" aria-describedby="validationTooltipEmailPrepend" required>
                  <div class="invalid-tooltip">
                    Please choose a unique and valid Email.
                  </div>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="validationTooltip03">City</label>
                <input type="text" class="form-control" id="validationTooltip03" placeholder="City" required>
                <div class="invalid-tooltip">
                  Please provide a valid city.
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationTooltip04">State</label>
                <input type="text" class="form-control" id="validationTooltip04" placeholder="State" required>
                <div class="invalid-tooltip">
                  Please provide a valid state.
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationTooltip05">Zip</label>
                <input type="text" class="form-control" id="validationTooltip05" placeholder="Zip" required>
                <div class="invalid-tooltip">
                  Please provide a valid zip.
                </div>
              </div>
            </div>
            <button class="btn btn-primary" type="submit">Submit form</button>
          </form>
    </div>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
            }, false)
        })
        })()
    </script>
</body>
</html>