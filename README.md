
# teste_receitas_rg_sistemas

Sistema completo para cadastro, edição, listagem e impressão de receitas, utilizando Laravel (backend) e Vue 3 (frontend).

## Estrutura do Projeto

- **server/**: Backend Laravel (PHP)
- **client/**: Frontend Vue 3
- **docker-compose.yml**: Orquestração dos serviços (client, server, nginx, db)
- **run**: Script utilitário para instalar, iniciar e testar o projeto

## Pré-requisitos

- Docker e Docker Compose instalados
- (Opcional) Node.js e Composer para desenvolvimento local

## Instalação

Execute o script abaixo para instalar todas as dependências e subir os containers:

```bash
./run install
```

## Inicialização

Para iniciar o projeto (client, server, nginx, db):

```bash
./run start
```

Acesse o frontend em: [http://localhost:3000](http://localhost:3000)  
Acesse o backend em: [http://localhost:8000](http://localhost:8000)

## Testes

Execute os testes do backend Laravel:

```bash
./run tests
```

## Cobertura de Testes

Gere o relatório de cobertura:

```bash
./run coverage
```

O relatório estará disponível em `server/coverage/index.html`.

## Desenvolvimento

- O backend está em `server/` e utiliza Laravel, PHPUnit, Xdebug.
- O frontend está em `client/` e utiliza Vue 3, Vuex, TailwindCSS.
- O ambiente é totalmente dockerizado, facilitando o setup e o desenvolvimento.

## Scripts Úteis

- Instalar dependências: `./run install`
- Iniciar projeto: `./run start`
- Rodar testes: `./run tests`
- Gerar cobertura: `./run coverage`

## Licença

MIT
