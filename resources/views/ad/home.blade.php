@extends('layout.master')
@section('content')
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
                <div class="card card-body">
                    <h4 class="card-title">Ad campaign add form</h4>
                    <form class="form-horizontal m-t-30 campaignAdFrom" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control ad_title" placeholder="Title" name="ad_title">
                        </div>
                        <div class="form-group">
                            <label for="example-email">Ad Start Date</label>
                            <input type="text" name="ad_start_date" class="form-control ad_start_date"
                                   placeholder="start date">
                        </div>
                        <div class="form-group">
                            <label for="example-email">Ad End Date</label>
                            <input type="text" name="ad_end_date" class="form-control ad_end_date"
                                   placeholder="end date">
                        </div>
                        <div class="form-group">
                            <label>Daily Price</label>
                            <input type="text" class="form-control ad_daily_price" placeholder="0.00" name="ad_daily_price">
                        </div>
                        <div class="form-group">
                            <label>Ad Image</label>
                            <input type="file" name="ad_images[]" class="ad_images" id="files" multiple>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-blue campaignAdBtn">
                                Save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
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
