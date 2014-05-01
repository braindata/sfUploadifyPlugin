function initFlash()
{
  $('body').ajaxSuccess(function(e, request, settings){
    var $flash = $('.sf_admin_flashes');

    try {
      var data = jQuery.parseJSON(request.responseText);
      if (data.message)
      {
        $flash.show();

        if (data.status){
          $flash.html("<div class='notice ui-state-highlight ui-corner-all'><span class='ui-icon ui-icon-info floatleft'></span>"+data.message+"</div>");
        } else{
          $flash.html("<div class='error ui-state-highlight ui-corner-all'><span class='ui-icon ui-icon-info floatleft'></span>"+data.message+"</div>");
        }

        $flash.stop().delay(4000).fadeOut('slow');
      }

    } catch (e) {}
  })
}

function initUploadify()
{
  var $browse = $("#browse");
  var buttonText = $browse.text();
  var scriptUrl = $browse.attr("href");

  $browse.uploadify({
    'uploader'       : webdir+'/sfUploadifyPlugin/swf/uploadify.swf',
    'script'         : scriptUrl,
    'cancelImg'      : webdir+'/sfUploadifyPlugin/images/cancel.png',
    'buttonImg'      : webdir+'/sfUploadifyPlugin/images/browse_de.png',
    'height'         : '26',
    'width'          : '117',
    'rollover'       : true,
    'folder'         : 'uploads',
    'buttonText'     : buttonText,
    'fileDataName'   : 'filename',
    'auto'           : false,
    'multi'          : true,
    'onComplete'     : function(event, queueID, fileObj, response, data){
      var data = jQuery.parseJSON(response);
      //$('#testing').val(response);
    },
    'onAllComplete'  : function (event, data){
      $("#browseQueue").fadeOut(function(){
        $("#browseQueue").dialog( "close" );
      });
    },
    'onSelectOnce'   : function (event, data){

      $queue = $("#browseQueue");

      $queue.dialog({
        width: 410,
        height: 300,
        modal: true,
        position: top,
        resizable: false,
        title: _selected_files
      });

      $queue.dialog( "option", "buttons",
      [
        {
          text: _upload_files,
          click: function(){$browse.uploadifyUpload();}
        },
        {
          text: _clear_files,
          click: function(){
            $browse.uploadifyClearQueue();
            $(this).fadeOut(function(){
             $(this).dialog( "close" );
            });
          }
        }
      ]);
    }
  });
  

}