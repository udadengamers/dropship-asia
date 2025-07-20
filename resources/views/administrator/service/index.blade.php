<x-admin.auth-layout>
    <!-- Page Heading -->
    <style>


        .articles a {
            text-decoration: none !important;
            display: block;
            margin-bottom: 0;
            color: #555
        }

        .articles .badge {
            font-size: 0.7em;
            padding: 5px 10px;
            line-height: 1;
            margin-left: 10px
        }

        .articles .item {
            padding: 20px
        }

        .articles .item:nth-of-type(even) {
            background: #fafafa
        }

        .articles .item .image {
            min-width: 50px;
            max-width: 50px;
            height: 50px;
            margin-right: 15px
        }

        .articles .item img {
            padding: 3px;
            border: 1px solid #28a745
        }

        .articles .item h3 {
            color: #555;
            font-weight: 400;
            margin-bottom: 0
        }

        .articles .item small {
            color: #aaa;
            font-size: 0.75em
        }

        .card-close {
            position: absolute;
            top: 15px;
            right: 15px
        }

        .card-close .dropdown-toggle {
            color: #999;
            background: none;
            border: none
        }

        .card-close .dropdown-toggle:after {
            display: none
        }

        .card-close .dropdown-menu {
            border: none;
            min-width: auto;
            font-size: 0.9em;
            border-radius: 0;
            -webkit-box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.1), -2px -2px 3px rgba(0, 0, 0, 0.1);
            box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.1), -2px -2px 3px rgba(0, 0, 0, 0.1)
        }

        .card-close .dropdown-menu a {
            color: #999 !important
        }

        .card-close .dropdown-menu a:hover {
            background: #796AEE;
            color: #fff !important
        }

        .card-close .dropdown-menu a i {
            margin-right: 10px;
            -webkit-transition: none;
            transition: none
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col">
              <div class="articles card">
                <div class="card-close">
                  
                </div>
                <div class="card-header d-flex align-items-center">
                  <h2 class="h3">Service Chat</h2>
                  <div class="badge badge-rounded bg-green">4 New       </div>
                </div>
                <div class="card-body no-padding">
                    
                    @include('administrator.service.user-list')
                  
                </div>
              </div>
            </div>
            
        </div>
    </div>
</x-admin.auth-layout>