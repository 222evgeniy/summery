$(document).on('change', '#summery_file', function(e)
{
    var filename = this.files[0].name,
        type = $(this)[0].files[0].type;
    if (!type.match(/(?:jpe?g|gif|png|txt|doc|docx|pdf)s*/ig))
    {
        resetAttachment(lang.t('Неверный формат файла'));
    }
    else if($(this)[0].files[0].size > 5242880)
    {
        resetAttachment(lang.t('Размер файла превышает 5мб'));
    }
    else
    {
        $(this).closest('.file-upload').find('#hidden_input').val(filename);
        if ($(this)[0].files.length)
        {
            $(this).closest('.file-upload').find(' input[type="hidden"]').val(filename);
        }
        if (filename)
        {
            var _upl = $('.file-upload .upl-text'), _p = _upl.parent(), _btn = _p.find('button.close');
            if (_btn.length > 0) _btn.remove();
            _upl.find('span:eq(0)').html(filename);
            $('#link_delete').show();
            var form = this.closest('#summery_form');

            var formData = new FormData(form);

            axios.post( 'summery/api/save-file',
                formData,
            ).then(function(){
                console.log('SUCCESS!!');
            })
                .catch(function(){
                    console.log('FAILURE!!');
            });
        }
    }
}).on('click', '.upl-text', function () {
    $(this).closest('.file-upload').find('input[type="file"]').trigger('click');
}).on('click', '#link_delete', function (e) {
    var summery_id = $(this).data('id'),
        token = $(this).data('token');

    e.preventDefault();
    $.ajax({
        method: "DELETE",
        url: '/api/summery/rest/v1/delete-safe-file?id='+summery_id,
        headers: {
            "Authorization": "Bearer " + token,
        },
        success: function (res) {
            window.location.reload();
        }
    });
    return false;
});

resetAttachment = function(message)
{
    var span = $('.label-text-upl');
    if(message){
        yii.alert(message, function () {
            $('input[name*="file"]').val('');
        });
    } else {
        $('input[name*="file"]').val('');
    }
    span.html(lang.t('Прикрепить файл'));
}



