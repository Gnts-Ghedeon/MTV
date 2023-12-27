@extends("admin.admin_app")

@section("content")

<style type="text/css">
  .iframe-container {
  overflow: hidden;
  padding-top: 56.25% !important;
  position: relative;
}

.iframe-container iframe {
   border: 0;
   height: 100%;
   left: 0;
   position: absolute;
   top: 0;
   width: 100%;
}
</style>



   <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-box">

                   <div class="row">
                     <div class="col-sm-6">
                          <a href="{{ URL::to('admin/podcast') }}"><h4 class="header-title m-t-0 m-b-30 text-primary pull-left" style="font-size: 20px;"><i class="fa fa-arrow-left"></i> {{trans('words.back')}}</h4></a>
                     </div>


                   </div>

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(Session::has('flash_message'))
                      <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                          {{ Session::get('flash_message') }}
                      </div>
                @endif

                @if(!getcong('omdb_api_key'))
                  <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                          Please set OMDb API key <a href="{{ URL::to('admin/general_settings') }}#omdbapi_id" target="_blank">here</a>
                  </div>
                @endif

                @if(!isset($movie->id))
                <div id="result" class="m-t-15"></div>

                 <input type="hidden" id="from" name="from" value="movie">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.import_from_imdb')}}</label>
                    <div class="col-sm-6">
                      <input type="text" name="imdb_id_title" id="imdb_id_title" value="" class="form-control" placeholder="Enter IMDb ID (e.g. tt1469304) or Title (e.g. Baywatch)" @if(!getcong('omdb_api_key')) disabled @endif>
                      <small id="emailHelp" class="form-text text-muted">({{trans('words.imdb_search_recommended')}})</small>
                    </div>
                     <div class="col-sm-2">
                      <button type="submit" id="import_movie_btn" class="btn btn-primary waves-effect waves-light mt-1" @if(!getcong('omdb_api_key')) disabled @endif> {{trans('words.fetch')}} </button>
                    </div>

                  </div>


                <hr/>
                @endif

                 {!! Form::open(array('url' => array('admin/podcast/add_edit_podcast'),'class'=>'form-horizontal','name'=>'pd_form','id'=>'pd_form','role'=>'form','enctype' => 'multipart/form-data')) !!}

                  <input type="hidden" name="id" value="{{ isset($movie->id) ? $movie->id : null }}">

                  <input type="hidden" name="imdb_id" id="imdb_id" value="">
                   <input type="hidden" name="imdb_votes" id="imdb_votes" value="">


                   {{-- PARTI I --}}


                <div class="row">

                    <div class="col-md-6">
                      <h4 class="m-t-0 m-b-30 header-title" style="font-size: 20px;">Podcast Information</h4>

                      <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Désignation *</label>
                    <div class="col-sm-8">
                      <input type="text" name="video_title" id="video_title" value="{{ isset($movie->pd_title) ? stripslashes($movie->pd_title) : old('video_title') }}" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="webSite" class="col-sm-12 col-form-label"> {{trans('words.description')}}</label>
                    <div class="col-sm-12">
                      <div class="card-box pl-0 description_box">

                      <textarea id="elm1" name="video_description">{{ isset($movie->pd_description) ? stripslashes($movie->pd_description) : old('video_description') }}</textarea>

                    </div>
                    </div>
                  </div>


                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Type d'accès</label>
                      <div class="col-sm-8">
                            <select class="form-control" name="video_access">
                                <option value="Paid" @if(isset($movie->pd_access) AND $movie->pd_access=='Paid') selected @endif>{{trans('words.paid')}}</option>
                                <option value="Free" @if(isset($movie->pd_access) AND $movie->pd_access=='Free') selected @endif>{{trans('words.free')}}</option>
                            </select>
                      </div>

                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.language_text')}}*</label>
                      <div class="col-sm-8">
                            <select class="form-control select2" name="movie_language" id="movie_language">
                                <option value="">{{trans('words.select_lang')}}</option>
                                @foreach($language_list as $language_data)
                                  <option value="{{$language_data->id}}" @if(isset($movie->id) && $language_data->id==$movie->movie_lang_id) selected @endif>{{$language_data->language_name}}</option>
                                @endforeach
                            </select>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Catégories *</label>
                      <div class="col-sm-8">
                            <select name="genres[]" class="select2 select2-multiple" multiple="multiple" multiple id="movie_genre_id" data-placeholder="Select Genres...">
                                 @foreach($genre_list as $genre_data)
                                  <option value="{{$genre_data->id}}" @if(isset($movie->id) && in_array($genre_data->id, explode(",",$movie->movie_genre_id))) selected @endif>{{$genre_data->category_name}}</option>
                                @endforeach
                            </select>
                      </div>
                  </div>



                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.duration')}}</label>
                    <div class="col-sm-8">
                      <div class="input-group">
                      <input type="text" name="duration" id="duration" value="{{ isset($movie->duration) ? $movie->duration : old('duration') }}" class="form-control" placeholder="1h 35m 54s">
                      <div class="input-group-append">
                            <span class="input-group-text"><i class="mdi mdi-clock"></i></span>
                        </div>
                    </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.status')}}</label>
                      <div class="col-sm-8">
                            <select class="form-control" name="status">
                                <option value="1" @if(isset($movie->status) AND $movie->status==1) selected @endif>{{trans('words.active')}}</option>
                                <option value="0" @if(isset($movie->status) AND $movie->status==0) selected @endif>{{trans('words.inactive')}}</option>
                            </select>
                      </div>
                  </div>

                  <hr/>
                  <h4 class="m-t-0 m-b-30 header-title" style="font-size: 20px;">{{trans('words.seo')}}</h4>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.seo_title')}}</label>
                    <div class="col-sm-8">
                      <input type="text" name="seo_title" id="seo_title" value="{{ isset($movie->seo_title) ? stripslashes($movie->seo_title) : old('seo_title') }}" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.seo_desc')}}</label>
                    <div class="col-sm-8">
                      <textarea name="seo_description" id="seo_description" class="form-control">{{ isset($movie->seo_description) ? stripslashes($movie->seo_description) : old('seo_description') }}</textarea>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.seo_keyword')}}</label>
                    <div class="col-sm-8">
                      <textarea name="seo_keyword" id="seo_keyword" class="form-control">{{ isset($movie->seo_keyword) ? stripslashes($movie->seo_keyword) : old('seo_keyword') }}</textarea>
                      <small id="emailHelp" class="form-text text-muted">{{trans('words.seo_keyword_note')}}</small>
                    </div>
                  </div>

                </div>
















                {{-- PARTI II --}}

                <div class="col-md-6">
                    <h4 class="m-t-0 m-b-30 header-title" style="font-size: 20px;"></h4>


                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Vignette*</label>
                    <div class="col-sm-8">

                      <div class="input-group">

                        <input type="text" name="video_image_thumb" id="video_image_thumb" value="{{ isset($movie->video_image_thumb) ? $movie->video_image_thumb : null }}" class="form-control" readonly>
                        <div class="input-group-append">
                          <button type="button" class="btn btn-dark waves-effect waves-light popup_selector" data-input="video_image_thumb" data-preview="holder_thumb" data-inputid="video_image_thumb">Select</button>
                          <!-- <a href="" class="popup_selector" data-inputid="poster_image" data-preview="holder_thumb">Select Image</a> -->
                        </div>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">({{trans('words.recommended_resolution')}} : 270X390)</small>
                      <div id="thumb_image_holder" style="margin-top:5px;max-height:100px;"></div>

                    </div>
                  </div>

                  @if(isset($movie->pd_image_thumb))

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">&nbsp;</label>
                        <div class="col-sm-8">
                        <img src="{{URL::to('/'.$movie->pd_image_thumb)}}" alt="video thumb" class="img-thumbnail" width="110">
                        </div>
                    </div>


                  @endif



                  <div class="form-group row" id="display_thumb_img" style="display: none;">
                    <label class="col-sm-3 col-form-label">&nbsp;</label>
                    <div class="col-sm-8">
                           <input type="hidden" name="thumb_link" id="thumb_link" value="">
                           <img id="imdb_thumb_image" src="" alt="video thumb" class="img-thumbnail" width="160">
                    </div>
                  </div>



                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Image de présentation</label>
                    <div class="col-sm-8">
                      <div class="input-group">
                        <input type="text" name="video_image" id="video_image" value="{{ isset($movie->pd_image) ? $movie->pd_image : null }}" class="form-control" readonly>
                        <div class="input-group-append">
                          <button type="button" class="btn btn-dark waves-effect waves-light popup_selector" data-input="video_image" data-preview="holder_poster" data-inputid="video_image">Select</button>
                        </div>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">({{trans('words.recommended_resolution')}} : 800x450)</small>
                      <div id="video_poster_holder" style="margin-top:5px;max-height:100px;"></div>
                    </div>
                  </div>



                  @if(isset($movie->pd_image))
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">&nbsp;</label>
                    <div class="col-sm-8">

                           <img src="{{URL::to('/'.$movie->video_image)}}" alt="video image" class="img-thumbnail" width="160">

                    </div>
                  </div>
                  @endif

                  <hr/>





                  <div class="form-group row" id="local_id" @if(isset($movie->video_type) AND $movie->video_type!="Local") style="display:none;" @endif>



                    <label class="col-sm-3 col-form-label">Fichier source *<small id="emailHelp" class="form-text text-muted">(Defualt Player File)</small></label>
                    <div class="col-sm-8 mb-3">

                      <div class="input-group">
                        <input type="text" name="video_url_local" id="video_url_local" value="{{ isset($movie->video_url) ? $movie->video_url : null }}" class="form-control" readonly>
                        <div class="input-group-append">
                          <button type="button" class="btn btn-dark waves-effect waves-light popup_selector" data-input="video_url_local" data-inputid="video_url_local">Select</button>
                        </div>
                      </div>

                    </div>

                  </div>




                  <div class="form-group row" id="dash_id" @if(isset($movie->video_type) AND  $movie->video_type!="DASH") style="display:none;" @endif @if(!isset($movie->id)) style="display:none;" @endif>
                    <label class="col-sm-3 col-form-label">{{trans('words.mpeg_dash_streaming')}}</label>
                     <div class="col-sm-8 mb-3">
                       <input type="text" name="video_url_dash" value="{{ isset($movie->video_url) ? $movie->video_url : null }}" class="form-control" placeholder="http://example.com/test.mpd">
                    </div>
                  </div>


                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.download_url')}}</label>
                    <div class="col-sm-8">
                      <input type="text" name="download_url" id="download_url" value="{{ isset($movie->download_url) ? $movie->download_url : old('download_url') }}" class="form-control">
                    </div>
                  </div>





                  </div>

                  <div class="form-group">
                  <div class="offset-sm-9 col-sm-9">
                    <button type="submit" id="add_btn_id" class="btn btn-primary waves-effect waves-light"><i class="fa fa-save"></i> {{trans('words.save')}} </button>
                  </div>
                </div>

                </div>
              </div>


                {!! Form::close() !!}
              </div>
            </div>
          </div>
        </div>
      </div>
      @include("admin.copyright")
    </div>

 <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>

<script>
  var route_prefix = "{{ URL::to('laravel-filemanager') }}";
 $('#video_thumb_image_select').filemanager('image', {prefix: route_prefix});

 $('#video_poster_image_select').filemanager('image', {prefix: route_prefix});

 $('#video_local_select').filemanager('file', {prefix: route_prefix});
 $('#video_url_local_480_select').filemanager('file', {prefix: route_prefix});
 $('#video_url_local_720_select').filemanager('file', {prefix: route_prefix});
 $('#video_url_local_1080_select').filemanager('file', {prefix: route_prefix});

</script> -->


<script type="text/javascript">


// function to update the file selected by elfinder
function processSelectedFile(filePath, requestingField) {

    //alert(requestingField);

    var elfinderUrl = "{{ URL::to('/') }}/";

    if(requestingField=="video_image_thumb")
    {
      $('#thumb_link').val('');

      var target_preview = $('#thumb_image_holder');
      target_preview.html('');
      target_preview.append(
              $('<img>').css('height', '5rem').attr('src', elfinderUrl + filePath.replace(/\\/g,"/"))
            );
      target_preview.trigger('change');
    }

    if(requestingField=="video_image")
    {
      var target_preview = $('#video_poster_holder');
      target_preview.html('');
      target_preview.append(
              $('<img>').css('height', '5rem').attr('src', elfinderUrl + filePath.replace(/\\/g,"/"))
            );
      target_preview.trigger('change');
    }

    //$('#' + requestingField).val(filePath.split('\\').pop()).trigger('change'); //For only filename
    $('#' + requestingField).val(filePath.replace(/\\/g,"/")).trigger('change');

}



 </script>

@endsection
