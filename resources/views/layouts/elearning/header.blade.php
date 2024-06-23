<div class="bg-theme">
    <header>
        <div class="container-fluid">
            <div class="row wow fadeInDown g-0">
                <div class="col-lg-7 col-xl-8 d-flex justify-content-center justify-content-sm-start align-items-center py-2">
                    <!--Start Title Page -->
                    <div class="container">
                      <div class="title-page py-3">
                        {{ @$curriculum->name }}
                      </div>
                    </div>
                    <!--End Title Page  -->
                </div>
                <div class="col-lg-5 col-xl-4 d-block d-sm-flex justify-content-end align-items-center py-2">
                  <div class="d-flex mb-2">
                  <img src="{{ asset("elearning/images/user.svg") }}" alt="" width="30">
                    <div class="d-table ms-3 me-4">
                      <div class="text_small_welcome">ยินดีต้อนรับ</div> 
                      <div class="border-1 text-white">
                        {{ Auth::user()->name }}
                      </div>
                    </div>
                  </div>
                  <div class="btn btn-warning rounded-pill text-dark">
                    <a href="{{ url('/home')}}" class="text-dark">
                        ออกจากบทเรียน
                    </a>
                  </div>
                </div>
            </div>
        </div>
    </header>
</div>