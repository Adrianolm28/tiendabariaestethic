<?php $ruta = base_url()  ?>
<section class="content">
  <div class="container-fluid">

    <style>
      .bg-info {
        background-color: #405189 !important;

      }

      /* Estilos para hacer la tabla más compacta */
      .table-sm {
        font-size: 12px;
        padding: 0.25rem;
      }

      .table-sm th,
      .table-sm td {
        padding: 0.25rem;
      }

      .card-header {
        font-weight: bolder;
      }

      #tabla-ord {
        font-size: 13px;

      }

      .card-footer {
        font-size: 13px;
      }
    </style>

    <!-- <h3>Bienvenido: <?= session()->username; ?></h3> -->

    <div class="row">
      <!-- Ganancia -->
      <div class="col mb-3">
        <a href="<?= base_url('dashboard/ganancias') ?>">
          <div class="small-box bg-info h-100" style="cursor:pointer;">
            <div class="inner">
              <h3 class="ganancia"></h3>

              <h5>Ganancia</h5>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <span class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></span>
          </div>
        </a>
      </div>
      <!-- ./col -->
      <!-- Pedidos -->
      <div class="col mb-3">
        <a href="<?= base_url('dashboard/pedidos') ?>">
          <div class="small-box bg-info h-100" style="cursor:pointer;">
            <div class="inner">
              <h3 class="total-pedidos"></h3>
              <h5>Pedidos</h5>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <span class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></span>
          </div>
        </a>
      </div>
      <!-- ./col -->
      <!-- Clientes -->
      <div class="col mb-3">
        <a href="<?= base_url('dashboard/clientesCompradores') ?>">
          <div class="small-box bg-info h-100" style="cursor:pointer;">
            <div class="inner">
              <h3 class="clientes"></h3>
              <h5>Clientes</h5>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <span class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></span>
          </div>
        </a>
      </div>
      <!-- ./col -->
    
      <!-- ./col -->

      <!-- Tarjeta de Total Visualizaciones (Filtro) -->
      <div class="col mb-3">
        <a href="<?= base_url('dashboard/visitasDetalle') ?>">
          <div class="small-box bg-info h-100" style="cursor:pointer;">
            <div class="inner">
              <h3 class="total-visitas-filtradas">0</h3>
              <h5>Total Visualizaciones</h5>
            </div>
            <div class="icon">
              <i class="ion ion-eye"></i>
            </div>
            <span class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></span>
          </div>
        </a>
      </div>
      <!-- ./col -->

      <!-- Tarjeta de Stock Total -->
      <div class="col mb-3">
        <a href="<?= base_url('dashboard/stockDetalle') ?>">
          <div class="small-box bg-info h-100" style="cursor:pointer;">
            <div class="inner">
              <h3 class="total-stock"><?= isset($totalStock) ? $totalStock : 0 ?></h3>
              <h5>Stock Total</h5>
            </div>
            <div class="icon">
              <i class="ion ion-cube"></i>
            </div>
            <span class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></span>
          </div>
        </a>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->

    <div class="card card-solid">
      <div class="card-body pb-0">
        <div class="row">

          <div class="col-md-6">
            <a>
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  Ventas x Categoria
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <canvas id="ventasPorCategoriaChart"></canvas>
                  </div>
                  <table class="table table-bordered table-sm" id="ventasPorCategoriaTable">
                    <thead>
                      <tr>
                        <th>Categoría</th>
                        <th>Cantidad de Ventas</th>
                        <th>Total de Ventas</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Los datos se insertarán aquí dinámicamente -->
                    </tbody>
                  </table>
                </div>

              </div>
            </a>
          </div>




          <div class="col-md-6">
            <a>
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  Ventas Mensuales
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <canvas id="myChart" width="350" height="260"></canvas>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                  </div>
                </div>
              </div>
            </a>
          </div>


          <div class="col-md-6">
            <a>
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  Productos más vendidos (Top 5)
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <canvas id="productosMasVendidosChart" width="300" height="200"></canvas>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                  </div>
                </div>
              </div>
            </a>
          </div>

          <!-- linechard -->

          <div class="col-md-6">
            <a>
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  Ventas Diarias de la Semana
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <canvas id="ventasDiariasChart" width="300" height="200"></canvas>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                  </div>
                </div>
              </div>
            </a>
          </div>

          <!-- Cambia col-md-6 a col-md-12 para ocupar todo el ancho -->
          <div class="col-md-12">
            <a>
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  Más Visitados
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <!-- Haz que el canvas ocupe el 100% del ancho -->
                    <canvas id="mostVisitedChart" style="width:100% !important; height:250px !important; min-width:600px;"></canvas>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                  </div>
                </div>
              </div>
            </a>
          </div>

        

          <!--  <div class="col-md-8">

            <div class="card bg-light d-flex flex-fill">
              <div class="card-header text-muted border-bottom-0">
                Productos Más Vendidos
              </div>
              <div class="card-body pt-0">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="fechaInicio">Fecha de Inicio:</label>
                      <input type="date" id="fechaInicio" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="fechaFin">Fecha de Fin:</label>
                      <input type="date" id="fechaFin" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">

                      <button id="filtrar" class="btn btn-primary btn-block mt-2">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>

                </div>

                <div class="table-responsive">
                  <table id="ordenesRecientes" class="table table-striped table-bordered tabla-reporte">
                    <thead>
                      <tr>
                        <th style="width: 10%;">Imagen</th>
                        <th style="width: 20%;">Nombre</th>
                        <th style="width: 10%;">Precio</th>
                        <th style="width: 10%;">Stock</th>
                        <th style="width: 15%;">Cant.Vendido</th>
                        <th style="width: 15%;">Total</th>
                      </tr>
                    </thead>
                    <tbody id="tabla-ord">
                    
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card-footer">
                <div class="text-right">
                </div>
              </div>
            </div>

          </div> -->

          <div class="col-md-12">
            <div class="card bg-light">
              <div class="card-header text-muted border-bottom-0" style="font-size: 13px;">
                Productos Más Vendidos
              </div>
              <div class="card-body pt-0">
                <div class="row mb-3">
                  <div class="col-md-4">
                    <label for="fechaInicio" class="form-label" style="font-size: 13px;">Fecha de Inicio:</label>
                    <input type="date" id="fechaInicio" class="form-control form-control-sm" style="border: 1px solid #ced4da; border-radius: 0;">
                  </div>
                  <div class="col-md-4">
                    <label for="fechaFin" class="form-label" style="font-size: 13px;">Fecha de Fin:</label>
                    <input type="date" id="fechaFin" class="form-control form-control-sm" style="border: 1px solid #ced4da; border-radius: 0;">
                  </div>
                  <div class="col-md-2 d-flex align-items-center">
                    <button id="filtrar" class="btn btn-primary btn-sm" style="border-radius: 0;">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>


                <div class="table-responsive">
                  <table id="ordenesRecientes" class="table table-striped table-bordered tabla-reporte" style="font-size: 13px;">
                    <thead>
                      <tr>
                        <th style="width: 10%;">Imagen</th>
                        <th style="width: 20%;">Nombre</th>
                        <th style="width: 10%;">Precio</th>
                        <th style="width: 10%;">Stock</th>
                        <th style="width: 15%;">Cant. Vendido</th>
                        <th style="width: 15%;">Total</th>
                      </tr>
                    </thead>
                    <tbody id="tabla-ord">
                      <!-- Aquí se insertarán los datos dinámicamente -->
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card-footer">
                <div class="text-right">
                  <!-- Aquí puedes agregar contenido adicional en el pie de la tarjeta si es necesario -->
                </div>
              </div>
            </div>
          </div>

          <!-- Tarjeta de total de visualizaciones filtradas -->
          

     
        </div>


        <div>


        </div>

        <!-- /.card-footer -->
      </div>



      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.min.css" />
<script>
  $(document).ready(function() {
    // Obtén el contexto del canvas
    var ctx = document.getElementById('myChart').getContext('2d');

    // Nombres de los meses
    var mesesNombres = [
      'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
      'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
    ];

    // Configura los datos iniciales del gráfico (pueden ser vacíos inicialmente)
    var data = {
      labels: [], // Se llenarán dinámicamente con los nombres de los meses
      datasets: [{
        label: 'Ventas',
        backgroundColor: 'rgba(216, 185, 22, 0.68)', // Color de fondo
        borderColor: 'rgba(20, 19, 19, 0.8)', // Color del borde
        borderWidth: 1,
        data: [], // Se llenarán dinámicamente con las ventas por mes
      }]
    };

    // Configura las opciones del gráfico
    var options = {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    };

    // Crea el objeto del gráfico de barras
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: data,
      options: options
    });

    // Llamada AJAX para obtener los datos desde el controlador de CodeIgniter
    $.ajax({
      url: '<?= base_url('dashboard/ventasMensuales') ?>',
      type: 'GET',
      success: function(response) {
        // Actualiza los datos del gráfico con los datos recibidos
        var meses = [];
        var ventas = [];

        // Procesa los datos recibidos del servidor
        response.forEach(function(item) {
          // Obtén el nombre del mes correspondiente
          var nombreMes = mesesNombres[item.mes - 1]; // Restamos 1 porque los meses en JavaScript son base 0

          // Agrega el nombre del mes y las ventas al array
          meses.push(nombreMes);
          ventas.push(item.total_mensual);
        });

        // Actualiza los datos en el gráfico
        myChart.data.labels = meses;
        myChart.data.datasets[0].data = ventas;

        // Actualiza el gráfico
        myChart.update();
      },
      error: function(error) {
        console.log('Error al obtener datos de ventas mensuales:', error);
      }
    });



    /* productos mas vendidos */
    // Obtén el contexto del canvas para el gráfico de productos más vendidos
    var ctxProductosMasVendidos = document.getElementById('productosMasVendidosChart').getContext('2d');

    // Configura los datos iniciales del gráfico
    var dataProductosMasVendidos = {
      labels: [], // Se llenarán dinámicamente con los nombres de los productos
      datasets: [{
        label: 'Total Vendido',
        data: [], // Se llenarán dinámicamente with las cantidades vendidas
        backgroundColor: 'rgba(255, 99, 132, 0.2)', // Color de fondo
        borderColor: 'rgba(20, 19, 19, 0.8)', // Color del borde
        borderWidth: 1
      }]
    };



    /* productos mas vendidos */

    // Obtén el contexto del canvas
    var ctx = document.getElementById('productosMasVendidosChart').getContext('2d');

    // Configura el gráfico inicialmente vacío
    var pieChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: [], // Etiquetas de los productos (nombres + cantidades vendidas)
        datasets: [{
          label: 'Productos más vendidos',
          data: [], // Cantidades vendidas
          backgroundColor: [
            'rgba(255, 99, 132, 0.8)',
            'rgba(54, 162, 235, 0.8)',
            'rgba(255, 206, 86, 0.8)',
            'rgba(75, 192, 192, 0.8)',
            'rgba(153, 102, 255, 0.8)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'top',
          },
          tooltip: {
            callbacks: {
              label: function(tooltipItem) {
                var label = tooltipItem.label || '';

                if (label) {
                  label += ': ';
                }
                label += tooltipItem.raw.toFixed(0); // Muestra la cantidad vendida sin decimales
                return label;
              },
              afterLabel: function(tooltipItem) {
                var dataset = pieChart.data.datasets[tooltipItem.datasetIndex];
                var index = tooltipItem.dataIndex;
                var total = dataset.data.reduce(function(previousValue, currentValue) {
                  return previousValue + currentValue;
                });
                var currentValue = dataset.data[index];
                var percent = Math.round((currentValue / total) * 100);
                return '(' + percent + '%)';
              }
            }
          }
        }
      }
    });

    // Llamada AJAX para obtener los datos desde el controlador de CodeIgniter
    $.ajax({
      url: '<?= base_url('reportes/productosMasVendidos') ?>',
      type: 'GET',
      success: function(response) {
        // Procesa los datos recibidos del servidor
        var nombresProductos = [];
        var ventasProductos = [];

        // Limita a mostrar solo los primeros 5 productos más vendidos
        var topProductos = response.slice(0, 5);

        topProductos.forEach(function(item) {
          nombresProductos.push(item.nombre + ' - ' + item.total_vendido); // Nombre del producto + cantidad vendida
          ventasProductos.push(item.total_vendido);
        });

        // Actualiza los datos en el gráfico de pastel
        pieChart.data.labels = nombresProductos;
        pieChart.data.datasets[0].data = ventasProductos;

        // Actualiza el gráfico
        pieChart.update();
      },
      error: function(error) {
        console.log('Error al obtener datos de productos más vendidos:', error);
      }
    });

    /* Fin productos mas vendidos */


    /* line chart ventas semanales */
    var ctxVentasDiarias = document.getElementById('ventasDiariasChart').getContext('2d');

    // Configura los datos iniciales del gráfico de línea
    var dataVentasDiarias = {
      labels: [],
      datasets: [{
        label: 'Ventas Diarias de la Semana',
        data: [],
        borderColor: 'rgba(75, 192, 192, 1)',
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        fill: true,
        borderWidth: 1
      }]
    };

    // Configura las opciones del gráfico de línea
    var optionsVentasDiarias = {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        x: {
          type: 'category', // Utilizamos 'category' en lugar de 'time' para días de la semana
          labels: [], // Etiquetas vacías para los días de la semana (se llenarán con los datos)
          title: {
            display: true,
            text: 'Días de la Semana'
          }
        },
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Total de Ventas'
          }
        }
      }
    };

    // Crea el objeto del gráfico de línea
    var ventasDiariasChart = new Chart(ctxVentasDiarias, {
      type: 'line',
      data: dataVentasDiarias,
      options: optionsVentasDiarias
    });

    // Llamada AJAX para obtener los datos desde el controlador de CodeIgniter
    $.ajax({
      url: '<?= base_url('dashboard/ventasSemanales') ?>',
      type: 'GET',
      success: function(response) {
        var dias = [];
        var ventas = [];

        // Mapeamos los datos recibidos para llenar las etiquetas y los datos del gráfico
        response.forEach(function(item) {
          // Convertimos la fecha a formato de día de la semana (Lun, Mar, Mié, ...)
          var diaSemana = obtenerDiaSemana(item.dia);
          dias.push(diaSemana);
          ventas.push(item.total_diario);
        });

        // Actualizamos los datos en el gráfico
        ventasDiariasChart.data.labels = dias;
        ventasDiariasChart.data.datasets[0].data = ventas;

        // Actualizamos el gráfico
        ventasDiariasChart.update();
      },
      error: function(error) {
        console.log('Error al obtener datos de ventas diarias de la semana:', error);
      }
    });

    // Función para obtener el día de la semana abreviado a partir de una fecha
    function obtenerDiaSemana(fecha) {
      var diasSemana = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];
      var date = new Date(fecha);
      return diasSemana[date.getDay()];
    }







    // Obtener el total de pedidos (todas las compras)
    $.ajax({
      url: "<?= base_url('dashboard/totalPedidos') ?>",
      method: "GET",
      dataType: "json",
      success: function(data) {
        $(".total-pedidos").text(data.total_pedidos);
      },
      error: function() {
        $(".total-pedidos").text("0");
      }
    });

    // Cambia este bloque para clientes:
    $.ajax({
      url: "<?= base_url('dashboard/totalClientesCompradores') ?>",
      method: "GET",
      dataType: "json",
      success: function(data) {
        $(".clientes").text(data.total_clientes); // Actualiza el total de clientes en el HTML
      },
      error: function(xhr, status, error) {
        $(".clientes").text("0");
      }
    });

    // Mostrar el total de ganancia en la tarjeta (solo dashboard, no reportes)
    $.ajax({
      url: "<?= base_url('dashboard/totalGanancia') ?>",
      method: "GET",
      dataType: "json",
      success: function(data) {
        $(".ganancia").text("S/. " + data.total_ganancia);
      },
      error: function() {
        $(".ganancia").text("S/. 0.00");
      }
    });


    $.ajax({
      url: "<?= base_url('dashboard/ventasPorCategoria'); ?>",
      method: "GET",
      dataType: "json",
      success: function(data) {
        var labels = [];
        var cantidades = [];
        var colores = [
          '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
        ];

        // LIMPIA EL TBODY ANTES DE AGREGAR FILAS NUEVAS
        $('#ventasPorCategoriaTable tbody').empty();

        data.forEach(function(item, index) {
          labels.push(item.nombre_categoria);
          cantidades.push(item.cantidad_ventas);

          // Formatear el total de ventas con el símbolo de la moneda
          var totalVentasFormatted = new Intl.NumberFormat('es-PE', {
            style: 'currency',
            currency: 'PEN'
          }).format(item.total_ventas);

          // Agregar fila a la tabla
          $('#ventasPorCategoriaTable tbody').append(
            '<tr>' +
            '<td>' + item.nombre_categoria + '</td>' +
            '<td>' + item.cantidad_ventas + '</td>' +
            '<td>' + totalVentasFormatted + '</td>' +
            '</tr>'
          );
        });

        // DIBUJA EL GRÁFICO SOLO SI HAY DATOS
        var ctx = document.getElementById('ventasPorCategoriaChart').getContext('2d');
        if (window.myDoughnutChart) {
          window.myDoughnutChart.destroy();
        }
        window.myDoughnutChart = new Chart(ctx, {
          type: 'doughnut',
          data: {
            labels: labels,
            datasets: [{
              data: cantidades,
              backgroundColor: colores,
              hoverBackgroundColor: colores
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                position: 'bottom',
              },
              title: {
                display: true,
                text: 'Ventas por Categoría'
              }
            },
            animation: {
              animateScale: true,
              animateRotate: true
            }
          }
        });
      },
      error: function(xhr, status, error) {
        console.error("Error al obtener los datos de ventas por categoría:", error);
      }
    });

    var table = $('#ordenesRecientes').DataTable({
      "language": {
        "url": "https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-MX.json"
      },
      "pageLength": 5,
      "ajax": {
        "url": '<?= base_url('reportes/ordenesRecientes') ?>',
        "dataSrc": ""
      },
      "columns": [{
          "data": "imagen_producto",
          "render": function(data) {
            return '<img src="<?= base_url('public/assets/img_tienda/productos/') ?>/' + data + '" width="50" height="50">';
          }
        },
        {
          "data": "nombre"
        },
        {
          "data": "precio"
        },
        {
          "data": "stock"
        },
        {
          "data": "veces_vendido"
        },
        {
          "data": "total_ventas"
        }
      ]
    });


    $('#filtrar').click(function() {
      var fechaInicio = $('#fechaInicio').val();
      var fechaFin = $('#fechaFin').val();

      $.ajax({
        url: '<?= base_url('reportes/ordenesRecientes') ?>',
        method: 'GET',
        dataType: 'json',
        data: {
          fechaInicio: fechaInicio,
          fechaFin: fechaFin
        },
        success: function(response) {
          table.clear().rows.add(response).draw();
        },
        error: function(xhr, status, error) {
          console.error(error);
        }
      });
    });
 



    // Obtén el contexto del canvas para el gráfico de los más visitados
    var ctxMostVisited = document.getElementById('mostVisitedChart').getContext('2d');

    // Configura el gráfico inicialmente vacío
    var mostVisitedChart = new Chart(ctxMostVisited, {
      type: 'bar',
      data: {
        labels: [], // Aquí van los nombres de las páginas más visitadas
        datasets: [{
          label: 'Visitas',
          data: [], // Aquí van los números de visitas por página
          backgroundColor: 'rgba(54, 162, 235, 0.8)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // Pedimos los datos al backend y actualizamos gráfico y tarjeta
    $.ajax({
      url: '<?= base_url('reportes/mostVisited') ?>',
      type: 'GET',
      success: function(response) {
        // Sumamos todas las visitas de todas las páginas públicas
        var totalVisits = response.reduce((sum, item) => sum + parseInt(item.visits), 0);

        // Usamos page_base para mostrar la ruta agrupada (más dinámica)
        mostVisitedChart.data.labels = response.map(item => item.page_base);
        mostVisitedChart.data.datasets[0].data = response.map(item => parseInt(item.visits));
        mostVisitedChart.update();

        // Mostramos el total de visitas en la tarjeta azul
        $(".total-visitas-filtradas").text(totalVisits);

        // Mensaje en consola para confirmar que ambos totales son iguales
        console.log('Total de visualizaciones y gráfico (MISMO TOTAL):', totalVisits);
      },
      error: function(error) {
        console.error('Error al obtener datos de los más visitados:', error);
      }
    });



  });
</script>
