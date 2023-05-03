@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-9 mx-auto">
                <div class="card ">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-md-3">
                                @if (Auth::user()->media_url)
                                    <img style="height: 170px; object-fit: contain;" src="{{ Auth::user()->media_url }}"
                                        alt="Profile Photo" class="img-thumbnail rounded-circle w-100">
                                @else
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/45/Minsu.png/640px-Minsu.png" alt="Profile Photo"
                                        class="rounded-circle w-100">
                                @endif

                            </div>
                            <div class="col-md-9">
                                <h2>{{ Auth::user()->name }}</h2>
                                <form action="{{ route('userprofile.update', Auth::user()->id)}}" method="post"  enctype="multipart/form-data"  >
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="photo" class="form-label">
                                           
                                                Profile Photo
                                           
                                        </label>
                                        <input class='dropzone' type="file" name="photo" id="photo" accept="image/*">
                                        @error('photo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" value="{{ Auth::user()->name }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email"
                                            value="{{ Auth::user()->email }}" class="form-control" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="home_address">Home Address</label>
                                        <input type="text" name="home_address" id="home_address"
                                            value="{{ Auth::user()->home_address }}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="year_graduated">Year Graduated</label>
                                        <input type="date" name="year_graduated" id="year_graduated" value="{{Auth::user()->year_graduated }}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="employment_status">Employment Status</label>
                                        <select name="employment_status" id="employment_status" class="form-control">
                                            <option value="">--Select Employment Status--</option>
                                            <option value="employed" {{ Auth::user()->employment_status == 'employed' ? 'selected' : '' }}>Employed</option>
                                            <option value="unemployed" {{ Auth::user()->employment_status == 'unemployed' ? 'selected' : '' }}>Unemployed</option>
                                        </select>
                                    </div>
                                    
                                    <div id="employed-fields" style="display: none;">
                                        <div class="form-group">
                                            <label for="work_company">Work Company</label>
                                            <input type="text" name="work_company" id="work_company" value="{{ Auth::user()->work_company}}" class="form-control">
                                        </div> 
                                        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
                                        <div class="form-group">
                                            <label for="work_address">Work Address</label>
                                            <div class="input-group">
                                                <input type="text" name="work_address" value="{{ Auth::user()->work_address }}" id="work_address" class="form-control" readonly>
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addressModal">Select Address</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="position_on_work">Position on Work</label>
                                            <input type="text" name="position_on_work" id="position_on_work" value="{{ Auth::user()->position_on_work == 'unemployed' ? 'Unemployed' : Auth::user()->position_on_work }}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                        <label for="date_hired">Date Hired</label>
                                        <input type="date" name="date_hired" id="date_hired" value="{{ Auth::user()->date_hired == 'unemployed' ? 'Unemployed' : Auth::user()->date_hired }}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                        <label for="employed_status">Employed Status</label>
                                        <input type="text" name="employed_status" id="employed_status" value="{{ Auth::user()->employed_status == 'unemployed' ? 'Unemployed' : Auth::user()->employed_status }}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                        <label for="job_to_course">Job to Course</label>
                                        <input type="text" name="job_to_course" id="job_to_course" value="{{ Auth::user()->job_to_course == 'unemployed' ? 'Unemployed' : Auth::user()->job_to_course }}" class="form-control">
                                        </div>
                                        
                                        </div> 
                                        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                                        <script> $('#employment_status').on('change', function() { if (this.value == 'employed') {
                                            $('#employed-fields').show();
                                            // Set the values to empty if switching to employed
                                            $('#position_on_work').val('');
                                            $('#date_hired').val('');
                                            $('#employed_status').val('');
                                            $('#job_to_course').val('');
                                            } else {
                                            $('#employed-fields').hide();
                                            // Set the values to "Unemployed" if switching to unemployed
                                            $('#position_on_work').val('Unemployed');
                                            $('#date_hired').val('Unemployed');
                                            $('#employed_status').val('Unemployed');
                                            $('#job_to_course').val('Unemployed');
                                            }
                                            });
                                            </script>
                                    
                                    <script>
                                        $('#employment_status').on('change', function() {
                                            if (this.value == 'employed') {
                                                $('#employed-fields').show();
                                            } else {
                                                $('#employed-fields').hide();
                                            }
                                        });
                                    </script>
                                    

                                    <div class="form-group">
                                        <label for="civil_service">Civil Service</label>
                                        <input type="text" name="civil_service" id="civil_service" value="{{ Auth::user()->civil_service }}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <input type="hidden" name="status" id="status" value="{{ Auth::user()->status }}" class="form-control">
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
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal"
                                                        id="addressModalOkButton">OK</button>

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
                                                // $.getJSON('{{ asset('barangays.json') }}', {
                                                //     city_id: cityId
                                                // }, function(data) {
                                                //     $.each(data.data, function(key, value) {
                                                //         if (cityId == value['city_code']) {
                                                //             $('#barangay').append('<option value="' + value.id + '">' + value.name + '</option>');
                                                //         }
                                                //     });
                                                // });
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

                                    <div type="hidden" id="map" style="height: 400px;"></div>
                                    <input type="hidden" name="home_lat" id="home_lat"
                                        value="{{ Auth::user()->home_lat }}">
                                    <input type="hidden" name="home_lng" id="home_lng"
                                        value="{{ Auth::user()->home_lng }}">
                                    <input type="hidden" name="work_lat" id="work_lat"
                                        value="{{ Auth::user()->work_lat }}">
                                    <input type="hidden" name="work_lng" id="work_lng"
                                        value="{{ Auth::user()->work_lng }}">
                                    <input type="hidden" name="pin_lat" id="pin_lat"
                                        value="{{ Auth::user()->pin_lat }}">
                                    <input type="hidden" name="pin_lng" id="pin_lng"
                                        value="{{ Auth::user()->pin_lng }}">
                                   
                                    
                                    
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

                                        document.getElementById('pin-location').addEventListener('click', function() {
                                            if (pinMarker) {
                                                map.setView(pinMarker.getLatLng(), 13);
                                            }
                                        });

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
                                   

                                    <div class="form-group">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Update
                                                Profile</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
