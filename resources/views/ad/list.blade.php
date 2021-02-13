@extends('layout.master')
@section('content')
    <style>
        .hidden {
            display: none !important;
        }
    </style>
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Ads</h4>
                        <h6 class="card-subtitle">Check all Ad campaign here.</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                                <th scope="col">Daily Price</th>
                                <th scope="col">Total</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($ads))
                                <?php $page=isset($_GET['page'])? ($_GET['page']-1):0;?>
                                @foreach($ads as $key => $cat)
                                    <tr>
                                        <td>{{ ($key+1+($perPage*$page)) }}</td>
                                        <td>{{ $cat['ad_title'] }}</td>
                                        <td>{{ date('d-m-Y', strtotime($cat['ad_start_date'])) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($cat['ad_end_date'])) }}</td>
                                        <td>{{ $cat['ad_daily_price'] }}</td>
                                        <td>{{ $cat['ad_total_price'] }}</td>
                                        <td>
                                            <input type="hidden" class="ad_id" value="{{$cat['id']}}">
                                            <a class="btn btn-primary edit_btn" href="{{url('/edit/'.$cat['id'])}}">
                                                Edit
                                            </a>
                                            <button class="btn btn-success view_btn">
                                                View
                                            </button>
{{--                                            <button class="btn btn-warning del_btn">--}}
{{--                                                Delete--}}
{{--                                            </button>--}}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="text-center">
                                    <td colspan="4">No Data available</td>
                                </tr>
                            @endif
                            </tbody>

                        </table>
                        <div style="height: 50px !important;">
                            <?php echo isset($pagination) ? $pagination:"";?>
                        </div>


                    </div>

                </div>

            </div>
<!--            --><?php //echo isset($pagination) ? $pagination:"";?>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
@endsection
