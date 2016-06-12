<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'third_party/PHPWord/vendor/autoload.php';

class Phpword {

    function generateSertifikat($templateLocation, $data){
        setlocale(LC_TIME, "Indonesian");
        if (!file_exists($data['nama_acara']."_".$data['id_acara'])) {
            mkdir($data['nama_acara']."_".$data['id_acara']);
        }
        $templateProcessor = new PhpOffice\PhpWord\TemplateProcessor($templateLocation);
        $templateProcessor->setValue('nama', $data['nama']); // On section/content
        $templateProcessor->setValue('NAMA_ACARA', $data['nama_acara']); // On section/content
        $date = $data['tanggal_acara'];
        $tanggal = strftime("%d", strtotime($date));
        $bulan = strftime("%B", strtotime($date));
        $tahun = strftime("%Y", strtotime($date));
        $templateProcessor->setValue('TANGGAL', $tanggal); // On section/content
        $templateProcessor->setValue('BULAN', $bulan); // On section/content
        $templateProcessor->setValue('TAHUN', $tahun); // On section/content
        $templateProcessor->saveAs($data['nama_acara']."_".$data['id_acara']."/".$data['nama'].'.docx');

        return $data['nama_acara']."_".$data['id_acara']."/".$data['nama'].'.docx';
    }

}
