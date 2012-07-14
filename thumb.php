<?PHP

    $imagem   = urldecode($_GET['img']);
    $tamanhoW = $_GET['w'];
    $forcar   = 'X';


    if (file_exists($imagem)) {
        list($width, $height, $type, $attr) = getimagesize($imagem);
        if ($type == 1) {
            $im = imagecreatefromgif($imagem);
            //criar uma amostra da imagem original GIF
        } elseif ($type == 2) {
            $im = imagecreatefromjpeg($imagem);
            //criar uma amostra da imagem original JPEG
        } elseif ($type == 3) {
            $im = imagecreatefrompng($imagem);
            //criar uma amostra da imagem original PNG
        }
        //VERIFICA SE FOI FORÇADO ALGUMA LARGURA/ALTURA FIXA
        if ($forcar == 'X') {
            $largurao = $width;
            $alturao  = $height;
            $largurad = $tamanhoW;
            $alturad  = ($alturao * $largurad) / $largurao;
        } elseif ($forcar == 'Y') {
            $largurao = $width;
            $alturao  = $height;
            $alturad  = $tamanhoH;
            $largurad = ($largurao * $alturad) / $alturao;
        } elseif ($forcar == 'XY' or $forcar == 'YX') {
            $largurao = $width;
            $alturao  = $height;
            $alturad  = $tamanhoH;
            $largurad = $tamanhoW;
        } else {
            $largurao = $width;
            // pegar a largura da amostra
            $alturao  = $height;
            // pegar a altura da amostra
            
            if ($largurao >= $alturao){
                $largurad = $tamanhoW;
                // definir a largura da miniatura em px
                $alturad  = (($alturao * $largurad)/ $largurao);
                // calcula a largura da imagem a partir da largura da miniatura
            } else {
                $alturad  = $tamanhoH;
                // definir a altura da miniatura em px
                $largurad = (($largurao * $alturad) / $alturao);
                // calcula a largura da imagem a partir da altura da miniatura
            }
        }
        
        if ($type == 1)    {
            $nova = imagecreate($largurad, $alturad);
            //criar uma imagem em branco
        } else {
            $nova = imagecreatetruecolor($largurad, $alturad);
            //criar uma imagem em branco
        }
        
        imagecopyresampled($nova,$im,0,0,0,0, $largurad, $alturad, $largurao, $alturao);
        //copiar sobre a imagem em branco a amostra diminuindo conforma as especificacoes da miniatura
        
        if ($type == 1) {
            imagegif($nova);
            //cria imagem gif
        } elseif ($type == 2) {
            imagejpeg($nova, '', 99);
            //cria imagem jpeg
        } elseif ($type == 3) {
            imagepng($nova);
            //cria imagem png
        }
        
        imagedestroy($nova);
        //libera a memoria usada na miniatura
        imagedestroy($im);
        //libera a memoria usada na amostra
        // Fim da geracao de miniaturas
    } else {
        echo('Arquivo não encontrado.');
    }