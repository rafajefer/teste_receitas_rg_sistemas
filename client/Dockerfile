FROM node:22

WORKDIR /app

# Copiar apenas package.json primeiro para aproveitar cache
COPY package*.json ./

# Instalar dependências locais (incluindo @vue/cli-service)
RUN npm install

# Instalar Vue CLI global corretamente
RUN npm install -g @vue/cli

# Copiar o restante do código
COPY . .

# Expor porta usada pelo Vue CLI
EXPOSE 3000

# Subir o servidor dev
CMD ["npm", "run", "serve-docker"]