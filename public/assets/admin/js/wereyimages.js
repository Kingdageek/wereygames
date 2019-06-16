function presetInput(id, imageUrl) {
    // debugger
    // To activate a modal using data attributes like I did, bootstrap inserts a
    // div.modal-backdrop in the DOM to dismiss modal when you click outside of it
    // And also adds a .modal-open class to hide the overflow.
    // Bootstrap's hide modal method is too abrupt cos of the transition on the fade class
    var imagesModal = $('#imagesModal')
    imagesModal.addClass('cust-fade')
    imagesModal.modal('hide')
    imagesModal.removeClass('cust-fade')
    $('.inImage').css( 'background-image', 'url(' + imageUrl + ')' )
    $(".cdx").css({"background":"rgba(0,0,0,.3)"});
    $("#photoBtnText").text('Change image');
    $('#imageId').val(id)
}

$(function(){
    var uploadBtn = $(".sky1")
    uploadBtn.click(function(){
       $("#cc").click();
    });

    var $form = $('#myform1')
    $('#cc').change(function() {
        uploadBtn.html("<p style='padding-top:10px;'><text style='color:#777;'><span class='fa fa-spin fa-spinner'></span> Loading</text></p>");
        $form.ajaxForm({
            success: function (data) {
                //debugger
                presetInput(data.id, data.imageUrl)
                uploadBtn.html('<span class="fa fa-upload"></span> <p>Upload Image</p>')
                $('.sky1').after('<div class="img" onclick="presetInput('+ data.id +', \'' + data.imageUrl + '\')" style="background-image:url(' + data.imageUrl + ');"></div>')
            }
        }).submit();
    })
});
