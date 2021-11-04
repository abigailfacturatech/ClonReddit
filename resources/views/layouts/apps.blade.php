
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reddit Clone</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<div class="container">
<body>
   
    

        <div class="row">
            <div class="col-md-12">
                <h1> Reditt Clone
<div class="container">
    <!-- -->
                    <small class="pull-right">
                        <a href="{{ route('create_post_path',[PostsController::class, 'create']);}}">Create Post</a>
                    </small>
                </h1>
            </div>
        </div>

        <hr>

    @include('layouts._errors')

    @include('layouts._messages')

    @yield('content')

    </div>
    
</body>
</html>