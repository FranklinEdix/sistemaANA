<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">

    <style>
    .red {
        color: white;
        background-color: red;
    }

    .green {
        color: white;
        background-color: green;
    }

    .blue {
        color: white;
        background-color: blue;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 red">
                Hello world
            </div>

            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 green">
                Hello world
            </div>

            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-12">
                <br /><br /><br /><br /><br /><br /><br /><br />

                <div class="btn-group dropup">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Click Me!
                    </button>

                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="http://sonarsystems.co.uk">Button 1</a>
                        <a class="dropdown-item" href="http://sonarsystems.co.uk">Button 2</a>
                        <a class="dropdown-item" href="http://sonarsystems.co.uk">Button 3</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="http://sonarsystems.co.uk">Sign Out</a>
                    </div>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Click Me!</button>
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Click Me!</span>
                    </button>

                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="http://sonarsystems.co.uk">Button 1</a>
                        <a class="dropdown-item" href="http://sonarsystems.co.uk">Button 2</a>
                        <a class="dropdown-item" href="http://sonarsystems.co.uk">Button 3</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="http://sonarsystems.co.uk">Sign Out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery first, then Bootstrap JS. -->

</body>

</html>
<script src="https://code.jquery.com/jquery.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
</script>