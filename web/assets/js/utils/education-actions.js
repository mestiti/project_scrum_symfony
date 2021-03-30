
function deleteEducationById(id)
{
    $.ajax({
        url:  path_to_education_delete,
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


