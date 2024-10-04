@extends('layouts.app')

@section('title', 'แดชบอร์ด')

@section('content')
    <div class="row">

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            {!! Form::select('curriculum_id', $curriculums, null, ['class' => 'form-select float-end', 'id' => 'curriculumSelect']) !!}
        </div>
        <div class="w-100 mb-3"></div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class=" mb-0 text-uppercase font-weight-bold">ผู้ใช้ที่ลงทะเบียนในระบบ</p>
                                <h5 class="font-weight-bolder">
                                    {{ number_format($userCount) }}
                                </h5>
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
                                <p class=" mb-0 text-uppercase font-weight-bold">ผู้ใช้ที่ลงทะเบียนใหม่วันนี้</p>
                                <h5 class="font-weight-bolder">
                                    {{ number_format($userCountToday) }}
                                </h5>
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
                                <p class=" mb-0 text-uppercase font-weight-bold">
                                    จำนวนผู้เข้าร่วมทำแบบทดสอบ
                                </p>
                                <h5 id="allPostExamCount" class="font-weight-bolder">
                                    {{-- Ajax Data Here --}}
                                </h5>
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
                                <p class=" mb-0 text-uppercase font-weight-bold">จำนวนผู้ผ่านแบบทดสอบ</p>
                                <h5 id="allPostExamPassCount" class="font-weight-bolder">
                                    {{-- Ajax Data Here --}}
                                </h5>
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
                    <h6 class="text-capitalize">จำนวนผู้ทำแบบทดสอบ</h6>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="stackedBarChart" class="chart-canvas" height="400"> {{-- Ajax Data Here --}}</canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card card-carousel overflow-hidden h-100 p-0">
                <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
                    <div class="carousel-inner border-radius-lg h-100">
                        <div class="carousel-item h-100 active" style="background-image: url('{{ asset('images/certificate.png') }}');
        background-size: cover;">
                        </div>
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
        <!-- ประเภทผู้ใช้งานทั้งหมด และ ช่องทางการลงทะเบียน อยู่ในคอลัมน์ซ้าย -->
        <div class="col-lg-6 mb-4">
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-2">ประเภทผู้ใช้งานทั้งหมด</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="userTypePieChart" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-2">ช่องทางการลงทะเบียน</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="providerPieChart" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- คะแนนเฉลี่ยแบบประเมินความพึงพอใจ อยู่ในคอลัมน์ขวา -->
        <div class="col-lg-6">
            <div class="card mb-4 h-100">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">แบบประเมินความพึงพอใจ</h6>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="surveyBarChart" class="chart-canvas" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script>
        $(document).ready(function() {
            var ctx = document.getElementById('stackedBarChart').getContext('2d');
            var stackedBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
                    datasets: [{
                            label: 'ผู้ทำแบบทดสอบไม่ผ่าน',
                            data: [],
                            backgroundColor: 'rgba(75, 192, 192, 0.6)',
                            stack: 'Stack 0',
                        },
                        {
                            label: 'ผู้ทำแบบทดสอบผ่าน',
                            data: [],
                            backgroundColor: 'rgba(153, 102, 255, 0.6)',
                            stack: 'Stack 0',
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'จำนวนผู้ทำแบบทดสอบผ่านและไม่ผ่านในแต่ละเดือน'
                        },
                        datalabels: {
                            anchor: 'end', // กำหนดให้ label อยู่ด้านบนของแท่ง
                            align: 'end', // ปรับตำแหน่ง
                            formatter: (value, ctx) => {
                                return value.toLocaleString(); // แปลงตัวเลขให้อยู่ในรูปแบบที่อ่านง่าย
                            },
                            color: 'black', // สีของตัวเลขบนกราฟ
                            font: {
                                weight: 'bold' // ทำให้ตัวเลขเป็นตัวหนา
                            }
                        }
                    },
                    scales: {
                        x: {
                            stacked: true,
                        },
                        y: {
                            stacked: true,
                            ticks: {
                                beginAtZero: true,
                                stepSize: 1
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels] // เพิ่มปลั๊กอิน datalabels
            });


            var surveyCtx = document.getElementById('surveyBarChart').getContext('2d');
            var surveyBarChart = new Chart(surveyCtx, {
                type: 'bar',
                data: {
                    labels: [], // หัวข้อแบบประเมินจะถูกอัพเดตจาก Ajax
                    datasets: [{
                        label: 'คะแนนเฉลี่ย (เต็ม 5)',
                        data: [], // คะแนนเฉลี่ยจะถูกอัพเดตจาก Ajax
                        backgroundColor: 'rgba(75, 192, 192, 0.6)', // กำหนดสีของแท่งกราฟ
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    indexAxis: 'y', // ทำให้กราฟเป็นแนวนอน
                    scales: {
                        x: {
                            beginAtZero: true,
                            max: 5 // ตั้งค่าขนาดสูงสุดของแกน X เป็น 5 เพื่อแสดงคะแนนเต็ม
                        }
                    },
                    plugins: {
                        legend: {
                            display: false // ซ่อนตัวบ่งบอกสี (legend) เพราะมีเพียงชุดข้อมูลเดียว
                        },
                        title: {
                            display: true,
                            text: 'คะแนนเฉลี่ยแบบประเมินความพึงพอใจ (คะแนนเต็ม 5)'
                        },
                        datalabels: {
                            anchor: 'end',
                            align: 'end',
                            formatter: (value, ctx) => {
                                if (typeof value === 'number') {
                                    return value.toFixed(1); // แสดงตัวเลขที่มีทศนิยม 1 ตำแหน่ง
                                }
                                return value; // ถ้าไม่ใช่ตัวเลข ให้แสดงค่าเดิม
                            },
                            color: 'black', // สีของตัวเลข
                            font: {
                                weight: 'bold' // ทำให้ตัวเลขหนา
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels] // เพิ่มปลั๊กอิน datalabels
            });


            ajaxDashboard($('#curriculumSelect').val());

            $('#curriculumSelect').change(function() {
                var curriculum_id = $(this).val();
                ajaxDashboard(curriculum_id);
            });

            function ajaxDashboard(curriculum_id) {
                $.ajax({
                    url: "{{ route('ajax.dashboard') }}",
                    type: "GET",
                    data: {
                        curriculum_id: curriculum_id
                    },
                    success: function(response) {
                        // อัพเดตข้อมูลกราฟแท่งแนวนอน
                        var surveyLabels = [];
                        var surveyData = [];

                        $.each(response.surveyResults, function(index, survey) {
                            surveyLabels.push(survey.survey.title); // ชื่อหัวข้อ
                            surveyData.push(parseFloat(survey.average_rating).toFixed(1)); // คะแนนเฉลี่ย
                        });

                        // อัพเดตข้อมูลในกราฟแท่งแนวนอน
                        surveyBarChart.data.labels = surveyLabels;
                        surveyBarChart.data.datasets[0].data = surveyData;
                        surveyBarChart.update();

                        // อัพเดตจำนวนผู้ทำแบบทดสอบและผู้ผ่านแบบทดสอบ
                        $('#allPostExamCount').text(response.allPostExamCount.toLocaleString());
                        $('#allPostExamPassCount').text(response.allPostExamPassCount.toLocaleString());

                        // อัพเดตข้อมูลในกราฟแท่ง
                        stackedBarChart.data.datasets[0].data = response.postExamNotPassDataChart;
                        stackedBarChart.data.datasets[1].data = response.postExamPassDataChart;
                        stackedBarChart.update();
                    }
                });
            }
        });
    </script>
@endpush

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // กราฟประเภทผู้ใช้
            var ctx1 = document.getElementById('userTypePieChart').getContext('2d');
            var userTypePieChart = new Chart(ctx1, {
                type: 'pie',
                data: {
                    labels: @json($userTypeLabels),
                    datasets: [{
                        data: @json($userTypeData),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(153, 102, 255, 0.6)',
                            'rgba(255, 159, 64, 0.6)'
                        ],
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'ประเภทผู้ใช้งานทั้งหมดในระบบ'
                        },
                        datalabels: {
                            formatter: (value, ctx) => {
                                let sum = ctx.dataset.data.reduce((a, b) => a + b, 0); // หาผลรวมทั้งหมดของกราฟ
                                let percentage = (value * 100 / sum).toFixed(2) + "%"; // คำนวณเปอร์เซ็นต์
                                return percentage; // แสดงเป็นเปอร์เซ็นต์
                            },
                            color: '#000', // เปลี่ยนสีของตัวเลขเป็นสีดำ
                            font: {
                                weight: 'bold', // ทำให้ตัวเลขเป็นตัวหนา
                                size: 14 // ขนาดของตัวเลข
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels] // เรียกใช้ปลั๊กอิน datalabels
            });



            // กราฟช่องทางการลงทะเบียน
            var ctx2 = document.getElementById('providerPieChart').getContext('2d');
            var providerPieChart = new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: @json($providerLabels),
                    datasets: [{
                        data: @json($providerData),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(153, 102, 255, 0.6)',
                            'rgba(255, 159, 64, 0.6)'
                        ],
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'ช่องทางการลงทะเบียนผู้ใช้งาน'
                        },
                        datalabels: {
                            formatter: (value, ctx) => {
                                let sum = ctx.dataset.data.reduce((a, b) => a + b, 0); // หาผลรวมทั้งหมดของกราฟ
                                let percentage = (value * 100 / sum).toFixed(2) + "%"; // คำนวณเปอร์เซ็นต์
                                return percentage; // แสดงเป็นเปอร์เซ็นต์
                            },
                            color: '#000', // เปลี่ยนสีของตัวเลขเป็นสีดำ
                            font: {
                                weight: 'bold', // ทำให้ตัวเลขเป็นตัวหนา
                                size: 14 // ขนาดของตัวเลข
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels] // เรียกใช้ปลั๊กอิน datalabels
            });

        });
    </script>
@endpush
