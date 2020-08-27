<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;
use Cake\Utility\Text;

/**
 * Utiles component
 */
class UtilesComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];


    /**
     * Responder
     *
     * @param array $data
     * @return Response
     */
    public function responder($data)
    {
        $response = $this->response;
        $response = $response->withType('application/json')
            ->withStringBody(json_encode($data));
        return $response;
    }

    /**
     * Función para subida de imagenes
     *
     * @param mixed $file
     * @param string $destino
     * @param string|null $imagenAnt
     * @return array
     */
    public function imagenes($file, $destino, $imagenAnt = null)
    {
        $r = ['estado' => false, 'mensaje' => '', 'imagen' => ''];
        $f = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']; //Formatos permitidos

        $existe_destino = false;
        if(is_dir($destino)){
            $existe_destino = true;
        }else{
            if(@mkdir($destino, 0777, true)) $existe_destino = true; 
        }
       
        if ($existe_destino) {
            if (!empty($file['name'])) {
                if (in_array($file['type'], $f)) {
                    
                    //Redimención de imagen
                    list($ancho, $alto) = getimagesize($file['tmp_name']); //Obtengo el tamaño de la imagen
                    
                    //Resolución permitida
                    $max_ancho = 1080; //800;
                    $max_alto = 720; //600;

                    if($ancho > 1280 OR $file['size'] > 100000){ //Si es mayor a 100KB o ancho mayor a 1280px
                        if($file['type']=='image/jpeg'){
                            $original = imagecreatefromjpeg($file['tmp_name']);
                        } elseif($file['type']=='image/png'){
                            $original = imagecreatefrompng($file['tmp_name']);
                        } elseif($file['type']=='image/gif'){
                            $original = imagecreatefromgif($file['tmp_name']);
                        }
                        
                        $x_ratio = $max_ancho / $ancho;
                        $y_ratio = $max_alto / $alto;

                        if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){
                            $ancho_final = $ancho;
                            $alto_final = $alto;
                        } elseif (($x_ratio * $alto) < $max_alto){
                            $alto_final = ceil($x_ratio * $alto);
                            $ancho_final = $max_ancho;
                        } else{
                            $ancho_final = ceil($y_ratio * $ancho);
                            $alto_final = $max_alto;
                        }

                        $lienzo=imagecreatetruecolor($ancho_final,$alto_final); 
                        
                        imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);

                        if($file['type']=='image/jpeg'){
                            imagejpeg($lienzo, $file['tmp_name'], 100);
                        } else if($file['type']=='image/png'){
                            imagepng($lienzo, $file['tmp_name'], 9);
                        } else if($file['type']=='image/gif'){
                            imagegif($lienzo, $file['tmp_name']);
                        }
                    }
                    
                    //Rotación de imagen
                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1);

                    if (function_exists('exif_read_data') AND !in_array($ext, ["bmp","gif","png"])){
                        $exif = exif_read_data($file['tmp_name']);

                        if($exif && isset($exif['Orientation'])){
                            $orientation = $exif['Orientation'];
                            if($orientation != 1){
                                $img = imagecreatefromjpeg($file['tmp_name']);
                                $deg = 0;
                                switch ($orientation) {
                                    case 3:
                                        $deg = 180;
                                    break;
                                    case 6:
                                        $deg = 270;
                                    break;
                                    case 8:
                                        $deg = 90;
                                    break;
                                }
                                if ($deg) {
                                    $img = imagerotate($img, $deg, 0);        
                                }
                                // then rewrite the rotated image back to the disk as $filename 
                                imagejpeg($img, $file['tmp_name'], 100);
                                $ext = "jpg";
                            } // if there is some rotation necessary
                        } // if have the exif orientation info
                    }

                    $nn = uniqid();
                    
                    if(move_uploaded_file($file['tmp_name'], $destino.$nn.'.'.$ext)){
                        $r['imagen']    = $nn.'.'.$ext;
                        $r['mensaje']   = __("La imagen se subió correctamente");
                        $r['estado']    = true;
                        $r['size']      = $file['size'];

                        if(!empty($imagenAnt)){
                            if($imagenAnt != "default.png"){
                                @unlink($destino.$imagenAnt);
                            }
                        }
                    } else{ 
                        $r["mensaje"] = __("Ocurrió un error al guardar imagen.");
                    }
                } else{ 
                    $r["mensaje"] = __("El formato de imagen es incorrecto."); 
                }
            } else{ 
                $r["mensaje"] = __("La imagen no se subió correctamente."); 
            }
        } else{ 
            $r["mensaje"] = __("La carpeta donde intenta guardar la imagen, no existe y no pudo ser creada."); 
        }
        
        return $r;
    }




     /**
     * Undocumented function
     *
     * @param [type] $ruta
     * @return void
     */
    public function archivos($i, $destino, $archivoAnt = null)
    {

        $r = ['estado' => false, 'mensaje' => '', 'archivo' => ''];
        $f = [
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/msword',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 
            'application/vnd.ms-powerpoint', 
            'text/plain', 
            'application/pdf',
            'text/csv'
        ];
        
        if(!is_dir($destino)){ @mkdir($destino, 0777, true); } //Si no exite lo creo.

        if (!empty($i['name'])) {

            if (in_array($i['type'], $f)) {

                $ext = substr(strtolower(strrchr($i['name'], '.')), 1);
                $nn = uniqid();
                $re = move_uploaded_file($i['tmp_name'], $destino.$nn.'.'.$ext);

                if ($re) {
                    $r['archivo']    = $nn.'.'.$ext;
                    $r['mensaje']   = __("El archivo se subió correctamente");
                    $r['estado']    = true;

                    if(!empty($archivoAnt)){
                        if($archivoAnt != ""){
                            @unlink($destino.$archivoAnt);
                        }
                    }
                }else{
                    $r["mensaje"] = __("ocurrió un error al guardar el archivo.");    
                }
            }else{
                $r["mensaje"] = __("El formato es incorrecto, sólo acepta archivos de word, excel, powerpoint, texto o pdf.");
            }
        }else{
            $r["mensaje"] = __("El archivo no se subió correctamente.");
        }
        return $r;
    }

    /* 
    * Sirve para pasarle un string y quitarle los acentos, caracteres espciales, etc.
    * Devuelve el mismo totalmente limpio.
    */ 
    public function limpiarString($string) {

        $caracteres = [
            'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 
            'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 
            'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U','Ú'=>'U', 'Û'=>'U', 
            'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 
            'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 
            'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 
            'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', '¨' => '-', 'º' => '-','~' => '-', "#" => '-', "@" => '-',
            "|" => '-', "!" => '-', "·" => '-', "$" => '-', "%" => '-', "&" => '-', "/" => '-', "(", ")" => '-', 
            "?" => '-', "'" => '-', "¡" => '-', "¿" => '-', "[" => '-', "^" => '-', "`" => '-', "]" => '-', "+" => '-',
            "}" => '-', "{" => '-', "¨" => '-', "´" => '-', ">" => '-', "< " => '-', ";" => '-', "," => '-', ":" => '-',
            " " => '-'
        ];

        $string = utf8_encode($string);

        $string = strtr(mb_strtolower($string), $caracteres);
    
        return $string;
    }


    /**
	 * Método para generar slugs 
     * 
     * Si se enviá modelo y campo hace una búsqueda en la DB pra comprobar
     * si ya existe y devuelve una alternativa.
     * 
     * ** Devuelve
     * 
     * Slug en formato string
	 *
	 * @param string $frase
	 * @param string|null $modelo
	 * @param string|null $campo
	 * @return string $slug
	 */
	public static function slugMeiquer($frase, $modelo = null, $campo = null)
	{
        try {
            if(empty($frase)) { return ''; }
            
            $stop_words = [
				'a', 'acá', 'ahí', 'ajena', 'ajeno', 'ajenas', 'ajenos', 'al', 'algo', 'algún', 'alguna', 'alguno', 'algunas', 'algunos', 'allá', 'allí', 'ambos', 'ante', 'antes', 'aquel', 'aquella', 'aquellas', 'aquello', 'aquellos', 'aquí', 'arriba', 'así', 'atrás', 'aun', 'aunque', 'bajo', 'bastante', 'bien', 'cabe', 'cada', 'casi', 'cierto', 'cierta', 'ciertos', 'ciertas', 'como', 'con', 'conmigo', 'conseguimos', 'conseguir', 'consigo', 'consigue', 'consiguen', 'consigues', 'contigo', 'contra', 'cual', 'cuales', 'cualquier', 'cualquiera', 'cualquieras', 'cuan', 'cuando', 'cuanto', 'cuanta', 'cuantos', 'cuantas', 'de', 'dejar', 'del', 'demás', 'demasiada', 'demasiado', 'demasiadas', 'demasiados', 'dentro', 'desde', 'donde', 'dos', 'el', 'él', 'ella', 'ello', 'ellas', 'ellos', 'empleáis', 'emplean', 'emplear', 'empleas', 'empleo', 'en', 'encima', 'entonces', 'entre', 'era', 'eras', 'eramos', 'eran', 'eres', 'es', 'esa', 'ese', 'eso', 'esas', 'eses', 'esos', 'esta', 'estas', 'estaba', 'estado', 'estáis', 'estamos', 'están', 'estar', 'este', 'esto', 'estes', 'estos', 'estoy', 'etc', 'fin', 'fue', 'fueron', 'fui', 'fuimos', 'gueno', 'ha', 'hace', 'haces', 'hacéis', 'hacemos', 'hacen', 'hacer', 'hacia', 'hago', 'hasta', 'incluso', 'intenta', 'intentas', 'intentáis', 'intentamos', 'intentan', 'intentar', 'intento', 'ir', 'jamás', 'junto', 'juntos', 'la', 'lo', 'las', 'los', 'largo', 'más', 'me', 'menos', 'mi', 'mis', 'mía', 'mías', 'mientras', 'mío', 'míos', 'misma', 'mismo', 'mismas', 'mismos', 'modo', 'mucha', 'muchas', 'muchísima', 'muchísimo', 'muchísimas', 'muchísimos', 'mucho', 'muchos', 'muy', 'nada', 'ni', 'ningún', 'ninguna', 'ninguno', 'ningunas', 'ningunos', 'no', 'nos', 'nosotras', 'nosotros', 'nuestra', 'nuestras', 'nuestro', 'nuestros', 'nunca', 'os', 'otra', 'otro', 'otras', 'otros', 'para', 'parecer', 'pero', 'poca', 'pocas', 'poco', 'pocos', 'podéis', 'podemos', 'poder', 'podría', 'podrías', 'podríais', 'podríamos', 'podrían', 'por', 'por qué', 'porque', 'primero', 'puede', 'pueden', 'puedo', 'pues', 'que', 'qué', 'querer', 'quién', 'quiénes', 'quienesquiera', 'quienquiera', 'quizá', 'quizás', 'sabe', 'sabes', 'saben', 'sabéis', 'sabemos', 'saber', 'se', 'según', 'ser', 'si', 'sí', 'siempre', 'siendo', 'sin', 'sino', 'so', 'sobre', 'sois', 'solamente', 'solo', 'sólo', 'somos', 'soy', 'sr', 'sra', 'sres', 'sta', 'su', 'sus', 'suya', 'suyas', 'suyo', 'suyos', 'tal', 'tales', 'también', 'tampoco', 'tan', 'tanta', 'tantas', 'tanto', 'tantos', 'te', 'tenéis', 'tenemos', 'tener', 'tengo', 'ti', 'tiempo', 'tiene', 'tienen', 'toda', 'todas', 'todo', 'todos', 'tomar', 'trabaja', 'trabajo', 'trabajáis', 'trabajamos', 'trabajan', 'trabajar', 'trabajas', 'tras', 'tú', 'tu', 'tus', 'tuya', 'tuyas', 'tuyo', 'tuyos', 'último', 'ultimo', 'un', 'una', 'unas', 'uno', 'unos', 'usa', 'usas', 'usáis', 'usamos', 'usan', 'usar', 'uso', 'usted', 'ustedes', 'va', 'van', 'vais', 'valor', 'vamos', 'varias', 'varios', 'vaya', 'verdadera', 'vosotras', 'vosotros', 'voy', 'vuestra', 'vuestras', 'vuestro', 'vuestros', 'y', 'ya', 'yo'
			];
			$caracteres_esp = ['/', '-', '_', '?', '¿', '\\', '"', '\'', '!', '¡'];
			$acentos = [
				'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
				'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
				'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
				'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
				'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y'
			];
            
			$frase = strtr(mb_strtolower($frase), $acentos);
            $frase_sin_caracteres = str_replace($caracteres_esp, " ", $frase);
			$array_frase = explode(' ', $frase_sin_caracteres);
			
            foreach ($array_frase as $k => $v) {
                if(in_array($v, $stop_words)) unset($array_frase[$k]);
			}
			
            $frase_nueva = implode(' ', $array_frase);
            $slug = Text::slug($frase_nueva);

            if (!empty($modelo) && !empty($campo)) {
                $tabla = TableRegistry::getTableLocator()->get($modelo);
                $num = []; $maximo = 0;
    
                $existe_slug = $tabla->find()
                    ->select($campo)
                    ->where([$campo => $slug])
                    ->enableHydration(false)
                    ->first();
    
                if ($existe_slug) {
                    $busco_otros_slug = $tabla->find()
                        ->select($campo)
                        ->where([$campo . ' LIKE' => ('%'.$slug.'%')])
                        ->enableHydration(false);
    
                    if($busco_otros_slug->count() > 0){
                        foreach ($busco_otros_slug as $k => $s) {
                            $replace = str_replace($slug, "", $s[$campo]);
                            if (!empty($replace) AND is_numeric($replace)) {
                                $num[] = (int)$replace;
                            }
                        }
                        if(!empty($num)) $maximo = max($num);
                        $slug .= ($maximo+1);
                    }
                }
            }

            return mb_strtolower($slug);
            
        } catch (\Exception $e) {
            return '';
        }
    }
}
