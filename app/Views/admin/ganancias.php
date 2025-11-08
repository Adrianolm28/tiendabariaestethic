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
      <button id="filtrarGanancias" class="btn btn-primary btn-sm w-100"><i class="fas fa-search"></i> Filtrar</button>
    </div>
    <div class="col-md-4 d-flex align-items-end">
      <h5 class="mb-0">Total Ganancia: <span id="totalGanancia" class="text-success">S/. 0.00</span></h5>
    </div>
  </div>

  <div class="table-responsive">
    <table id="tablaGanancias" class="table table-bordered table-striped" style="font-size:13px;">
      <thead>
        <tr>
          <th>ID</th>
          <th>Fecha</th>
          <th>Ganancia</th>
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
  var tabla = $('#tablaGanancias').DataTable({
    "language": {
      "url": "https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-MX.json"
    },
    "ajax": {
      "url": "<?= base_url('dashboard/gananciasAjax') ?>",
      "data": function(d) {
        d.start_date = $('#start_date').val();
        d.end_date = $('#end_date').val();
      },
      "dataSrc": function(json) {
        $('#totalGanancia').text('S/. ' + json.total_ganancia);
        return json.data;
      }
    },
    "columns": [
      { "data": "id" },
      { "data": "fecha" },
      { "data": "ganancia" }
    ],
    "order": [[1, "desc"]]
  });

  $('#filtrarGanancias').click(function() {
    tabla.ajax.reload();
  });
});
</script>
