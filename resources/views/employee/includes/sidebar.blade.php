<div class="sidebar" data-color="rose" data-background-color="black" data-image="{{asset('assets/img/a.jpeg')}}">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo"><a href="#" data-color="rose" class="simple-text logo-normal"
            style="font-size: 16px; text-align: center; color:white ; font-weight: bold;text-transform: capitalize;">

            Patient's Friends Association
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="user-info">
                <a data-toggle="collapse" href="#collapseExample" class="username">
                    <span style="padding-left: 20px">
                        {{auth()->user()->username}}
                        <b class="caret"></b>
                    </span>
                </a>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('employee.myProfile')}}">
                                <span class="sidebar-mini"> MP </span>
                                <span class="sidebar-normal"> My Profile </span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li class="nav-item active ">

                <a class="nav-link" href="{{route('employee.dashboard')}}">
                    <i class="material-icons">dashboard</i>
                    <p> Dashboard </p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#patientsExamples">
                    <i class="material-icons">supervised_user_circle</i>
                    <p> Patients
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="patientsExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('employee.patientManagment')}}">
                                <span class="sidebar-mini"> PM </span>
                                <span class="sidebar-normal"> Patients management
                                </span>
                            </a>
                        </li>



                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('employee.patientManagment.AnalysisWating')}}">
                                <span class="sidebar-mini"> AWR </span>
                                <span class="sidebar-normal"> Analysis Waiting Result </span>
                            </a>
                        </li>

                    </ul>
                </div>

            </li>
            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#analysisExamples">
                    <i class="material-icons">science</i>
                    <p> Analysis
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="analysisExamples">
                    <ul class="nav">

                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('employee.showAnalysis')}}">
                                <span class="sidebar-mini"> SA </span>
                                <span class="sidebar-normal"> Show Analysis </span>
                            </a>
                        </li>


                    </ul>
                </div>
            </li>


            <li class="nav-item ">
                <ul class="nav">
                    <li class="nav-item ">
                        <a class="nav-link" href="{{route('employee.aboutus')}}">
                            <i class="material-icons">favorite_border</i>
                            <span class="sidebar-normal"> About Us </span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
    <div class="sidebar-background"></div>
</div>
