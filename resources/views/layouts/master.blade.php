<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body class="bg-light">

    @include('layouts.sidebar')
    @include('layouts.navbar')
    
    <div class="row m-0">
        <div class="col-md-2 p-1">            
            <div class="bg-white p-2 shadow-sm" style="min-height: 89vh;">
                <h5>Menu</h5>
                <ul >
                    <ol class="py-1 ms-0 my-3 bg-light"><a href="{{route('employee.index')}}" class="btn px-0">Employee</a></ol>
                    <ol class="py-1 ms-0 my-3 bg-light"><a href="{{route('attendence.index')}}" class="btn px-0">Attendance</a></ol>
                    <ol class="py-1 ms-0 my-3 bg-light"><a href="{{route('project.index')}}" class="btn px-0">Project</a></ol>
                    <ol class="py-1 ms-0 my-3 bg-light"><a href="{{route('project_feature.index')}}" class="btn px-0">Project Features</a></ol>
                    <ol class="py-1 ms-0 my-3 bg-light"><a href="{{route('task.index')}}" class="btn px-0">Tasks</a></ol>
                    <ol class="py-1 ms-0 my-3 bg-light"><a href="{{route('job.index')}}" class="btn px-0">Job</a></ol>
                </ul>
            </div>
        </div>
        <div class="col-md-10 p-1">
            <div class="container-fluid p-3" style="min-height: 89vh;">
                @yield('content')
            </div>
        </div>
    </div>

    <footer id="sticky-footer" class="flex-shrink-0 py-3 bg-dark text-white">
        <div class="container text-center">
        <small>Copyright &copy;2023</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>