@extends('admin.layout.app')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
</div>

{{-- CARD ATAS --}}
<div class="row">

    <div class="col-md-6 col-lg-3">
        <div class="card m-b-30">
            <div class="card-body text-center">
                <h5 class="mt-0">$18090</h5>
                <p class="text-muted">Visits Today</p>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card m-b-30">
            <div class="card-body text-center">
                <h5 class="mt-0">562</h5>
                <p class="text-muted">New Users</p>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card m-b-30">
            <div class="card-body text-center">
                <h5 class="mt-0">7514</h5>
                <p class="text-muted">New Orders</p>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card m-b-30">
            <div class="card-body text-center">
                <h5 class="mt-0">$32874</h5>
                <p class="text-muted">Total Sales</p>
            </div>
        </div>
    </div>

</div>

{{-- CHART --}}
<div class="row">
    <div class="col-md-8">
        <div class="card m-b-30">
            <div class="card-body">
                <h5 class="header-title">Overview</h5>
                <div id="multi-line-chart" style="height:300px;"></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card m-b-30">
            <div class="card-body">
                <h5 class="header-title">Revenue</h5>
                <div id="morris-donut-chart" style="height:300px;"></div>
            </div>
        </div>
    </div>
</div>

{{-- TABLE --}}
<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">

                <h5 class="header-title">Members</h5>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Country</th>
                                <th>Earnings</th>
                                <th>Sales</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>John Doe</td>
                                <td>USA</td>
                                <td>$100</td>
                                <td>10</td>
                            </tr>

                            <tr>
                                <td>William</td>
                                <td>France</td>
                                <td>$490</td>
                                <td>24</td>
                            </tr>

                            <tr>
                                <td>Bobby</td>
                                <td>Spain</td>
                                <td>$380</td>
                                <td>19</td>
                            </tr>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection