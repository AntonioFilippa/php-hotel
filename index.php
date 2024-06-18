<?php
$hotels = [
    ['name' => 'Hotel Belvedere', 'description' => 'Hotel Belvedere Descrizione', 'parking' => true, 'vote' => 4, 'distance_to_center' => 10.4],
    ['name' => 'Hotel Futuro', 'description' => 'Hotel Futuro Descrizione', 'parking' => true, 'vote' => 2, 'distance_to_center' => 2],
    ['name' => 'Hotel Rivamare', 'description' => 'Hotel Rivamare Descrizione', 'parking' => false, 'vote' => 1, 'distance_to_center' => 1],
    ['name' => 'Hotel Bellavista', 'description' => 'Hotel Bellavista Descrizione', 'parking' => false, 'vote' => 5, 'distance_to_center' => 5.5],
    ['name' => 'Hotel Milano', 'description' => 'Hotel Milano Descrizione', 'parking' => true, 'vote' => 2, 'distance_to_center' => 50],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Hotel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Lista Hotel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="container mt-5">
        <h2 class="mb-4">Cerca Hotel</h2>
        <form method="GET" class="mb-5">
            <div class="form-row align-items-center">
                <div class="col-auto my-1">
                    <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" id="parking" name="parking" value="1">
                        <label class="custom-control-label" for="parking">Solo con parcheggio</label>
                    </div>
                </div>
                <div class="col-auto my-1">
                    <label class="sr-only" for="vote">Voto minimo</label>
                    <input type="number" class="form-control" id="vote" name="vote" placeholder="Voto minimo" min="1" max="5">
                </div>
                <div class="col-auto my-1">
                    <button type="submit" class="btn btn-primary">Cerca</button>
                </div>
            </div>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrizione</th>
                    <th>Parcheggio</th>
                    <th>Voto</th>
                    <th>Distanza dal centro (km)</th>
                </tr>
            </thead>
             <tbody>
                <?php
                $filteredHotels = $hotels;
                if (isset($_GET['parking'])) {
                    $filteredHotels = array_filter($filteredHotels, function($hotel) {
                        return $hotel['parking'] === true;
                    });
                }
                if (isset($_GET['vote']) && $_GET['vote'] !== '') {
                    $vote = (int)$_GET['vote'];
                    $filteredHotels = array_filter($filteredHotels, function($hotel) use ($vote) {
                        return $hotel['vote'] >= $vote;
                    });
                }

                foreach ($filteredHotels as $hotel) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($hotel['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($hotel['description']) . "</td>";
                    echo "<td>" . ($hotel['parking'] ? 'Sì' : 'No') . "</td>";
                    echo "<td>" . htmlspecialchars($hotel['vote']) . "</td>";
                    echo "<td>" . htmlspecialchars($hotel['distance_to_center']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">Posto al piede della pagina.</span>
        </div>
    </footer>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>