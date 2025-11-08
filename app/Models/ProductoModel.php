<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    protected $allowedFields = ['nombre', 'descripcion', 'caracteristicas', 'precio', 'precio_anterior', 'precio_transferencia', 'marca', 'modelo', 'categoria_producto', 'imagen_producto', 'producto_video', 'estado', 'manual_pdf', 'producto_descuento', 'stock', 'id_sistema', 'id_subcategoria', 'costo_producto', 'descuento_transferencia', 'delivery'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';




    public function insert_data($data)
    {
        $result = $this->insert($data);
        if ($result) {
            return $this->insertID();
        } else {
            return false;
        }
    }


    public function filtrarPorCategoria($id_categoria)
    {
        // Ejecutar la consulta SQL para obtener productos por id_categoria
        $query = $this->select('p.id_producto, p.nombre, p.producto_descuento, p.descripcion, p.precio, p.precio_anterior, p.precio_transferencia, p.descuento_transferencia, p.producto_video, i.nombre_archivo AS imagen_producto, p.categoria_producto AS id_categoria, m.nombre AS categoria_producto')
            ->from('productos p')
            ->join('(SELECT id_producto, nombre_archivo FROM imagenes_producto WHERE orden = 1) i', 'p.id_producto = i.id_producto', 'left')
            ->join('marca_producto m', 'p.marca = m.id_marca', 'left') // Unión con la tabla marca_producto
            ->where('p.categoria_producto', $id_categoria)
            ->where('p.estado', 1) // Filtrar productos activos
            ->groupBy('p.id_producto') // Agrupar por ID de producto para seleccionar una imagen por producto
            ->findAll();

        return $query;
    }




    public function filtrarPorMarca($marca)
    {
        // Ejecutar la consulta SQL para obtener productos por marca con la imagen de orden "1"
        $query = $this->select('p.id_producto, p.nombre, p.descripcion, p.precio, p.precio_anterior,p.precio_transferencia,, p.descuento_transferencia, p.producto_descuento, p.producto_video, p.marca AS id_marca, m.nombre AS marca_producto, p.categoria_producto, i.nombre_archivo AS imagen_producto')
            ->from('productos p')
            ->join('(SELECT id_producto, nombre_archivo FROM imagenes_producto WHERE orden = 1) i', 'p.id_producto = i.id_producto', 'left')
            ->join('marca_producto m', 'p.marca = m.id_marca', 'left') // Unión con la tabla marca_producto
            ->where('p.marca', $marca)
            ->where('p.estado', 1) // Filtrar productos activos
            ->groupBy('p.id_producto')
            ->findAll();

        return $query;
    }

    /* filtros descuento  */


    public function buscarProductosConDescuento()
    {
        return $this->where('producto_descuento >', 0)->findAll();
    }

    public function buscarProductosConDescuentoPorCategoria($categoriaId)
    {
        return $this->where('categoria_producto', $categoriaId)
            ->where('producto_descuento >', 0)
            ->findAll();
    }

    public function buscarProductosConDescuentoPorSubcategoria($subcategoriaId)
    {
        return $this->where('id_subcategoria', $subcategoriaId)
            ->where('producto_descuento >', 0)
            ->findAll();
    }

    public function countAllDescuentos()
    {
        return $this->where('producto_descuento >', 0)->countAllResults();
    }

    public function paginateProductosConDescuento($num, $group = null, $page = null)
    {
        return $this->where('producto_descuento >', 0)->paginate($num, $group, $page);
    }



    /* filtros descuento */





    /* public function filtrarPorPrecio($precioMin, $precioMax)
    {
        // Realizar la consulta SQL para obtener los productos dentro del rango de precios especificado
        $productos = $this->db->table('productos')
            ->where('precio >=', $precioMin)
            ->where('precio <=', $precioMax)
            ->get()
            ->getResultArray();

        // Calcular precio con descuento para cada producto
        foreach ($productos as &$producto) {
            // Calcular el precio con descuento si aplica
            if ($producto['producto_descuento'] > 0) {
                $precioConDescuento = $producto['precio'] - ($producto['precio'] * ($producto['producto_descuento'] / 100));
                // Agregar el precio con descuento al arreglo del producto
                $producto['precio_con_descuento'] = number_format($precioConDescuento, 2, '.', '');
            } else {
                // Si no hay descuento, el precio con descuento es igual al precio original
                $producto['precio_con_descuento'] = "0";
            }
        }

        return $productos;
    } */
    public function filtrarPorPrecio($precioMin, $precioMax)
    {
        // Realizar la consulta SQL para obtener los productos dentro del rango de precios especificado
        $productos = $this->db->table('productos')
            ->where('precio >=', $precioMin)
            ->where('precio <=', $precioMax)
            ->get()
            ->getResultArray();

        // Iterar sobre los productos para agregar el nombre de la imagen con orden = 1
        foreach ($productos as &$producto) {
            // Obtener el nombre del archivo de imagen con orden = 1
            $imagen = $this->db->table('imagenes_producto')
                ->where('id_producto', $producto['id_producto'])
                ->where('orden', 1) // Filtrar por orden = 1
                ->get()
                ->getRowArray();

            // Verificar si se encontró la imagen y asignar el nombre_archivo al producto
            if ($imagen) {
                $producto['imagen_producto'] = $imagen['nombre_archivo'];
            } else {
                // Si no hay imagen con orden = 1, asignar un valor predeterminado o manejar como desees
                $producto['imagen_producto'] = 'default.jpg';
            }

            // Calcular precio con descuento para cada producto
            if ($producto['producto_descuento'] > 0) {
                $precioConDescuento = $producto['precio'] - ($producto['precio'] * ($producto['producto_descuento'] / 100));
                // Agregar el precio con descuento al arreglo del producto
                $producto['precio_con_descuento'] = number_format($precioConDescuento, 2, '.', '');
            } else {
                // Si no hay descuento, el precio con descuento es igual al precio original
                $producto['precio_con_descuento'] = "0";
            }
        }

        return $productos;
    }






    /* public function buscarProductosPorTexto($texto)
    {
        // Realizar consulta SQL para buscar productos por nombre o descripción
        $builder = $this->db->table('productos');
        $builder->select('productos.*, categoria_producto.nombre as categoria_nombre, categoria_producto.id_categoria');
        $builder->join('categoria_producto', 'categoria_producto.id_categoria = productos.categoria_producto', 'left');
        $builder->like('productos.nombre', $texto);
        $builder->orLike('productos.descripcion', $texto);
        $query = $builder->get();
        $productos = $query->getResultArray();


       
        

        // Procesar los productos para construir el array de datos
        $data = [];
        foreach ($productos as $producto) {
            // Calcular el precio con descuento
            $precioConDescuento = $producto['precio'] - ($producto['precio'] * ($producto['producto_descuento'] / 100));

            // Obtener la categoría y la marca del producto
            $categoriaModel = new CategoriaProductoModel();
            $categoria = $categoriaModel->find($producto['categoria_producto']);
            $marcaModel = new MarcasProductosModel();
            $marca = $marcaModel->find($producto['marca']);

            



            // Obtener las imágenes adicionales del producto
            $imagenesModel = new ImagenesProductoModel();
            $imagenes = $imagenesModel->where('id_producto', $producto['id_producto'])->findAll();

            // Construir el HTML de las imágenes adicionales
            $imagenesHTML = '';
            foreach ($imagenes as $imagen) {
                $imagenesHTML .= '<img src="' . base_url('public/assets/img_tienda/productos/' . $imagen['nombre_archivo']) . '" alt="Imagen">';
            }

            // Construir el array de datos del producto
            $data[] = [
                'id_producto' => $producto['id_producto'],
                'id_sistema' => $producto['id_sistema'],
                'imagen_producto' => $producto['imagen_producto'],
                'nombre' => $producto['nombre'],
                'descripcion' => $producto['descripcion'],
                'caracteristicas' => $producto['caracteristicas'],
                'precio' => $producto['precio'],
                'precio_con_descuento' => $producto['producto_descuento'] == 0 ? "0.00" : ($producto['producto_descuento'] === "0.00" ? $producto['precio'] : number_format($precioConDescuento, 2, '.', '')),
                'precio_anterior' => $producto['precio_anterior'],
                'marca' => $marca['nombre'] ?? null,
                'modelo' => $producto['modelo'],
                'categoria_producto' => $categoria['nombre'] ?? null,
                'imagenes_adicionales' => $imagenesHTML,
                'id_categoria' => $categoria['id_categoria'] ?? null,
                'id_marca' => $marca['id_marca'] ?? null,
                'stock' => $producto['stock'],
                'estado' => $producto['estado'],
                'producto_descuento' => $producto['producto_descuento'],
                'acciones' => '<button class="btn btn-primary">Editar</button>',
            ];
        }

        return $data;
    } */

    public function buscarProductosPorTexto($texto)
    {
        // Realizar consulta SQL para buscar productos por nombre o descripción
        $builder = $this->db->table('productos');
        $builder->select('productos.*, productos.producto_video, categoria_producto.nombre as categoria_nombre, categoria_producto.id_categoria, imagenes_producto.nombre_archivo as imagen_producto');
        $builder->join('categoria_producto', 'categoria_producto.id_categoria = productos.categoria_producto', 'left');
        $builder->join('imagenes_producto', 'imagenes_producto.id_producto = productos.id_producto AND imagenes_producto.orden = 1', 'left');
        $builder->groupStart();
        $builder->like('productos.nombre', $texto);
        $builder->orLike('productos.descripcion', $texto);
        $builder->groupEnd();
        $query = $builder->get();
        $productos = $query->getResultArray();

        return $productos;
    }


    public function buscarProductosPorSubcategoria($id_subcategoria)
    {
        // Realizar consulta SQL para buscar productos por id_subcategoria
        $builder = $this->db->table('productos');
        $builder->select('productos.*, productos.producto_video, categoria_producto.nombre as categoria_nombre, categoria_producto.id_categoria, imagenes_producto.nombre_archivo as imagen_producto');
        $builder->join('categoria_producto', 'categoria_producto.id_categoria = productos.categoria_producto', 'left');
        $builder->join('imagenes_producto', 'imagenes_producto.id_producto = productos.id_producto AND imagenes_producto.orden = 1', 'left');
        $builder->where('productos.id_subcategoria', $id_subcategoria);
        $query = $builder->get();
        $productos = $query->getResultArray();

        return $productos;
    }







    public function buscarProductosPorTexto1($texto)
    {
        // Realizar consulta principal para buscar productos por nombre o descripción
        $builder = $this->db->table('productos');
        $builder->select('productos.*, categoria_producto.nombre as categoria_nombre, categoria_producto.id_categoria');
        $builder->join('categoria_producto', 'categoria_producto.id_categoria = productos.categoria_producto', 'left');
        $builder->groupStart();
        $builder->like('productos.nombre', $texto);
        $builder->orLike('productos.descripcion', $texto);
        $builder->groupEnd();
        $query = $builder->get();
        $productos = $query->getResultArray();

        return $productos;
    }



    public function productos_categorias()
    {
        $productoModel = new ProductoModel();

        // Consulta SQL para obtener un producto de cada categoría con el nombre de la categoría
        $sql = "SELECT p.*, c.nombre AS nombre_categoria, i.nombre_archivo AS imagen_producto
        FROM productos p
        INNER JOIN (
            SELECT categoria_producto, MIN(id_producto) AS id_producto
            FROM productos
            GROUP BY categoria_producto
        ) AS pc ON p.id_producto = pc.id_producto
        INNER JOIN categoria_producto c ON p.categoria_producto = c.id_categoria
        LEFT JOIN imagenes_producto i ON p.id_producto = i.id_producto AND i.orden = 1
        GROUP BY p.id_producto";


        // Ejecutar la consulta
        $productosPorCategoria = $productoModel->query($sql)->getResultArray();

        return $productosPorCategoria;
    }

    // En tu modelo de Producto (ProductoModel.php)

    public function productos_marcas()
    {
        $productoModel = new ProductoModel();

        // Consulta SQL para obtener un producto de cada marca con el nombre de la marca
        $sql = "SELECT p.*, m.nombre AS nombre_marca, i.nombre_archivo AS imagen_producto
        FROM productos p
        INNER JOIN (
            SELECT marca, MIN(id_producto) AS id_producto
            FROM productos
            GROUP BY marca
        ) AS pm ON p.id_producto = pm.id_producto
        INNER JOIN marca_producto m ON p.marca = m.id_marca
        LEFT JOIN imagenes_producto i ON p.id_producto = i.id_producto AND i.orden = 1
        GROUP BY p.id_producto";

        // Ejecutar la consulta
        $productosPorMarca = $productoModel->query($sql)->getResultArray();

        /*  echo "<pre>";
        print_r($productosPorMarca); */

        return $productosPorMarca;
    }



    public function mostrarProducto($productoId)
{
    // Carga el modelo
    $this->load->model('ProductoModel');

    // Recupera los datos del producto
    $producto = $this->ProductoModel->obtenerProductoPorId($productoId);

    // Pasa los datos del producto a la vista
    $this->load->view('producto_detalle', ['producto' => $producto]);
}





}
