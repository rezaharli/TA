<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'third_party/PHPWord/vendor/autoload.php';

class Phpword {

    function generateSertifikat($templateLocation, $data){
        setlocale(LC_TIME, "Indonesian");

        $path_sertifikat = 'assets/sertifikat/'.$data['sebagai'].'/'.$data['nama_acara']."_".$data['id_acara'];

        if ( ! file_exists($path_sertifikat)) {
            mkdir($path_sertifikat, 0777, true);
        }
        $templateProcessor = new PhpOffice\PhpWord\TemplateProcessor($templateLocation);
        $templateProcessor->setValue('nama', $data['nama']); // On section/content
        $templateProcessor->setValue('nama_acara', $data['nama_acara']); // On section/content

        $date       = $data['tanggal_acara'];
        $tanggal    = strftime("%d", strtotime($date));
        $bulan      = strftime("%B", strtotime($date));
        $tahun      = strftime("%Y", strtotime($date));

        $templateProcessor->setValue('tanggal', $tanggal); // On section/content
        $templateProcessor->setValue('bulan', $bulan); // On section/content
        $templateProcessor->setValue('tahun', $tahun); // On section/content
        $templateProcessor->setValue('sebagai', $data['sebagai']); // On section/content

        $templateProcessor->saveAs($path_sertifikat."/".$data['nama'].'.docx');

        return $path_sertifikat."/".$data['nama'].'.docx';
    }

}
