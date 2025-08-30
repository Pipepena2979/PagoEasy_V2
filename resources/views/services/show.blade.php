<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Servicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
    <h1 class="mb-4">Detalles del Servicio</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $service->name }}</h5>
            <p class="card-text">{{ $service->description }}</p>
            <a href="{{ route('index') }}" class="btn btn-secondary">Regresar</a>
        </div>
    </div>
</div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
