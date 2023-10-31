$(document).ready(function () {
    $("#upload-file").on("change", function () {
        let file = this.files[0];
        let ext = file.name.split(".").pop().toLowerCase();
        $(".name-file").html(file.name);
        if (ext != "jpg" && ext != "jpeg" && ext != "png") {
            alert("File yang dimasukan tidak valid!!\nHarus memasukan file dengan format (jpg, jpeg, png).");
            return false;
        }
        var reader = new FileReader();

        reader.onload = function(event) {
            $("#image-upload").attr("src", event.target.result);
            $("#image-upload").css("display", "block");
          };
        console.log(file[0]);
        reader.readAsDataURL(file);
    });

    $("#btn-addUkuran").on("click", function () {
        let ukuran = $("#ukuran").val();
        let newItem = $(
            `<div class='item-ukuran'>
                <input type='checkbox' name='tambah_ukuran[]' style='display: none;' value='${ukuran}' checked readonly>
                <span>${ukuran}</span>
                <ion-icon name='close-outline' class='delete-data-tmb'></ion-icon>
            </div>`);
        $("#list-ukuran").append(newItem);
        $("#ukuran").val("");
    });

    $("#list-ukuran").on("click", function (event) {
        if (event.target.classList.contains("delete-data")) {
            let parent = event.target.parentElement;
            let inputElement = $(event.target).siblings("input[type='checkbox']");
            inputElement.attr("name", "hapus_ukuran[]");
            $(parent).css("display", "none");
        } else if (event.target.classList.contains("delete-data-tmb")) {
            let parent = event.target.parentElement;
            parent.remove();
        }
    });
})