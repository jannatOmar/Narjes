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
                            <a class="nav-link" href="{{route('manager.myProfile')}}">
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

                <a class="nav-link" href="{{route('manager.dashboard')}}">
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
                            <a class="nav-link" href="{{route('manager.patientManagment')}}">
                                <span class="sidebar-mini"> PM </span>
                                <span class="sidebar-normal"> Patients management
                                </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('manager.patientManagment.create')}}">
                                <span class="sidebar-mini"> AP </span>
                                <span class="sidebar-normal"> Add patients </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('manager.patientManagment.addAnalysis')}}">
                                <span class="sidebar-mini"> APA </span>
                                <span class="sidebar-normal"> Add patient Analysis </span>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('manager.patientManagment.AnalysisWating')}}">
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
                            <a class="nav-link" href="{{route('manager.showAnalysis')}}">
                                <span class="sidebar-mini"> SA </span>
                                <span class="sidebar-normal"> Show Analysis </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('manager.analysis.create')}}">
                                <span class="sidebar-mini"> ANA </span>
                                <span class="sidebar-normal"> Add New Analysis</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#Doctor">
                    <i class="material-icons">health_and_safety</i>
                    <p> Doctor
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="Doctor">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('manager.doctor.managment')}}">
                                <span class="sidebar-mini"> DM </span>
                                <span class="sidebar-normal"> Doctor Management</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('manager.doctor.create')}}">
                                <span class="sidebar-mini"> AND </span>
                                <span class="sidebar-normal"> Add New Doctor </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#formsExamples">
                    <i class="material-icons">paid
                    </i>
                    <p> Financial details

                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="formsExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('manager.laboratryAnalysisPrice')}}">
                                <span class="sidebar-mini"> LAP </span>
                                <span class="sidebar-normal"> Laboratory Analysis Price </span>
                            </a>
                        </li>



                    </ul>

                </div>
            </li>




            <li class="nav-item ">
                <ul class="nav">
                    <li class="nav-item ">
                        <a class="nav-link" href="{{route('manager.aboutus')}}">
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
