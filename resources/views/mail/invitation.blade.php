<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <h2>Vous avez une demande de partage !</h2>
    <ul>
      <li><strong>Projet</strong> : {{ $invitation['project'] }}</li>
      <li><strong>Auteur</strong> : {{ $invitation['author'] }}</li>
    </ul>
    <a href="http://localhost/projects">Cliquez ici pour accepter le partage</a>
  </body>
</html>
