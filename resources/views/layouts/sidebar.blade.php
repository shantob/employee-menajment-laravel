<nav id="sidebar" class="bg-dark">
    <div class="sidebar-header">
        <h4>{{ config('app.name', 'Employee Management') }}</h4>
        {{ auth()->user()->name }}
    </div>

    <ul class="list-unstyled components">

        <li>
            <a href="{{route('home')}}">
                <i class="fas fa-tachometer-alt mx-2"></i>
                Dashboard
            </a>
        </li>
        @if(auth()->user()->role == \App\Models\User::ADMIN)
        <li>
            <a href="#employeeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-user-tie mx-2"></i>
                Employee
            </a>
            <ul class="collapse list-unstyled" id="employeeSubmenu">
                <li>
                    <a href="{{route('employee.index')}}">Employee List</a>
                </li>
                <li>
                    <a href="{{route('employee.create')}}">Add Employee</a>
                </li>
            </ul>
        </li>
        @endif
        <li>
            <a href="#attendenceSubmit" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-user-clock mx-2"></i>
                Attendance
            </a>
            <ul class="collapse list-unstyled" id="attendenceSubmit">
                <li>
                    <a href="{{route('attendence.index')}}">Attendance List</a>
                </li>
                @if(auth()->user()->role == \App\Models\User::ADMIN)
                <li>
                    <a href="{{route('attendence.create')}}">Add Attendance</a>
                </li>
                @endif
            </ul>
        </li>
        <li>
            <a href="#projectSubmit" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-file-archive mx-2"></i>
                Project
            </a>
            <ul class="collapse list-unstyled" id="projectSubmit">
                <li>
                    <a href="{{route('project.index')}}">Project List</a>
                </li>
                @if(auth()->user()->role == \App\Models\User::ADMIN)
                <li>
                    <a href="{{route('project.create')}}">Add Project</a>
                </li>
                @endif
                <li>
                    <a href="{{route('project_feature.index')}}">Project Feature List</a>
                </li>
                @if(auth()->user()->role == \App\Models\User::ADMIN)
                <li>
                    <a href="{{route('project_feature.create')}}">Add Project Feature</a>
                </li>
                @endif
            </ul>
        </li>

        <li>
            <a href="#taskSubmit" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-sticky-note mx-2"></i>
                Task
            </a>
            <ul class="collapse list-unstyled" id="taskSubmit">
                <li>
                    <a href="{{route('task.index')}}">Task List</a>
                </li>
                @if(auth()->user()->role == \App\Models\User::ADMIN)
                <li>
                    <a href="{{route('task.create')}}">Add Task</a>
                </li>
                @endif
            </ul>
        </li>
        @if(auth()->user()->role == \App\Models\User::ADMIN)
        <li>
            <a href="{{route('job.index')}}">
                <i class="fas fa-file-alt mx-2"></i>
                Job
            </a>
        </li>
        @endif
        @if(auth()->user()->role == \App\Models\User::ADMIN)
        <li>
            <a href="{{route('expenses.index')}}">
                <i class="fas fa-file-alt mx-2"></i>
                Expenses
            </a>
        </li>
        @endif
        <li>
            <a href="{{route('leave.index')}}">
                <i class="fas fa-file-alt mx-2"></i>
                Leave
            </a>
        </li>
        <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt mx-2"></i>
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>

    </ul>
</nav>