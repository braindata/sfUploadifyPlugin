<?php

class sfUploadifyWidgetActions extends sfActions
{
  public function executeCreate(sfWebRequest $request)
  {
    $message = "";

    $this->setLayout(false);
    $FileManager = new sfFileManager();
    
    $status = false;
    
    $this->object_id = $request->getParameter('object_id');
    $this->object_class = $request->getParameter('object_class');
    
    $this->object = Doctrine::getTable($this->object_class)->find($this->object_id);

    if ($this->object)
    {
      $user = Doctrine::getTable("sfGuardUser")->find($request->getParameter("user_id"));
      $this->getUser()->signIn($user);
      
      $file = $request->getFiles("filename");
      
      
      
      // save sfValidatedFileObject
      $this->saveFile(new sfValidatedFileManagerFile(
              $file['name'], 
              sfValidatedFileManagerFile::getTypeFromName($file['tmp_name']), 
              $file['tmp_name'], 
              $file['size'])
            );

      $message = sprintf($this->getContext()->getI18N()->__("The file %s was created successfully!", null, 'uploadify'), $file['name']);
      $status = true;
    }

    return $this->renderText(json_encode(array("status" => $status, "message" => $message, "files" => $request->getFiles())));
  }
  
  public function saveFile($file)
  {
    $object = $this->object->copy(false);
    
    if (is_object($file))
    {
      $file->save();
      
      // If  the File was saved
      if ($file->isSaved())
      {
        $object->updateFileMetaInfo($file);
      }
    }
  }
  
  public function _saveFile($files)
  {
    $values = $this->object->getCloneValues();
    $class = $this->object_class."Form";
    $form = new $class();

    $form->bind(null, $files);
    $form->getObject()->fromArray($values);

    // get sfValidatedFileObject
    $file = $form->getValue('filename');
    
    if ($form->isValid())
    {
      $object = $form->save();
      
      if (is_object($file))
        $file->save();
      
      // If  the File was saved
      if (is_object($file) AND $file->isSaved())
      {
        $object->updateFileMetaInfo($file);
      }
    }
  }

}
