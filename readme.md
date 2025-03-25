# 🚀 Guide d'installation et d'utilisation du projet  

## 📦 Installation des dépendances  

Avant de lancer le projet, exécutez les commandes suivantes :  

### 📌 Pour **Windows (cmd/Powershell)**  
```powershell
composer install  # Installation des dépendances PHP  
npm install       # Installation des dépendances Node.js  
yarn             # Installation des paquets avec Yarn  
```

### 📌 Pour **Linux/macOS**  
```bash
composer install
npm install
yarn
```

### 📌 Configuration de Babel et ESLint (Tous OS)  
```bash
yarn add --dev @babel/preset-env
yarn add --dev @babel/plugin-transform-react-jsx
yarn add --dev @babel/core
yarn add --dev eslint-config-preact
yarn add --dev babel-plugin-jsx-pragmatic
```

### 🔧 Démarrage du serveur de développement  
**Windows (cmd/Powershell) & Linux/macOS**  
```bash
yarn dev  # Lance le serveur de développement  
```
(Pour arrêter, utilisez `CTRL + C`)  

---

## 🐳 Lancement de Docker  

### 📌 Pour **Windows (PowerShell ou WSL)**
```powershell
docker compose down; docker compose up -d
```

### 📌 Pour **Linux/macOS**
```bash
docker compose down && docker compose up -d
```

⚠️ **Vérifiez que Mercure fonctionne** (un message d’activation devrait apparaître). Si ce n'est pas le cas, il faudra le démarrer manuellement.  

---

## 🔥 Chargement des fixtures  

Si vous souhaitez ajouter des données de test :  

```bash
php bin/console doctrine:fixtures:load
```
Puis créez les utilisateurs suivants :  
- **Utilisateur "b"** : Nom, prénom, mot de passe `b`, email `b@gmail.com`  
- **Administrateur** : Nom, prénom, mot de passe `admin`, email `admin@gmail.com`  

Ensuite, chargez les autres groupes de fixtures :  

```bash
php bin/console doctrine:fixtures:load --group=friends --append
php bin/console doctrine:fixtures:load --group=request --append
```

---

## 📜 Migrations  

**Windows (cmd/Powershell)**  
```powershell
Remove-Item -Recurse -Force migrations/*
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```

**Linux/macOS**  
```bash
rm -rf migrations/*
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```

---

## 🚀 Lancer le serveur  

**Windows (cmd/Powershell)**  
```powershell
symfony server:start
```

**Linux/macOS**  
```bash
symfony server:start
```

---

## 🖥️ Tests avec Selenium  

### 📌 Installation  

1. **Téléchargez et ouvrez Docker**  
2. Exécutez la commande suivante pour lancer le serveur Selenium :  

```bash
docker run -d -p 4444:4444 --name selenium-server selenium/standalone-chrome
```

3. Installez Selenium en local :  

**Windows (cmd/Powershell)**
```powershell
pip install selenium
```

**Linux/macOS**
```bash
pip3 install selenium
```

### 🛠️ Exécution des tests  

```bash
python testSelenium/test_login.py
```
*(Remplacez `test_login.py` par le fichier du test à exécuter.)*  

---

## 📡 Monitoring avec Loki et Consul  

- **Loki & Consul** sont déjà téléchargés et prêts à l'emploi.  

---

## 📧 Symfony Mailer  

1. Installez Symfony Mailer si ce n’est pas encore fait :  

```bash
composer require symfony/mailer
```

2. Si les emails ne sont pas reçus, essayez :  

```bash
php bin/console messenger:consume async -vv
```
ou  

```bash
php bin/console mailer:test projecthub.contact@gmail.com
```

---

🎉 **Tout est prêt !** Si à ce stade ça ne fonctionne pas… eh bien, bon courage et que la chance soit avec vous ! 🚀