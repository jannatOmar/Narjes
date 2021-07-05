<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{asset('/assets/img/favicon.png')}}">
    <title>About us</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{asset('assets/css/material-dashboard.css?v=2.2.2')}}" rel="stylesheet" />

    <style>
        body {
            background-color: #fff;
            margin: 0px;
            padding: 0px;
            overflow-x: hidden;
        }

        .about {
            margin: 30px 65px;
        }
        .dash
   {
      margin-top:-85px;
   }

        .photo {
            float: right;
            border-radius: 20px;
            margin-left: 10px;

        }

        .in {

            padding: 35px;
            overflow: auto;
            margin: 70px;

        }

        td {

            text-align: center;
        }

        table {
            float: left;
            width: 20%;
            margin: auto;
        }

        li {
            list-style-type: none;
        }
    </style>
</head>

<body>

<div class="row"> 
    <div class="col-md-12">
    <h2 class="about">About us</h2>
  
<div style="float:right" class="dash">
    <a class="nav-link" style="margin-right: 40px;" href="{{route('admin.dashboard')}}">
                        <i class="material-icons">dashboard</i>
                        <p style="display:inline-block" class="d-lg-none d-md-block">
                            Dashboard
                        </p>
    </a>
</div>
    </div>
</div>


<div>
    <h1 style="text-align: center; margin-bottom: 90px; margin-top: 60px;">Our awesome team</h1>

    <div class="row">

        <table class="col-md-2   ">
            <tr>
                <td><img src="{{asset('assets/img/teamm.jpg')}}" height="130" width="130"></td>
            </tr>
            <tr>
                <td>Aroub Ahmad</td>
            </tr>
            <tr>
                <td>Nazlet Essa - Tulkarm</td>
            </tr>
            <tr>
                <td>aroubahmad159357@gmail.com</td>
            </tr>
            <tr>
                <td>0595537235</td>
            </tr>
            <tr>
                <td><button class="btn btn-round btn-facebook"
                            onclick="document.location='https://www.facebook.com/profile.php?id=100018326029006'"><i
                            class="fa fa-facebook-f"></i> </button></td>
            </tr>

        </table>
        <table class="col-md-2 ">
            <tr>
                <td><img src="{{asset('assets/img/teamm.jpg')}}" height="130" width="130"></td>
            </tr>
            <tr>
                <td>Ahmad Shon</td>
            </tr>
            <tr>
                <td>Irtah - Tulkarm</td>
            </tr>
            <tr>
                <td>ahmadshon87@gmail.com</td>
            </tr>
            <tr>
                <td>0592823113</td>
            </tr>
            <tr>
                <td><button class="btn btn-round btn-facebook"
                            onclick="document.location='https://www.facebook.com/ahmad.shon.99'"><i
                            class="fa fa-facebook-f"></i> </button></td>
            </tr>

        </table>
        <table class="col-md-2  ">
            <tr>
                <td><img src="{{asset('assets/img/teamm.jpg')}}" height="130" width="130"></td>
            </tr>
            <tr>
                <td>Jannat Omar</td>
            </tr>
            <tr>
                <td>Deir Al Ghosoun - Tulkarm</td>
            </tr>
            <tr>
                <td>jannat.omar2017@gmail.com</td>
            </tr>
            <tr>
                <td>0597608804</td>
            </tr>
            <tr>
                <td><button class="btn btn-round btn-facebook"
                            onclick="document.location='https://www.facebook.com/jannatf.alomar'"><i
                            class="fa fa-facebook-f"></i> </button></td>
            </tr>


        </table>
        <table class="col-md-2 ">
            <tr>
                <td><img src="{{asset('assets/img/teamm.jpg')}}" height="130" width="130"></td>
            </tr>
            <tr>
                <td>Beesan Tahayni</td>
            </tr>
            <tr>
                <td>Selat alharithia - Jenin</td>
            </tr>
            <tr>
                <td>beessnatahayni@gmail.com</td>
            </tr>
            <tr>
                <td>0594164019</td>
            </tr>
            <tr>
                <td><button class="btn btn-round btn-facebook"
                            onclick="document.location='https://www.facebook.com/beesan.silawi'"><i
                            class="fa fa-facebook-f"></i> </button></td>
            </tr>


        </table>

        <table class=" col-md-2  ">
            <tr>
                <td><img src="{{asset('assets/img/teamm.jpg')}}" height="130" width="130"></td>
            </tr>
            <tr>
                <td>Ahmad Mahmoud</td>
            </tr>
            <tr>
                <td>Balaa - Tulkarm</td>
            </tr>
            <tr>
                <td>kiraaa1412@gmail.com</td>
            </tr>
            <tr>
                <td>0598038379</td>
            </tr>
            <tr>
                <td><button class="btn btn-round btn-facebook"
                            onclick="document.location='https://www.facebook.com/ahmad.mahmoud.102361/'"><i
                            class="fa fa-facebook-f"></i> </button></td>
            </tr>


        </table>

    </div>
</div>



<div class="row" style="margin-top: 190px; background-color: rgb(239, 245, 245); color: #000;">

    <div class="col-md-4" style=" text-align:center ;display:inline-block; margin-top: 50px;">
        <ul>
            <li> Patient Friends Charitable Society</li>
            <li>A friend in need is a friend indeed</li>
            <li>Address : Palestine - Tulkarm - Behind the Chamber of Commerce</li>
            <li> Telephone : 2678228</li>
            <li>Phone : 0592390333</li>

        </ul>
    </div>

    <div class="col-md-4" style=" text-align:center; display:inline-block;">
        <ul>
            <br>
            <br><br>
            <li> You can contact us on :</li>
            <li>‏‪pfs_society@yahoo.com‬ </li>
            <li> <button class="btn btn-round btn-facebook"
                         onclick="document.location='https://www.facebook.com/PFS.Tulkarm/'"><i
                        class="fa fa-facebook-f"></i> </button> </li>
            <br>
            <br>
        </ul>
    </div>

    <div class="col-md-4" style=" text-align:center ;display:inline-block; margin-top: 50px;">
        <ul>
            <li> جمعية أصدقاء المريض الخيرية - طولكرم </li>
            <li> الصديق وقت الضيق </li>

            <li> العنوان : فلسطين - طولكرم - خلف الغرفة التجارية</li>
            <li>هاتف: 2678228 </li>
            <li> جوال : 0592390333 </li>
            <li>نتمنى الصحة والعافية للجميع </li>
        </ul>
    </div>

</div>
<div class="wraper">
    <div class="main-panel">
        <footer class="footer">
            <div class="container">
                <nav class="float-left">
                    <ul>
                    </ul>
                </nav>
                <div class="copyright float-right">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>, made with <i class="material-icons">favorite</i> by
                    Khadoorie's University Students.
                </div>
            </div>
        </footer>
    </div>
</div>
</body>

</html>