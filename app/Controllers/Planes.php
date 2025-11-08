<?php

namespace App\Controllers;

use App\Models\PlanesModel;

class Planes extends BaseController
{
    public function planes()
    {

        $planes = new PlanesModel();

        $data['planes'] = $planes->findAll();

        echo view("admin/admin_header.php");
        echo view('admin/planes', $data);
        echo view("admin/admin_footer");
    }


    public function guardarDatos()
    {
        $planesModel = new PlanesModel();

        $packageId = $this->request->getPost('packageId');
        $nuevoDato = $this->request->getPost('nuevoDato');
        $action = $this->request->getPost('action');
        $editedIndex = $this->request->getPost('editedIndex'); // Agrega esta línea

        // Obtén los datos existentes de "features" para el paquete
        $package = $planesModel->find($packageId);

        if ($package) {
            $features = $package['features'];

            if ($features) {
                $featuresArray = explode("|", $features);
            } else {
                $featuresArray = [];
            }

            if ($action === 'add') {
                // Si es una adición, agrega los nuevos datos al array
                $featuresArray[] = $nuevoDato[0];
            } elseif ($action === 'edit' && isset($editedIndex)) {
                // Si es una edición, reemplaza el valor antiguo con el nuevo valor en el array
                $featuresArray[$editedIndex] = $nuevoDato[0];
            }

            // Elimina elementos duplicados (por si acaso)
            $featuresArray = array_unique($featuresArray);

            // Convierte el array nuevamente en una cadena utilizando el separador "|"
            $newFeatures = implode("|", $featuresArray);

            // Actualiza la base de datos con los nuevos datos
            $data = [
                'features' => $newFeatures
            ];

            if ($planesModel->update($packageId, $data)) {
                // Redirige a una vista de éxito después de la actualización
                return redirect()->back();
            } else {
                // Puedes establecer un mensaje de error aquí si lo deseas
                return redirect()->back();
            }
        } else {
            // Puedes establecer un mensaje de error aquí si lo deseas
            return redirect()->back();
        }
    }

    public function eliminarDato()
    {
        $planesModel = new PlanesModel();

        $packageId = $this->request->getPost('packageId');
        $elementIndex = $this->request->getPost('elementIndex');

        // Obtén los datos existentes de "features" para el paquete
        $package = $planesModel->find($packageId);

        if ($package) {
            $features = $package['features'];

            if ($features) {
                $featuresArray = explode("|", $features);

                // Elimina el elemento del array utilizando el índice proporcionado
                if (isset($featuresArray[$elementIndex])) {
                    unset($featuresArray[$elementIndex]);

                    // Convierte el array nuevamente en una cadena utilizando el separador "|"
                    $newFeatures = implode("|", $featuresArray);

                    // Actualiza la base de datos con los nuevos datos
                    $data = [
                        'features' => $newFeatures
                    ];

                    if ($planesModel->update($packageId, $data)) {
                        // Devuelve una respuesta exitosa
                        return $this->response->setJSON(['success' => true]);
                    }
                }
            }
        }

        // Devuelve una respuesta de error si no se puede eliminar
        return $this->response->setJSON(['success' => false]);
    }
}
