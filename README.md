MTV

API Route de base 

HOST: https://nd/api/

//Auth de base, Email + mot de passe 
### LOGIN -- [POST] = /login


### List All Movies [GET] = /movies

+ Response 200 (application/json)


    //recuperer les films en get 
    
    /api/movies
    'livestv'=>LiveTvController::class,
    'seasons'=>SaisonController::class,
    'subsplan'=>SubsPlanController::class,
    'languages'=>LanguagesController::class,
    'actorsdirs'=>ActordirsController::class,
    'sports'=>SportsController::class,
    'sportcats'=>SportsCategory::class,
    'genres'=>GenresController::class,
    'series'=>SeriesController::class,
    'settings'=>SettingsController::class,


