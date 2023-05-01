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
                                    <div class="form-group">
                                        <label for="work_address">Work Address</label>
                                        <input type="text" name="work_address" id="work_address"
                                            value="{{ Auth::user()->work_address }}" class="form-control">
                                    </div>
                                    
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary" id="select-address-btn">Select Address</button>
                                    </div>
                                    
                                    <!-- Modal for selecting address -->
                                    <div class="modal fade" id="select-address-modal" tabindex="-1" aria-labelledby="select-address-modal-label" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="select-address-modal-label">Select Address</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="region-select">Region</label>
                                                                <select id="region-select" class="form-control"></select>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="province-select">Province</label>
                                                                <select id="province-select" class="form-control"></select>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="city-select">City/Municipality</label>
                                                                <select id="city-select" class="form-control"></select>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="barangay-select">Barangay</label>
                                                                <select id="barangay-select" class="form-control"></select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary" id="select-address-confirm-btn">Select</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- jQuery -->
                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                    
                                    <!-- Bootstrap JavaScript -->
                                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
                                    <!-- Load the select-philippines-address JavaScript file -->
                                    <!-- Load the select-philippines-address JavaScript file -->
                                    <script src="{{ asset('node_modules/select-philippines-address') }}"></script>

                                    <script src="{{ asset('node_modules/select-philippines-address/dist/select-philippines-address.min.js') }}"></script>

                                    <script>
                                        // Add event listener to the button to open the modal
                                        $('#select-address-btn').on('click', function() {
                                            $('#select-address-modal').modal('show');
                                        });
                                    
                                        // Create the address dropdown select elements
                                        var regionSelect = $('#region-select');
                                        var provinceSelect = $('#province-select');
                                        var citySelect = $('#city-select');
                                        var barangaySelect = $('#barangay-select');
                                    
                                        // Populate the regions select element
                                        for (var region of selectPhilippinesAddress.getRegions()) {
                                            regionSelect.append($('<option>', {
                                                value: region,
                                                text: region
                                            }));
                                        }
                                    
                                        // Update the provinces select element when the region is changed
                                        regionSelect.on('change', function() {
                                            var region = $(this).val();
                                            var provinces = selectPhilippinesAddress.getProvinces(region);
                                    
                                            // Clear the provinces, cities, and barangays select elements
                                            provinceSelect.empty();
                                            citySelect.empty();
                                            barangaySelect.empty();
                                    
                                            // Populate the provinces select element
                                            for (var province of provinces) {
                                                provinceSelect.append($('<option>', {
                                                    value: province,
                                                    text: province
                                                }));
                                            }
                                    
                                            // Trigger the change event on the provinces select element to update the cities select element
                                            provinceSelect.trigger('change');
                                        });
                                    
                                        // Update the cities and barangays select elements when the province is changed
                                        provinceSelect.on('change', function() {
                                            var region = regionSelect.val();
                                            var province = $(this).val();
                                            var cities = selectPhilippinesAddress.getCities(region, province);
                                    
                                            // Clear the cities and barangays select elements
                                            citySelect.empty();
                                            barangaySelect.empty();
                                    
                                            // Populate the cities select element
                                            for (var city of cities) {
                                                citySelect.append($('<option>', {
                                                    value: city,
                                                    text: city
                                                }));
                                            }
                                    
                                            // Trigger the change event on the cities select element to update the barangays select element
                                            citySelect.trigger('change');
                                        });
                                    
                                        // Update the barangays select element when the city is changed
                                        citySelect.on('change', function() {
                                            var region = regionSelect.val();
                                            var province = provinceSelect.val();
                                            var city = $(this).val();
                                            var barangays = selectPhilippinesAddress.getBarangays(region, province, city);
                                    
                                            // Clear the barangays select element
                                            barangaySelect.empty();
                                    
                                            // Populate the barangays select element
                                            for (var barangay of barangays) {
                                                barangaySelect.append($('<option>', {
                                                    value: barangay,
                                                    text: barangay
                                                }));
                                            }
                                        });
                                    
                                        // Add event listener to the confirm button in the modal
                                        $('#select-address-confirm-btn').on('click', function() {
                                            // Get the selected address from the dropdowns
                                            var region = $('#region-select').val();
                                            var province = $('#province-select').val();
                                            var city = $('#city-select').val();
                                            var barangay = $('#barangay-select').val();
                                            var address = barangay + ', ' + city + ', ' + province + ', ' + region;
                                    
                                            // Update the work address input field with the selected address
                                            $('#work_address').val(address);
                                    
                                            // Close the modal
                                            $('#select-address-modal').modal('hide');
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
                                    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
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

                                        document.getElementById('profile-form').addEventListener('submit', function(e) {
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
                                    </script>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update Profile</button>
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
