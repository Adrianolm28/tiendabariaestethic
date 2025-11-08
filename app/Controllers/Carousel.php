<?php

namespace App\Controllers;

use App\Models\CarouselModel;

class Carousel extends BaseController
{


    public function carousel()
    {

        $carousel = new CarouselModel();
        $data['carousel'] = $carousel->findAll();

        echo view("admin/admin_header.php");
        echo view('admin/carousel', $data);
        echo view("admin/admin_footer");
    }


    public function store()
    {
        helper(['form', 'url']);
        $carouselModel = new CarouselModel(); // Renombrar para consistencia
        $id = $this->request->getPost('id');
        $validationRules = [];
        $data = [];

        // Definir reglas de validaci¨®n comunes o espec¨ªficas
        if (empty($id)) { // Creando nuevo
            $validationRules['imagen_carousel'] = 'uploaded[imagen_carousel]|mime_in[imagen_carousel,image/jpg,image/jpeg,image/png]|max_size[imagen_carousel,2048]';
        } else { // Actualizando
            // Solo validar si se sube una nueva imagen
            if ($this->request->getFile('imagen_carousel') && $this->request->getFile('imagen_carousel')->isValid()) {
                $validationRules['imagen_carousel'] = 'uploaded[imagen_carousel]|mime_in[imagen_carousel,image/jpg,image/jpeg,image/png]|max_size[imagen_carousel,2048]';
            }
        }

        if (!$this->validate($validationRules)) {
            return $this->response->setJSON(['status' => false, 'error' => $this->validator->getErrors()]);
        }

        // Manejo de la imagen
        $imageFile = $this->request->getFile('imagen_carousel');
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            // Eliminar imagen antigua si se est¨¢ actualizando y se sube una nueva
            if (!empty($id)) {
                $oldEntry = $carouselModel->find($id);
                if ($oldEntry && !empty($oldEntry['imagen_carousel'])) {
                    $oldImagePath = ROOTPATH . 'public/assets/image/others/banner/' . $oldEntry['imagen_carousel'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            }
            $newFileName = $imageFile->getRandomName();
            $imageFile->move(ROOTPATH . 'public/assets/image/others/banner', $newFileName);
            $data['imagen_carousel'] = $newFileName;
        } elseif (empty($id) && (!$imageFile || !$imageFile->isValid())) {
            // Si es un nuevo registro y no se subi¨® imagen v¨¢lida (aunque la regla 'uploaded' deber¨ªa cubrir esto)
             return $this->response->setJSON(['status' => false, 'error' => ['imagen_carousel' => 'Debe seleccionar una imagen v¨¢lida.']]);
        }


        if (empty($id)) { // Insertar nuevo
            // El estado por defecto podr¨ªa ser 0 (inactivo) o 1 (activo) seg¨²n preferencia
            $data['estado'] = $this->request->getPost('estado') ?? 1; // Asumir activo si no se especifica
            
            $saveId = $carouselModel->insert($data); // Usar insert que devuelve ID
            if ($saveId) {
                $newData = $carouselModel->find($saveId);
                return $this->response->setJSON(['status' => true, 'data' => $newData, 'message' => 'Imagen guardada correctamente.']);
            } else {
                return $this->response->setJSON(['status' => false, 'message' => 'Error al guardar la imagen.']);
            }
        } else { // Actualizar existente
            // No actualizamos el estado aqu¨ª a menos que haya un campo para ello en el form de edici¨®n
            if (empty($data) && !$this->request->getPost('imagen_actual')) {
                 // Si no hay nuevos datos de imagen y no se subi¨® una nueva, no hay nada que actualizar
                 // Opcionalmente, podr¨ªas permitir actualizar otros campos si los tuvieras
                $updatedData = $carouselModel->find($id); // Devolver datos existentes
                return $this->response->setJSON(['status' => true, 'data' => $updatedData, 'message' => 'No hubo cambios en la imagen.']);
            }

            if ($carouselModel->update($id, $data)) {
                $updatedData = $carouselModel->find($id);
                return $this->response->setJSON(['status' => true, 'data' => $updatedData, 'message' => 'Imagen actualizada correctamente.']);
            } else {
                return $this->response->setJSON(['status' => false, 'message' => 'Error al actualizar la imagen.']);
            }
        }
    }

    public function edit($id = null)
    {
        $carouselModel = new CarouselModel(); // Renombrar para consistencia
        $data = $carouselModel->find($id); // Usar find()

        if ($data) {
            return $this->response->setJSON(['status' => true, 'data' => $data]);
        } else {
            return $this->response->setJSON(['status' => false, 'message' => 'Elemento no encontrado.']);
        }
    }

    public function actualizar_estado($id = null, $nuevoEstado)
    {
        $carouselModel = new CarouselModel(); // Renombrar para consistencia
        // Validar $nuevoEstado
        if (!in_array($nuevoEstado, ['0', '1'])) {
            return $this->response->setJSON(['status' => false, 'message' => 'Estado no v¨¢lido.']);
        }
        $data = ['estado' => $nuevoEstado];

        if ($carouselModel->update($id, $data)) {
            $response = [
                'status' => true,
                'message' => 'El estado del carrusel ha cambiado correctamente.',
                'new_status' => $nuevoEstado
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'No se pudo cambiar el estado del carrusel.',
            ];
        }
        return $this->response->setJSON($response);
    }

    // Nuevo m¨¦todo para eliminar
    public function delete($id = null)
    {
        $carouselModel = new CarouselModel();
        $entry = $carouselModel->find($id);

        if ($entry) {
            // Eliminar archivo de imagen del servidor
            if (!empty($entry['imagen_carousel'])) {
                $imagePath = ROOTPATH . 'public/assets/image/others/banner/' . $entry['imagen_carousel'];
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Eliminar de la base de datos
            if ($carouselModel->delete($id)) {
                return $this->response->setJSON(['status' => true, 'message' => 'Elemento del carrusel eliminado correctamente.']);
            } else {
                return $this->response->setJSON(['status' => false, 'message' => 'Error al eliminar el elemento de la base de datos.']);
            }
        } else {
            return $this->response->setJSON(['status' => false, 'message' => 'Elemento no encontrado.'])->setStatusCode(404);
        }
    }
}
