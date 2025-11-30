

# Projeto de Receitas – API Laravel + Front-end Vue 3 (SPA)

Aplicação completa para gerenciamento de receitas, incluindo cadastro de usuários, autenticação, CRUD de receitas, pesquisa, edição, exclusão, além de uma SPA independente em Vue 3 + TypeScript. O backend é desenvolvido em Laravel seguindo princípios de Clean Architecture, SOLID, testes unitários e executado via Docker.

## Tecnologias Utilizadas

### Backend (API – Laravel 12)
- PHP 8.x
- Laravel 12
- Clean Architecture
- SOLID
- PHPUnit (Testes Unitários)
- Docker / Docker Compose
- MySQL
- Laravel Sanctum

### Frontend (SPA – Vue 3 + TypeScript)
- Vue 3
- TypeScript
- Vite
- TailwindCSS
- Axios

## Funcionalidades Implementadas
- Cadastro e autenticação de usuários
- CRUD de receitas
- Pesquisa
- Upload opcional de imagem
- Arquitetura desacoplada com SPA
- Testes unitários

## Estrutura do Projeto

- **server/**: Backend Laravel (PHP)
- **client/**: Frontend Vue 3
- **docker-compose.yml**: Orquestração dos serviços (client, server, nginx, db)
- **run**: Script utilitário para instalar, iniciar e testar o projeto

### Backend (Laravel – Clean Architecture)
```
server/
└── app/
	 ├── Domain/
	 ├── Application/
	 ├── Infrastructure/
	 └── Interfaces/
```

### Frontend (Vue 3 SPA)
```
client/
└── src/
	 ├── components/
	 ├── views/ (ou pages/)
	 ├── services/
	 ├── router/
	 ├── stores/ (ou store/)
	 └── types/
```
## Pré-requisitos

- Docker e Docker Compose instalados
- (Opcional) Node.js e Composer para desenvolvimento local

## Rodando o Projeto com Docker

1. Clonar o projeto:
	```bash
	git clone https://github.com/rafajefer/teste_receitas_rg_sistemas.git
	cd teste_receitas_rg_sistemas
	```
2. Instalar e subir containers:
	```bash
	./run install
	```
3. Migrar banco de dados:
	```bash
	docker compose exec server php artisan migrate
	```
4. Acessar API, SPA e phpMyAdmin:
	- Frontend: [http://localhost:3000](http://localhost:3000)
	- Backend/API: [http://localhost:8000](http://localhost:8000)
	- phpMyAdmin: [http://localhost:8001](http://localhost:8001)
	  - Usuário: `root`
	  - Senha: `root`

## Testes

Execute os testes do backend Laravel:
```bash
./run tests
```

Gere o relatório de cobertura:
```bash
./run coverage
```
O relatório estará disponível em `server/coverage/index.html`.

## Endpoints Principais


- **Auth:** `/api/register`, `/api/login`, `/api/logout`
- **Receitas:** `/api/recipes`, `/api/recipes/{id}`

## Exemplos de Requisições API

### Cadastro de usuário
```bash
curl -X POST http://localhost:8000/api/register \
	-H "Content-Type: application/json" \
	-d '{
		"name": "Rafael",
		"email": "rafael@email.com",
		"password": "senha123",
		"password_confirmation": "senha123"
	}'
```

### Login
```bash
curl -X POST http://localhost:8000/api/login \
	-H "Content-Type: application/json" \
	-d '{
		"email": "rafael@email.com",
		"password": "senha123"
	}'
```

### Listar receitas (autenticado)
```bash
curl -X GET http://localhost:8000/api/recipes \
	-H "Authorization: Bearer <TOKEN>"
```

### Criar receita (autenticado)
```bash
curl -X POST http://localhost:8000/api/recipes \
	-H "Authorization: Bearer <TOKEN>" \
	-H "Content-Type: application/json" \
	-d '{
		"title": "Bolo de Cenoura",
		"description": "Receita clássica de bolo de cenoura com cobertura de chocolate.",
		"ingredients": "cenoura, farinha, ovos, açúcar, chocolate",
		"steps": "Misture tudo, asse por 40min."
	}'
```

### Logout
```bash
curl -X POST http://localhost:8000/api/logout \
	-H "Authorization: Bearer <TOKEN>"
```

## Desenvolvimento

- O backend está em `server/` e utiliza Laravel, PHPUnit, Xdebug.
- O frontend está em `client/` e utiliza Vue 3, Vuex, TailwindCSS.
- O ambiente é totalmente dockerizado, facilitando o setup e o desenvolvimento.

## Scripts Úteis


- **Instalar dependências e containers:**
	```bash
	./run install
	```
- **Iniciar projeto (client, server, nginx, db):**
	```bash
	./run start
	```
- **Parar projeto (client, server, nginx, db):**
	```bash
	./run stop
	```
- **Rodar todos os testes:**
	```bash
	./run tests
	```
- **Rodar todos os testes unitários:**
	```bash
	./run tests unit
	```
- **Rodar todos os testes de integração (feature):**
	```bash
	./run tests feature
	```
- **Rodar teste unitário de uma classe específica:**
	```bash
	./run tests unit Application/UseCases/Recipe/ListRecipesUseCaseTest.php
	```
- **Rodar teste de integração de uma classe específica:**
	```bash
	./run tests feature Interfaces/Http/Controllers/Api/Auth/LoginUserControllerTest.php
	```
- **Gerar relatório de cobertura de testes:**
	```bash
	./run coverage
	```
- **Gerar cobertura apenas de testes unitários:**
	```bash
	./run coverage unit
	```
- **Gerar cobertura apenas de testes de integração:**
	```bash
	./run coverage feature
	```
- **Abrir relatório de cobertura no navegador:**
	```bash
	./run coverage
	# O relatório estará disponível em server/coverage/index.html
	```

## Comandos docker Úteis

Execute esses comandos no diretório raiz do projeto:

- **Acessar o container do client:**
	```bash
	docker compose exec client bash
	```
- **Acessar o container do server:**
	```bash
	docker compose exec server bash
	```
- **Acessar o log do container do client:**
	```bash
	docker compose logs client --tail=200
	```
- **Migrar banco de dados:**
	```bash
	docker compose exec server php artisan migrate
	```
- **Migrar e popular banco de dados:**
	```bash
	docker compose exec server php artisan migrate:fresh --seed
	```
- **Limpar e cachear configurações:**
	```bash
	docker compose exec server php artisan config:cache
	```
- **Instalar dependência no client (exemplo com moment):**
	```bash
	docker compose exec client npm install moment
	```
- **Instalar dependência no server (exemplo com barryvdh/laravel-dompdf):**
	```bash
	docker compose exec server composer require barryvdh/laravel-dompdf
	```
- **Reiniciar containers:**
	```bash
	docker compose restart client
	docker compose restart server
	```
- **Remover volumes e containers (limpeza total):**
	```bash
	docker compose down -v
	```
- **Verificar status dos containers:**
	```bash
	docker compose ps
	```
- **Solução de problemas de permissões:**
	```bash
	sudo chown -R $USER:$USER client/
	sudo chown -R $USER:$USER server/
	```

## Autor

Rafael Jeferson

## Licença


MIT

## Links Úteis

- [Documentação Laravel](https://laravel.com/docs)
- [Documentação Vue 3](https://vuejs.org/guide/introduction.html)
- [Documentação Vite](https://vitejs.dev/guide/)
- [Documentação TailwindCSS](https://tailwindcss.com/docs/installation)
- [Documentação Docker](https://docs.docker.com/)
- [Documentação Docker Compose](https://docs.docker.com/compose/)
- [Documentação Axios](https://axios-http.com/docs/intro)
- [Documentação PHPUnit](https://phpunit.de/documentation.html)
