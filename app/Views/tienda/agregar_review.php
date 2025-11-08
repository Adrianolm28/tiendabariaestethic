<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Deja tu Opinión</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .rating-stars {
            direction: rtl;
            unicode-bidi: bidi-override;
            display: inline-flex;
        }
        .rating-stars input[type="radio"] {
            display: none;
        }
        .rating-stars label {
            font-size: 2rem;
            color: #ccc;
            cursor: pointer;
            transition: color 0.2s;
        }
        .rating-stars input[type="radio"]:checked ~ label,
        .rating-stars label:hover,
        .rating-stars label:hover ~ label {
            color: #FFD700;
        }
        .producto-info {
            background: #f5f5f5;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
        }
        .producto-info img {
            max-width: 80px;
            max-height: 80px;
            margin-right: 20px;
            border-radius: 6px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>Deja tu Opinión sobre el Producto</h2>
    <?php if (!empty($producto)): ?>
        <div class="producto-info">
            <?php if (!empty($producto['imagen_principal'])): ?>
                <img src="<?= base_url('public/assets/img_tienda/productos/' . $producto['imagen_principal']) ?>" alt="<?= esc($producto['nombre']) ?>">
            <?php endif; ?>
            <div>
                <strong><?= esc($producto['nombre']) ?></strong><br>
                <?php if (!empty($producto['marca'])): ?>
                    <small>Marca: <?= esc($producto['marca']) ?></small>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
    <form id="formReview">
        <input type="hidden" name="producto_id" value="<?= esc($producto_id) ?>">
        <div class="form-group">
            <label for="nombre">Tu nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" class="form-control" id="correo" name="correo" required>
        </div>
        <div class="form-group">
            <label for="comentario">Comentario</label>
            <textarea class="form-control" id="comentario" name="comentario" required></textarea>
        </div>
        <div class="form-group">
            <label>Calificación</label><br>
            <div class="rating-stars">
                <input type="radio" id="star5" name="rating" value="5" required><label for="star5" title="5 estrellas">★</label>
                <input type="radio" id="star4" name="rating" value="4"><label for="star4" title="4 estrellas">★</label>
                <input type="radio" id="star3" name="rating" value="3"><label for="star3" title="3 estrellas">★</label>
                <input type="radio" id="star2" name="rating" value="2"><label for="star2" title="2 estrellas">★</label>
                <input type="radio" id="star1" name="rating" value="1"><label for="star1" title="1 estrella">★</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Enviar Opinión</button>
    </form>
    <div id="mensajeReview" class="mt-3"></div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$('#formReview').on('submit', function(e) {
    e.preventDefault();
    var producto_id = $('input[name="producto_id"]').val();
    $.post('<?= base_url('review/agregarReview') ?>', $(this).serialize(), function(resp) {
        if (resp.success) {
            Swal.fire('¡Gracias!', resp.message, 'success').then(function() {
                // Redirigir al producto después de enviar la reseña
                window.location.href = "<?= base_url('tienda/verproducto/') ?>" + producto_id;
            });
        } else {
            Swal.fire('Error', resp.message, 'error');
        }
    });
});
</script>
</body>
</html>
