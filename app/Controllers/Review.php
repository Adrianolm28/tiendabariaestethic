<?php

namespace App\Controllers;

use App\Models\ReviewModel;

class Review extends BaseController
{
    public function agregarReview()
    {



        $response = [
            'success' => false,
            'message' => 'Hubo un error al agregar la reseña.'
        ];

        if ($this->request->getPost()) {
            // Obtener los datos del formulario
            $data = [
                'producto_id' => $this->request->getPost('producto_id'),
                'usuario_nombre' => $this->request->getPost('nombre'),
                'correo' => $this->request->getPost('correo'),
                'comentario' => $this->request->getPost('comentario'),
                'rating' => $this->request->getPost('rating'),
            ];

            // Insertar los datos en la tabla reviews
            $reviewModel = new ReviewModel(); // Asegúrate de ajustar el nombre de tu modelo
            $insertado = $reviewModel->insert($data);

            if ($insertado) {
                // Si la inserción fue exitosa, actualizar la respuesta
                $response['success'] = true;
                $response['message'] = 'La reseña fue agregada exitosamente.';
            }
        } else {
            // Si no se recibieron datos del formulario, actualizar el mensaje de error
            $response['message'] = 'No se recibieron datos del formulario.';
        }

        // Devolver la respuesta en formato JSON
        return $this->response->setJSON($response);
    }

    // Mostrar formulario para agregar review (GET)
    public function agregarReviewForm()
    {
        $producto_id = $this->request->getGet('producto_id');
        $producto = null;
        if ($producto_id) {
            // Asume que tienes un modelo ProductoModel
            $productoModel = new \App\Models\ProductoModel();
            $producto = $productoModel->find($producto_id);
        }
        return view('tienda/agregar_review', [
            'producto_id' => $producto_id,
            'producto' => $producto
        ]);
    }
  
    public function mostrarReviews($producto_id)
    {
        $reviewModel = new ReviewModel();

        $paginaActual = $this->request->getVar('page') ?? 1;
        $limit = 4; // Número máximo de reseñas por página
        $reviews = $reviewModel->where('producto_id', $producto_id)->paginate($limit, 'reviews');
        $paginacion = $reviewModel->pager->links('reviews', 'default_full');

        return $this->response->setJSON([
            'reviews' => $reviews,
            'pagination' => $paginacion
        ]);
    }

    // Vista principal de administración de reviews
    public function adminIndex()
    {
        $productoModel = new \App\Models\ProductoModel();
        $productos = $productoModel->select('id_producto, nombre, marca')->findAll();
        return view('admin/review', ['productos' => $productos]);
    }

    // Listar reviews para AJAX
    public function adminListar()
    {
        $reviewModel = new ReviewModel();
        $reviews = $reviewModel->orderBy('id', 'DESC')->findAll();
        return $this->response->setJSON(['reviews' => $reviews]);
    }

    // Eliminar review por AJAX
    public function adminEliminar()
    {
        $id = $this->request->getPost('id');
        $reviewModel = new ReviewModel();
        $success = $reviewModel->delete($id);

        return $this->response->setJSON(['success' => $success]);
    }

    // Editar review: retorna JSON para el modal
    public function adminEditar($id)
    {
        $reviewModel = new ReviewModel();
        $review = $reviewModel->find($id);
        return $this->response->setJSON($review);
    }

    // Guardar cambios de edición del review
    public function adminEditarGuardar()
    {
        $id = $this->request->getPost('id');
        $data = [
            'usuario_nombre' => $this->request->getPost('usuario_nombre'),
            'correo' => $this->request->getPost('correo'),
            'comentario' => $this->request->getPost('comentario'),
            'rating' => $this->request->getPost('rating'),
        ];
        $reviewModel = new ReviewModel();
        $success = $reviewModel->update($id, $data);

        return $this->response->setJSON([
            'success' => $success,
            'message' => $success ? 'El review ha sido actualizado.' : 'No se pudo actualizar el review.'
        ]);
    }
}
