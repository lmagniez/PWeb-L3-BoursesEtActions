Rapport technique
============

Choix technique
============

Pour ce projet, nous avons tout d'abord utilisé le framework Bootstrap permettant de donner un site responsive.

**Récupération des données de l'API**
*recup_donnee.php*
Appelle l'API en fonction d'un symbole (*ex: FB, AAPL*) via curl.
Curl renvoie un csv, qu'on va encode en json et envoyer au javascript (api.js).
api.js se chargera d'ajouter la nouvelle donnée au json (structure détaillée plus bas).

**Récupération du json vers Javascript**
*api.js*
Récupération effectué via un XMLHttpRequest.

**Sauvegarde du json**
*api.js*
*save_categorie.php*
Appel ajax effectué dans le JavaScript, appelle save_categorie.php.

**Génération graphes**
*api.js*
Utilisation de Graph.js et génération dynamique du HTML avec DOM.

I- Pages du site
============
1- Login
------------
Lance une nouvelle session.
Demande les identifiants de l'utilisateur, se connecte à la base de données et redirige sur la page d'accueil si il peut établir la connection.

2- Accueil
------------
Page d'accueil

3- Bourse
------------
Visualisation de l'ensemble des actions enregistrées dans le json.
Affiche le graphe correspondant et les dernières données récupérées par l'API.
On peut ici ajouter une action à ses favoris (on créé une entrée dans la base).

4- Profil
------------
Deux actions possibles:
-Visualiser ses actions favorites, acheter ou vendre des parts.
-Paramètres du compte, modifier les différentes informations.

II- Modèle de la base utilisée
============
1- Utilisateur
------------
Représente un utilisateur.
Contient les identifiants de l'utilisateur, et l'argent qu'il possède.
Créé lorsque l'utilisateur s'inscrit, modifié à chaque achat/vente de parts.

~~~sql
CREATE TABLE IF NOT EXISTS Utilisateur
(
    idUser INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    password VARCHAR(100),
    adressemail VARCHAR(150),
    Argent DECIMAL
);
~~~

2- Action
------------
Représente une action.
Contient un id et un nom.
Les données réelles de l'actions (bid/ask) sont stockées dynamiquement dans le JSON.

~~~sql
CREATE TABLE IF NOT EXISTS Utilisateur
(
    idUser INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    password VARCHAR(100),
    adressemail VARCHAR(150),
    Argent DECIMAL
);
~~~

 3- Action Utilisateur
 ------------
 Associe une action à un utilisateur, et indique le nombre de part que l'utilisateur possède.
~~~sql
CREATE TABLE IF NOT EXISTS Action_Utilisateur
(
    idUser INTEGER ,
    idAction INTEGER ,
    nombreAction int,
    FOREIGN KEY ( idUser ) REFERENCES Utilisateur(idUser),
     FOREIGN KEY (idAction) REFERENCES Action(idAction)
);;
~~~


III- Modèle du json utilisé
============
On va stocker dans le JSON le nom de l'action et son symbole (défini au préalable par nos soins).
L'utilisateur pourra ensuite accéder aux données via l'API de ces différentes actions.
On va stocker les 15 dernières données dans un tableau. On ajoute une donnée à chaque fois que l'utilisateur arrive sur une page se connectant avec l'API (bourse.php, profil.php)

~~~json
[
 {
	"name": "Facebook",
	"symbole": "FB",
	"type": "Action",
	"données": [
		{
		"ask":123.5,
		"bid":125.3,
		"change":12.3,
		"changeP":3.5,
		"date": "3/17/2017",
		"time":"4:00pm"
		},
		[...]
	]
 }, [...]
 ]
~~~


