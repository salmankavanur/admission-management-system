<!--**********************************
    Sidebar start
***********************************-->
<div class="dlabnav">
    <div class="dlabnav-scroll">    
        <ul class="metismenu" id="menu">
            @hasanyrole('Super Admin')
            <li>
                <a class="has-arrow" href="javascript:void(0);">
                    <i class="material-symbols-outlined">home</i>
                    <span class="nav-text">Home</span>
                </a>
                <ul> <!-- Closed by default -->
                    <li><a href="{{ url('/') }}">Dashboard</a></li>
                </ul>
                <ul> <!-- Closed by default -->
                    <li><a href="{{ route('users.index') }}">Users/Other Admins</a></li>
                </ul>
                <ul> <!-- Closed by default -->
                    <li><a href="{{ route('settings.site_logo') }}">Site Logo</a></li>
                </ul>
              
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0);">
                    <i class="material-symbols-outlined">account_balance</i>
                    <span class="nav-text">Institute</spanf>
                </a>
                <ul > <!-- Closed by default -->
                    <li><a href="{{ route('institute.index') }}">Institutes</a></li>
                    <li><a href="{{ route('department.index') }}">Departments</a></li>                        
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0);">
                    <i class="material-symbols-outlined">school</i>
                    <span class="nav-text">Student</span>
                </a>
                <ul> <!-- Closed by default -->
                    <li><a href="{{ route('student.application.index') }}">Applications</a></li>
                    <li><a href="{{ route('student.index') }}">Student</a></li>
                    <li><a href="{{ route('student.admit_card') }}">Admit Cards</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0);">
                    <i class="material-symbols-outlined">filter_list</i>
                    <span class="nav-text">Filter</span>
                </a>
                <ul> <!-- Closed by default -->
                    <li><a href="{{ route('student.filter') }}">Applications</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0);">
                    <i class="material-symbols-outlined">done_all</i>
                    <span class="nav-text">Reports</span>
                </a>
                <ul> <!-- Closed by default -->
                    <li><a href="{{ route('attendance.index') }}">Attendance Reports</a></li>
                    {{-- <li><a href="{{ route('student.add') }}">Interviews</a></li>
                    <li><a href="{{ route('student.admit_card') }}">Test</a></li> --}}
                    <li><a href="{{ route('logs.index') }}">Logs</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0);">
                    <i class="material-symbols-outlined">notifications</i>
                    <span class="nav-text">Notify Students</span>
                </a>
                <ul> <!-- Closed by default -->
                    <li><a href="{{ route('notifications.index') }}">Notify Students</a></li>
                </ul>
                <ul> <!-- Closed by default -->
                    <li><a href="{{ route('settings.template') }}">Notification Template</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0);">
                    <i class="material-symbols-outlined">description</i>
                    <span class="nav-text">Prospectus</span>
                </a>
                <ul> <!-- Closed by default -->
                    <li><a href="{{ route('brochures.index') }}">Prospectus</a></li>
                </ul>
            </li>
            @endhasanyrole
            @hasanyrole('Student')
            <li>
                <a class="has-arrow" href="javascript:void(0);">
                    <i class="material-symbols-outlined">home</i>
                    <span class="nav-text">Home</span>
                </a>
                <ul> <!-- Closed by default -->
                    <li><a href="{{ url('/') }}">Dashboard</a></li>
                </ul>
                {{-- <ul> <!-- Closed by default -->
                    <li><a href="{{ route('users.index') }}">Staff</a></li>
                </ul> --}}
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0);">
                    <i class="material-symbols-outlined">badge</i>
                    <span class="nav-text">My Record</span>
                </a>
                <ul> <!-- Closed by default -->
                    @if(auth()->user()->department_id)
                    <li><a href="{{ route('student.view', auth()->user()->id) }}">My Applicaton</a></li>
                    <li><a href="{{ route('student.admit_card') }}">Admit Card</a></li>
                    @else
                    <li><a href="{{ url('/') }}">Select Department First</a></li>

                    @endif
                </ul>
            </li>
            
            @endhasanyrole
            @hasanyrole('Manager')
            <li>
                <a class="has-arrow" href="javascript:void(0);">
                    <i class="material-symbols-outlined">home</i>
                    <span class="nav-text">Home</span>
                </a>
                <ul> <!-- Closed by default -->
                    <li><a href="{{ url('/') }}">Dashboard</a></li>
                </ul>
                <ul> <!-- Closed by default -->
                    <li><a href="{{ route('users.index') }}">Staff</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0);">
                    <i class="material-symbols-outlined">badge</i>
                    <span class="nav-text">Institute Settings</span>
                </a>
                <ul> <!-- Closed by default -->
                    <li><a href="{{ route('forms.create') }}">Application Form</a></li>
                </ul>
                <ul> <!-- Closed by default -->
                    <li><a href="{{ route('student.application.index') }}">Applications</a></li>
                </ul>
                <ul> <!-- Closed by default -->
                    <li><a href="{{ route('student.index') }}">Students</a></li>
                </ul>
                <ul> <!-- Closed by default -->
                    <li><a href="{{ route('student.admit_card') }}">Admit Cards</a></li>
                </ul>
                <ul> <!-- Closed by default -->
                    <li><a href="{{ route('department.index_manager') }}">Departments</a></li>
                </ul>
               
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0);">
                    <i class="material-symbols-outlined">filter_list</i>
                    <span class="nav-text">Filter</span>
                </a>
                <ul> <!-- Closed by default -->
                    <li><a href="{{ route('student.filter') }}">Applications</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0);">
                    <i class="material-symbols-outlined">done_all</i>
                    <span class="nav-text">Reports</span>
                </a>
                <ul> <!-- Closed by default -->
                    <li><a href="{{ route('attendance.index') }}">Attendance Reports</a></li>
                    <li><a href="{{ route('attendance.absent') }}">Absentess/Remaining Students</a></li>
                    
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0);">
                    <i class="material-symbols-outlined">notifications</i>
                    <span class="nav-text">Notify Students</span>
                </a>
                <ul> <!-- Closed by default -->
                    <li><a href="{{ route('notifications.index') }}">Notify Students</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0);">
                    <i class="material-symbols-outlined">description</i>
                    <span class="nav-text">Prospectus</span>
                </a>
                <ul> <!-- Closed by default -->
                    <li><a href="{{ route('brochures.index') }}">Prospectus</a></li>
                </ul>
            </li>
            @endhasanyrole
            @hasanyrole('Staff')
            <li>
                <a class="has-arrow" href="javascript:void(0);">
                    <i class="material-symbols-outlined">home</i>
                    <span class="nav-text">Home</span>
                </a>
                <ul> <!-- Closed by default -->
                    <li><a href="{{ url('/') }}">Dashboard</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0);">
                    <i class="material-symbols-outlined">badge</i>
                    <span class="nav-text">Institute Settings</span>
                </a>
                <ul> <!-- Closed by default -->
                    <li><a href="{{ route('student.application.index') }}">Applications</a></li>
                </ul>
                <ul> <!-- Closed by default -->
                    <li><a href="{{ route('student.index') }}">Students</a></li>
                </ul>
                <ul> <!-- Closed by default -->
                    <li><a href="{{ route('student.admit_card') }}">Admit Cards</a></li>
                </ul>
                {{-- <ul> <!-- Closed by default -->
                    <li><a type="button" data-bs-toggle="modal" data-bs-target="#admissionmodal">Admission Period</a></li>
                </ul> --}}
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0);">
                    <i class="material-symbols-outlined">done_all</i>
                    <span class="nav-text">Reports</span>
                </a>
                <ul> <!-- Closed by default -->
                    <li><a href="{{ route('attendance.index') }}">Attendance Reports</a></li>
                    <li><a href="{{ route('attendance.absent') }}">Absentess/Remaining Students</a></li>
                    {{-- <li><a href="{{ route('student.admit_card') }}">Test</a></li> --}}
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0);">
                    <i class="material-symbols-outlined">notifications</i>
                    <span class="nav-text">Notify Students</span>
                </a>
                <ul> <!-- Closed by default -->
                    <li><a href="{{ route('notifications.index') }}">Notify Students</a></li>
                </ul>
            </li>

            @endhasanyrole
   
        </ul>
        <div class="copyright">
            <p><strong>Students Admission Portal</strong></p>
            <p class="fs-12" style="text-align: center">Made with <span class="heart"></span></p>
        </div>
    </div>
</div>

<!--**********************************
    Sidebar end
***********************************-->
