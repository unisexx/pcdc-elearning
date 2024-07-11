@if ($showCookieConsent ?? false)
    <div class="cookie-consent">
        <p>เว็บไซต์นี้ใช้คุกกี้เพื่อเพิ่มประสบการณ์การใช้งานของคุณ <a href="{{ url('/privacy-policy') }}">อ่านเพิ่มเติม</a></p>
        <button id="acceptCookies">ยอมรับ</button>
    </div>
@endif

<script>
    document.getElementById('acceptCookies').addEventListener('click', function() {
        document.cookie = "cookie_consent=1; path=/";
        document.querySelector('.cookie-consent').style.display = 'none';
    });
</script>

<style>
    .cookie-consent {
        position: fixed;
        bottom: 0;
        width: 100%;
        background-color: #000;
        color: #fff;
        text-align: center;
        padding: 10px;
    }

    .cookie-consent p {
        margin: 0;
    }

    .cookie-consent button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
    }
</style>
