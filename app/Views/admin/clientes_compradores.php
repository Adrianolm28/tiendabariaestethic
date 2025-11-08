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
    <div class="col-md-2 d-flex align-items-end">
      <button id="filtrarClientes" class="btn btn-primary btn-sm w-100"><i class="fas fa-search"></i> Filtrar</button>
    </div>
  </div>

  <div class="table-responsive">
    <table id="tablaClientesCompradores" class="table table-bordered table-striped" style="font-size:13px;">
      <thead>
        <tr>
          <th>ID Cliente</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Email</th>
          <th>Total Pedidos</th>
          <th>Total Gastado</th>
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
  var tabla = $('#tablaClientesCompradores').DataTable({
    "language": {
      "url": "https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-MX.json"
    },
    "ajax": {
      "url": "<?= base_url('dashboard/clientesCompradoresAjax') ?>",
      "data": function(d) {
        d.start_date = $('#start_date').val();
        d.end_date = $('#end_date').val();
      },
      "dataSrc": ""
    },
    "columns": [
      { "data": "id_cliente" },
      { "data": "nombre" },
      { "data": "apellido" },
      { "data": "email" },
      { "data": "total_pedidos" },
      { 
        "data": "total_gastado",
        "render": function(data) {
          return "S/. " + parseFloat(data).toFixed(2);
        }
      }
    ],
    "order": [[4, "desc"]] // Ordenar por Total Pedidos descendente
  });

  $('#filtrarClientes').click(function() {
    tabla.ajax.reload();
  });
});
</script>
