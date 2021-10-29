<?php

namespace App\Controller;

use App\Service\mPdfService;

class DefaultController
{
    const HOME_DIR = __DIR__ . '/../../public/';
    const ASSETS_DIR = __DIR__ . '/../../assets/';
    const FONT_DIR = self::ASSETS_DIR . 'fonts/';
    const IMAGE_DIR = self::ASSETS_DIR . 'images/';

    public function indexAction(): void
    {
        $filename = 'demonstration.pdf';

        $pdfService = new mPdfService();
        $pdfService->generateDemoPDF('demonstration.pdf');

        echo "
            <h2>PDF generation successful!</h2>
            <p>Check the file here: <a href=\"$filename\">/public/$filename</a></p>
            <hr>
            <h2>About</h2>
            <h3>Embedding fonts</h3>
            <p>
                This demonstration is about embedding different font-styles to mPDF. Due to the design it has, it's only
                possible to embed regular and bold fonts. With a little workaround we can embed more font-styles. 
                Read more about its font integration 
                <a href='https://mpdf.github.io/fonts-languages/fonts-in-mpdf-7-x.html'>here</a>. 
            </p>
            <h3>Embedding images</h3>
            <p>
                Somehow, there should be a way to embed images by referencing the source. I've tried it, and it didn't
                work out for me. However, a good workaround here is embedding the image in a base64 encoded string.
            </p>
            "
        ;
    }
}