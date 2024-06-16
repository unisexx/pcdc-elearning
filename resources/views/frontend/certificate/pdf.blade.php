<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
    @font-face {
        font-family: 'THSarabunNew';
        font-style: normal;
        font-weight: normal;
        src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
    }

    @font-face {
        font-family: 'THSarabunNew';
        font-style: normal;
        font-weight: bold;
        src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
    }

    @font-face {
        font-family: 'THSarabunNew';
        font-style: italic;
        font-weight: normal;
        src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
    }

    @font-face {
        font-family: 'THSarabunNew';
        font-style: italic;
        font-weight: bold;
        src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
    }

    html,
    body {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        position: relative;
    }

    body {
        font-family: "THSarabunNew";
        background-image: url("{{ asset('images/certificate/certificate_bg.jpg') }}");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        margin: 0 auto;
        display: block;
    }

    h1 {
        position: absolute;
        font-size: 200px;
        font-weight: bolder;
        top: 500px;
        left: 50%;
        /* กำหนดตำแหน่งซ้ายเป็นกึ่งกลางของหน้า */
        transform: translateX(-50%);
        /* ย้ายตำแหน่งในแนวนอนกลับไปครึ่งหนึ่งของความกว้างของ h1 */
        text-align: center;
        /* จัดข้อความให้อยู่กึ่งกลางใน h1 */
    }
</style>

<head>
    <title>Certificate</title>
</head>

<body>
    <h1>{{ $title }}</h1>
</body>

</html>
