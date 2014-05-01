<script>
  jQuery(document).ready(function() {
    _close = '<?php echo __('Close', null, 'sf_uploadify') ?>';
    _save = '<?php echo __('Save', null, 'sf_uploadify') ?>';
    _upload_files = '<?php echo __('Upload Files', null, 'uploadify') ?>';
    _clear_files = '<?php echo __('Clear Files', null, 'uploadify') ?>';
    _selected_files = '<?php echo __('File Queue', null, 'uploadify') ?>';

    webdir = '<?php echo sfConfig::get("app_webdir"); ?>';
    
    $('#uploadify_actions .fg-button').button();
    $('#uploadify_actions .fg-button').button("option", "icons", {primary:'ui-icon-folder-open'});

    initFlash();
    initUploadify();
  });
</script>

<div id="uploadify_actions">
<a href="<?php echo $createUrl ?>" id="browse" Onclick="return false;"><?php echo __('Browse', null, 'uploadify') ?></a>
<!--<br/><br/>
<a href="<?php echo $createUrl ?>" class="fg-button fg-button-icon-left" Onclick="return false;"><?php echo __('Browse', null, 'uploadify') ?></a>
<a href="<?php echo $createUrl ?>" class="fg-button fg-button-icon-left ui-state-hover" Onclick="return false;"><?php echo __('Browse', null, 'uploadify') ?></a>
<a href="<?php echo $createUrl ?>" class="fg-button fg-button-icon-left ui-state-active" Onclick="return false;"><?php echo __('Browse', null, 'uploadify') ?></a>-->
</div>

<div style="clear: both;"></div>


<!--<textarea id="testing" style="width: 600px; height: 500px;"></textarea>-->