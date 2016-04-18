README :

=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=

PROJET : ETNA MOVIES

REALISATION : SMIDA HAIKEL , ICHE NOUR EL YAKINE

TECHNOLOGIES : PHP & MongoDB

Système d'exploitation : Debian

Objectifs : Maitriser MongoDB, savoir communiquer avec une base de données MongoDB via PHP


Le projet ETNA MOVIES a pour but de simuler un systeme de location de films.

Fonctionnement :

Le projet se decoupe en 3 parties : - Etudiant
									- Film
									- Location

****************************************************************************************

Pour l'etudiant 4 commandes lui sont liees :

add_student : On doit entrer un login avec 6 lettres suivit d'un underscore '_' et d'une lettre ou d'un chiffre,
			  puis si le login est valide et n'existe pas deja il doit rentrer successivement son nom/prenom , age , email , numero de telephone.
			  		ex : add_student etnaok_p ou add_student etnaok_4

del_student : Permet de supprimer un etudiant en rentrant son login.
					ex : del_student etnaok_p

update_student : Permet de mettre a jour les informations d'un etudiant en rentrant dans un premier temps le login,
				 puis le type d'information qu'il veut changer ( name ou age ou email ou numero ).
				 	ex : update_student etnaok_p
				 	  -> What do you want to update ?
				 	  	 age
				 	  -> Nez age ?
				 	  	 42	 

show_student : Fonctionne de 2 manieres, soit on l'excecute sans option, ce qui va afficher tous les etudiants,
			   soit en ajoutant a la suite un login ce qui affiche les informations de l'etudiant voulu.
			   		ex : show_student ou show_student etnaok_p

*****************************************************************************************

La partie film contient 2 fonctionnalitees :

movies_storing : Permet de parser un fichier et de recuperer les films et leur informations dans la base de donnees mongo.

show_movies : cette commande excecuter sans option affiche tous les films par ordre alphabetique, ces options sont au nombre de 4.

				show_movie desc  affiche tous les films par ordre alphabetique inverse .

				show_movie genre  affiche suivit du genre voulu tout les films qui y correspondent .
						ex : show_movie genre action

				show_movie year  suivit d'une annee affiche tout les films sortie durant l'annee voulu .
						ex : show_movie year 2001

				show_movie rate  suivit d'un entier entre 1 et 10 tout les film note entre l'entier tape et son +1 exclus
						ex : show_movie rate 7    
						Va afficher les films qui ont une une note comprise entre 7 (inclus) et 8 exclus.

*****************************************************************************************

La partie film contient 3 fonctionnalitees ;

rent_movie : suivit du login de l'etudiant puis de imdbcode du film qu'il veut louer 
					ex : rent_movie login_x imdb_code

return_movie : suivit du login de l'etudiant puis de imdbcode du film qu'il veut rendre.
					ex : return_movie login_x imdb_code

show_rented_movies : Affiche tous les films qui sont actuellement loues par les etudiants.

=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=