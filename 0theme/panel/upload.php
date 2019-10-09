<?php
    $output_dir = "../storage/uploads/tmp/";
    if(isset($_FILES["estate-images-file"])){
        $ret = array();

        //	This is for custom errors;	
        /*	$custom_error= array();
        $custom_error['jquery-upload-file-error']="File already exists";
        echo json_encode($custom_error);
        die();
        */
        $error =$_FILES["estate-images-file"]["error"];
        //You need to handle  both cases
        //If Any browser does not support serializing of multiple files using FormData() 
        if(!is_array($_FILES["estate-images-file"]["name"])) //single file
        {
            $fileName = $_FILES["estate-images-file"]["name"];
            move_uploaded_file($_FILES["estate-images-file"]["tmp_name"],$output_dir.$fileName);
            $ret[]= $output_dir.$fileName;
        }
        else  //Multiple files, file[]
        {
            $fileCount = count($_FILES["estate-images-file"]["name"]);
            for($i=0; $i < $fileCount; $i++)
            {
            $fileName = $_FILES["estate-images-file"]["name"][$i];
            move_uploaded_file($_FILES["estate-images-file"]["tmp_name"][$i],$output_dir.$fileName);
            $ret[]= $output_dir.$fileName;
            }

        }
        echo json_encode($ret);
    }
?>