if (@json($errors->any())) {
    var errorMessage = "<ul>";
    @foreach ($errors->all() as $error)
        errorMessage += "<li>{{ $error }}</li>";
    @endforeach
    errorMessage += "</ul>";
    alert(errorMessage);
}