# Rebase

## Controller/View Names

While this does follow some basic RESTful conventions. This is not a RESTful API. These are URL's so we don't need to feel compelled to stick to a REST convention if/when it doesn't make sense. Case in point, `process`, `login` and `logout`. 

/photos 	            index 	    PhotosIndex          
/photos/create 	        create 	    PhotosCreate         
/photos 	            store 	    PhotosStore
/photos/{photo} 	    show 	    PhotosShow
/photos/{photo}/edit 	edit 	    PhotosEdit
/photos/{photo} 	    update 	    PhotosUpdate
/photos/{photo} 	    destroy 	PhotosDestroy



