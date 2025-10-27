<?php

namespace App\Core;

use App\Core\helpers\HTTP;

/**
 * Class Router
 * 
 * Este es el **router principal** de NanoPHP.
 * Permite registrar rutas HTTP (GET, POST, PUT, DELETE) y asociarlas
 * con un controlador y un método de acción. 
 * Soporta rutas con parámetros dinámicos usando la sintaxis `{param}`.
 */
class Router
{
    use HTTP;

    /**
     * @var array Lista de rutas registradas
     */
    private array $routes = [];

    /**
     * Agrega una ruta al router
     *
     * Convierte rutas con parámetros, por ejemplo `/users/{id}` 
     * a expresiones regulares, y las almacena con el método HTTP, 
     * controlador y acción correspondiente.
     *
     * @param string $method Método HTTP (GET, POST, PUT, DELETE)
     * @param string $path Ruta a registrar
     * @param string $controller Nombre completo del controlador (con namespace)
     * @param string $action Método del controlador a ejecutar
     */
    public function add(string $method, string $path, string $controller, string $action): void
    {
        // Convertir ruta con parámetros ({id}) en regex
        $pattern = preg_replace('#\{([\w]+)\}#', '(?P<\1>[^/]+)', $path);
        $pattern = "#^" . $pattern . "$#";

        $this->routes[] = [
            'method' => $method,
            'pattern' => $pattern,
            'controller' => $controller,
            'action' => $action
        ];
    }

    /**
     * Registrar una ruta GET
     *
     * @param string $path
     * @param string $controller
     * @param string $action
     */
    public function get(string $path, string $controller, string $action): void
    {
        $this->add('GET', $path, $controller, $action);
    }

    /**
     * Registrar una ruta POST
     *
     * @param string $path
     * @param string $controller
     * @param string $action
     */
    public function post(string $path, string $controller, string $action): void
    {
        $this->add('POST', $path, $controller, $action);
    }

    /**
     * Registrar una ruta PUT
     *
     * @param string $path
     * @param string $controller
     * @param string $action
     */
    public function put(string $path, string $controller, string $action): void
    {
        $this->add('PUT', $path, $controller, $action);
    }

    /**
     * Registrar una ruta DELETE
     *
     * @param string $path
     * @param string $controller
     * @param string $action
     */
    public function delete(string $path, string $controller, string $action): void
    {
        $this->add('DELETE', $path, $controller, $action);
    }

    /**
     * Despacha la ruta actual
     *
     * Este método compara la URI de la solicitud con las rutas registradas,
     * verifica el método HTTP, y llama al controlador y método correspondiente.
     * Soporta:
     * - Sobrescribir método mediante `_method` en POST (PUT/DELETE simulados)
     * - Prefijos de subdirectorios
     * - Parámetros dinámicos en la ruta
     *
     * @param string $requestUri URI de la solicitud
     * @param string $requestMethod Método HTTP de la solicitud
     * @return void
     */
    public function dispatch(string $requestUri, string $requestMethod): void
    {
        // Soporte para _method en formularios POST
        if ($requestMethod === 'POST' && isset($_POST['_method'])) {
            $requestMethod = strtoupper($_POST['_method']);
        }

        $scriptName = dirname($_SERVER['SCRIPT_NAME']); // Ejemplo: /M2M-Project-2025/Public
        $requestPath = parse_url($requestUri, PHP_URL_PATH);

        // Eliminar prefijo de subdirectorio
        if (strpos($requestPath, $scriptName) === 0) {
            $requestPath = substr($requestPath, strlen($scriptName));
        }

        // Asegurar que siempre empiece con /
        $requestPath = '/' . ltrim($requestPath, '/');

        foreach ($this->routes as $route) {
            if ($route['method'] !== $requestMethod) {
                continue;
            }

            if (preg_match($route['pattern'], $requestPath, $matches)) {
                $controllerName = $route['controller'];
                $action = $route['action'];

                // Validar existencia del controlador
                if (!class_exists($controllerName)) {
                    http_response_code(500);
                    echo "Controlador $controllerName no existe";
                    return;
                }

                $controller = new $controllerName();

                // Validar existencia del método
                if (!method_exists($controller, $action)) {
                    http_response_code(500);
                    echo "Método $action no existe en $controllerName";
                    return;
                }

                // Extraer parámetros nombrados de la ruta
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                // Ejecutar acción del controlador
                call_user_func_array([$controller, $action], $params);
                return;
            }
        }

       if($this->isJsonRequest())
        {
            $this->response([
                "success" => false,
                "message" => "Oops... Parece que el recurso que buscabas no existe"
            ], 404);
        } else {
            View::render('404');
        }
    }
}
