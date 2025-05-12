<?php include 'includes/header.php'; ?>
<?php include 'includes/nav.php'; ?>

<main class="container my-5">
    <h1 class="display-4 text-center mb-5">My Hometown: Istanbul </h1>

    <!-- Image Slider -->
    <div id="citySlider" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#citySlider" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#citySlider" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#citySlider" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#citySlider" data-bs-slide-to="3"></button>
        </div>
        <div class="carousel-inner rounded">
            <div class="carousel-item active">
                <a href="#landmark1">
                    <img src="https://wallpapers.com/images/hd/istanbul-s-famous-blue-mosque-aesthetic-1xm474mw23cufnh6.jpg"
                        class="d-block w-100" alt="City Landmark 1">
                </a>
            </div>
            <div class="carousel-item">
                <a href="#landmark2">
                    <img src="https://www.agoda.com/wp-content/uploads/2024/04/istanbul-turkey.jpg"
                        class="d-block w-100" alt="City Landmark 2">
                </a>
            </div>
            <div class="carousel-item">
                <a href="#landmark3">
                    <img src="https://ychef.files.bbci.co.uk/1280x720/p0gzbrt0.jpg" class="d-block w-100"
                        alt="City Landmark 3">
                </a>
            </div>
            <div class="carousel-item">
                <a href="#landmark4">
                    <img src="https://shootmyjourney.com/wp-content/uploads/2020/09/DSC_8890-scaled.jpg"
                        class="d-block w-100" alt="City Landmark 4">
                </a>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#citySlider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#citySlider" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <section class="city-info">
        <div class="row">
            <div class="col-md-6">
                <h2>About Istanbul </h2>
                <p>Istanbul is a beautiful city located in Marmara Region with a population of approximately 15 Million.
                    It's known for its rich history, cultural heritage, and natural beauty.</p>

                <h3 class="mt-4">Key Facts</h3>
                <ul class="list-group">
                    <li class="list-group-item">Founded: 660 BCE</li>
                    <li class="list-group-item">Area: 5,343.22 km² (2,063.03 sq mi)</li>
                    <li class="list-group-item">Population: 15 Million</li>
                    <li class="list-group-item">Famous for: Culture and Beauty</li>
                </ul>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body" style="max-height: 500px;">
                        <h3>Climate</h3>
                        <p>Istanbul has a humid subtropical climate with cold winters and warm summers.</p>
                        <canvas id="weatherChart"></canvas>
                    </div>
                </div>
            </div>
            <section class="landmarks mt-5">
                <h2>Places to Visit <br> <br></h2>
                <div class="row">
                    <div class="col-md-6 mb-4" id="landmark1">
                        <div class="card h-100">
                            <img src="https://c4.wallpaperflare.com/wallpaper/381/457/206/hagia-sophia-architecture-sky-building-wallpaper-preview.jpg" class="card-img-top" alt="Landmark 1">
                            <div class="card-body">
                                <h3>Hagia Sophia</h3>
                                <p>A stunning architectural masterpiece that has served as a church, mosque, and museum over the centuries. Its massive dome and historic mosaics make it a must-see</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4" id="landmark2">
                        <div class="card h-100">
                            <img src="https://dq5r178u4t83b.cloudfront.net/wp-content/uploads/sites/175/2022/02/14154605/6-Topkapi-Palace_thumb.jpg" class="card-img-top" alt="Landmark 2">
                            <div class="card-body">
                                <h3>Topkapi Palace</h3>
                                <p>Once the residence of Ottoman sultans, this lavish palace offers insight into imperial life with its ornate rooms, courtyards, and views over the Bosphorus.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4" id="landmark3">
                        <div class="card h-100">
                            <img src="https://c4.wallpaperflare.com/wallpaper/502/144/853/galata-kulesi-galata-bridge-galata-istanbul-turkey-hd-wallpaper-preview.jpg" class="card-img-top" alt="Landmark 3">
                            <div class="card-body">
                                <h3>Galata Tower</h3>
                                <p>A medieval stone tower offering panoramic views of Istanbul’s skyline and the Bosphorus. It’s especially beautiful at sunset.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4" id="landmark4">
                        <div class="card h-100">
                            <img src="https://aws-tiqets-cdn.imgix.net/images/content/b0170840dcbd4fb9ba770db77b0d91e7.png?auto=format%2Ccompress&fit=crop&ixlib=python-3.2.1&q=70" class="card-img-top" alt="Landmark 4">
                            <div class="card-body">
                                <h3>Dolmabahçe Palace</h3>
                                <p>A grand and opulent 19th-century palace blending European and Ottoman styles, once the main administrative center of the late Ottoman Empire.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</main>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Weather Chart Configuration
        const ctx = document.getElementById('weatherChart');
        const weatherChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Average Temperature (°C)',
                    data: [6.6, 6.9, 9.0, 13.6, 18.3, 22.6, 25.2, 25.0, 21.4, 16.5, 12.0, 8.6],
                    backgroundColor: 'rgba(233, 196, 106, 0.2)',
                    borderColor: 'rgba(233, 196, 106, 1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Rainfall (mm)',
                    data: [98, 80, 70, 46, 36, 34, 38, 48, 61, 97, 107, 124],
                    backgroundColor: 'rgba(42, 157, 143, 0.2)',
                    borderColor: 'rgba(42, 157, 143, 1)',
                    borderWidth: 2,
                    type: 'bar',
                    yAxisID: 'y1'
                }]
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Temperature (°C)'
                        }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        grid: {
                            drawOnChartArea: false
                        },
                        title: {
                            display: true,
                            text: 'Rainfall (mm)'
                        }
                    }
                }
            }
        });
    });
</script>

<?php include 'includes/footer.php'; ?>