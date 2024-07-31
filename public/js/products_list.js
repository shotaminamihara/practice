$(document).ready(function() {
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $('#search_form').on('submit', function(event) {
      event.preventDefault();
      let formData = new FormData(this);
      let url = $(this).data('url');
      $.ajax({
          url: url,
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success: function(response) {
            console.log('Response:', response);
            $('#productTable tbody').html($(response.data).find('tbody').html());
          }
      });
  });

  $("#productTable").tablesorter({
      headers: {
          1: { sorter: false }, 
          6: { sorter: false }, 
          7: { sorter: false }  
      },
      sortList: [[0, 1]] 
  });
  $("#productTable").on("sortEnd", function() {
      let th = $(this).find("th");
      th.removeClass("sorted-asc sorted-desc");
      th.each(function(index) {
          if ($(this).hasClass("tablesorter-headerAsc")) {
              $(this).addClass("sorted-asc");
          } else if ($(this).hasClass("tablesorter-headerDesc")) {
              $(this).addClass("sorted-desc");
          }
      });
  });

  $("#productTable").on("click", ".delete", function(event) {
    event.preventDefault(); 
    let $row = $(this).closest("tr");
    let deleteUrl = $(this).closest("form").attr("action");
    if (confirm("削除しますか？")) {
        $.ajax({
            url: deleteUrl,
            type: "POST",
            data: {
                _method: "DELETE",
                _token: $('input[name="_token"]').val()
            },
            success: function(response) {
                alert("削除が成功しました");
                $row.remove(); 
                $("#productTable").trigger("update");
            }
        });
    }
  });
});