//Carga el enlace 'url' en el selector 'donde'
function enlace(donde,url) {
    $(donde).fadeOut(500,function() {
        $(this).load(url,function() {
            $(this).fadeIn(500);
            //cambiar url a traves de javascript
            window.history.pushState(donde, null, url);
        });
    });
}
