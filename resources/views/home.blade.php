@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (!session('welcome_notification'))
                    @php
                        session(['welcome_notification' => true]);
                    @endphp
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: true,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK',
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })
                        Toast.fire({
                            icon: 'success',
                            title: "{{ __('Welcome To AlumnConnect!') }} {{ Auth::user()->name }}"
                        })
                    </script>
                @endif
            </div>
            {{-- <div class="col-md-8">
                <div class="row">
                    <div class="col">
                        @if (auth()->user()->status == 'completed')
                            <div class="col-md-8">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
                                <link rel="stylesheet"
                                    href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css">

                                <script>
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'info',
                                        title: '{{ __('Welcome to AlumnConnect!') }}   {{ Auth::user()->name }} {{ __('please wait for admin approval to access site') }}',
                                        showConfirmButton: true,
                                        confirmButtonText: '{{ __('OK') }}',
                                    });
                                </script>

                            </div>
                        @endif
                    </div>
                </div>
            </div> --}}
            <div class="col-md-8">
                <div class="row">
                    <div class="col">
                        @if (!auth()->user()->approved)
                            <div class="col-md-8">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
                                <link rel="stylesheet"
                                    href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css">

                                <script>
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'info',
                                        title: '{{ __('Welcome to AlumnConnect!') }}   {{ Auth::user()->name }} {{ __('please wait for admin approval to access site') }}',
                                        showConfirmButton: true,
                                        confirmButtonText: '{{ __('OK') }}',
                                    });
                                </script>

                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('pdf.records') }}" class="btn btn-primary ml-auto mb-4">Print Records</a>


    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="container text-center">
                        <h1>DEPARTMENT</h1>
                        <canvas id="Department"></canvas>
                    </div>
                </div>
                <div class="col-6">
                    <div class="container text-center">
                        <h1>EMPLOYMENT STATUS</h1>
                        <canvas id="employmentStatus"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="container text-center">
                        <h1>Job Related to Baccalaureate Degree</h1>
                        <canvas id="jobRelate"></canvas>
                    </div>
                </div>
                <div class="col-6">
                    <div class="container text-center">
                        <h1>CIVIL SERVICE ELIGIBILITY</h1>
                        <canvas id="civil"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="container text-center">
                        <h1>Work Employment Status</h1>
                        <canvas id="workStat"></canvas>
                    </div>
                </div>
                <div class="col-6">
                    <div class="container text-center">
                        <h1>POSITION ON WORK</h1>
                        <canvas id="position"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center mb-3">Alumni's Work Address</h3>
                <div type="hidden" id="map" style="height: 400px;"></div>
            </div>
        </div>
    </div>
 
    <script>
        
        var map = L.map('map').setView([12.8797, 121.7740], 6);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Retrieve user coordinates from the database
        var userCoordinates = {!! json_encode($userCoordinates) !!};

        // Loop through the user coordinates and add markers to the map
        for (var i = 0; i < userCoordinates.length; i++) {
            var userMarker = L.marker([userCoordinates[i].lat, userCoordinates[i].lng]).addTo(map);
            userMarker.bindPopup("<div style='font-weight: bold; font-size: 16px;'>" + userCoordinates[i].name + "'s Work Address</div><br>" + userCoordinates[i].address);

        }
    </script>

    <script>
        var dept = {!! json_encode($dept) !!};
        var empStat = {!! json_encode($empStat) !!};
        var jobRelate = {!! json_encode($jobRelate) !!};
        var civil = {!! json_encode($civil) !!};
        var workStat = {!! json_encode($workStat) !!};
        var position = {!! json_encode($position) !!};

    </script>
    <script> 
        var ctx = document.getElementById('position').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: position.map(d => d.label),
                datasets: [{
                        label: [position.map(d => d.label)],
                        data: position.map(d => d.value),
                        backgroundColor: [
                            'rgba(255, 99, 132, 2)',
                            'rgba(54, 162, 235, 2)',
                            'rgba(255, 206, 86, 2)',
                            'rgba(75, 192, 192, 2)',
                            'rgba(153, 102, 255, 2)',
                            'rgba(255, 159, 64, 2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    },

                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
    <script> 
        var ctx = document.getElementById('workStat').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: workStat.map(d => d.label),
                datasets: [{
                        label: [workStat.map(d => d.label)],
                        data: workStat.map(d => d.value),
                        backgroundColor: [
                            'rgba(255, 99, 132, 2)',
                            'rgba(54, 162, 235, 2)',
                            'rgba(255, 206, 86, 2)',
                            'rgba(75, 192, 192, 2)',
                            'rgba(153, 102, 255, 2)',
                            'rgba(255, 159, 64, 2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    },

                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
    <script> 
        var ctx = document.getElementById('civil').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: civil.map(d => d.label),
                datasets: [{
                        label: [civil.map(d => d.label)],
                        data: civil.map(d => d.value),
                        backgroundColor: [
                            'rgba(255, 99, 132, 2)',
                            'rgba(54, 162, 235, 2)',
                            'rgba(255, 206, 86, 2)',
                            'rgba(75, 192, 192, 2)',
                            'rgba(153, 102, 255, 2)',
                            'rgba(255, 159, 64, 2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    },

                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
    <script>
        
        var ctx = document.getElementById('jobRelate').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: jobRelate.map(d => d.label),
                datasets: [{
                        label: [jobRelate.map(d => d.label)],
                        data: jobRelate.map(d => d.value),
                        backgroundColor: [
                            'rgba(255, 99, 132, 2)',
                            'rgba(54, 162, 235, 2)',
                            'rgba(255, 206, 86, 2)',
                            'rgba(75, 192, 192, 2)',
                            'rgba(153, 102, 255, 2)',
                            'rgba(255, 159, 64, 2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    },

                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
    <script>
       
        var ctx = document.getElementById('employmentStatus').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: empStat.map(d => d.label),
                datasets: [{
                        label: [empStat.map(d => d.label)],
                        data: empStat.map(d => d.value),
                        backgroundColor: [
                            'rgba(255, 99, 132, 2)',
                            'rgba(54, 162, 235, 2)',
                            'rgba(255, 206, 86, 2)',
                            'rgba(75, 192, 192, 2)',
                            'rgba(153, 102, 255, 2)',
                            'rgba(255, 159, 64, 2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    },

                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

    <script>
        var ctx = document.getElementById('Department').getContext('2d');
        var Department = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: dept.map(d => d.label),
                datasets: [{
                    label: 'Department',
                    data: dept.map(d => d.value),
                    backgroundColor: [
                        'rgba(255, 99, 132, 2)',
                        'rgba(54, 162, 235, 2)',
                        'rgba(255, 206, 86, 2)',
                        'rgba(75, 192, 192, 2)',
                        'rgba(153, 102, 255, 2)',
                        'rgba(255, 159, 64, 2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

@endsection
