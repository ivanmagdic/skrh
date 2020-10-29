<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
          crossorigin=""/>

    <style>
        #map {
            height: 600px;
        }
    </style>
</head>
<body class="font-sans text-gray-900 bg-gray-100 antialiased">
<main>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="text-xl text-gray-800 mb-6">
                        API endpoints
                    </div>
                    <div class="mb-6">
                        <div class="mb-2"><span
                                class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded text-green-600 bg-green-200 uppercase last:mr-0 mr-1">
                            GET
                            </span> <span class="text-gray-500">
                                Camera list
                            </span></div>
                        <div class="text-gray-700">
                            {{ config('app.url') }}/api/cameras
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div id="map"></div>
            </div>
        </div>
    </div>
</main>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin="">
</script>
<script>
    // initialize Leaflet at @44.4467472,16.4064761,7z
    let map = L.map('map').setView({lon: 16.4064761, lat: 44.4467472}, 7);

    // add the OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
    }).addTo(map);

    // show the scale bar on the lower left corner
    L.control.scale().addTo(map);

    // add markers
    let markers =
        {!! \App\Models\Camera::query()->get()->map(function ($camera) {
                    return [
                        'name' => $camera->name,
                        'lat' => $camera->latitude,
                        'long' => $camera->longitude,
                    ];
                })->toJson()
        !!};

    markers.forEach(element => L.marker({lon: element.long, lat: element.lat}).bindPopup(element.name).addTo(map));
</script>
</body>
</html>
