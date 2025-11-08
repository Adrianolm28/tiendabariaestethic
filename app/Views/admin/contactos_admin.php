<?php 
// Aquí podrías incluir el header del admin si es un archivo separado que no se carga automáticamente por el layout principal
// Ejemplo: echo view('admin/admin_header'); 
?>

<section class="content">
  <div class="container-fluid mt-3"> <!-- Añadido mt-3 para consistencia -->
    <h3>Administración de Contactos</h3>
    <div class="row mb-3">
      <div class="col-md-4">
        <label for="fechaInicioContactos">Fecha de Inicio:</label>
        <input type="date" id="fechaInicioContactos" class="form-control form-control-sm">
      </div>
      <div class="col-md-4">
        <label for="fechaFinContactos">Fecha de Fin:</label>
        <input type="date" id="fechaFinContactos" class="form-control form-control-sm">
      </div>
      <div class="col-md-2 d-flex align-items-end">
        <button id="filtrarContactos" class="btn btn-primary btn-sm">Filtrar</button>
      </div>
    </div>
    <div class="table-responsive">
      <table id="tablaContactosAdmin" class="table table-bordered table-striped" style="font-size:13px;"> <!-- Añadido style font-size -->
        <thead>
          <tr>
            <th>ID</th>
            <th>Tipo Doc.</th>
            <th>Num. Doc.</th>
            <th>Nombres</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Descripción</th>
            <th>Fecha Registro</th>
            <th>Acciones</th> <!-- Nueva columna -->
          </tr>
        </thead>
        <tbody>
          <!-- Datos cargados por DataTables -->
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- DataTables CSS y JS deben estar incluidos en tu layout principal (ej. admin_footer.php) -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.min.css" /> -->
<!-- <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script> -->

<script>
$(document).ready(function() {
  var tablaContactosAdmin = $('#tablaContactosAdmin').DataTable({
    "language": {
      "url": "https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-MX.json"
    },
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url": "<?= base_url('dashboard/contactosAdminAjax') ?>", // Asegúrate que esta ruta exista en Routes.php
      "type": "GET", // o "POST" si prefieres
      "data": function(d) {
        d.fechaInicio = $('#fechaInicioContactos').val();
        d.fechaFin = $('#fechaFinContactos').val();
      }
    },
    "columns": [
      { "data": "id" },
      { "data": "tipo_documento" },
      { "data": "numero_documento" },
      { "data": "nombres" },
      { "data": "email" },
      { "data": "telefono" },
      { "data": "descripcion" },
      { "data": "created_at" },
      { 
        "data": null,
        "orderable": false,
        "searchable": false,
        "render": function(data, type, row) {
          return '<button class="btn btn-danger btn-sm btn-delete-contacto" data-id="' + row.id + '"><i class="fas fa-trash"></i> Eliminar</button>';
        }
      }
    ],
    "order": [[7, "desc"]] // Ordenar por fecha de registro descendente por defecto
  });

  $('#filtrarContactos').click(function() {
    tablaContactosAdmin.ajax.reload();
  });

  // Evento para el botón de eliminar
  $('#tablaContactosAdmin tbody').on('click', '.btn-delete-contacto', function() {
    var contactoId = $(this).data('id');
    Swal.fire({
      title: '¿Estás seguro?',
      text: "¡No podrás revertir esto!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, ¡eliminar!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "<?= base_url('admin/contactos/delete/') ?>" + contactoId,
          type: 'POST', // La ruta se definió como POST
          dataType: 'json',
          // CSRF Token si lo estás usando globalmente
          // data: {
          //   '<?= csrf_token() ?>': '<?= csrf_hash() ?>' 
          // },
          success: function(response) {
            if (response.status === 'success') {
              Swal.fire(
                '¡Eliminado!',
                response.message,
                'success'
              );
              tablaContactosAdmin.ajax.reload(); // Recargar la tabla
            } else {
              Swal.fire(
                'Error',
                response.message,
                'error'
              );
            }
          },
          error: function(xhr, status, error) {
            Swal.fire(
              'Error',
              'No se pudo conectar con el servidor para eliminar el contacto.',
              'error'
            );
          }
        });
      }
    });
  });
});
</script>

<?php 
// Aquí podrías incluir el footer del admin si es un archivo separado
// Ejemplo: echo view('admin/admin_footer'); 
?>
