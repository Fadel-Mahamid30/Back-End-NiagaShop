
$(document).ready(function () {
    
    $(".closeFlashMessage").on("click", function() {
       let parent = this.parentElement.parentElement;
       parent.remove();
    });

})