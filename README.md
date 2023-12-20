MTV

API Route de base 

HOST: https://nd/api/

//Auth de base, Email + mot de passe 
### LOGIN -- [POST] = /login


### List All Movies [GET] = /movies

+ Response 200 (application/json)

{
    "id": 3,
    "video_access": "Paid",
    "movie_lang_id": 1,
    "movie_genre_id": "3,1",
    "upcoming": 1,
    "video_title": "Laal Singh Chaddha",
    "release_date": 1660156200,
    "duration": "2M 10S",
    "video_description": "<p>An official remake of the 1994 American film Forrest Gump</p>\r\n<p><strong>Director</strong>: Advait Chandan</p>\r\n<p><strong>Writer</strong>: Atul     
    Kulkarni</p>\r\n<p><strong>Actors</strong>: Aamir Khan, Kareena Kapoor, Manav Vij</p>\r\n<p><strong>Production</strong>: N/A</p>",
    "actor_id": "13,14,15",
    "director_id": "12",
    "video_slug": "laal-singh-chaddha",
    "video_image_thumb": "upload/images/Laal_Singh_Chaddha_270X390.jpg",
    "video_image": "upload/images/Laal_Singh_Chaddha_1280X720.jpg",
    "trailer_url": "https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4",
    "video_type": null,
    "video_quality": null,
    "video_url": null,
    "video_url_480": null,
    "video_url_720": null,
    "video_url_1080": null,
    "download_enable": null,
    "download_url": null,
    "subtitle_on_off": null,
    "subtitle_language1": null,
    "subtitle_url1": null,
    "subtitle_language2": null,
    "subtitle_url2": null,
    "subtitle_language3": null,
    "subtitle_url3": null,
    "imdb_id": null,
    "imdb_rating": null,
    "imdb_votes": null,
    "seo_title": "",
    "seo_description": "",
    "seo_keyword": "",
    "views": 3,
    "content_rating": "16+",
    "status": 1,
    "created_at": null,
    "updated_at": "2022-11-10 12:57:06"
},



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


