<?php
/**
 * Created by PhpStorm.
 * User: shady
 * Date: 12/26/18
 * Time: 9:31 AM
 */
require __DIR__ . '/vendor/autoload.php';

class Files
{
    const FOLDER_NAME="upload";

    private $app;
    private $repo;
    /**
     * Files constructor.
     */
    public function __construct(SfsApplication $app)
    {
        $this->app = $app;
        $config = new \JamesMoss\Flywheel\Config(__DIR__.'/db');
        $this->repo = new \JamesMoss\Flywheel\Repository('files', $config);
    }

    /**
     * @return \JamesMoss\Flywheel\Repository
     */
    public function getRepo()
    {
        return $this->repo;
    }

    /**
     * @param \JamesMoss\Flywheel\Repository $repo
     */
    public function setRepo($repo)
    {
        $this->repo = $repo;
    }

    public function createFile($filename, $path, $url){
        $file = new \JamesMoss\Flywheel\Document(array(
            'name'     => $filename,
            'dateAdded' => date("Y-m-d h:i:s"),
            'path'      => $path,
            'url'       => $url,
        ));
        $this->saveFile($file);
    }

    public function saveFile( $file )
    {
        $this->getRepo()->store($file);
    }

    public function getAllFiles()
    {
        $files = $this->repo->query()
            ->orderBy('dateAdded DESC')
            ->execute();
        return $files;
    }



    public static function _getFiles()
    {
        $files_list = array();
        $dir = __DIR__ . '/upload';
        try{
            if ($handle = opendir($dir)) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
                        $files_list[] = array(
                            'filename' =>	$entry,
                            'filesize' => filesize($dir.DIRECTORY_SEPARATOR.$entry),
                            'modified' => date("F d Y H:i:s.",filemtime($dir.DIRECTORY_SEPARATOR.$entry))
                        );
                    }
                }
                closedir($handle);
            }
        }catch (FileNotFoundException $e){

        }
        return $files_list;
    }

    public function getDatedFolder()
    {
        $year = date('Y');
        $day = date('m');
        $this->createCurrentFolder($year, $day);
        return $this->app->getBaseDir() . '/' . self::FOLDER_NAME . '/' . $year . '/' . $day;
    }

    public function getDatedUrl( $file )
    {
        $year = date('Y');
        $day = date('m');
        $baseUrl = Helper::baseUrl();
        return $baseUrl . '/'
            . self::FOLDER_NAME . '/'
            . $year . '/' . $day . '/' . $file;
    }


    private function createCurrentFolder($year, $day)
    {
        $new_path = $this->createPath(array(self::FOLDER_NAME,$year, $day));
        if(!file_exists($new_path)){
            mkdir($new_path,0777,true);
        }
    }

    private function createPath($params)
    {
        $base = $_SERVER['DOCUMENT_ROOT'] . '/';
        $path ='';
        foreach($params as $folder ){
            $path .= $folder . '/';
        }
        echo $base .$path;
        return $base . $path;
    }

    public function randomName($num = 6)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $string = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < $num; $i++) {
            $string .= $characters[mt_rand(0, $max)];
        }
        return $string;
    }

}