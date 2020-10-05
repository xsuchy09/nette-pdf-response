# nette-pdf-response
PdfResponse for Nette.

## Install
```composer
composer require xsuchy09/nette-pdf-response
```

## Usage
```php
class SomePresenter extends BasePresenter
{
	public function actionDefault()
	{
		// $pdfCreator is yours pdf library
		$pdfCreator = new ...
		//  which will return pdf as data here
		$data = $pdfCreator->getData();

		$response = new \xsuchy09\Application\Responses\PdfResponse($data, 'download.pdf');
		$this->sendResponse($response);
	}
}
```