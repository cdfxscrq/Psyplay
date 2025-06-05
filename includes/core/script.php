<?php if("post" == get_current_post_type()) {?>
<script>
	jQuery('input[name=Checkbx]').click(function() {
	var coc = jQuery('input[name=Checkbx2]').get(0).value;
	// Send Request
    jQuery.getJSON("https://www.omdbapi.com/?apikey=c0d64821&i=" + coc + "", function(data) {
	    var valDir = "";
		var valWri = "";
		jQuery.each(data, function(key, val) {
			  jQuery('input[name=' +key+ ']').val(val); 
			  if(key == "Director"){
				valDir+= " "+val+",";
			  }	  
			  if(key == "Year"){
				jQuery('#new-tag-release-year').val(val);
			  }
			   if(key == "Country"){
				jQuery('#new-tag-country').val(val);
			  }
		});
		jQuery('#new-tag-director').val(valDir);
	}); 
});
</script> 

<?php $api = get_option('tmdbapi'); if ($api == "true") { ?>
<script>
	jQuery('input[name=Checkbx]').click(function() {
	var input = jQuery('input[name=Checkbx2]').get(0).value;
	var url = "https://api.themoviedb.org/3/movie/";
	var agregar = "?append_to_response=images,trailers";
	var idioma = "&language=<?php echo get_option('tmdbidioma') ?>&include_image_language=<?php echo get_option('tmdbidioma')?>,null";
	var apikey = "&api_key=<?php echo get_option('tmdbkey')?>";
	// Send Request
    jQuery.getJSON( url + input + agregar + idioma + apikey, function(tmdbdata) {   
		var valTit = "";
		var valPlo = "";
		var valImg = "";
		var valBac = "";
		jQuery.each(tmdbdata, function(key, val) {
			  jQuery('input[name=' +key+ ']').val(val); 

			jQuery('#message').remove();
            jQuery('#psy-content-info .inside').prepend('<div id=\"message\" class=\"notice rebskt updated \"><p><?php if(info_movie_get_meta( 'id' )){ _e("The data have been updated, check please","psythemes"); } else { _e("Data were completed, check please","psythemes"); } ?></p></div>');
			jQuery("#verify").show();			  
			  if(key == "title"){
				valTit+= ""+val+"";
			  }
			  if(key == "overview"){
				valPlo+= ""+val+"";
				}
			  if(key == "poster_path"){
				valImg+= "https://image.tmdb.org/t/p/w185"+val+"";
			  }
			  if(key == "backdrop_path"){
				valBac+= "https://image.tmdb.org/t/p/w780"+val+"";
			  }
<?php $api = get_option('apigenero'); if ($api == "true") { ?>
if(key == "genres"){
			var genr = "";
			var genr1_arr=[];
			jQuery.each( tmdbdata.genres, function( i, item ) {
       	 		genr += "" + item.name + ", ";
				genr1 = item.name;
				jQuery('input[name=newcategory]').val( genr1 );
				jQuery('#category-add-submit').trigger('click');
				jQuery('#category-add-submit').prop("disabled", false);
				jQuery('input[name=newcategory]').val("");
				genr1_arr.push(genr1);
				});
			jQuery('input[name=' +key+ ']').val( genr );
			jQuery('#categorychecklist .selectit').each(function(){
					jQuery(this).children("input[type=checkbox]").prop("checked",false);	
			});
			jQuery('#categorychecklist .selectit').each(function(){
					gen = jQuery.trim(jQuery(this).text());
					if(jQuery.inArray(gen,genr1_arr) !== -1)
					{
						console.log("shyam");
						jQuery(this).children("input[type=checkbox]").prop("checked",true);
					}
				});
		}	
<?php } ?>
if(key == "trailers"){
			var tral = "";
			jQuery.each( tmdbdata.trailers.youtube, function( i, item ) {
       	 		tral += "[" + item.source + "]";
    		});
			jQuery('input[name="youtube_id"]').val(tral.slice(0, 13));
}
if(key == "images"){
			var imgt = "";
			jQuery.each( tmdbdata.images.backdrops, function( i, item ) {
				imgt += "https://image.tmdb.org/t/p/w300" + item.file_path + "\n";	
    		});
			jQuery('textarea[name="imagenes"]').val( imgt );
}



jQuery.getJSON( url + input + "/credits?" + apikey, function(tmdbdata) {
	jQuery.each(tmdbdata, function(key, val) {
		if(key == "cast"){
			var valCast = "";
			jQuery.each( tmdbdata.cast, function( i, item ) {
			if(i>6) return false;
			valCast += "" + item.name + ", "; //
		});
			jQuery('#new-tag-stars').val( valCast );
		} else {
			var crew_d = crew_dl = "";
			var crew_w = crew_wl = "";	
		}
	});
});
		});
		jQuery('#title').val(valTit);
		jQuery('#content').val(valPlo);
		jQuery('#poster_url').val(valImg);
		jQuery('#fondo_player').val(valBac);
	}); 
});
</script>
<?php  } } elseif("tvshows" == get_current_post_type()) {?>
<script>
	jQuery('input[name=generartv]').click(function() {
	var input = jQuery('input[name=id]').get(0).value;
	var url = "https://api.themoviedb.org/3/tv/";
	var agregar = "?append_to_response=images,trailers";
	var idioma = "&language=<?php echo get_option('tmdbidioma') ?>&include_image_language=<?php echo get_option('tmdbidioma')?>,null";
	var apikey = "&api_key=<?php echo get_option('tmdbkey')?>";
	// Send Request
    jQuery.getJSON(url + input + agregar + idioma + apikey, function(tmdbdata) {
    var valPlo = "";
    var valImg = "";
    var valBac = "";
    jQuery.each(tmdbdata, function(key, val) {
        jQuery('input[name=' + key + ']').val(val);
			jQuery('#message').remove();
            jQuery('#psy-content-info .inside').prepend('<div id=\"message\" class=\"notice rebskt updated \"><p><?php if(info_movie_get_meta( 'id' )){ _e("The data have been updated, check please","mtms"); } else { _e("Data were completed, check please","mtms"); } ?></p></div>');
			jQuery("#verify").show();			  
        if (key == "name") {
            jQuery('#title').val(val);
        }
        if (key == "vote_count") {
            jQuery('#serie_vote_count').val(val);
        }
        if (key == "vote_average") {
            jQuery('#serie_vote_average').val(val);
        }
		if(key == "overview"){
		valPlo+= ""+val+"";
		}
        if (key == "poster_path") {
            valImg += "https://image.tmdb.org/t/p/w185" + val + "";
        }
        if (key == "backdrop_path") {
            valBac += "https://image.tmdb.org/t/p/original" + val + "";
        }
        <?php $api = get_option('apigenero'); if ($api == "true") { ?>
        if (key == "genres") {
            var genr = "";
			var genr1_arr=[];
            jQuery.each(tmdbdata.genres, function(i, item) {
       	 		genr += "" + item.name + ", ";
				genr1 = item.name;
				jQuery('input[name=newcategory]').val( genr1 );
				jQuery('#category-add-submit').trigger('click');
				jQuery('#category-add-submit').prop("disabled", false);
				jQuery('input[name=newcategory]').val("");
				genr1_arr.push(genr1);
            });
            jQuery('input[name=' + key + ']').val(genr);
			jQuery('#categorychecklist .selectit').each(function(){
					jQuery(this).children("input[type=checkbox]").prop("checked",false);	
			});
			jQuery('#categorychecklist .selectit').each(function(){
					gen = jQuery.trim(jQuery(this).text());
					if(jQuery.inArray(gen,genr1_arr) !== -1)
					{
						jQuery(this).children("input[type=checkbox]").prop("checked",true);
					}
				});
        }
        <?php } ?>
        if (key == "images") {
            var imgt = "";
            jQuery.each(tmdbdata.images.backdrops, function(i, item) {
                imgt += "https://image.tmdb.org/t/p/w300" + item.file_path + "\n";
            });
            jQuery('textarea[name="imagenes"]').val(imgt);
        }
        if (key == "first_air_date") {
            jQuery('#new-tag-release-year').val(val.slice(0, 4));
        }
		
		       if (key == "created_by") {
            var crea = "";
            jQuery.each(tmdbdata.created_by, function(i, item) {
                crea += item.name + ",";
            });
            jQuery('#new-tag-director').val(crea);
        }
        if (key == "production_companies") {
            var pro = "";
            jQuery.each(tmdbdata.production_companies, function(i, item) {
                pro += item.name + ",";
            });
            jQuery('#new-tag-studio').val(pro);
        }
        if (key == "networks") {
            var net = "";
            jQuery.each(tmdbdata.networks, function(i, item) {
                net += item.name + ",";
            });
            jQuery('#new-tag-networks').val(net);
        }
        jQuery.getJSON(url + input + "/credits?" + apikey, function(tmdbdata) {
            jQuery.each(tmdbdata, function(key, val) {
                if (key == "cast") {
                    var valCast = "";
                    jQuery.each(tmdbdata.cast, function(i, item) {
                        valCast += "" + item.name + ", "; //
                    });
                    jQuery('#new-tag-stars').val(valCast);
                }
            });
            jQuery.getJSON(url + input + "/videos?" + apikey, function(tmdbdata) {
                jQuery.each(tmdbdata, function(key, val) {
                    var videomt = "";
                    jQuery.each(tmdbdata.results, function(i, item) {
                        videomt += "[" + item.key + "]";
                    });
                    jQuery('#youtube_id').val(videomt.slice(0, 13));
                });
            });
        });
    });
    jQuery('#content').val(valPlo);
    jQuery('#poster_url').val(valImg);
    jQuery('#fondo_player').val(valBac);
    });
    });
</script>
<?php  } elseif("episodes" == get_current_post_type()) {?>
<script>
	jQuery('input[name=generarepis]').click(function() {
	var input = jQuery('input[name=ids]').get(0).value;
	var temp = jQuery('input[name=temporada]').get(0).value;
	var epis = jQuery('input[name=episodio]').get(0).value;
	var imgplus = "?append_to_response=images";
	var adde = '/season/'+temp+'/episode/'+ epis + imgplus;
	var url = "https://api.themoviedb.org/3/tv/";
	var idioma = "&language=<?php echo get_option('tmdbidioma') ?>&include_image_language=<?php echo get_option('tmdbidioma')?>,null";
	var apikey = "&api_key=<?php echo get_option('tmdbkey')?>";
	// Send Request
    jQuery.getJSON(url + input + adde + idioma + apikey, function(tmdbdata) {
    var valPlo = "";
    var valImg = "";
    var valBac = "";
    jQuery.each(tmdbdata, function(key, val) {
        jQuery('input[name=' + key + ']').val(val);
		
					jQuery('#message').remove();
            jQuery('#psy-content-info .inside').prepend('<div id=\"message\" class=\"notice rebskt updated \"><p><?php if(episodios_get_meta( 'ids' )){ _e("The data have been updated, check please","mtms"); } else { _e("Data were completed, check please","mtms"); } ?></p></div>');
			jQuery("#verify").show();		
		
        if (key == "vote_count") {
            jQuery('#serie_vote_count').val(val);
        }
		  if (key == "season_number") {
            jQuery('#season_number').val(val);
        }
				  if (key == "episode_number") {
            jQuery('#episode_number').val(val);
        }
        if (key == "vote_average") {
            jQuery('#serie_vote_average').val(val);
        }
		if(key == "overview"){
		valPlo+= ""+val+"";
		}
        if (key == "still_path") {
            valImg += "https://image.tmdb.org/t/p/w780" + val + "";
        }
        if (key == "images") {
            var imgt = "";
            jQuery.each(tmdbdata.images.stills, function(i, item) {
                imgt += "https://image.tmdb.org/t/p/w300" + item.file_path + "\n";
            });
            jQuery('textarea[name="imagenes"]').val(imgt);
        }
        if (key == "air_date") {
            jQuery('#new-tag-episodedate').val(val.slice(0, 4));
        }

        if (key == "crew") {
            var crew_d = crew_w = crew_a = "";
            jQuery.each(tmdbdata.crew, function(i, item) {
                if (item.department == "Directing") {
                    crew_d += "" + item.name + ",";
                }
            });
            jQuery('#new-tag-director').val(crew_d);
        }
        if (key == "guest_stars") {
            var star_a = "";
            jQuery.each(tmdbdata.guest_stars, function(i, item) {
                star_a += "" + item.name + ", ";
            });

            jQuery('#new-tag-gueststar').val(star_a);

        }
        jQuery.getJSON(url + input + "?" + idioma + apikey, function(tmdbdata) {

            jQuery.each(tmdbdata, function(key, item) {
                if (key == "name") {
				var genr = "";
				var genr1_arr=[];
       	 		genr += "" + item+ ", ";
				genr1 = item;
				jQuery('input[name=newepisodeserie]').val( genr1 );
				jQuery('#episodeserie-add-submit').trigger('click');
				jQuery('#episodeserie-add-submit').prop("disabled", false);
				jQuery('input[name=newepisodeserie]').val("");
				genr1_arr.push(genr1);

			jQuery('#episodeseriechecklist .selectit').each(function(){
					jQuery(this).children("input[type=checkbox]").prop("checked",false);	
			});
			jQuery('#episodeseriechecklist .selectit').each(function(){
					gen = jQuery.trim(jQuery(this).text());
					if(jQuery.inArray(gen,genr1_arr) !== -1)
					{
						console.log("shyam3");
						jQuery(this).children("input[type=checkbox]").prop("checked",true);
					}
				});
                    jQuery('#serie').val(item);
					jQuery('#title').val(item + " " + "Season" + " " + temp + " " + "Episode" + " "+ epis);
                }
                if (key == "poster_path") {
                    jQuery('#poster_serie').val("https://image.tmdb.org/t/p/w185" + item);
                }
            });
        });

    });
    jQuery('#content').val(valPlo);
    jQuery('#fondo_player').val(valImg);

    });
    });
</script>	
<?php }