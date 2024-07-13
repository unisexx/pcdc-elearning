@if ($showCookieConsent ?? false)
    <div class="cookie-consent" id="cookieConsent">
        <div class="container">
            <div class="row bg1_cookie justify-content-between">
                <svg class="inner-dashed-border animated-dashes">
                    <rect x="5px" y="5px" rx="30px" ry="30px" width="97%" height="85%"></rect>
                </svg>
                <div class="d-block d-sm-flex align-items-center">
                    <div class="p-2 w-100 d-flex flex-lg-row flex-column">
                        <div class="cookie_icon me-3"><img src="{{ asset('html/images/check-mark.svg') }}" alt="" class="img-fluid"></div>
                        <div class="cookie_title me-3 pt-2">เว็บไซต์นี้ใช้คุกกี้เพื่อเพิ่มประสบการณ์การใช้งานของคุณ</div>
                        <a href="{{ url('/privacy-policy') }}" class="read_consent">อ่านเพิ่มเติม</a>
                    </div>
                    <div class="p-2 ms-auto">
                        <a class="close-btn" id="cookieConsentCloseButton"><i class="fa fa-times-circle"></i></a>
                        <button class="btn float-end rounded-pill btn-allow" id="acceptCookies">ยอมรับ</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endif

<script>
    document.getElementById('acceptCookies').addEventListener('click', function() {
        fetch('/accept-cookie', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({})
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                document.querySelector('.cookie-consent').style.display = 'none';
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    });

    document.getElementById('cookieConsentCloseButton').addEventListener('click', function() {
        localStorage.setItem('cookieConsent', 'true');
        document.getElementById('cookieConsent').style.display = 'none';
    });

    window.onload = function() {
        if (document.cookie.indexOf("cookie_consent=1") !== -1) {
            document.getElementById('cookieConsent').style.display = 'none';
        }
    };
</script>
