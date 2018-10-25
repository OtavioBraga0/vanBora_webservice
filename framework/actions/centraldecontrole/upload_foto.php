<?php
Controller::loadClass('core/upload'); 
Controller::loadClass('site/foto/foto'); 
Controller::loadClass('site/foto/fotoDB');

//$oFoto->iAlbumCodigo = 1;

$dir_dest = 'images/fotosAlbuns';

function multiple(array $_files, $top = TRUE)
{
    $files = array();
    foreach($_files as $name=>$file){
        if($top) $sub_name = $file['name'];
        else    $sub_name = $name;
        
        if(is_array($sub_name)){
            foreach(array_keys($sub_name) as $key){
                $files[$name][$key] = array(
                    'name'     => $file['name'][$key],
                    'type'     => $file['type'][$key],
                    'tmp_name' => $file['tmp_name'][$key],
                    'error'    => $file['error'][$key],
                    'size'     => $file['size'][$key],
                );
                $files[$name] = multiple($files[$name], FALSE);
            }
        }else{
            $files[$name] = $file;
        }
    }
    return $files;
}

$files = multiple($_FILES);

foreach ($files['uploads'] as $file) 
{
    $oFoto = new Foto();
    $oFoto->iAlbumCodigo = $_POST['inputAlbumCodigo'];
    
    $handle = new Upload( $file );
    if ( $handle->uploaded )
    {
        $handle->file_overwrite = true;
        $handle->image_convert = 'jpg';
        //Configuracoes de redimensionamento retrato
        $lMax  = 2000; //largura maxima permitida
        $aMax  = 1600; // altura maxima permitida
        //Configuracoes de redimensionamento paisagem
        $plMax = 1800; //largura maxima permitida
        $paMax = 1400; // altura maxima permitida


        if ( $handle->image_src_x > $handle->image_y )
        {
            if ( $handle->image_src_x > $lMax || $handle->image_y > $aMax )
            {
                $handle->image_resize = true;
                $handle->image_ratio = true;
                $handle->image_x = ($lMax / 2);
                $handle->image_y = ($aMax / 2);
            }
        }
        else
        {
            if ( $handle->image_src_x > $plMax || $handle->image_y > $paMax )
            {
                $handle->image_resize = true;
                $handle->image_ratio = true;
                $handle->image_x = ($plMax / 2);
                $handle->image_y = ($paMax / 2);
            }
        }

        $handle->file_new_name_body = md5( uniqid( $file['name'] ) );
        $handle->Process( $dir_dest );
        if ( $handle->processed )
        {
            $oFoto->sUrl     = $handle->file_dst_name;
            $oFoto->sData    = date( 'Y-m-d 00:00:00' );
            $oFoto->iPosicao = '999';
            
            $last_id = FotoDB::salvaFoto($oFoto);
            //$db->query( "insert into fotos (foto_album,foto_url,foto_data,foto_pos) values ($album_id,'$file_dst_name','$foto_data','999');" );
            //$file_dst_name .= "?v=" . time();
            //echo json_encode( array( 'url' => "$oFoto->sUrl", 'id' => $last_id, 'time' => time() ) );
        }
        else
        {
           // echo json_encode( array( 'url' => "error", 'id' => '', 'time' => time() ) );
        }
    }
    
    header('Location: ?pagina=centraldecontrole/album&edit='.$_POST['inputAlbumCodigo']);
}

?>