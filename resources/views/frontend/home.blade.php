<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Lonely Bootstrap Template - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i|Playfair+Display:400,400i,500,500i,600,600i,700,700i&subset=cyrillic" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
<style>
    .header-top{
        margin-top: 50px;
    }
    .post-author a {
        display: flex;
        align-items: center;
    }
    .post-author img {
    border-radius: 100%;
    width: 28px;
    margin-right: 5px;
    margin-top: 5px;
}
.grid-blog .post-author {
    width: 189px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
.grid-blog .post-author a:hover {
    color: #ee344e
}

</style>
  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Lonely
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/free-html-bootstrap-template-lonely/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main id="main">
    
    <div class="container header-top">
        <div class="d-flex justify-content-sm-end">
            <div class="search-box ms-2">
              <span>Search</span>  <input type="date" name="search" id="search">
                <i class="ri-search-line search-icon"></i>
            </div>
        </div>
        <hr>
        <div id="dynamic-row"> 
            @foreach($all_posts as $single_post)
                <div class="row" >
                    <div class="col-md-3">                
                        <div class="card-body"><img src="{{ asset('frontend/assets/task_img/'.$single_post->image) }}" alt="" style="width:50px;height:50px "></div>
                        <div class="post-author">

                            @if($single_post->created_user_type == "user")
                            <img src="{{asset('frontend/assets/task_img/user.png')}}" alt="Post Author">{{$single_post->user->name}}<span></span>
                            @elseif($single_post->created_user_type == "super_admin")
                            <img src="{{asset('frontend/assets/task_img/admin.png')}}" alt="Post Author">{{$single_post->super_admin->name}}<span></span>
                            @endif
                        </div>
                        <div>
                            <i class="far fa-clock"></i> {{ date('F jS, Y', strtotime($single_post->post_date)) }}</li>
                        </div>        
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">{{ $single_post->title }}</div>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
        
        
    </div>

    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Skills</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row skills-content">

          <div class="col-lg-6">

            <div class="progress">
              <span class="skill">HTML <i class="val">100%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <div class="progress">
              <span class="skill">CSS <i class="val">90%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <div class="progress">
              <span class="skill">JavaScript <i class="val">75%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

          </div>

          <div class="col-lg-6">

            <div class="progress">
              <span class="skill">PHP <i class="val">80%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <div class="progress">
              <span class="skill">WordPress/CMS <i class="val">90%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <div class="progress">
              <span class="skill">Photoshop <i class="val">55%</i></span>
              <div class="progress-bar-wrap">
                <div class="progress-bar" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

          </div>

        </div>

      </div>
    </section><!-- End Skills Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Lonely</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/free-html-bootstrap-template-lonely/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End  Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>


    <script src="{{ asset('backend/assets/js/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/ajax_form_submit.js') }}"></script>

    {{-- date picker start --}}
 

    {{-- date picker end --}}
<script>
        $("#search").on('input',function(){
            var searchRequest = $(this).val();
            $.ajax({
                "type" : 'GET',
                'url'  : '{{ route("public.post.search") }}',
                data : {
                    search: searchRequest ,
                },
                success:function(response){
                    $("#dynamic-row tr").remove()
                    $.each(response.searchResult , function(index, val) { 
                       

                        $("#dynamic-row").append(`
                       
                        <div class="row" >
                            <div class="col-md-3">                
                                <div class="card-body"><img src="{{ asset('frontend/assets/task_img/'.$single_post->image) }}" alt="" style="width:50px;height:50px "></div>
                                <div class="post-author">

                                    @if($single_post->created_user_type == "user")
                                    <img src="{{asset('frontend/assets/task_img/user.png')}}" alt="Post Author">{{$single_post->user->name}}<span></span>
                                    @elseif($single_post->created_user_type == "super_admin")
                                    <img src="{{asset('frontend/assets/task_img/admin.png')}}" alt="Post Author">{{$single_post->super_admin->name}}<span></span>
                                    @endif
                                </div>
                                <div>
                                    <i class="far fa-clock"></i> {{ date('F jS, Y', strtotime($single_post->post_date)) }}</li>
                                </div>        
                            </div>
                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-body">{{ $single_post->title }}</div>
                                </div>
                            </div>
                        </div>
                        <hr>


                        `)
                       

                    });
                }
            });
        });
    </script>


</body>

</html>