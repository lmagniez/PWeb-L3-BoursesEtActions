

<?php
?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Jeux</title>
	</head>
	<body>
		    <body>
        <section  class="container">
            <article name="données" class="well form-inline pull-left col-lg-5">
				<script type="text/javascript" src="tp7.js"></script>
                <button class="btn btn-primary" type="submit" onclick="executerRequete(lireSuivant)"><span class="glyphicon glyphicon-play"> </span> Lecture avant</button>
                <button class="btn btn-primary" type="submit" onclick="executerRequete(lirePrecedent)"><span class="glyphicon glyphicon-step-backward"> </span> Lecture arrière</button>

				<button class="btn btn-primary" type="submit" onclick="executerRequete(lireJoueurs)"><span class="glyphicon glyphicon-step-backward"> </span> Récup équipe</button>


            </article>
        </section>

        <div id="equipe">

        </div>

    </body>
</html>
