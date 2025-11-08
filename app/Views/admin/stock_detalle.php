<?php ?>
<section class="content">
  <div class="container-fluid">
    <h3>Detalle de Stock</h3>
    <div class="row mb-3">
      <div class="col-md-4">
        <label for="fechaInicio">Fecha de Inicio:</label>
        <input type="date" id="fechaInicio" class="form-control form-control-sm">
      </div>
      <div class="col-md-4">
        <label for="fechaFin">Fecha de Fin:</label>
        <input type="date" id="fechaFin" class="form-control form-control-sm">
      </div>
      <div class="col-md-2 d-flex align-items-end">
        <button id="filtrarStock" class="btn btn-primary btn-sm">Filtrar</button>
      </div>
    </div>
    <div class="table-responsive">
      <table id="tablaStock" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Producto</th>
            <th>Stock</th>
            <th>Fecha Actualización</th>
          </tr>
        </thead>
        <tbody>
          <!-- Datos dinámicos -->
        </tbody>
      </table>
    </div>
  </div>
</section>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<script>
$(document).ready(function() {
  var tablaStock = $('#tablaStock').DataTable({
    "ajax": {
      "url": "<?= base_url('dashboard/stockDetalleAjax') ?>",
      "data": function(d) {
        d.fechaInicio = $('#fechaInicio').val();
        d.fechaFin = $('#fechaFin').val();
      },
      "dataSrc": ""
    },
    "columns": [
      { "data": "nombre" },
      { "data": "stock" },
      { "data": "updated_at" }
    ]
  });

  $('#filtrarStock').click(function() {
    tablaStock.ajax.reload();
  });
});
</script>
<?php ?>
