@if ($showCookieConsent ?? false)
    <div class="cookie-consent" id="cookieConsent">
        <div class="container">
            <div class="row bg1_cookie justify-content-between">
                <svg class="inner-dashed-border animated-dashes">
                    <rect x="5px" y="5px" rx="30px" ry="30px" width="97%" height="85%"></rect>
                </svg>
                <div class="d-block d-sm-flex align-items-center">
                    <div class="p-2 w-100 d-flex flex-lg-row flex-column">
                        {{-- <div class="cookie_icon me-3"><img src="{{ asset('html/images/check-mark.svg') }}" alt="" class="img-fluid"></div> --}}
                        <div class="cookie_title me-3 pt-2">
                            เราใช้คุกกี้เพื่อพัฒนาประสิทธิภาพ และประสบการณ์ที่ดีในการใช้เว็บไซต์ของคุณ คุณสามารถศึกษารายละเอียดได้ที่
                            <a href="{{ url('/cookie-policy') }}" class="read_consent">นโยบายคุกกี้</a>
                            และสามารถจัดการความเป็นส่วนตัวเองได้ของคุณได้เองโดยคลิกที่ปุ่มตั้งค่า
                        </div>
                    </div>
                    <style>
                        .cookie-button-grid {
                            display: grid;
                            grid-template-columns: repeat(2, 1fr);
                            gap: 1rem;
                        }
                    </style>

                    <div class="p-2 ms-auto cookie-button-grid">
                        <a class="close-btn" id="cookieConsentCloseButton"><i class="fa fa-times-circle"></i></a>
                        <button class="btn rounded-pill btn-allow" id="acceptCookies">ยอมรับ</button>
                        {{-- <button class="btn btn-secondary rounded-pill" data-bs-toggle="modal" data-bs-target="#cookieSettingsModal">ตั้งค่า</button> --}}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endif

<!-- Bootstrap 5 Modal for Cookie Settings -->
<div class="modal fade" id="cookieSettingsModal" tabindex="-1" aria-labelledby="cookieSettingsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cookieSettingsModalLabel">การตั้งค่าคุกกี้</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>โปรดเลือกประเภทของคุกกี้ที่คุณต้องการอนุญาต:</p>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="strictlyNecessary" checked disabled>
                    <label class="form-check-label" for="strictlyNecessary">
                        คุกกี้ที่จำเป็นอย่างเคร่งครัด (Strictly Necessary Cookies)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="performanceCookies">
                    <label class="form-check-label" for="performanceCookies">
                        คุกกี้เพื่อการวิเคราะห์และประเมินผล (Performance Cookies)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="functionalCookies">
                    <label class="form-check-label" for="functionalCookies">
                        คุกกี้เพื่อการใช้งานเว็บไซต์ (Functional Cookies)
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary" id="saveCookieSettings">บันทึกการตั้งค่า</button>
            </div>
        </div>
    </div>
</div>

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

    document.getElementById('saveCookieSettings').addEventListener('click', function() {
        const performance = document.getElementById('performanceCookies').checked;
        const functional = document.getElementById('functionalCookies').checked;

        fetch('/save-cookie-settings', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    performanceCookies: performance,
                    functionalCookies: functional
                })
            })
            .then(response => response.text())
            .then(data => {
                console.log('Cookie settings saved:', data);
                document.querySelector('.cookie-consent').style.display = 'none';
                document.querySelector('#cookieSettingsModal').modal('hide');
            })
            .catch((error) => {
                console.error('Error saving settings:', error);
            });
    });

    window.onload = function() {
        if (document.cookie.indexOf("cookie_consent=1") !== -1) {
            document.getElementById('cookieConsent').style.display = 'none';
        }
    };
</script>

<style>
    .read_consent {
        text-decoration: underline;
    }
</style>
