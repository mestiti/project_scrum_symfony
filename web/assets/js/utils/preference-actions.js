// Handle events for the generated preferences.
function createPreferenceByData(formData)
{
    $.ajax({
        url: path_to_create_preference,
        type: 'POST',
        dataType: 'json',
        data: formData,
        success:function(data){
            // handling the response data from the controller
            if(data.status == 'success'){
                console.log('Creating preference success, result state: ' + data);
            }
            if(data.status == 'error'){
                console.log('Error during preference creation, result state: ' + data);
            }
            if(data.status == 'timeout'){
                console.log('Request timed out (creating preference).')
            }}

    });
}

function deletePreferenceById(preferenceId)
{
    $.ajax({
        url:  path_to_preference_delete,
        type: "POST",
        dataType: "json",
        data: {
            "id": preferenceId,
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


