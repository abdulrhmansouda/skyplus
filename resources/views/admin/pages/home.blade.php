@extends('admin.dashboard')


@section('title','الصفحة الرئيسية')

@section('content')
    <div class="py-4 container-fluid">
        <div class="row">
            <div class="mb-4 col-lg-3 col-sm-6 mb-lg-0">
                <div class="card">
                    <div class="p-3 card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="mb-0 text-sm text-capitalize font-weight-bold">أموال اليوم</p>
                                    <h5 class="mb-0 font-weight-bolder">
                                        $53,000
                                        <br>

                                        <span class="text-sm text-success font-weight-bolder">+55%</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-start">
                                <div class="text-center shadow icon icon-shape bg-gradient-info border-radius-md">
                                    <i class="text-lg fas fa-wallet opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-4 col-lg-3 col-sm-6 mb-lg-0">
                <div class="card">
                    <div class="p-3 card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="mb-0 text-sm text-capitalize font-weight-bold">مستخدمو اليوم</p>
                                    <h5 class="mb-0 font-weight-bolder">
                                        2,300
                                        <br>
                                        <span class="text-sm text-success font-weight-bolder">+33%</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-start">
                                <div class="text-center shadow icon icon-shape bg-gradient-info border-radius-md">
                                    <i class="text-lg fas fa-calendar-alt opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-4 col-lg-3 col-sm-6 mb-lg-0">
                <div class="card">
                    <div class="p-3 card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="mb-0 text-sm text-capitalize font-weight-bold">عملاء جدد</p>
                                    <h5 class="mb-0 font-weight-bolder">
                                        +3,462
                                        <br />
                                        <span class="text-sm text-danger font-weight-bolder">-2%</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-start">
                                <div class="text-center shadow icon icon-shape bg-gradient-info border-radius-md">
                                    <i class="text-lg fas fa-id-card opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="p-3 card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="mb-0 text-sm text-capitalize font-weight-bold">مبيعات</p>
                                    <h5 class="mb-0 font-weight-bolder">
                                        $103,430
                                        <br />
                                        <span class="text-sm text-success font-weight-bolder">+5%</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-start">
                                <div class="text-center shadow icon icon-shape bg-gradient-info border-radius-md">
                                    <i class="fas fa-shopping-cart" text-lg opacity-10"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4 row">
            <div class="mb-4 col-lg-7 mb-lg-0">
                <div class="card">
                    <div class="p-3 pb-4 card-body">
                        <div class="row">
                            <div class="mb-4 col-lg-6 mb-lg-0">
                                <div class="d-flex flex-column h-100">
                                    <h6 class="font-weight-bolder"> نظرة عامة على الفواتير</h6>
                                    <form action="">
                                        <div class="mb-3">
                                            <input type="date" class="form-control" aria-label="name"
                                                aria-describedby="name-addon" required value='2022-03-29'>
                                        </div>
                                    </form>
                                    <span class="text-xs text-info">اختر تاريخ مختلف لعرض قيمه</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ul class="p-0 mt-4 list-group">
                                    <li class="pt-0 pb-0 text-sm border-0 list-group-item ps-0"><strong
                                            class="text-dark">عدد الفواتير
                                            :</strong>&nbsp; 100</li>
                                    <li class="pb-0 text-sm border-0 list-group-item ps-0"><strong
                                            class="text-dark">مجموع قيمة الفواتير
                                            :</strong> &nbsp; 2000</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-4 col-lg-5 mb-lg-0">
                <div class="card">
                    <div class="p-3 card-body">
                        <h6 class="mb-0 ms-2"> المستخدمين </h6>
                        <div class="container px-0 border-radius-lg px-md-3">
                            <div class="row">
                                <div class="pt-3 col-sm-4 col-6 ps-0">
                                    <div class="mb-0 d-flex">
                                        <div
                                            class="text-center shadow icon icon-shape icon-sm border-radius-sm bg-gradient-success ms-2 d-flex align-items-center justify-content-center">
                                            <i class="cursor-pointer fa fa-user fs-6" aria-hidden="true"></i>
                                        </div>
                                        <p class="mt-1 mb-0 text-sm font-weight-bold">نشط</p>
                                    </div>
                                    <h4 class="font-weight-bolder">86</h4>
                                </div>
                                <div class="pt-3 col-sm-4 col-6 ps-0">
                                    <div class="mb-0 d-flex">
                                        <div
                                            class="text-center shadow icon icon-shape icon-sm border-radius-sm bg-gradient-info ms-2 d-flex align-items-center justify-content-center">
                                            <i class="cursor-pointer fa fa-user fs-6" aria-hidden="true"></i>
                                        </div>
                                        <p class="mt-1 mb-0 text-sm font-weight-bold">غير نشط</p>
                                    </div>
                                    <h4 class="font-weight-bolder">0</h4>
                                </div>
                                <div class="pt-3 col-sm-4 col-6 ps-0">
                                    <div class="mb-0 d-flex">
                                        <div
                                            class="text-center shadow icon icon-shape icon-sm border-radius-sm bg-gradient-danger ms-2 d-flex align-items-center justify-content-center">
                                            <i class="cursor-pointer fa fa-user fs-6" aria-hidden="true"></i>
                                        </div>
                                        <p class="mt-1 mb-0 text-sm font-weight-bold">مغلق</p>
                                    </div>
                                    <h4 class="font-weight-bolder">0</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4 row">

            <div class="col-12">
                <div class="card">
                    <div class="pb-0 card-header">
                        <h6>نظرة عامة على المبيعات</h6>
                        <p class="text-sm">
                            <i class="fa fa-arrow-up text-success"></i>
                            <span class="font-weight-bold">4% أكثر</span> في عام 2021
                        </p>
                    </div>
                    <div class="p-3 card-body">
                        <div class="chart">
                            <canvas id="chart-line" class="chart-canvas" height="300px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('js')
    <script>
        // var ctx = document.getElementById("chart-bars").getContext("2d");

        // new Chart(ctx, {
        //   type: "bar",
        //   data: {
        //     labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        //     datasets: [{
        //       label: "Sales",
        //       tension: 0.4,
        //       borderWidth: 0,
        //       borderRadius: 4,
        //       borderSkipped: false,
        //       backgroundColor: "#fff",
        //       data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
        //       maxBarThickness: 6
        //     },],
        //   },
        //   options: {
        //     responsive: true,
        //     maintainAspectRatio: false,
        //     plugins: {
        //       legend: {
        //         display: false,
        //       }
        //     },
        //     interaction: {
        //       intersect: false,
        //       mode: 'index',
        //     },
        //     scales: {
        //       y: {
        //         grid: {
        //           drawBorder: false,
        //           display: false,
        //           drawOnChartArea: false,
        //           drawTicks: false,
        //         },
        //         ticks: {
        //           suggestedMin: 0,
        //           suggestedMax: 500,
        //           beginAtZero: true,
        //           padding: 15,
        //           font: {
        //             size: 14,
        //             family: "Open Sans",
        //             style: 'normal',
        //             lineHeight: 2
        //           },
        //           color: "#fff"
        //         },
        //       },
        //       x: {
        //         grid: {
        //           drawBorder: false,
        //           display: false,
        //           drawOnChartArea: false,
        //           drawTicks: false
        //         },
        //         ticks: {
        //           display: false
        //         },
        //       },
        //     },
        //   },
        // });


        var ctx2 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

        var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
        gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

        new Chart(ctx2, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                        label: "Mobile apps",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#cb0c9f",
                        borderWidth: 3,
                        backgroundColor: gradientStroke1,
                        fill: true,
                        data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                        maxBarThickness: 6

                    },
                    {
                        label: "Websites",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#3A416F",
                        borderWidth: 3,
                        backgroundColor: gradientStroke2,
                        fill: true,
                        data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
                        maxBarThickness: 6
                    },
                ],
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
                            color: '#b2b9bf',
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
                            color: '#b2b9bf',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
@endsection

