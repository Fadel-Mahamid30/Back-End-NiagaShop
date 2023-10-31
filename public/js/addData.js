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

    let dataUkuran = [];

    function viewDataUkuran() {
        let element = "";
        dataUkuran = [...new Set(dataUkuran)]
        dataUkuran.forEach(function(value, index){
           element +=  
           ` <div class="item-ukuran">
                <input type="checkbox" name="ukuran[]" style="display: none;" value="${value}" checked readonly>
                <span>${value}</span>
                <ion-icon name="close-outline" class="delete-data" data-id="${index}"></ion-icon>
            </div>`
        });

        $("#list-ukuran").html(element);
    }

    $("#btn-addUkuran").on("click", function () {
        let ukuran = $("#ukuran").val();
        if (ukuran == "" || ukuran == "0" || ukuran == 0) {
            alert("Data yang dimasukan tidak valid!");
            return false;
        }
        dataUkuran.push(ukuran);
        $("#ukuran").val("");
        viewDataUkuran();
    });

    $("#list-ukuran").on("click", function (event) {
        if (event.target.classList.contains("delete-data")) {
            let index = event.target.getAttribute("data-id");
            dataUkuran.splice(index, 1);
            viewDataUkuran()
        }
    })
    viewDataUkuran();
})