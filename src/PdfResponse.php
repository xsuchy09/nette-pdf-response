<?php
/******************************************************************************
 * Author: Petr Suchy (xsuchy09) <suchy@wamos.cz> <https://www.wamos.cz>
 * Project: xsuchy09-pdfresponse
 * Date: 18.02.20
 * Time: 8:03
 * Copyright: (c) Petr Suchy (xsuchy09) <suchy@wamos.cz> <http://www.wamos.cz>
 *****************************************************************************/


declare(strict_types=1);


namespace xsuchy09\Application\Responses;


use Nette;
use Nette\Application\IResponse;


/**
 * Class PdfResponse
 * @package xsuchy09\Application\Responses
 */
class PdfResponse implements IResponse
{

	/**
	 * @var string
	 */
	protected $data;

	/**
	 * @var string
	 */
	protected $filename;

	/**
	 * @var string
	 */
	protected $outputCharset = 'utf-8';

	/**
	 * @var string
	 */
	protected $contentType = 'application/pdf';

	/**
	 * PdfResponse constructor.
	 *
	 * @param string $data
	 * @param string $filename
	 */
	public function __construct(string $data, string $filename = 'output.pdf')
	{
		$this->data = $data;
		$this->filename = $filename;
	}

	/**
	 * @inheritDoc
	 */
	public function send(Nette\Http\IRequest $httpRequest, Nette\Http\IResponse $httpResponse): void
	{
		$httpResponse->setContentType($this->contentType, $this->outputCharset);
		$attachment = 'attachment';
		if (false === empty($this->filename)) {
			$attachment .= sprintf('; filename="%s"', $this->filename);
		}
		$httpResponse->setHeader('Content-Disposition', $attachment);
		$httpResponse->setHeader('Content-Length', (string)strlen($this->data));
		print $this->data;
	}

	/**
	 * @return string
	 */
	public function getData(): string
	{
		return $this->data;
	}

	/**
	 * @param string $data
	 *
	 * @return PdfResponse
	 */
	public function setData(string $data): PdfResponse
	{
		$this->data = $data;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getFilename(): string
	{
		return $this->filename;
	}

	/**
	 * @param string $filename
	 *
	 * @return PdfResponse
	 */
	public function setFilename(string $filename): PdfResponse
	{
		$this->filename = $filename;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getOutputCharset(): string
	{
		return $this->outputCharset;
	}

	/**
	 * @param string $outputCharset
	 *
	 * @return PdfResponse
	 */
	public function setOutputCharset(string $outputCharset): PdfResponse
	{
		$this->outputCharset = $outputCharset;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getContentType(): string
	{
		return $this->contentType;
	}

	/**
	 * @param string $contentType
	 *
	 * @return PdfResponse
	 */
	public function setContentType(string $contentType): PdfResponse
	{
		$this->contentType = $contentType;
		return $this;
	}
}