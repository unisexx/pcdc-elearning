<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ config('app.name', 'e-learning โรคติดต่อในเด็กและโควิด 19') }}</title>
        <base href="{{url('/')}}">

        <style>
            body {
                font-family: "thsarabun";
                font-size: 16.0pt;
            }
            @page {
                header: page-header;
                margin-top: 25pt;
                footer: page-footer;
                margin-footer: 3mm; /* <any of the usual CSS values for margins> */
            }
            table {
                width: 100%;
                overflow: wrap;
                border-collapse: collapse;
            }

            h4 {
                font-size: 20px;
                font-weight: bold;
                line-height: 30px;
            }

            .page-break {
                page-break-after: always;
            }

            .input-dotted {
                display: inline-block;
                border-bottom: 1px dotted #000;
                text-decoration: none;
                text-align: center;
            }

            .input-group-text {
                border: 0px;
                background: #FFF;
                padding: 0rem 0.2rem;
                font-size: 14px;
                font-weight: normal;
            }
            .ps-7{
                padding-left:4rem;
            }
            .table-border th,.table-border td{
                border: 1px solid #000000;
            }
            p ,span, td{
                text-align:left!important;
            }
        </style>
        @stack('css')
    </head>

    <body>
        @yield('content')
    </body>
</html>