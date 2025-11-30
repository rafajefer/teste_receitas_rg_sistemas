# todo-list



### Passo a passo
Clone Repositório
```sh
git clone https://github.com/rafajefer/todo-list.git todo-list
```
```sh
cd todo-list/vue3
```

### Buildando imagem e executando
```sh
docker build -t app-image:latest .
docker run --rm -it --name app-container -p 3000:3000 -v $(pwd):/app app-image:latest bash
```

### Instale as dependências do projeto
```sh
cp .env.sample .env
npm install
```

Utilize o CTRL D para sair

### Inicie o client com vue3 com docker
```sh
docker compose up -d
```

Acesse o container app
```sh
docker exec -it app bash
```

### Para encerrar o client
```sh
docker compose down
```

### Para da permissão em arquivos/pastas
```sh
sudo chown $USER:$USER .
```


Acesse o projeto
[http://localhost:3000](http://localhost:3000)

Acessando api fake do projeto criada com json-server
[http://localhost:5000/todos](http://localhost:5000/todos)
