<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="{{asset('client/admin/css/styles.css')}}" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
            .notification {
              background-color: #555;
              color: white;
              text-decoration: none;
              padding: 15px 26px;
              position: relative;
              display: inline-block;
              border-radius: 2px;
            }
            
            .notification:hover {
              background: red;
            }
            
            .notification .badge {
              position: absolute;
              top: 0px;
              right: -10px;
              padding: 5px 10px;
              border-radius: 50%;
              background-color: rgb(12, 2, 156);
              color: white;
            }
            </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="{{route('client.home')}}">E-SHOPPER</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <a href="#" class="notification mr-3 text-decoration-none">
                <span>Order</span>
                <span class="badge">3</span>
            </a>
            <a href="#" class="notification text-decoration-none">
                <span>Site Message</span>
                <span class="badge">8</span>
            </a>
            {{-- <button class="btn btn-primary"> <a href="" class="text-decoration-none text-white font-weight-bold">Order(5)</a></button>
            <button class="btn btn-success"><a href="" class="text-decoration-none text-warning">Site Message(5)</a></button> --}}
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
           
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Activity Log</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>