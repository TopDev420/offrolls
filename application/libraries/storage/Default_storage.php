<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* Description of Default Storage
*/


class Default_storage{

    private $CI;

    public function __construct(){
        $this->CI = & get_instance();
        
    }	

    public function uploadBlobFile($file) {
        $nfilename = $file['newname'] . '.' . $file['extension'];
        $filename = $file['upload_path'] . $nfilename;
        $im = imagecreatefromstring(file_get_contents($file['blob']));
        if(imagepng($im, $filename)){
            return array(
                'status' => true,
                'name' => $nfilename
            ); 
        } else {
            return array(
                'status' => false,
                'message' => 'Image not uploaded!'
            );
        }

    }

    public function uploadFile($file) {
        $config['upload_path'] = $file['upload_path'];
        $config['allowed_types'] = $file['allowed_types'];
        $config['overwrite'] = TRUE;
        $config['file_name'] = $file['newname'];;

        $this->CI->load->library('upload', $config);
        $this->CI->upload->initialize($config);

        if($this->CI->upload->do_upload($file['upload_file'])) {
            $uploadData =  $this->CI->upload->data();
            return array(
                'status' => true,
                'name' => $uploadData['file_name']
            );
        } else {
            return array(
                'status' => false,
                'message' => $this->upload->display_errors()
            );
        }
        
    }

    public function deleteFile($file){
        //Unlink Existing Image
        if(is_readable($file)){
            unlink($file);
        }
}

}