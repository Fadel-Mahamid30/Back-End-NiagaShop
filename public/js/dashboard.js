
$(document).ready(function () {

    // navbar 
    $(".action").click(function () {
        $(".action").toggleClass("active");
        $(".menu").toggleClass("active");
    });

    var first_page = 1;
    var itemsPerPage = 10; // Ubah sesuai dengan jumlah item per halaman yang Anda inginkan
    var $itemList = $('#data-items');
    var $pagination = $('#pagination ul');

    var totalItems = $itemList.children('tr').length;
    var totalPages = Math.ceil(totalItems / itemsPerPage);
    
    $("#pagination").find("p span.last-page").text(totalPages);
    $("#pagination").find("p span.first-page").text(first_page);
    $("#pagination").find("ul li p").text(first_page);

    // Sembunyikan semua item
    $itemList.children('tr').hide();

    // Tampilkan item pertama
    $itemList.children('tr').slice(0, itemsPerPage).show();

    // Buat tombol pagination
    for (var i = 1; i <= totalPages; i++) {
        $pagination.append('<li style="display: none;"><a href="#" class="page">' + i + '</a></li>');
    }

    // Tambahkan event handler untuk tombol pagination
    $pagination.find('.page').on('click', function() {
        var page = $(this).text();
        var start = (page - 1) * itemsPerPage;
        console.log(start);
        var end = start + itemsPerPage;
        first_page = page;

        $("#pagination").find("ul li p").text(first_page);
        $("#pagination").find("p span.first-page").text(first_page);
        $itemList.children('tr').hide();
        $itemList.children('tr').slice(start, end).show();
    });


    // Tambahkan event handler untuk tombol "Previous" dan "Next"
    $pagination.find('.prev').on('click', function() {
        var currentPage = parseInt($pagination.find('.page.active').text());
        if (currentPage > 1) {
        $pagination.find('.page.active').removeClass('active');
        $pagination.find('.page').eq(currentPage - 2).addClass('active');
        $pagination.find('.page').eq(currentPage - 2).trigger('click');
        }
    });

    $pagination.find('.next').on('click', function() {
        var currentPage = parseInt($pagination.find('.page.active').text());
        if (currentPage < totalPages) {
        $pagination.find('.page.active').removeClass('active');
        $pagination.find('.page').eq(currentPage).addClass('active');
        $pagination.find('.page').eq(currentPage).trigger('click');
        }
    });

    // Tampilkan halaman pertama secara default
    $pagination.find('.page').eq(0).addClass('active');

    $(".delete").on('click', function (event) {
        var konfirmasi = window.confirm("Apakah Anda yakin ingin melanjutkan?");
        if (!konfirmasi) {
          event.preventDefault();
          return;
        }
    })
});