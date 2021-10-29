<?php

namespace App\Service;

use App\Controller\DefaultController;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use Mpdf\Mpdf;
use Mpdf\MpdfException;

class mPdfService
{
    public function generateDemoPDF(string $pdfName): void
    {
        try {
            $mpdf = new Mpdf($this->getFontConfiguration());
            $mpdf->WriteHTML(
                $this->getDemoHTML() .
                $this->getDemoImage()
            );
            $mpdf->Output(DefaultController::HOME_DIR . $pdfName);
        } catch (MpdfException $e) {
            printf("<h2>Error: Exception</h2><pre>%s: %s</pre>",
                (string)$e->getCode(),
                $e->getMessage()
            );
        }
    }

    /**
     * @return array
     */
    protected function getFontConfiguration(): array
    {
        $defaultConfig = (new ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        return [
            'fontDir' => array_merge($fontDirs, [
                DefaultController::FONT_DIR,
            ]),
            'fontdata' => $fontData + [
                'opensans-light' => [
                    'R' => 'opensans-light.ttf',
                ],
                'opensans-regular' => [
                    'R' => 'opensans-regular.ttf',
                ],
                'opensans-medium' => [
                    'R' => 'opensans-medium.ttf',
                ],
                'opensans-semibold' => [
                    'R' => 'opensans-semibold.ttf',
                ],
                'opensans-bold' => [
                    'R' => 'opensans-bold.ttf',
                ],
            ],
            'default_font' => 'opensans-regular'
        ];
    }

    /**
     * @return string
     */
    protected function getDemoHTML(): string
    {
        return '
            <h3 style="font-family: opensans-light, sans-serif;">Almost before we knew it, we had left the ground.</h3>
            <h3 style="font-family: opensans-regular, sans-serif;">Almost before we knew it, we had left the ground.</h3>
            <h3 style="font-family: opensans-medium, sans-serif;">Almost before we knew it, we had left the ground.</h3>
            <h3 style="font-family: opensans-semibold, sans-serif;">Almost before we knew it, we had left the ground.</h3>
            <h3 style="font-family: opensans-bold, sans-serif;">Almost before we knew it, we had left the ground.</h3>';
    }

    /**
     * @return string
     */
    protected function getDemoImage(): string
    {
        $imageConverter = new ImageConverterService();

        return $imageConverter->convertToBase64(DefaultController::IMAGE_DIR . '/data-analytics-concept.jpg');
    }
}