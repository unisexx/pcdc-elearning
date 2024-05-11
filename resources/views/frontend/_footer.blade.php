{{-- @dump($contact) --}}
<div class="shape2 wow fadeInUp"></div>
<footer class="bg_footer wow fadeInUp">
    <div class="container">
        <div class="address">
            <h5>กองโรคติดต่อทั่วไป กรมควบคุมโรค</h5>
            <div class="row g-4 pt-4 pb-5">
                <div class="col-auto">
                    <img src="{{ asset('html/images/icon-map.svg') }}" alt="" width="20" class="me-2"> {{ $contact->address }}
                </div>
                <div class="col-auto">
                    <img src="{{ asset('html/images/icon-call.svg') }}" alt="" width="18" class="me-2"> โทรศัพท์ {{ $contact->tel }}
                </div>
                <div class="col-auto">
                    <img src="{{ asset('html/images/icon-fax.svg') }}" alt="" width="18" class="me-2"> โทรสาร {{ $contact->fax }}
                </div>
                <div class="col-auto">
                    <img src="{{ asset('html/images/icon-email.svg') }}" alt="" width="18" class="me-2"> อีเมล {{ $contact->email }}
                </div>
            </div>
        </div>
        <p class="float-end">
            <a href="#" onclick="topFunction()" id="myBtn" class="scroll-top">
                <em class="fa-solid fa-arrow-up" style="  position: relative; top: -3px;"></em>
            </a>
        </p>
        <div class="line_footer"></div>
        <div class="copy_right py-3">
            <div class="row">
                <div class="col-auto">
                    สงวนลิขสิทธิ์ © 2567 กองโรคติดต่อทั่วไป กรมควบคุมโรค กระทรวงสาธารณสุข -
                    <a href="#">นโยบายเว็บไซต์</a> | <a href="#">นโยบายการคุ้มครองข้อมูลส่วนบุคคล</a>
                </div>
                <div class="col-auto ms-auto">
                    ติดตาม : <a href="{{ $contact->facebook }}" target="_blank"><img src="{{ asset('html/images/icon-facebook.svg') }}" alt="facebook" width="30" class="ms-3"></a>
                    <a href="{{ $contact->youtube }}" target="_blank"><img src="{{ asset('html/images/icon-youtube.svg') }}" alt="youtube" width="30" class="ms-3"></a>
                </div>
            </div>
        </div>
    </div>
</footer>
