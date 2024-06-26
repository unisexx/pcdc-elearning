@extends('layouts.app')

@section('title', 'แดชบอร์ด')

@section('content')
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">ผู้ใช้ที่ลงทะเบียนในระบบ</p>
                                <h5 class="font-weight-bolder">
                                    2,345
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">+5%</span>
                                    จากเดือนก่อน
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">ผู้ใช้ที่ลงทะเบียนใหม่วันนี้</p>
                                <h5 class="font-weight-bolder">
                                    18
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">+3%</span>
                                    จากเมื่อวาน
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i class="ni ni-folder-17 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">จำนวนผู้เข้าร่วมทำแบบทดสอบ</p>
                                <h5 class="font-weight-bolder">
                                    1,835
                                </h5>
                                <p class="mb-0">
                                    <span class="text-danger text-sm font-weight-bolder">-2%</span>
                                    จากเดือนก่อน
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="ni ni-ruler-pencil text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">จำนวนผู้ผ่านแบบทดสอบ</p>
                                <h5 class="font-weight-bolder">
                                    945
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">+5%</span> จากเดือนก่อน
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">จำนวนผู้ผ่านแบบทดสอบ (ออกใบประกาศ)</h6>
                    <p class="text-sm mb-0">
                        <i class="fa fa-arrow-up text-success"></i>
                        <span class="font-weight-bold">4%</span> จากปีก่อน
                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card card-carousel overflow-hidden h-100 p-0">
                <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
                    <div class="carousel-inner border-radius-lg h-100">
                        <div class="carousel-item h-100 active" style="background-image: url('{{ asset('images/cert.png') }}');
        background-size: cover;">
                            {{-- <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                    <i class="ni ni-camera-compact text-dark opacity-10"></i>
                                </div>
                                <h5 class="text-white mb-1">Get started with Argon</h5>
                                <p>There’s nothing I really wanted to do in life that I wasn’t able to get good at.</p>
                            </div> --}}
                        </div>
                        {{-- <div class="carousel-item h-100" style="background-image: url('./img/carousel-2.jpg');
        background-size: cover;">
                            <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                    <i class="ni ni-bulb-61 text-dark opacity-10"></i>
                                </div>
                                <h5 class="text-white mb-1">Faster way to create web pages</h5>
                                <p>That’s my skill. I’m not really specifically talented at anything except for the
                                    ability to learn.</p>
                            </div>
                        </div>
                        <div class="carousel-item h-100" style="background-image: url('./img/carousel-3.jpg');
        background-size: cover;">
                            <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                    <i class="ni ni-trophy text-dark opacity-10"></i>
                                </div>
                                <h5 class="text-white mb-1">Share with us your design tips!</h5>
                                <p>Don’t be afraid to be wrong because you can’t learn anything from a compliment.</p>
                            </div>
                        </div> --}}
                    </div>
                    <button class="carousel-control-prev w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">

            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">เวลาที่ใช้ทำแบบทดสอบโดยเฉลี่ย</h6>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center ">
                        <tbody>
                            <tr>
                                <td class="w-30">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                        <div class="ms-4">
                                            <h6 class="text-sm mb-0">บทเรียนที่ 1 การเกิดโรค</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <h6 class="text-sm mb-0">8 นาที</h6>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-30">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                        <div class="ms-4">
                                            <h6 class="text-sm mb-0">บทเรียนที่ 2 โรคติดต่อที่พบบ่อยในเด็ก</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <h6 class="text-sm mb-0">15 นาที</h6>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-30">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                        <div class="ms-4">
                                            <h6 class="text-sm mb-0">บทเรียนที่ 3 การป้องกันควบคุมโรคติดต่อ</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <h6 class="text-sm mb-0">12 นาที</h6>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-30">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                        <div class="ms-4">
                                            <h6 class="text-sm mb-0">บทเรียนที่ 4 แนวปฏิบัติการเฝ้าระวังป้องกัน</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <h6 class="text-sm mb-0">10 นาที</h6>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-30">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                        <div class="ms-4">
                                            <h6 class="text-sm mb-0">บทเรียนที่ 5 การดูแลเด็กป่วยเบื้องต้น</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <h6 class="text-sm mb-0">14 นาที</h6>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="col-lg-5">
            <div class="card mb-4">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">แบบประเมินความพึงพอใจ</h6>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center">
                        <tbody>
                            <tr>
                                <td class="w-50">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                        <div class="ms-4">
                                            <h6 class="text-sm mb-0">ความน่าสนใจของเนื้อหา</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <h6 class="text-sm mb-0">8.5</h6>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-50">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                        <div class="ms-4">
                                            <h6 class="text-sm mb-0">ความยากง่ายของบทเรียน</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <h6 class="text-sm mb-0">7.8</h6>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-50">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                        <div class="ms-4">
                                            <h6 class="text-sm mb-0">ความพึงพอใจ</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <h6 class="text-sm mb-0">9.2</h6>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-50">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                        <div class="ms-4">
                                            <h6 class="text-sm mb-0">ระบบง่ายต่อการใช้งาน</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <h6 class="text-sm mb-0">8.0</h6>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-50">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                        <div class="ms-4">
                                            <h6 class="text-sm mb-0">ประโยชน์ต่อการนำไปใช้</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <h6 class="text-sm mb-0">8.7</h6>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        new Chart(ctx1, {
            type: "bar", // เปลี่ยนประเภทกราฟเป็น bar
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    backgroundColor: 'rgba(94, 114, 228, 0.5)', // สีพื้นหลังของแท่งกราฟ
                    borderColor: '#5e72e4', // สีขอบของแท่งกราฟ
                    borderWidth: 1, // ความหนาของขอบแท่งกราฟ
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500], // ข้อมูลในกราฟ
                    maxBarThickness: 50, // กำหนดความหนาสูงสุดของแท่งกราฟ
                    barThickness: 40, // กำหนดความหนาของแท่งกราฟ
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        },
                        // ปรับการตั้งค่าสำหรับการจัดกลุ่มแท่งกราฟ
                        categoryPercentage: 0.8, // เพิ่มเปอร์เซ็นต์ของการจัดกลุ่ม
                        barPercentage: 0.9, // เพิ่มเปอร์เซ็นต์ของความหนาแท่งกราฟ
                    },
                },
            },
        });
    </script>
@endpush
