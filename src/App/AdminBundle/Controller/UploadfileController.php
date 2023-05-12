<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\Medias;
use App\AdminBundle\Entity\Actualite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UploadfileController extends Controller
{
    public function uploadfileAction(Request $request,$directory = null,$nameinput,$directorysend,$thumb)
    {
        $uploaded_file = $request->files->all() ;
        if(!empty($uploaded_file)) {
            $pictutre_file = $uploaded_file[$nameinput]['file'][0];
            if($pictutre_file != null){
                if (in_array($pictutre_file->getMimeType(), array("image/jpg", "image/gif", "image/tiff", "image/jpeg","image/png"))) {
                    $propertiesDir = $directory;
                    $fileName = md5(uniqid()) . '.' . $pictutre_file->guessExtension();
                    $pictutre_file->move($propertiesDir, $fileName);
                    $filefullname = $propertiesDir . $fileName;
                }
            }else{
               if(!empty($thumb)){
                   $fileName = $thumb;
               }else{
                   $fileName = "";
               }
            }

            }
        return $fileName;
        }

    public function pageuploadimageAction(Request $request,$directory = null,$nameinput,$directorysend,$thumb)
    {
        $uploaded_file = $request->files->all() ;
        $data = array();
        if(!empty($uploaded_file)) {
            $pictutre_file = $uploaded_file[$nameinput]['file'];
     
            foreach($pictutre_file as $v){
                if($v != null){
                    if (in_array($v->getMimeType(), array("image/jpg", "image/gif", "image/tiff", "image/jpeg","image/png"))) {
                        $propertiesDir = $directory;
                        $fileName = md5(uniqid()) . '.' . $v->guessExtension();
                        $v->move($propertiesDir, $fileName);
                        $filefullname = $propertiesDir . $fileName;
                        $size = $v->getClientSize();
                        $data[] = array('name'=>$fileName,'size'=>$size);

                    }
                }else{
                    if(!empty($thumb)){
                        $fileName = $thumb;
                    }else{
                        $fileName = "";
                    }
                }

            }
        }
        return array($data);
    }

}