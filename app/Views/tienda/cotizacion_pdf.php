<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotizacion</title>
    <style>
        .invoice {
            position: relative;
            background-color: #FFF;

        }

        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #0d6efd
        }

        .invoice .company-details {
            text-align: right
        }

        .invoice .company-details .name {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .contacts {
            margin-bottom: 10px
        }

        .invoice .invoice-to {
            text-align: left
        }

        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .invoice-details {
            text-align: right
        }

        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #0d6efd
        }

        .invoice main {
            padding-bottom: 50px
        }

        .invoice main .thanks {
            margin-top: -100px;
            font-size: 2em;
            margin-bottom: 50px
        }



        .invoice table {
            width: 100%;



        }

        .invoice table td,
        .invoice table th {
            padding: 8px;
            background: #eee;
            border-bottom: 1px solid #fff
        }

        .invoice table th {
            white-space: nowrap;
            font-weight: 100;
            font-size: 16px
        }

        /* .invoice table td h3 {
            margin: 0;
            font-weight: 400;
            color: #0d6efd;
            font-size: 1.2em
        }
 */
        /* .invoice table .qty,
        .invoice table .total,
        .invoice table .unit {
            text-align: right;
            font-size: 1.2em
        } */

        .invoice table .no {
            color: #fff;
            font-size: 1.0em;
            background: #0d6efd
        }

        /*  .invoice table .unit {
            background: #ddd
        }
 */


        /*   .invoice table tbody tr:last-child td {
            border: none
        }
 
        /* .invoice table tfoot td {
            background: 0 0;
            border-bottom: none;
            white-space: nowrap;
            text-align: right;
            padding: 10px 20px;
            font-size: 1.2em;
            border-top: 1px solid #aaa
        }
 */
        .invoice table tfoot tr:first-child td {
            border-top: none
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0px solid rgba(0, 0, 0, 0);

            margin-bottom: 1.5rem;

        }

        .invoice table tfoot tr:last-child td {
            color: #0d6efd;
            font-size: 1.4em;
            border-top: 1px solid #0d6efd
        }

        .invoice table tfoot tr td:first-child {
            border: none
        }

        .invoice footer {
            width: 100%;
            text-align: center;
            color: #777;
            border-top: 1px solid #aaa;

        }

        span {
            font-weight: bold;
        }
    </style>

</head>



<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div id="invoice">
                    
                   
                    <div class="invoice overflow-auto">
                        <div style="min-width: 600px">
                            <header>
                                <div class="row">
                                    <div class="col">
                                    

                                        
                                        <img style="max-width: 120px; max-height: 144px; line-height: 140px;" src="<?= base_url('public/assets/img_tienda/logo_tienda/' . $configTienda[0]['logo_t']) ?>" alt="Logo de la tienda">


                                    </div>
                                    <div class="col company-details">
                                        <h2 class="name">
                                            <a>
                                                <span>RUC:</span> <?= $configTienda[0]['ruc'] ?>
                                            </a>
                                        </h2>
                                        <div><span>RAZON SOCIAL:</span> <?= $configTienda[0]['razon_social'] ?></div>
                                        <div><span>CONTACTO:</span> <?= $configTienda[0]['telefono'] ?></div>
                                        <div><span>CORREO:</span> <?= $configTienda[0]['correo'] ?></div>
                                    </div>
                                </div>
                            </header>
                            <main>
                                <div class="row contacts">
                                    <div class="col invoice-to">
                                        <div class="text-gray-light"><span>COTIZACION: </span> <span>N°</span> <?= $cotizacionExitosa['cotizacion']['id'] ?></div>
                                        <h2 class="to"><span>DNI O RUC:</span> <?= $cotizacionExitosa['cotizacion']['nombre'] ?></h2>
                                        <div class="address"><span>DIRECCION:</span> <?= $cotizacionExitosa['cotizacion']['direccion'] ?></div>
                                        <div class="email"><span>CORREO:</span> <?= $cotizacionExitosa['cotizacion']['email'] ?>
                                        </div>
                                    </div>

                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th class="text-left">DESCRIPCION</th>
                                            <th class="text-right">CANTIDAD</th>
                                            <th class="text-right">PRECIO</th>
                                            <th class="text-right">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $subtotal = 0;
                                        foreach ($cotizacionExitosa['cotizacion']['compraDetalles'] as $detalle) :
                                            $totalDetalle = $detalle['cantidad'] * $detalle['precio'];
                                            $subtotal += $totalDetalle;
                                        ?>
                                            <tr>
                                                <td class="no"><?= $detalle['id'] ?></td>
                                                <td class="text-left">
                                                    <?= $detalle['nombre'] ?>
                                                </td>
                                                <td class="unit"> <?= $detalle['cantidad'] ?></td>
                                                <td class="qty"> <?= $detalle['precio'] ?></td>
                                                <td class="total"><?= $totalDetalle ?></td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">SUBTOTAL</td>
                                            <td><?= $subtotal ?></td>
                                        </tr>

                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">TOTAL</td>
                                            <td><?= $subtotal ?></td>
                                        </tr>
                                    </tfoot>
                                </table>

                                <!--  <div class="notices">
                                    <div>NOTICE:</div>
                                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                                </div> -->
                            </main>

                        </div>

                    </div>
                </div>

                

            </div>
        </div>
    </div>
</body>

</html>