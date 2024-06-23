document.addEventListener('DOMContentLoaded', function() {
    let deleteButtons = document.querySelectorAll('.delete');
    for (let i = 0; i < deleteButtons.length; i++) {
      deleteButtons[i].addEventListener('click', function(event) {
        event.preventDefault();
        let confirmation = confirm('削除してもよろしいですか？');
        if (confirmation) {
          event.target.closest('form').submit();
        }
      });
    }
  });