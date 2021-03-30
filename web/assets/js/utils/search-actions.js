// Handle events for the generated preferences.
function searchByName(id) {
    var url = "{{ path('home_preference') }}";
    $.ajax({
        url: path_to_search,
        type: 'POST',
        dataType: 'json',
        data: id,
        success: function (data) {
            // handling the response data from the controller
            if (data.status == 'success') {
                console.log('succes' + data);
                $('#results').load(url);
            }
            if (data.status == 'error') {
                console.log('Error' + data);
            }
            if (data.status == 'timeout') {
                console.log('Request timed out .')
            }
        }

    });
}



