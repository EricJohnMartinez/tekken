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
                            </div><div class="col-md-9">
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
