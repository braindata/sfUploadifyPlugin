<?php
/**
 * Description of sfPictureGalleryManager
 *
 * @author Johannes
 */
class sfUploadifyWidget extends sfWidgetForm {
  
  public function configure( $options = array(), $attributes = array() )
  {
    $this->addOption("object");
  }

  public function getStylesheets()
  {
    return array(
        '/sfUploadifyPlugin/css/widget.css' => 'all',
        '/sfUploadifyPlugin/css/uploadify.css' => 'all',
    );
  }

  public function getJavascripts()
  {
    return array(
        '/sfUploadifyPlugin/js/widget.js',
        '/sfUploadifyPlugin/js/jquery.uploadify.v2.1.0.min.js',
        '/sfUploadifyPlugin/js/swfobject'
    );
  }

  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    //load partial Helper as we want to outsource the Template
    sfContext::getInstance()->getConfiguration()->loadHelpers('Partial');

    $object = $this->getOption('object');
    $controller = sfContext::getInstance()->getController();
    $param = array("object_class" => get_class($object), "object_id" => $object->getId());

    $options = array(
        'object_class' => get_class($object),
        'object_id'    => $object->getId(),
        'createUrl'   => $controller->genUrl(array_merge(array("sf_route" => 'object_file_create'), $param, array("user_id" => sfContext::getInstance()->getUser()->getId()))),
    );

    return get_partial( 'sfUploadifyWidget/widget', $options);
  }
}
?>
