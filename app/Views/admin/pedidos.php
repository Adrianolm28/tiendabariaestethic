<!-- Filtro de fechas y estado -->
<div class="container-fluid mt-3">
  <div class="row mb-3">
    <div class="col-md-3">
      <label for="start_date">Fecha Inicio:</label>
      <input type="date" id="start_date" class="form-control form-control-sm">
    </div>
    <div class="col-md-3">
      <label for="end_date">Fecha Fin:</label>
      <input type="date" id="end_date" class="form-control form-control-sm">
    </div>
    <div class="col-md-3">
      <label for="estado">Estado:</label>
      <select id="estado" class="form-control form-control-sm">
        <option value="">Todos</option>
        <?php foreach($estados as $estado): ?>
          <option value="<?= $estado['id_estado'] ?>"><?= $estado['nombre_estado'] ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-2 d-flex align-items-end">
      <button id="filtrarPedidos" class="btn btn-primary btn-sm w-100"><i class="fas fa-search"></i> Filtrar</button>
    </div>
  </div>

  <div class="table-responsive">
    <table id="tablaPedidos" class="table table-bordered table-striped" style="font-size:13px;">
      <thead>
        <tr>
          <th>ID</th>
          <th>Fecha</th>
          <th>Cliente</th>
          <th>Email</th>
          <th>DNI</th>
          <th>Total</th>
          <th>Estado</th>
          <th>Canal Pago</th>
        </tr>
      </thead>
      <tbody>
        <!-- DataTable AJAX -->
      </tbody>
    </table>
  </div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.min.css" />
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<script>
$(document).ready(function() {
  var tabla = $('#tablaPedidos').DataTable({
    "language": {
      "url": "https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-MX.json"
    },
    "ajax": {
      "url": "<?= base_url('dashboard/pedidosAjax') ?>",
      "data": function(d) {
        d.start_date = $('#start_date').val();
        d.end_date = $('#end_date').val();
        d.estado = $('#estado').val();
      },
      "dataSrc": "data"
    },
    "columns": [
      { "data": "id" },
      { "data": "fecha" },
      { "data": "nombre" },
      { "data": "email" },
      { "data": "dni" },
      { "data": "total" },
      { "data": "nombre_estado" },
      { "data": "canal_pago" }
    ],
    "order": [[1, "desc"]] // Ordenar por la columna Fecha (índice 1) descendente
  });

  $('#filtrarPedidos').click(function() {
    tabla.order([1, 'desc']).draw(); // Fuerza el orden por Fecha descendente al filtrar
    tabla.ajax.reload();
  });
});
</script>
