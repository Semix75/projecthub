avant de lancer le projet lancer ces commandes : 
- composer install 
- npm install 
- yarn
-  yarn add --dev @babel/preset-env
- yarn add --dev @babel/plugin-transform-react-jsx
 yarn add --dev @babel/core
 yarn add --dev eslint-config-preact
 yarn add --dev babel-plugin-jsx-pragmatic
- yarn dev 
- crtl c 

lancement docker : 
- docker compose down && docker compose up -d

si il y a marquer que mercure tourne c'est bon sinon bon courage 

si vous voulais ajouter les fixtures :
- php bin/console doctrine:fixtures:load
- creer un user b avec tous en b et l'email b@gmail.com
- creer un user admin avec tous en admin et l'email admin@gmail.com
- php bin/console doctrine:fixtures:load --group=friends --append
- php bin/console doctrine:fixtures:load --group=request --append


ensuite : 
- rm -rf migrations/*
- php bin/console make:migration 
- php bin/console d:m:m


enfin lancer le server : 
- symfony server:start 


si a ce stade  ca marche pas encore bah bon courage que la chance soit avec toi 

Pour tester l'algo
- composer require --dev liip/test-fixtures-bundle