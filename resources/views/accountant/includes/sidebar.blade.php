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
                            <a class="nav-link" href="{{route('accountant.myProfile')}}">
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

                <a class="nav-link" href="{{route('accountant.dashboard')}}">
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
                            <a class="nav-link" href="{{route('accountant.patientManagment')}}">
                                <span class="sidebar-mini"> PM </span>
                                <span class="sidebar-normal"> Patients management
                                </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('accountant.patientManagment.create')}}">
                                <span class="sidebar-mini"> AP </span>
                                <span class="sidebar-normal"> Add patients </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('accountant.patientManagment.addAnalysis')}}">
                                <span class="sidebar-mini"> APA </span>
                                <span class="sidebar-normal"> Add patient Analysis </span>
                            </a>
                        </li>

                    </ul>
                </div>

            </li>


            <li class="nav-item ">
                <ul class="nav">
                    <li class="nav-item ">
                        <a class="nav-link" href="{{route('accountant.aboutus')}}">
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
