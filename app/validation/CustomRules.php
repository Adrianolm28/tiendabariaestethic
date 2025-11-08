<?php

// app/Validation/CustomRules.php

namespace App\Validation;

use CodeIgniter\Validation\Rules;

class CustomRules extends Rules
{
    public function valid_ruc(string $str, string $field, array $data): bool
    {
        // Implementa la validación personalizada para el RUC aquí.
        // Puedes personalizar esta validación según las reglas específicas de tu país o aplicación.

        return true; // Cambia esto según tus necesidades.
    }

    public function valid_nombres(string $str, string $field, array $data): bool
    {
        // Implementa la validación personalizada para los nombres aquí.
        // Puedes personalizar esta validación según tus requisitos específicos.

        return true; // Cambia esto según tus necesidades.
    }

    public function valid_telefono(string $str, string $field, array $data): bool
    {
        // Implementa la validación personalizada para el teléfono aquí.
        // Puedes personalizar esta validación según tus requisitos específicos.

        return true; // Cambia esto según tus necesidades.
    }

    public function valid_descripcion(string $str, string $field, array $data): bool
    {
        // Implementa la validación personalizada para la descripción aquí.
        // Puedes personalizar esta validación según tus requisitos específicos.

        return true; // Cambia esto según tus necesidades.
    }

    public function valid_email_domain(string $str, string $field, array $data): bool
{
    // Implementa la validación personalizada del dominio del correo electrónico aquí.
    // Puedes personalizar esta validación según tus requisitos específicos.

    $validDomains = ['example.com', 'yourdomain.com']; // Agrega los dominios válidos aquí

    $emailParts = explode('@', $str);
    $domain = end($emailParts);

    return in_array($domain, $validDomains);
}
}
