var PostsBtn = document.getElementById("posts-btn");
var PostsContainer = document.getElementById("posts-container");


PostsBtn.addEventListener("click", function(){
    if ( gingco.current_page < gingco.max_page ) {
        gingco.current_page++;
        var site_url = `http://localhost/wordpress-practice/wp-json/wp/v2/posts?_embed&order=desc&page=${gingco.current_page}&per_page=${gingco.posts_per_page}`;
        var ourRequest = new XMLHttpRequest();
        ourRequest.open('GET', site_url );
        ourRequest.onload = function() {
        if(ourRequest.status >= 200 && ourRequest.status < 400) {
                var data = JSON.parse(ourRequest.responseText);
                appendResponse(data);
                if ( gingco.current_page == gingco.max_page ) {
                    PostsBtn.remove();
                }
                
            } else {
                console.log('We connected to the server, but it returned an error.');
            }
        };

        ourRequest.onerror = function() {
            console.log('Connection error');
        }

        ourRequest.send();

    }
});


function appendResponse(data) {
    let html = '';
    html = data.map( item => {
        let images = item._embedded['wp:featuredmedia'];
        let image = '';
        if( images != undefined) {
            image  =  images.length > 0 ? images[0] : '';
        }

        return `<div class="col-xs-12 col-sm-6 col-md-4 blog-grid more-box" id="${item.id}">
            <div class="item">
                <img src="${image.source_url}" alt="${item.title.rendered}" class="img-responsive">
                <div class="item">        
                    <div class="blog-details">
                        <a href="<?php the_permalink(); ?>"><h2>${item.title.rendered}</h2></a>
                        ${ item.excerpt.rendered }
                        <a class="read-more" href="${item.link}">More</a>
                    </div>
                </div>
            </div>
        </div>`;
    });

    PostsContainer.insertAdjacentHTML('beforeend', html);
}