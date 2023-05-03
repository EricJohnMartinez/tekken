@extends('layouts.app')

@section('content')
    <style>
        body {
            background-image: url('http://minsu.edu.ph/template/images/slides/slides_2.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: top center;
            border-top-right-radius: 8px;
            border-top-left-radius: 8px;
            height: 100vh !important;
        }
    </style>

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
    <script>
        var dept = {!! json_encode($dept) !!};
        var empStat = {!! json_encode($empStat) !!};
    </script>
    <script>
        console.log(empStat);
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
                        'rgba(255, 159, 64, 2)'],
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

    <script>
        $(document).ready(function() {
            // Hide any error messages when the modal is opened
            $('#createJobModal').on('show.bs.modal', function() {
                $('.modal-body').find('.alert').remove();
                $('.modal-body').find('.is-invalid').removeClass('is-invalid');
            });

            // Submit the form when the "Create" button is clicked
            $('#createJobModal').on('click', '#createJobBtn', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');
                var url = form.attr('action');
                var formData = new FormData(form[0]);

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Handle success response here
                    },
                    error: function(xhr) {
                        // Handle error response here
                    }
                });
            });
        });
    </script>
    <!-- Bootstrap CSS -->


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>



@endsection
