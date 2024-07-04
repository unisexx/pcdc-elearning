<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
    @font-face {
        font-family: 'THSarabunNew';
        font-style: normal;
        font-weight: normal;
        src: url("{{ asset('fonts/THSarabunNew.ttf') }}") format('truetype');
    }

    @font-face {
        font-family: 'THSarabunNew';
        font-style: normal;
        font-weight: bold;
        src: url("{{ asset('fonts/THSarabunNew_Bold.ttf') }}") format('truetype');
    }

    @font-face {
        font-family: 'THSarabunNew';
        font-style: italic;
        font-weight: normal;
        src: url("{{ asset('fonts/THSarabunNew_Italic.ttf') }}") format('truetype');
    }

    @font-face {
        font-family: 'THSarabunNew';
        font-style: italic;
        font-weight: bold;
        src: url("{{ asset('fonts/THSarabunNew_BoldItalic.ttf') }}") format('truetype');
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
        background-image: url("{{ asset('images/certificate/certificate_bg_sign.jpg') }}");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        margin: 0 auto;
        display: block;
        line-height: 150px;
    }

    .running_number {
        position: absolute;
        font-size: 70;
        text-align: center;
        font-weight: bold;
        top: 20px;
        right: 150px;
    }

    .content-position {
        position: absolute;
        top: 650px;
        left: 50%;
        transform: translateX(-50%);
        text-align: center;
        white-space: nowrap;
    }

    .title {
        font-size: 200px;
        font-weight: bolder;
    }

    .name {
        font-size: 180px;
        font-weight: bolder;
    }

    .description {
        font-size: 180px;
    }

    .course {
        font-size: 180px;
        font-weight: bolder;
    }

    .date {
        font-size: 150px;
    }

    .qr {
        position: absolute;
        right: 300px;
        bottom: 70px;
    }

    .sign {
        position: absolute;
        font-size: 70;
        text-align: center;
        line-height: 70px;
        font-weight: bold;
    }

    .sign1 {
        top: 2200px;
        left: 465px;
    }

    .sign2 {
        top: 2200px;
        left: 50%;
        transform: translateX(-50%);
    }

    .sign3prefix {
        top: 2050px;
        left: 3300px;
    }

    .sign3 {
        top: 2200px;
        left: 3300px;
    }

    .sign4 {
        top: 2650px;
        left: 380px;
    }

    .sign5 {
        top: 2650px;
        left: 50%;
        transform: translateX(-50%);
    }

    .sign6 {
        top: 2650px;
        left: 3450px;
    }

    .expire {
        position: absolute;
        font-size: 70;
        text-align: center;
        font-weight: bold;
        bottom: 100px;
        left: 200px;
        color: #3d689e;
    }
</style>

<head>
    <title>Certificate</title>
</head>

<body>
    <div class="running_number">{{ @$running_number }}</div>
    <div class="content-position">
        <div class="title">{{ @$title }}</div>
        <div class="name">{{ @$name }}</div>
        <div class="description">{{ @$description }}</div>
        <div class="course">{{ @$course }}</div>
        <div class="date">{{ @$date }}</div>
    </div>
    <div class="sign sign1">
        <div>(นายแพทย์ธงชัย กีรติหัตถยากร)</div>
        <div>อธิบดีกรมควบคุมโรค</div>
    </div>
    <div class="sign sign2">
        <div>(แพทย์หญิงอัจฉรา นิธิอภิญญาสกุล)</div>
        <div>อธิบดีกรมอนามัย</div>
    </div>
    <div class="sign sign3prefix">ว่าที่ร้อยตรี</div>
    <div class="sign sign3">
        <div>(ธนุ วงษ์จินดา)</div>
        <div>เลขาธิการคณะกรรมการการศึกษาขั้นพื้นฐาน</div>
    </div>
    <div class="sign sign4">
        <div>(นายขจร ศรีชวโนทัย)</div>
        <div>อธิบดีกรมส่งเสริมการปกครองท้องถิ่น</div>
    </div>
    <div class="sign sign5">
        <div>(นางอภิญญา ชมภูมาศ)</div>
        <div>อธิบดีกรมกิจการเด็กและเยาวชน</div>
    </div>
    <div class="sign sign6">
        <div>(นายสุนทร สุนทรชาติ)</div>
        <div>ผู้อำนวยการสำนักอนามัย กทม.</div>
    </div>
    <div class="expire">
        <div>ประกาศนียบัตรนี้มีผลรับรองถึงปี {{ @$expires_at }}</div>
    </div>
    @if (isset($qrcode))
        <div class="qr">
            <img src="data:image/png;base64,{{ $qrcode }}" />
        </div>
    @endif
</body>

</html>
