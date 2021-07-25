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
                            <a class="nav-link" href="{{route('admin.myProfile')}}">
                                <span class="sidebar-mini"> MP </span>
                                <span class="sidebar-normal"> My Profile </span>
                            </a>
                        </li>
                      
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.userManagment.create')}}">
                                <span class="sidebar-mini"> ANU </span>
                                <span class="sidebar-normal"> Add New User </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.userManagment')}}">
                                <span class="sidebar-mini"> EP </span>
                                <span class="sidebar-normal"> User Management </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li class="nav-item active ">

                <a class="nav-link" href="{{route('admin.dashboard')}}">
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
                            <a class="nav-link" href="{{route('admin.patientManagment')}}">
                                <span class="sidebar-mini"> PM </span>
                                <span class="sidebar-normal"> Patients management
                                </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('admin.patientManagment.create')}}">
                                <span class="sidebar-mini"> AP </span>
                                <span class="sidebar-normal"> Add patients </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('admin.patientManagment.addAnalysis')}}">
                                <span class="sidebar-mini"> APA </span>
                                <span class="sidebar-normal"> Add patient Analysis </span>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('admin.patientManagment.AnalysisWating')}}">
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
                            <a class="nav-link" href="{{route('admin.showAnalysis')}}">
                                <span class="sidebar-mini"> SA </span>
                                <span class="sidebar-normal"> Show Analysis </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('admin.analysis.create')}}">
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
                            <a class="nav-link" href="{{route('admin.doctor.managment')}}">
                                <span class="sidebar-mini"> DM </span>
                                <span class="sidebar-normal"> Doctor Management</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('admin.doctor.create')}}">
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
                            <a class="nav-link" href="{{route('admin.laboratryAnalysisPrice')}}">
                                <span class="sidebar-mini"> LAP </span>
                                <span class="sidebar-normal"> Laboratory Analysis Price </span>
                            </a>
                        </li>



                    </ul>

                </div>
            </li>

            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#tablesExamples">
                    <i class="material-icons">money_off</i>
                    <p> Discount
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="tablesExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('admin.discount')}}">
                                <span class="sidebar-mini"> DM </span>
                                <span class="sidebar-normal"> Discount Managment</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('admin.discount.create')}}">
                                <span class="sidebar-mini"> AND </span>
                                <span class="sidebar-normal"> Add New Discount </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#mapsExamples">
                    <i class="material-icons">description</i>
                    <p> Reports
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="mapsExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('admin.report.analysis')}}">
                                <span class="sidebar-mini"> ROA </span>
                                <span class="sidebar-normal"> Reports Of Analysis</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('admin.report.patient')}}">
                                <span class="sidebar-mini"> ROP </span>
                                <span class="sidebar-normal"> Reports Of Patients</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('admin.report.showDiscount')}}">
                                <span class="sidebar-mini"> ROD</span>
                                <span class="sidebar-normal">Reports Of Discounts </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>



            <li class="nav-item ">
                <a class="nav-link" data-toggle="collapse" href="#actions">
                <i class="material-icons">manage_accounts</i>
                    <p> Actions
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="actions">
                    <ul class="nav">
                    <li class="nav-item ">
                        <a class="nav-link" href="{{route('admin.action.logging')}}">
                            <span class="sidebar-mini">LI </span>
                            <span class="sidebar-normal">Logging </span>
                        </a>
                    </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('admin.action.index')}}">
                                <span class="sidebar-mini">UA </span>
                                <span class="sidebar-normal"> User Action</span>
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </li>
           

            <li class="nav-item ">
                <ul class="nav">
                    <li class="nav-item ">
                        <a class="nav-link" href="{{route('admin.aboutus')}}">
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
