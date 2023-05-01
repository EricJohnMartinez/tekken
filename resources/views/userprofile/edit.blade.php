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
                                    <img src="https://via.placeholder.com/150" alt="Profile Photo"
                                        class="rounded-circle w-100">
                                @endif
                                <form action="{{ route('userprofile.update', Auth::user()->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="photo" class="form-label">
                                            @if ($user->getFirstMediaUrl('photos'))
                                                Change Photo
                                            @else
                                                Upload Photo
                                            @endif
                                        </label>
                                        <input type="file" name="photo" id="photo" accept="image/*">
                                        @error('photo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Photo</button>
                                </form>
                            </div>
                            <div class="col-md-9">
                                <h2>{{ Auth::user()->name }}</h2>
                                <form action="{{ route('userprofile.update', Auth::user()->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
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

                                    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
                                    <div class="form-group">
                                        <label for="work_address">Work Address</label>
                                        <div class="input-group">
                                            <input type="text" name="work_address" id="work_address" class="form-control"
                                                readonly>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#addressModal">Select Address</button> 
                                            </div>
                                        </div>
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
                                                    <div class="form-group">
                                                        <label for="barangay">Barangay</label>
                                                        <select name="barangay" id="barangay" class="form-control">
                                                            <option value="">-- Select a barangay --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                                    <script>
                                        $.getJSON('{{ asset('regions.json') }}', function(data) {
    console.log(data); // Debugging code
    $.each(data.regions, function(key, value) {
        console.log(key, value); // Debugging code
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
                                                        $.each(data.provinces, function(key, value) {
                                                            $('#province').append('<option value="' + value.id + '">' +
                                                                value.name + '</option>');
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
                                                        $.each(data.cities, function(key, value) {
                                                            $('#city').append('<option value="' + value.id + '">' + value
                                                                .name + '</option>');
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
                                                    $.getJSON('{{ asset('barangays.json') }}', {
                                                        city_id: cityId
                                                    }, function(data) {
                                                        $.each(data.barangays, function(key, value) {
                                                            $('#barangay').append('<option value="' + value.id + '">' +
                                                                value.name + '</option>');
                                                        });
                                                    });
                                                }
                                            });
                                            // Set selected address
                                            $('#addressModal').on('shown.bs.modal', function() {
                                                var workAddress = $('#work_address').val();
                                                if (workAddress) {
                                                    var address = JSON.parse(workAddress);
                                                    $('#region').val(address.region_id).trigger('change');
                                                    setTimeout(function() {
                                                        $('#province').val(address.province_id).trigger('change');
                                                    }, 500);
                                                    setTimeout(function() {
                                                        $('#city').val(address.city_id).trigger('change');
                                                    }, 1000);
                                                    setTimeout(function() {
                                                        $('#barangay').val(address.barangay_id);
                                                    }, 1500);
                                                }
                                            });

                                            // Save selected address
                                            $('#addressModal').on('hidden.bs.modal', function() {
                                                var regionId = $('#region').val();
                                                var provinceId = $('#province').val();
                                                var cityId = $('#city').val();
                                                var barangayId = $('#barangay').val();
                                                var workAddress = {
                                                    region_id: regionId,
                                                    province_id: provinceId,
                                                    city_id: cityId,
                                                    barangay_id: barangayId
                                                };
                                                $('#work_address').val(JSON.stringify(workAddress));
                                            });
                                        
                                    </script>
                                    
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary" id="pin-location">Pin
                                            Location</button>
                                    </div>
                                    <div id="map" style="height: 400px;"></div>
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


                                    <link rel="stylesheet"
                                        href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
                                    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>

                                    <link rel="stylesheet"
                                        href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
                                    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

                                    <script>
                                        var workLat = {{ Auth::user()->work_lat ?? 'null' }};
                                        var workLng = {{ Auth::user()->work_lng ?? 'null' }};
                                        var pinLat = {{ Auth::user()->pin_lat ?? 'null' }};
                                        var pinLng = {{ Auth::user()->pin_lng ?? 'null' }};

                                        var workAddress = workLat && workLng ? L.latLng(workLat, workLng) : null;
                                        var pinAddress = pinLat && pinLng ? L.latLng(pinLat, pinLng) : null;

                                        var map = L.map('map', {
                                            center: L.latLng(13.4224, 121.1829), // Calapan City, Oriental Mindoro, Philippines
                                            zoom: 13
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

                                        if (pinAddress) {
                                            pinMarker = L.marker(pinAddress).addTo(map);
                                            pinMarker.bindPopup("<b>Pin Location</b><br>").openPopup();
                                            map.setView(pinAddress, 13);
                                        }

                                        map.on('click', function(e) {
                                            if (pinMarker) {
                                                map.removeLayer(pinMarker);
                                            }

                                            pinMarker = L.marker(e.latlng).addTo(map);
                                            pinMarker.bindPopup("<b>Pin Location</b><br>").openPopup();

                                            document.getElementById('work_lat').value = e.latlng.lat.toFixed(6);
                                            document.getElementById('work_lng').value = e.latlng.lng.toFixed(6);

                                            L.Control.geocoder({
                                                    collapsed: false,
                                                    defaultMarkGeocode: false,
                                                    placeholder: 'Enter work address...',
                                                    errorMessage: 'Could not find that address.',
                                                    geocoder: L.Control.Geocoder.nominatim()
                                                })
                                                .on('markgeocode', function(e) {
                                                    document.getElementById('work_address').value = e.geocode.name;
                                                })
                                                .addTo(map)
                                                .markGeocode(e.latlng);
                                        });

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
