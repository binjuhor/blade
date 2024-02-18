<?php

namespace Binjuhor\Blade;

use GuzzleHttp\Client;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;

class BladeTemplate
{
	/**
	 * @var Dispatcher
	 */
	private $dispatcher;
	/**
	 * @var Filesystem
	 */
	private $files;
	/**
	 * @var EngineResolver
	 */
	private $engineResolver;
	/**
	 * @var FileViewFinder
	 */
	private $finder;
	/**
	 * @var Factory
	 */
	private $factory;
	/**
	 * @var BladeCompiler
	 */
	private $compiler;

	private $compileDir;

	private $url;

	public function __construct(array $settings)
	{
		$this->dispatcher = new Dispatcher(new Container);
		$this->files = new Filesystem;
		$this->engineResolver = new EngineResolver;

		$this->finder = new FileViewFinder($this->files, [$settings['view']]);
		$this->compiler = new BladeCompiler($this->files,  $settings['cache']);

		$this->engineResolver->register('blade', function () {
			return new CompilerEngine($this->compiler);
		});

		$this->compileDir = $settings['compileDir'];
		$this->url = $settings['url'];
		$this->factory = new Factory($this->engineResolver, $this->finder, $this->dispatcher);
	}

	public function render($view, $data = [])
	{
		return $this->factory->make($view, $data)->render();
	}

	public function compiles()
	{
		$client = new Client();
		$page = isset($_REQUEST['f']) ? $_REQUEST['f'] : 'index';
		$fullUrl = $this->url.'/?f=' . $page;
		if (!is_dir($this->compileDir))
		{
			mkdir($this->compileDir, 0777, true);
		}

		$response = $client->request('GET', $fullUrl);
		$html = $response->getBody();
		$this->files->put($this->compileDir.'/'.$page . '.html', $html);
		return true;
	}
}
