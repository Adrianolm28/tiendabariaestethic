<?php

namespace App\Controllers;

use App\Models\CarritoModel;
use \CodeIgniter\Controller;


class Cart extends BaseController
{
    protected $carritoModel;

    public function __construct()
    {
        $this->carritoModel = new CarritoModel();
    }



    public function index()
    {
    }


    public function agregarAlCarrito()
    {
        // Obtener los datos del producto a agregar
        $userId = session()->get('user_id'); // Obtener el ID del usuario desde la sesión, ajusta según tu lógica de autenticación
        $productId = $this->request->getPost('product_id');
        $productName = $this->request->getPost('nombre_producto');
        $quantity = $this->request->getPost('cantidad');
        $price = $this->request->getPost('precio');
        $previousPrice = $this->request->getPost('precio_anterior');
        $discountPrice = $this->request->getPost('precio_descuento');
        $productImage = $this->request->getPost('imagen_producto');

        // Validar los datos recibidos si es necesario

        // Insertar el producto en el carrito
        $data = [
            'user_id' => $userId,
            'product_id' => $productId,
            'nombre_producto' => $productName,
            'cantidad' => $quantity,
            'precio' => $price,
            'precio_anterior' => $previousPrice,
            'precio_descuento' => $discountPrice,
            'imagen_producto' => $productImage,
        ];

        $this->carritoModel->insert($data); 

        if ($insertedId) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Producto agregado al carrito con éxito', 'inserted_id' => $insertedId]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Error al agregar el producto al carrito']);
        }
    
    }

    // Método para mostrar el carrito del usuario
    public function mostrarCarrito()
    {
        // Obtener el ID del usuario desde la sesión, ajusta según tu lógica de autenticación
        $userId = session()->get('user_id');

        // Obtener los productos del carrito del usuario
        $productosCarrito = $this->carritoModel->where('user_id', $userId)->findAll();

        // Puedes pasar los datos a la vista y renderizarla aquí
    }

    // Método para eliminar un producto del carrito
    public function eliminarDelCarrito($id)
    {
        // Eliminar el producto del carrito por su ID
        $this->carritoModel->delete($id);

        // Redireccionar o enviar alguna respuesta de confirmación
    }
}
