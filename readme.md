install vitejs plus plugin

 yarn
   yarn dev
   yarn add --dev @babel/preset-env
   yarn add --dev @babel/plugin-transform-react-jsx
   yarn add --dev @babel/core
   yarn add --dev eslint-config-preact
  yarn add --dev babel-plugin-jsx-pragmatic

Pour tester l'algo
 mettre à jour les nouvelles données des fixtures dans la base (si vous l'avez pas fait)
 - php bin/console doctrine:fixtures:load --purge-with-truncate
La commande supprime tout donc il faut ajouter un admin comme d'hab si vous voulez voir le tableau de bord admin
pour lancer l'algo
- php bin/console attribution:run
vous pouvez voir les résultats dans le fichier data.db, le tableau de bord admin ou mettre à jour les groupes
dans groupe dans la vue user pour bien visualiser