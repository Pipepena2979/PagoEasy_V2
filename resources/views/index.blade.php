<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PagoEasy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">PagoEasy</h2>
        </div>
        <div>
            <a href="{{ route('services.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Crear Servicio
            </a>
        </div>
    </div>
    
    <h1 class="text-center mb-4">Paga tus servicios en línea</h1>    

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif


    <div class="row text-center mb-5">
        @foreach($services as $service)
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="mb-2">
                            @if($service->name == 'Electricidad')
                                <i class="bi bi-lightbulb" style="font-size: 2.5rem; color: #ffc107;"></i>
                            @elseif($service->name == 'Agua')
                                <i class="bi bi-droplet" style="font-size: 2.5rem; color: #0dcaf0;"></i>
                            @elseif($service->name == 'Internet')
                                <i class="bi bi-wifi" style="font-size: 2.5rem; color: #0d6efd;"></i>
                            @elseif($service->name == 'Recolección de Basura')
                                <i class="bi bi-trash" style="font-size: 2.5rem; color: #dc3545;"></i>
                            @elseif($service->name == 'Gas')
                                <i class="fas fa-fire-extinguisher" style="font-size: 2.5rem; color: #198754;"></i>
                            @else
                                <i class="bi bi-question-circle" style="font-size: 2.5rem; color: gray;"></i>
                            @endif
                        </div>
                        <h5 class="card-title">{{ $service->name }}</h5>
                        <div class="mt-3 d-flex justify-content-center gap-2">
                            <a href="{{ route('services.show', $service->id) }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-eye"></i> Ver
                            </a>
                            <a href="{{ route('services.edit', $service->id) }}" class="btn btn-outline-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <form action="{{ route('services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este servicio?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-trash"></i> Eliminar
                                </button>
                            </form>
                        </div>
                        <br>
                        <button class="btn btn-primary" onclick="showForm({{ $service->id }})" data-bs-toggle="modal" data-bs-target="#formModal">
                            Pagar
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>       

    <!-- Modal de pago -->
    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('pagar') }}" method="POST" class="modal-content">
                @csrf
                <input type="hidden" name="service_id" id="service_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Pagar Servicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nombre</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Correo electrónico</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Método de pago</label>
                        <select name="payment_id" class="form-select" required>
                            <option value="" disabled selected>Seleccione un Método de Pago</option>
                            @foreach($payments as $payment)
                                <option value="{{ $payment->id }}">{{ $payment->method }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Teléfono</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary w-100">Pagar Servicio</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function showForm(serviceId) {
        document.getElementById('service_id').value = serviceId;
    }
</script>
<script>
    const alert = document.querySelector('.alert');
    if (alert) {
        setTimeout(() => {
            alert.classList.add('fade');
            alert.classList.remove('show');
            setTimeout(() => {
                alert.remove(); // Elimina completamente el alert del HTML
            }, 200); // Espera 200ms para permitir el efecto fade-out antes de eliminar
        }, 3000);
    }
</script>


</body>
</html>
