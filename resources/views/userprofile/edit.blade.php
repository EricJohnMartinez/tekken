@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-9 mx-auto">
                <div class="card ">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-md-3">
                                @if (Auth::user()->media_urls['photo'])
                                    <img style="height: 170px; object-fit: contain;"
                                        src="{{ Auth::user()->media_urls['photo'] }}" alt="Profile Photo"
                                        class="img-thumbnail rounded-circle w-100">
                                @else
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/45/Minsu.png/640px-Minsu.png"
                                        alt="Profile Photo" class="rounded-circle w-100">
                                @endif

                            </div>
                            <div class="col-md-9">
                                <h2>{{ Auth::user()->name }}</h2>
                                <form action="{{ route('userprofile.update', Auth::user()->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3 row">
                                        <div class="col">
                                            <label for="photo" class="form-label">
                                                Profile Photo
                                            </label>
                                            <input class='dropzone' type="file" name="photo" id="photo"
                                                accept="image/*">
                                            @error('photo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        @if (Auth::user()->hasRole('employer'))
                                        @else
                                            <div class="col">
                                                <label for="resume" class="form-label">Resume</label>
                                                <input name="resume" type="file" id="">
                                                @error('resume')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>
                                    @if (Auth::user()->hasRole('employer'))
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name"
                                                value="{{ Auth::user()->name }}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email"
                                                value="{{ Auth::user()->email }}" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="department">Department</label>
                                            <select name="department" id="department" class="form-control">
                                                <option value="{{ Auth::user()->department }}">
                                                    {{ Auth::user()->department }}
                                                </option>
                                                @if (Auth::user()->hasRole('employer'))
                                                    <option value="Employer">Employer</option>
                                                @else
                                                    <option value="BSED">BSED</option>
                                                    <option value="BTVTED">BTVTED</option>
                                                    <option value="Criminology">Criminology</option>
                                                    <option value="BSIT">BSIT</option>
                                                    <option value="CBM">CBM</option>
                                                    <option value="AB">AB</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="home_address">Home Address</label>
                                            <input type="text" name="home_address" id="home_address"
                                                value="{{ Auth::user()->home_address }}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="age">Age</label>
                                            <input type="number" name="age" id="age"
                                                value="{{ Auth::user()->age }}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="work_company">Work Company</label>
                                            <input type="text" name="work_company" id="work_company"
                                                value="{{ Auth::user()->work_company }}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="employment_status">Employment Status</label>
                                            <select name="employment_status" id="employment_status" class="form-control">
                                                <option value="{{ Auth::user()->employment_status }}">--Select Employment
                                                    Status--</option>
                                                @if (Auth::user()->hasRole('employer'))
                                                    <option value="employer"
                                                        {{ Auth::user()->employment_status == 'employer' ? 'selected' : '' }}>
                                                        Employer</option>
                                                @else
                                                    <option value="employed"
                                                        {{ Auth::user()->employment_status == 'employed' ? 'selected' : '' }}>
                                                        Employed</option>
                                                    <option value="unemployed"
                                                        {{ Auth::user()->employment_status == 'unemployed' ? 'selected' : '' }}>
                                                        Unemployed</option>
                                                @endif
                                            </select>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name"
                                                value="{{ Auth::user()->name }}" class="form-control">
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email"
                                                value="{{ Auth::user()->email }}" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="department">Department</label>
                                            <select name="department" id="department" class="form-control">
                                                <option value="{{ Auth::user()->department }}">--Select Department--
                                                </option>
                                                @if (Auth::user()->hasRole('employer'))
                                                    <option value="Employer">Employer</option>
                                                @else
                                                    <option value="BSED">BSED</option>
                                                    <option value="BTVTED">BTVTED</option>
                                                    <option value="Criminology">Criminology</option>
                                                    <option value="BSIT">BSIT</option>
                                                    <option value="CBM">CBM</option>
                                                    <option value="AB">AB</option>
                                                @endif
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="civil_service">Civil Service</label>
                                            <input type="text" name="civil_service" id="civil_service"
                                                value="{{ Auth::user()->civil_service }}" class="form-control"
                                                placeholder="(Ex: Career Service Examination, Board Exam)
                                            "required>

                                        </div>

                                        <div class="form-group">
                                            <label for="home_address">Home Address</label>
                                            <input type="text" name="home_address" id="home_address"
                                                value="{{ Auth::user()->home_address }}" class="form-control"
                                                placeholder="Home Address"required>
                                        </div>
                                        <div class="form-group">
                                            <label for="age">Age</label>
                                            <input type="number" name="age" id="age"
                                                value="{{ Auth::user()->age }}" class="form-control"
                                                placeholder="Age"required>
                                        </div>
                                        <div class="form-group">
                                            <label for="year_graduated">Year Graduated</label>
                                            <select name="year_graduated" id="year_graduated" class="form-control">
                                                <option value="{{ Auth::user()->year_graduated }}">
                                                    --Select Year Graduated--</option>
                                                <option value="2009-2010">A.Y. 2009 - 2010</option>
                                                <option value="2010-2011">A.Y. 2010 - 2011</option>
                                                <option value="2011-2012">A.Y. 2011 - 2012</option>
                                                <option value="2012-2013">A.Y. 2012 - 2013</option>
                                                <option value="2013-2014">A.Y. 2013 - 2014</option>
                                                <option value="2014-2015">A.Y. 2014 - 2015</option>
                                                <option value="2015-2016">A.Y. 2015 - 2016</option>
                                                <option value="2016-2017">A.Y. 2016 - 2017</option>
                                                <option value="2017-2018">A.Y. 2017 - 2018</option>
                                                <option value="2018-2019">A.Y. 2018 - 2019</option>
                                                <option value="2019-2020">A.Y. 2019 - 2020</option>
                                                <option value="2020-2021">A.Y. 2020 - 2021</option>
                                                <option value="2021-2022">A.Y. 2021 - 2022</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="employment_status">Employment Status</label>
                                            <select name="employment_status" id="employment_status" class="form-control">
                                                <option value="{{ Auth::user()->employment_status }}">--Select Employment
                                                    Status--</option>
                                                @if (Auth::user()->hasRole('employer'))
                                                    <option value="employer"
                                                        {{ Auth::user()->employment_status == 'employer' ? 'selected' : '' }}>
                                                        Employer</option>
                                                @else
                                                    <option value="employed"
                                                        {{ Auth::user()->employment_status == 'employed' ? 'selected' : '' }}>
                                                        Employed</option>
                                                    <option value="unemployed"
                                                        {{ Auth::user()->employment_status == 'unemployed' ? 'selected' : '' }}>
                                                        Unemployed</option>
                                                @endif
                                            </select>
                                        </div>

                                        <div id="employed-fields" style="display: none;">
                                            <div class="form-group">
                                                <label for="work_company">Name of Company</label>
                                                <input type="text" name="work_company" id="work_company"
                                                    value="{{ Auth::user()->work_company }}" class="form-control"
                                                    placeholder="Name of Company">
                                            </div>
                                            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                                            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
                                            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
                                            <div class="form-group">
                                                <label for="work_address">Work Address</label>
                                                <div class="input-group">
                                                    <input type="text" name="work_address"
                                                        value="{{ Auth::user()->work_address }}" id="work_address"
                                                        class="form-control" placeholder="Work Address">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-primary"
                                                            data-toggle="modal" data-target="#addressModal">Select
                                                            Address</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="position_on_work">Position on Work</label>
                                                <input type="text" name="position_on_work" id="position_on_work"
                                                    value="{{ Auth::user()->position_on_work }}" class="form-control"
                                                    placeholder="(Ex: Instructor )
                                                ">
                                            </div>

                                            <div class="form-group">
                                                <label for="date_hired">Date Hired</label>
                                                <input type="date" name="date_hired" id="date_hired"
                                                    value="{{ Auth::user()->date_hired }}" class="form-control">
                                            </div>

                                            <div class="form-group"> <label for="employed_status">Work Employment
                                                    Status</label> <select name="employed_status" id="employed_status"
                                                    class="form-control">
                                                    <option value="{{ Auth::user()->employed_status }}">--Select
                                                        Employment Status--</option>
                                                    <option value="Permanent/Regular"
                                                        {{ Auth::user()->employed_status == 'Permanent/Regular' ? 'selected' : '' }}>
                                                        Permanent/Regular</option>
                                                    <option value="Contractual"
                                                        {{ Auth::user()->employed_status == 'Contractual' ? 'selected' : '' }}>
                                                        Contractual</option>
                                                    <option value="Probationary"
                                                        {{ Auth::user()->employed_status == 'Probationary' ? 'selected' : '' }}>
                                                        Probationary</option>
                                                    <option value="Job Order"
                                                        {{ Auth::user()->employed_status == 'Job Order' ? 'selected' : '' }}>
                                                        Job Order</option>
                                                    <option value="Part-Time"
                                                        {{ Auth::user()->employed_status == 'Part-Time' ? 'selected' : '' }}>
                                                        Part-Time</option>
                                                    <option value="Self-Employed"
                                                        {{ Auth::user()->employed_status == 'Self-Employed' ? 'selected' : '' }}>
                                                        Self-Employed</option>
                                                    <option value="Contract of Service"
                                                        {{ Auth::user()->employed_status == 'Contract of Service' ? 'selected' : '' }}>
                                                        Contract of Service</option>
                                                    <option value="Casual"
                                                        {{ Auth::user()->employed_status == 'Casual' ? 'selected' : '' }}>
                                                        Casual</option>
                                                    <option value="None"
                                                        {{ Auth::user()->employed_status == 'None' ? 'selected' : '' }}>
                                                        None
                                                    </option>
                                                </select> </div>

                                            <div class="form-group">
                                                <label for="job_to_course">Is your job related to your Baccalaureate
                                                    Degree?</label>
                                                <select type="text" name="job_to_course" id="job_to_course"
                                                    class="form-control">{{ Auth::user()->job_to_course }}

                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="monthly_income">Monthly Income</label>
                                                <select name="monthly_income" id="monthly_income" class="form-control">
                                                    <option value="{{ Auth::user()->monthly_income }}">
                                                        --Select Monthly Income--</option>
                                                    <option value="Php 10,000 or lower">Php 10,000 or lower</option>
                                                    <option value="Php 10,001 to Php 20,000">Php 10,001 to Php 20,000
                                                    </option>
                                                    <option value="Php 20,001 to Php 30,000">Php 20,001 to Php 30,000
                                                    </option>
                                                    <option value="Php 30,001 to Php 40,000">Php 30,001 to Php 40,000
                                                    </option>
                                                    <option value="Php 40,001 to Php 50,000">Php 40,001 to Php 50,000
                                                    </option>
                                                    <option value="Php 50,001 to Php 60,000">Php 50,001 to Php 60,000
                                                    </option>
                                                    <option value="Php 60,001 to Php 70,000">Php 60,001 to Php 70,000
                                                    </option>
                                                    <option value="Php 70,001 to Php 80,000">Php 70,001 to Php 80,000
                                                    </option>
                                                    <option value="Php 80,001 to Php 90,000">Php 80,001 to Php 90,000
                                                    </option>
                                                    <option value="Php 90,001 to Php 100,000">Php 90,001 to Php 100,000
                                                    </option>
                                                    <option value="Php 100,000 or higher">Php 100,000 or higher</option>
                                                </select>
                                            </div>
                                        </div>
                                        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                                        <script>
                                            $(document).ready(function() {
                                                // Get the "employment_status" field
                                                var employmentStatus = $('#employment_status');

                                                // Get the "employed-fields" div
                                                var employedFields = $('#employed-fields');

                                                // Check the initial value of the "employment_status" field
                                                if (employmentStatus.val() === 'employed') {
                                                    // If the value is "employed", show the "employed-fields" div and make the fields required
                                                    employedFields.show();
                                                    employedFields.find('input, select').prop('required', true);
                                                } else {
                                                    // Otherwise, hide the "employed-fields" div and remove the "required" attribute
                                                    employedFields.hide();
                                                    employedFields.find('input, select').prop('required', false);
                                                }

                                                // Add an event listener to the "employment_status" field
                                                employmentStatus.on('change', function() {
                                                    if ($(this).val() === 'employed') {
                                                        // If the value is "employed", show the "employed-fields" div and make the fields required
                                                        employedFields.show();
                                                        employedFields.find('input, select').prop('required', true);
                                                    } else {
                                                        // Otherwise, hide the "employed-fields" div and remove the "required" attribute
                                                        employedFields.hide();
                                                        employedFields.find('input, select').prop('required', false);

                                                        // Reset the values of the form fields to empty strings or default values
                                                        $('#work_company').val('');
                                                        $('#work_address').val('');
                                                        $('#position_on_work').val('');
                                                        $('#date_hired').val('');
                                                        $('#work_lat').val('');
                                                        $('#work_lng').val('');
                                                        $('#job_to_course').val('No');
                                                        $('#monthly_income').val('');
                                                    }
                                                });
                                            });
                                        </script>
                                        <div type="hidden" id="map" style="height: 400px;"></div>
                                        <input type="text" name="work_lat" id="work_lat"
                                            value="{{ Auth::user()->work_lat }}"readonly>
                                        <input type="text" name="work_lng" id="work_lng"
                                            value="{{ Auth::user()->work_lng }}"readonly>
                                        <div class="form-group">
                                            <input type="hidden" name="status" id="status"
                                                value="{{ Auth::user()->status }}" class="form-control">
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="addressModal" tabindex="-1" role="dialog"
                                            aria-labelledby="addressModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addressModalLabel">Select Address</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="region">Region</label>
                                                            <select name="region" id="region" class="form-control">
                                                                <option value="">-- Select a region --</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="province">Province</label>
                                                            <select name="province" id="province" class="form-control">
                                                                <option value="">-- Select a province --</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="city">City/Municipality</label>
                                                            <select name="city" id="city" class="form-control">
                                                                <option value="">-- Select a city/municipality --
                                                                </option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancel</button>
                                                        <button type="button" class="btn btn-primary"
                                                            data-dismiss="modal" id="addressModalOkButton">OK</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <script>
                                            $.getJSON('{{ asset('regions.json') }}', function(data) {
                                                $.each(data.data, function(key, value) {
                                                    $('#region').append('<option value="' + value.id + '">' + value.name + '</option>');
                                                });
                                            });
                                            // Load provinces
                                            $('#region').change(function() {
                                                var regionId = $(this).val();
                                                $('#province').empty();
                                                $('#province').append('<option value="">-- Select a province --</option>');
                                                $('#city').empty();
                                                $('#city').append('<option value="">-- Select a city --</option>');
                                                $('#barangay').empty();
                                                $('#barangay').append('<option value="">-- Select a barangay --</option>');
                                                if (regionId) {
                                                    $.getJSON('{{ asset('provinces.json') }}', {
                                                        region_id: regionId
                                                    }, function(data) {
                                                        $.each(data.data, function(key, value) {
                                                            if (regionId == value['region_code']) {
                                                                var option = $('<option value="' + value.id + '">' + value.name +
                                                                    '</option>');
                                                                option.attr('data-region', value.region_id); // Add data attribute
                                                                $('#province').append(option);
                                                            }
                                                        });
                                                    });
                                                }
                                            });
                                            // Load cities
                                            $('#province').change(function() {
                                                var provinceId = $(this).val();
                                                $('#city').empty();
                                                $('#city').append('<option value="">-- Select a city --</option>');
                                                $('#barangay').empty();
                                                $('#barangay').append('<option value="">-- Select a barangay --</option>');
                                                if (provinceId) {
                                                    $.getJSON('{{ asset('cities.json') }}', {
                                                        province_id: provinceId
                                                    }, function(data) {
                                                        $.each(data.data, function(key, value) {
                                                            if (provinceId == value['province_code']) {
                                                                $('#city').append('<option value="' + value.id + '">' + value.name +
                                                                    '</option>');
                                                            }
                                                        });
                                                    });
                                                }
                                            });
                                            // Load barangays
                                            $('#city').change(function() {
                                                var cityId = $(this).val();
                                                $('#barangay').empty();
                                                $('#barangay').append('<option value="">-- Select a barangay --</option>');
                                                if (cityId) {
                                                    $('#barangay').replaceWith(
                                                        '<input type="text" id="barangay" class="form-control" placeholder="Enter barangay">');
                                                } else {
                                                    $('#barangay').replaceWith(
                                                        '<select name="barangay" id="barangay" class="form-control"><option value="">-- Select a barangay --</option></select>'
                                                    );
                                                }
                                            });
                                            $('#addressModalOkButton').click(function() {
                                                $('#addressModal').data('button', 'ok');
                                                var regionName = $('#region option:selected').text();
                                                var provinceName = $('#province option:selected').text();
                                                var cityName = $('#city option:selected').text();
                                                var barangayName = $('#barangay').val() || $('#barangay option:selected').text();
                                                var workAddress = regionName + ', ' + provinceName + ', ' + cityName + ', ' + barangayName;
                                                $('#work_address').val(workAddress);
                                            });
                                            $('#addressModalOkButton').click(function() {
                                                $('#addressModal').data('button', 'ok');
                                            });
                                        </script>



                                        <script>
                                            var workLat = {{ Auth::user()->work_lat ?? 'null' }};
                                            var workLng = {{ Auth::user()->work_lng ?? 'null' }};


                                            var workAddress = workLat && workLng ? L.latLng(workLat, workLng) : null;


                                            var map = L.map('map', {
                                                center: L.latLng(13.4224, 121.1829), // Calapan City, Oriental Mindoro, Philippines
                                                zoom: 30
                                            });


                                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                                attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
                                            }).addTo(map);

                                            var pinMarker;

                                            if (workAddress) {
                                                var workMarker = L.marker(workAddress).addTo(map);
                                                workMarker.bindPopup("<b>Work Address</b><br>{{ Auth::user()->work_address }}").openPopup();
                                                map.setView(workAddress, 13);
                                            }

                                            var profileForm = document.getElementById('profile-form');
                                            if (profileForm) {
                                                profileForm.addEventListener('submit', function(e) {
                                                    e.preventDefault();
                                                    var form = this;

                                                    $.ajax({
                                                        url: form.action,
                                                        type: 'PUT',
                                                        data: $(form).serialize(),
                                                        success: function(response) {
                                                            // Update the work address field in the form
                                                            $('#work_address').val(response.work_address);

                                                            // Update the work address field in the profile card
                                                            $('#work-address').text(response.work_address);
                                                        }
                                                    });
                                                });
                                            }
                                        </script>
                                    @endif
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update
                                            Profile</button>
                                    </div>
                                </form>
                                <!-- Include the jQuery library -->
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                                <!-- Include the SweetAlert2 library -->
                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                                <script>
                                    @if (session('success'))
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success!',
                                            text: '{{ session('success') }}',
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                    @elseif (session('error'))
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error!',
                                            text: '{{ session('error') }}',
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                    @endif
                                </script>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
