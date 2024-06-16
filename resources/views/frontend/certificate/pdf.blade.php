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

    body {
        font-family: "THSarabunNew";
    }

    .certificate {
        text-align: center;
        border: 10px solid #000;
        padding: 20px;
        margin: 50px auto;
        width: 70%;
    }

    .certificate h1 {
        font-size: 50px;
        margin-bottom: 0;
    }

    .certificate p {
        font-size: 20px;
    }

    .qrcode {
        margin-top: 20px;
    }
</style>

<head>
    <title>Certificate</title>
</head>

<body>
    <div class="certificate">
        <h1>Certificate of Completion</h1>
        <p>This is to certify that</p>
        <h2>{{ $name }}</h2>
        <p>has successfully completed the course</p>
        <h2>{{ $course }}</h2>
        <p>{{ $date }}</p>
        <div class="qrcode">
            <img src="data:image/png;base64,{{ $qrcode }}" alt="QR Code">
        </div>
    </div>
</body>

</html>
