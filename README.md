

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
4. Acessar API e SPA:
	- Frontend: [http://localhost:3000](http://localhost:3000)
	- Backend/API: [http://localhost:8000](http://localhost:8000)

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

## Desenvolvimento

- O backend está em `server/` e utiliza Laravel, PHPUnit, Xdebug.
- O frontend está em `client/` e utiliza Vue 3, Vuex, TailwindCSS.
- O ambiente é totalmente dockerizado, facilitando o setup e o desenvolvimento.

## Scripts Úteis

- Instalar dependências: `./run install`
- Iniciar projeto: `./run start`
- Rodar testes: `./run tests`
- Gerar cobertura: `./run coverage`

## Autor

Rafael Jeferson

## Licença

MIT
