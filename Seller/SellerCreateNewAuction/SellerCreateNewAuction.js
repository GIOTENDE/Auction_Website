
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
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $("#blah").attr("src", e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
}
