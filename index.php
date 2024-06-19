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
    <nav class="navbar navbar-expand-lg navbar-light bg-light text-center">
        <a class="navbar-brand" href="#">Lista Hotel</a>
        <button class="navbar-toggler" 
        type="button" 
        data-toggle="collapse" 
        data-target="#navbarNav" 
        aria-controls="navbarNav" 
        aria-expanded="false" 
        aria-label="Toggle navigation">
            
        <span class="navbar-toggler-icon"></span>
        
    </button>
   
</nav>

    <div class="container mt-5 text-center">
        <h1 class="mb-4">Cerca Hotel</h1>
       <form action ="index.php" method="GET" class="mb-5">
   
       <div class="form-row">
   
       <div class="col-md-4 mb-3">
   
       <div class="custom-control custom-checkbox">
   
       <input type="checkbox" class="custom-control-input" id="parking" name="parking" value="1" 
       <?php if (isset($_GET['parking'])) echo 'checked'; ?>>
   
       <label class="custom-control-label mt-5" for="parking">Solo con parcheggio</label>
   
    </div>
   
</div>

<div class="col-md-4 mb-3">

<label for="vote">Voto minimo</label>

<input type="number" class="form-control" id="vote" name="vote" placeholder="Voto minimo" min="1" max="5" 
<?php if (isset($_GET['vote'])) echo 'value="' . htmlspecialchars($_GET['vote']) . '"'; ?>>
</div>

<div class="col-md-4 mb-3 align-self-end">

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
                $filteredHotels = [];

                foreach ($hotels as $hotel) {

                    $includeHotel = true;

                    if (isset($_GET['parking']) && $hotel['parking'] !== true) {

                        $includeHotel = false;

                    }

                    if (isset($_GET['vote']) && $_GET['vote'] !== '' && $hotel['vote'] < (int)$_GET['vote']) {

                        $includeHotel = false;

                    }

                    if ($includeHotel) {

                        $filteredHotels[] = $hotel;

                    }

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
                // DICHIARO END FOREACH
                ?>
            </tbody>
        </table>
    </div>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">Footer Hotel</span>
        </div>
    </footer>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>