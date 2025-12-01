<?php

namespace App\Interfaces\Http\Controllers\Api\Swagger;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="API da Teste Receitas RG Sistemas",
 *     version="1.0.0",
 *     description="Documentação da API para o projeto da Teste Receitas RG Sistemas",
 *     @OA\Contact(
 *         email="rafa.jefer@gmail.com"
 *     )
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="Servidor local"
 * )
 */
class SwaggerAnnotations
{
    // Essa classe fica vazia, serve só para agregar essas anotações globais
}