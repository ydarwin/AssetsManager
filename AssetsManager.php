<?php
namespace App\Libraries;

class AssetsManager
{
    const ASSET_TYPE_CSS = 'css';
    const ASSET_TYPE_JS = 'js';

	private array $cssArray;
	private array $jsArray;
    private string $pathAssets;

    /**
    * Summary of __construct AssetsManager
    * @param string $pathAssets Path to assets folder
    */
	public function __construct(string $pathAssets)
    {
        $this->pathAssets = $pathAssets;

        $this->path_css = $this->pathAssets . 'css/';
		$this->path_js  = $this->pathAssets . 'js/';

		$this->clear();
	}

    /**
    * Remove all assets
    * @return void
    */
	public function clear() : void
    {
		$this->cssArray  = [];
		$this->jsArray  = [];
	}

    private function _add(string $assetType, string|array $filename, bool $defaultPath = true) : void
    {
        $filesArray = [];

        if (is_string($filename)) {
            $filesArray[] = $filename;
        } elseif (is_array($filename) && !empty($filename)) {
            $filesArray = $filename;
        }
        unset($filename);

        foreach ($filesArray as $item) {
            switch ($assetType) {
                case self::ASSET_TYPE_CSS:
                    $fullPath = $defaultPath === true ? ($this->path_css . $item) : $item;
                    $this->cssArray[] = $fullPath;
                    break;
                case self::ASSET_TYPE_JS:
                    $fullPath = $defaultPath === true ? ($this->path_js . $item) : $item;
                    $this->jsArray[] = $fullPath;
                    break;
            }
        }
    }

    /**
     * Add one or more css files
     * @param mixed $filename Add one or more css files, can be string or array
     * @param bool $defaultPath Set false to use custom path from $filename, default is true
     * @return void
     */
    public function addCSS(string|array $filename, bool $defaultPath = true) : void
    {
        $this->_add(self::ASSET_TYPE_CSS, $filename, $defaultPath);
    }

    /**
     * Add one or more js files
     * @param mixed $filename Add one or more js files, can be string or array
     * @param bool $defaultPath Set false to use custom from in $filename, default is true
     * @return void
     */
    public function addJS(string|array $filename, bool $defaultPath = true) : void
    {
        $this->_add(self::ASSET_TYPE_JS, $filename, $defaultPath);
    }

    private function _render(string $assetType) : string
    {
        $output = '';

        switch ($assetType) {
            case self::ASSET_TYPE_CSS:
                foreach ($this->cssArray as $item) {
                    $output .= sprintf('<link rel="stylesheet" href="%s" />%s', $item, PHP_EOL);
                }
                break;
            case self::ASSET_TYPE_JS:
                foreach ($this->jsArray as $item) {
                    $output .= sprintf('<script src="%s" type="text/javascript"></script>%s', $item, PHP_EOL);
                }
                break;
        }

        return $output;
    }

    /**
     * Get all css files for use in HTML
     * @return string
     */
    public function renderCSS() : string
    {
        return $this->_render(self::ASSET_TYPE_CSS);
    }

    /**
     * Get all js files for use in HTML
     * @return string
     */
    public function renderJS() : string
    {
        return $this->_render(self::ASSET_TYPE_JS);
    }
}

/* End of file: AssetsManager.php */