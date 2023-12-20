Pré-requis

    php >= 8.1.X
    
    Laravel >= 9.X

    Mysql >= 5.X

MIS EN ROUTE : 

    ### Ne pas faire un PHP artisan serve ###
    
    1- Base de donnée se trouve dans le fichier file.sql a la racine du projet
    
    2- Modifier le fichier .env et l'adapder en fonction de vos identifiant base de donnée et smtp
    
    3- Prenez tout le contenu et le placer directement dans votre dossier www ou equivalent de votre server

    4- puis lancer le projet comme par exemple :  https://{Nom de domaine ou ip addresse corespondante }/ [{nom du dossier}]

    

API Route de base 

    HOST: https://{Nom de domaine ou ip addresse corespondante }/api/{Route}

    Liste des routes avec leur verbes :
    
    api/movies        [GET|POST|PUT|DELETE]         ### Liste des films disponible sur la plateforme
    api/livestv       [GET|POST|PUT|DELETE]         ### Liste des chaines de lives disponible sur la plateforme
    api/seasons'      [GET|POST|PUT|DELETE]         ### Liste des saisons de serie disponible sur la plateforme
    api/subsplan'     [GET|POST|PUT|DELETE]         ### Liste des differents plan d'abonnement disponibles
    api/languages'    [GET|POST|PUT|DELETE]         ### Liste des langues d'affichage disponible sur la plateforme
    api/actorsdirs'   [GET|POST|PUT|DELETE]         ### Liste des differents acteurs et directeurs ou producteur
    api/sports'       [GET|POST|PUT|DELETE]         ### Liste des chaines de sports
    api/sportcats'    [GET|POST|PUT|DELETE]         ### Liste des catégories de chaine de sports
    api/genres'       [GET|POST|PUT|DELETE]         ### Liste des genres de films et series 
    api/series'       [GET|POST|PUT|DELETE]         ### Liste des series
    api/settings'     [GET|POST|PUT|DELETE]         ### Liste des paramettres des utilisateurs
    apt/auth/login    [GET]                         ### Authentification de base avec Email + Mot de passe

### NOTE ########

1- Pour la consommation coté client de l'api, seul la methode [GET] (recuperation des données + recherche ) sont disponible

2- Les reponses sont renvoyer au format JSON suivis du code de cette derniere
    
    Ex: Response 200 avec (application/json) en entête 
    
2- Le reste operation [POST|PUT|DELETE] se font via l'interface admin de la plateforme disponible sur le https://{Nom de domaine ou ip addresse corespondante }/admin

    Identifiant  : admin@admin.com
    Mot de passe : admin








