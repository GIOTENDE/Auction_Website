
function add_image(){
    var src = "prod_picture";
    show_image(src);
}
function show_image(src) {
    var img = document.createElement("prod_picture");
    prod_picture.src = src;
  

    // This next line will just add it to the <body> tag
    document.body.appendChild(prod_picture);
}