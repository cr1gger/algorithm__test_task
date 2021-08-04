<?php
require('fpdf.php');

class Cloner {
    private $path;
    private $allow_extensions;
    private $postfix = '.pdf';
    private $copyPath;

    public function __construct($path, $allow_extensions = ['php', 'html', 'js'])
    {
        if (empty($path)) throw new Exception('Argument --path cannot be empty');
        if (!is_dir($path)) throw new Exception('Path is not dir');

        $this->path = $path;
        $this->allow_extensions = $allow_extensions;

        $levelUp = $this->path . DIRECTORY_SEPARATOR .'..';
        $this->copyPath = $levelUp . DIRECTORY_SEPARATOR . 'Copy ' . basename($this->path);
    }
    public function start()
    {
        $this->scanAll($this->path, $this->copyPath);
    }

    /**
     * Копирует всю папку, конвертирую только разрешенные файлы в pdf
     * @param string $from
     * @param string $to
     */
    private function scanAll($from, $to) {
        if (is_dir($from)) {
            if (!is_dir($to)) mkdir($to);
            $files = scandir($from);
            foreach ($files as $file){
                if ($file != "." && $file != "..") {
                    $this->scanAll($from . DIRECTORY_SEPARATOR . $file, $to . DIRECTORY_SEPARATOR . $file);
                }
            }
        }
        else if (file_exists($from)) {
            $fileInfo = pathinfo($from);
            $ext = $fileInfo['extension'] ?? null;
            if (in_array($ext, $this->allow_extensions))
            {
                $fpdf = new FPDF();
                $fpdf->AddPage();
                $fpdf->SetFont('Arial','',14);
                $fpdf->Write(5, file_get_contents($from));
                $fpdf->Output('F', $to . $this->postfix, true);
            } else copy($from, $to);
        }
    }
}