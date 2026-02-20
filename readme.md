# 🚀 Guide d'installation et d'utilisation du projet  

## 📦 Installation des dépendances  

Avant de lancer le projet, exécutez les commandes suivantes :  

### 📌 Pour **Windows (cmd/Powershell)**  
```powershell
composer update --ignore-platform-reqs --with-dependencies
composer require lexik/jwt-authentication-bundle
# Si problème avec sodium :
composer install --ignore-platform-req=ext-sodium
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

---

## 🔧 Configuration de Babel et ESLint (Tous OS)  
```bash
yarn add --dev @babel/preset-env @babel/plugin-transform-react-jsx @babel/core eslint-config-preact babel-plugin-jsx-pragmatic
```

---

## 🚀 Démarrage du serveur de développement  
**Windows (cmd/Powershell) & Linux/macOS**  
```bash
yarn dev  # Lance le serveur de développement 
# Si problème avec popper.js :
yarn add @popperjs/core
# Si problème avec sass-embedded :
yarn add -D sass-embedded
# Relancer le serveur :
yarn dev 
```
(Pour arrêter, utilisez `CTRL + C`)  

---

## 🐳 Lancement avec Docker  

### 📌 Pour **Windows (PowerShell ou WSL)**
```powershell
docker compose down; docker compose up -d
```

### 📌 Pour **Linux/macOS**
```bash
docker compose down && docker compose up -d
```

⚠️ **Vérifiez que Mercure fonctionne** (un message d’activation devrait apparaître). Sinon, démarrez-le manuellement.  

---

## 🔥 Chargement des fixtures  

Ajoutez des données de test avec :  
```bash
php bin/console doctrine:fixtures:load
```

Créez ensuite les utilisateurs suivants :  
- **Utilisateur "b"** : Nom, prénom, mot de passe `b`, email `b@gmail.com`  
- **Administrateur** : Nom, prénom, mot de passe `admin`, email `admin@gmail.com`  

Chargez ensuite d'autres groupes de fixtures :  
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

## 🚀 Lancer le serveur Symfony  

**Windows (cmd/Powershell) & Linux/macOS**  
```bash
symfony server:start
```

---

## 🖥️ Tests avec Selenium  

### 📌 Installation  

1. **Téléchargez et ouvrez Docker**  
2. Lancez le serveur Selenium :  
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

1. Installez Symfony Mailer si nécessaire :  
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

## 🔬 Tester l'algorithme  
```bash
composer require --dev liip/test-fixtures-bundle
```
Si problème avec sodium :  
```bash
composer require --dev liip/test-fixtures-bundle --ignore-platform-req=ext-sodium
```

---

🎉 **Tout est prêt !** Si à ce stade ça ne fonctionne pas… eh bien, bon courage et que la chance soit avec vous ! 🚀
