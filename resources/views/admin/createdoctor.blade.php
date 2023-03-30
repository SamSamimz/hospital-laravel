@extends('admin.layouts.main')

@section('main')

<!-- Page Wrapper -->
<div id="wrapper">

    @include('admin.partials.sidebar')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            @include('admin.partials.navbar')


            <!-- Begin Page Content -->
            <div class="container-fluid">
                <div class="card shadow mb-4">
                    <div class="d-flex align-items-center justify-content-between card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Form for Add Doctor</h6>
                        <a href="{{route('doctors')}}" class="btn btn-primary">All Doctor</a>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            {{-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> --}}
                            <div class="col-lg-7 mx-auto">
                                <div class="p-5 mx-auto">
                                    <form class="user" action="{{route('store.doctor')}}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control form-control-user"
                                                id="exampleInputEmail" placeholder="Doctor Name...">
                                            @error('name')
                                            <li class="text-danger">{{$message}}</li>
                                            @enderror
                                        </div>
                                        <div class="form-group">

                                            <select name="post" class="form-control" style="border-radius:20px;">
                                                <option selected disabled>Select Post</option>
                                                @foreach ($post as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('post')
                                            <li class="text-danger">{{$message}}</li>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="file" name="image" class="form-control form-control-user">
                                            @error('image')
                                            <li class="text-danger">{{$message}}</li>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Add
                                            Doctor</button>
                                    </form>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

    </div>
    <!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>




@if(session()->has('success'))
<script>

  $(window).ready(function () {
    Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: 'A new doctor has been saved',
      showConfirmButton: false,
      timer: 3000
    })
  });
</script>
@endif


@endsection