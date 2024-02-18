<?php

namespace Binjuhor\Blade;

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

	public function __construct($view, $cache)
	{
		$this->dispatcher = new Dispatcher(new Container);
		$this->files = new Filesystem;
		$this->engineResolver = new EngineResolver;

		$this->finder = new FileViewFinder($this->files, [__DIR__ . $view]);
		$this->compiler = new BladeCompiler($this->files, __DIR__ . $cache);

		$this->engineResolver->register('blade', function () {
			return new CompilerEngine($this->compiler);
		});

		$this->factory = new Factory($this->engineResolver, $this->finder, $this->dispatcher);
	}

	public function render($view, $data = [])
	{
		return $this->factory->make($view, $data)->render();
	}
}
