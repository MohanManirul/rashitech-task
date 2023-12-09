@extends('frontend.layouts.master')
@section('per_page_meta')
    <meta content="all post" name="description" />
@endsection

@section('per_page_title')
    {{ __('Profile| All Posts') }}
@endsection

@push('per_page_css')
    <style>
        
    </style>
@endpush
@section('body-content')
    <div class="page-content">
        <div class="container">
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">My All Posts</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div id="customerList">
                                <div class="row g-4 mb-3">
                                    <div class="col-sm-auto">
                                        <div>
                                            <button type="button" class="btn btn-success add-btn" id="create-btn" ><i class="ri-add-line align-bottom me-1"></i><a href="{{ route('user.post.create.page') }}">Add</a> </button>
                                            <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <input type="search" name="search" id="search" class="form-control search" placeholder="Search...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive table-card mt-3 mb-1">
                                    <table class="table align-middle table-nowrap" id="customerTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col" style="width: 50px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                    </div>
                                                </th>
                                                <th class="sort" data-sort="customer_name">Sl</th>
                                                <th class="sort" data-sort="email">Title</th>
                                                <th class="sort" data-sort="phone">Image</th>
                                                <th class="sort" data-sort="date">Post Date</th>
                                                <th class="sort" data-sort="status">Status</th>
                                                <th class="sort" data-sort="action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dynamic-row" class="list form-check-all">
                                            @foreach ($my_posts as $key=>$single_post)                                                
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                                        </div>
                                                    </th>
                                                    
                                                    <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#VZ2101</a></td>
                                                    <td class="customer_name">{{ $key+1 }}</td>
                                                    <td class="email">{{ $single_post->title }}</td>
                                                    <td class="phone"><img style="width: 50px;height:auto" src="{{ asset('frontend/assets/task_img/' . $single_post->image) }}" alt="Image"></td>
                                                    <td class="date">{{ $single_post->post_date }}</td>
                                                    
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                            <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any orders for you search.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-item pagination-prev disabled" href="#">
                                            Previous
                                        </a>
                                        <ul class="pagination listjs-pagination mb-0"></ul>
                                        <a class="page-item pagination-next" href="#">
                                            Next
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

        </div>
        <!-- container-fluid -->
    </div>

@endsection

@push('per_page_js')
    <script src="{{ asset('backend/assets/js/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/ajax_form_submit.js') }}"></script>

    <script>
        $("#search").on('input',function(){
            var searchRequest = $(this).val();
            console.log(searchRequest);
            $.ajax({
                "type" : 'GET',
                'url'  : '{{ route("post.search") }}',
                data : {
                    search: searchRequest ,
                },
                success:function(response){
                    $("#dynamic-row tr").remove()
                    $.each(response.searchResult , function(index, val) { 
                        let post_edit_route = "{{ route('user.post.edit',':id') }}";
                        post_edit_route = post_edit_route.replace(':id',val.id);

                        $("#dynamic-row").append(`
                        <tr>
                            <th scope="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                </div>
                            </th>
                            
                            <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#VZ2101</a></td>
                            <td class="customer_name">${ index+1 }</td>
                            <td class="email">${ val.title }</td>
                            <td class="phone"><img style="width: 50px;height:auto" src="{{ asset('frontend/assets/task_img/' . $single_post->image) }}" alt="Image"></td>
                            <td class="date">${ val.post_date }</td>
                            
                        </tr>
                       
                        `)
                       

                    });
                }
            });
        });
    </script>
@endpush