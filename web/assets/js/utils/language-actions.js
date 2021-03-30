// Handle events for the generated languages.
function createLanguageByData(formData)
{
    $.ajax({
        url: path_to_create_language,
        type: 'POST',
        dataType: 'json',
        data: formData,
        success:function(data){
            // handling the response data from the controller
            if(data.status == 'success'){
                console.log('Creating language success, result state: ' + data);
            }
            if(data.status == 'error'){
                console.log('Error during language creation, result state: ' + data);
            }
            if(data.status == 'timeout'){
                console.log('Request timed out (creating language).')
            }}

    });
}




function deleteLanguageById(id)
{
    $.ajax({
        url:  path_to_language_delete,
        type: "POST",
        dataType: "json",
        data: {
            "id": id
        },
        async: true,
        success: function (data)
        {
            console.log('Deleting announce success, result state: ' + data);

        },
        error: function (data)
        {
            console.log('Error during announce deletion, result state: ' + data);
        }
    })
}



