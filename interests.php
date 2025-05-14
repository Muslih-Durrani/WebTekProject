<?php include 'includes/header.php'; ?>
<?php include 'includes/nav.php'; ?>

<main class="container my-5">
    <h1 class="display-4 text-center mb-5">My Interests</h1>

    <section class="mb-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Movie Recommendations</h2>
                <p class="card-text">Here are some movie recommendations based on my favorite genres.</p>

                <div class="row" id="movies-container">
                    <!-- Movies will be loaded here via API -->
                    <div class="col-12 text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Book Recommendations</h2>
                <p class="card-text">Some of my favorite books and recommendations.</p>

                <div class="row" id="books-container">
                    <!-- Books will be loaded here via API -->
                    <div class="col-12 text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Sports News</h2>
                <p class="card-text">Latest updates from my favorite sports.</p>

                <div id="sports-news-container">
                    <!-- Sports news will be loaded here via API -->
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Generate random page number for variety (1-5)
        const randomPage = Math.floor(Math.random() * 5) + 1;

        // Fetch movies with random genre combination
        fetchMovies(randomPage);

        // Fetch books with random subject
        fetchBooks();

        // Fetch sports news with random sport
        fetchSportsNews();
    });

    function fetchMovies(page) {
        // Random action/adventure/sci-fi combinations
        const genres = [
            '28,12,878',  // Action+Adventure+SciFi
            '28,53',       // Action+Thriller
            '12,14',       // Adventure+Fantasy
            '878,9648'     // SciFi+Mystery
        ];
        const randomGenres = genres[Math.floor(Math.random() * genres.length)];

        const apiKey = '793cbc9882354eace266f52a9c5e58ca';
        const url = `https://api.themoviedb.org/3/discover/movie?api_key=${apiKey}&page=${page}&with_genres=${randomGenres}`;

        fetch(url)
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                const moviesContainer = document.getElementById('movies-container');
                moviesContainer.innerHTML = '';

                // Shuffle and pick 4 random movies
                const shuffled = data.results.sort(() => 0.5 - Math.random());
                shuffled.slice(0, 4).forEach(movie => {
                    if (!movie.poster_path) return;

                    const movieCard = `
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="https://image.tmdb.org/t/p/w500${movie.poster_path}" 
                             class="card-img-top" alt="${movie.title}"
                             onerror="this.src='https://via.placeholder.com/500x750?text=No+Poster'">
                        <div class="card-body">
                            <h5 class="card-title">${movie.title}</h5>
                            <p class="card-text">${movie.overview.substring(0, 100)}...</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Rating: ${movie.vote_average}/10</small>
                        </div>
                    </div>
                </div>`;
                    moviesContainer.innerHTML += movieCard;
                });
            })
            .catch(error => {
                console.error('Error fetching movies:', error);
                document.getElementById('movies-container').innerHTML = `
            <div class="col-12">
                <div class="alert alert-warning">
                    <i class="fas fa-film me-2"></i>
                    Movie recommendations unavailable. Showing placeholder data.
                </div>
                <!-- Fallback placeholder movies -->
                ${getPlaceholderMovies()}
            </div>`;
            });
    }

    function fetchBooks() {
        const subjects = [
            'fiction', 'fantasy', 'science_fiction', 'mystery',
            'romance', 'history', 'biography', 'technology'
        ];
        const randomSubject = subjects[Math.floor(Math.random() * subjects.length)];

        const url = `https://openlibrary.org/subjects/${randomSubject}.json?limit=4`;

        fetch(url)
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                const booksContainer = document.getElementById('books-container');
                booksContainer.innerHTML = '';

                data.works.forEach(book => {
                    const coverId = book.cover_id || 0;
                    const coverUrl = coverId ?
                        `https://covers.openlibrary.org/b/id/${coverId}-M.jpg` :
                        'https://via.placeholder.com/500x750?text=No+Cover';

                    const authors = book.authors ?
                        book.authors.map(a => a.name).join(', ') : 'Unknown Author';

                    const bookCard = `
        <div class="col-md-3 mb-4">
            <div class="card h-100 book-card"> 
                <img src="${coverUrl}" 
                     class="card-img-top" 
                     alt="${book.title}"
                     style="height: 400px;" 
                     onerror="this.src='https://via.placeholder.com/500x750?text=No+Cover'">
                <div class="card-body">
                    <h5 class="card-title">${book.title}</h5>
                    <p class="card-text">By ${authors}</p>
                </div>
            </div>
        </div>`;
                    booksContainer.innerHTML += bookCard;
                });
            })
            .catch(error => {
                console.error('Error fetching books:', error);
                document.getElementById('books-container').innerHTML = `
            <div class="col-12">
                <div class="alert alert-warning">
                    <i class="fas fa-book me-2"></i>
                    Book recommendations unavailable. Showing placeholder data.
                </div>
                ${getPlaceholderBooks()}
            </div>`;
            });
    }

    function fetchSportsNews() {
        const sports = [
            'cricket', 'ufc', 'football', 'tennis', 'formula 1',

        ];
        const randomSport = sports[Math.floor(Math.random() * sports.length)];


        const apiKey = '5510a83a428e43d09a0369b7c7298175';
        const url = `https://newsapi.org/v2/everything?q=${randomSport}&language=en&pageSize=3&apiKey=${apiKey}`;

        fetch(url)
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                const newsContainer = document.getElementById('sports-news-container');
                newsContainer.innerHTML = '';

                data.articles.forEach(article => {
                    const newsItem = `
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="${article.urlToImage || 'https://via.placeholder.com/300x200?text=No+Image'}" 
                                 class="img-fluid rounded-start" alt="${article.title}"
                                 onerror="this.src='https://via.placeholder.com/300x200?text=No+Image'">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">${article.title}</h5>
                                <p class="card-text">${article.description || 'No description available'}</p>
                                <a href="${article.url}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    Read More <i class="fas fa-external-link-alt ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>`;
                    newsContainer.innerHTML += newsItem;
                });
            })
            .catch(error => {
                console.error('Error fetching sports news:', error);
                document.getElementById('sports-news-container').innerHTML = `
            <div class="alert alert-warning">
                <i class="fas fa-running me-2"></i>
                Sports news unavailable. Showing placeholder data.
            </div>
            ${getPlaceholderNews()}`;
            });
    }

    // Fallback placeholder functions
    function getPlaceholderMovies() {
        const movies = [
            { title: "The Shawshank Redemption", rating: 9.3 },
            { title: "The Godfather", rating: 9.2 },
            { title: "The Dark Knight", rating: 9.0 },
            { title: "Pulp Fiction", rating: 8.9 }
        ];

        return movies.map(movie => `
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <img src="https://via.placeholder.com/500x750?text=${encodeURIComponent(movie.title)}" 
                     class="card-img-top" alt="${movie.title}">
                <div class="card-body">
                    <h5 class="card-title">${movie.title}</h5>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Rating: ${movie.rating}/10</small>
                </div>
            </div>
        </div>`).join('');
    }

    function getPlaceholderBooks() {
        const books = [
            { title: "To Kill a Mockingbird", author: "Harper Lee" },
            { title: "1984", author: "George Orwell" },
            { title: "The Great Gatsby", author: "F. Scott Fitzgerald" },
            { title: "Pride and Prejudice", author: "Jane Austen" }
        ];

        return books.map(book => `
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <img src="https://via.placeholder.com/150x200?text=${encodeURIComponent(book.title)}" 
                     class="card-img-top" alt="${book.title}">
                <div class="card-body">
                    <h5 class="card-title">${book.title}</h5>
                    <p class="card-text">By ${book.author}</p>
                </div>
            </div>
        </div>`).join('');
    }

    function getPlaceholderNews() {
        const news = [
            { title: "Important Sports Event Happened", desc: "Details about the sports event" },
            { title: "Team Wins Championship", desc: "Description of the championship win" },
            { title: "Athlete Breaks World Record", desc: "Information about the new world record" }
        ];

        return news.map(item => `
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="https://via.placeholder.com/300x200?text=Sports+News" 
                         class="img-fluid rounded-start" alt="${item.title}">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">${item.title}</h5>
                        <p class="card-text">${item.desc}</p>
                        <a href="#" class="btn btn-sm btn-outline-primary">Read More</a>
                    </div>
                </div>
            </div>
        </div>`).join('');
    }
</script>

<?php include 'includes/footer.php'; ?>