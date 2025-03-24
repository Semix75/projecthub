# 1) Partir d’une image Node
FROM node:18

# 2) Créer un dossier de travail
WORKDIR /app

# 3) Copier les fichiers de définition des dépendances
COPY package.json yarn.lock ./

# 4) Installer les dépendances
RUN yarn

# 5) Copier le reste du code
COPY . .

# 6) Exposer le port Vite (par défaut 5173, ou 3000 selon la config)
EXPOSE 5173

# 7) Lancer le serveur de dev Vite
CMD ["yarn", "dev"]
