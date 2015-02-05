hljs.initHighlightingOnLoad();

// install view-row button
if(location.href.indexOf('?')  < 0 || location.href.split('?')[1].indexOf('list') < 0){
    var e = document.createElement("span");
    e.textContent = 'view raw';
    e.id = "view-raw";
    var h1 = document.getElementsByTagName('h1')[0];
    var view_raw = h1.appendChild(e);
    view_raw.addEventListener('click', function(){
        if(location.href.indexOf('?') >= 0){
            location.href += '&view=raw';
        }
        else{
            location.href += '?view=raw';
        }
    })
    // h1.addEventListener('hover', function(){
    //     view_raw.style.opacity = 1;
    // });
}