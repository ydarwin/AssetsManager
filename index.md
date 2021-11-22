## Welcome to AssetsManager Library for CodeIgniter 4

## Controller Example

**Using the Library**
```php
use App\Libraries\AssetsManager;
```

**In your Controller**
```php
public function index() {
  $assetsManager = new AssetsManager('https://yourDomain.com/public/assets/');
  $assetsManager->addCSS('bootstrap.min.css'); // Add single css file
  $assetsManager->addCSS(['bootstrap.min.css', 'othercssfile.css']); // Add multiple css file
  
  $assetsManager->addJS('jquery.min.js'); // Add single css file
  $assetsManager->addJS(['jquery.min.js', 'otherjsfile.css']); // Add multiple js file
  
  view('myview, ['assetsManager' => $assetsManager]);  
}
```
**In your View**
```php
<?php
echo $assetsManager->renderCSS(); // for use in header by example

echo $assetsManager->renderJS(); // for use in footer by example
?>
```
## Other methods in AssetsManager Library
**public function clear()**
reset the assets list

Example:
$assetsManager->addCSS('filecss.css);
echo $assetsManager->renderCSS();
$assetsManager->clear();

$assetsManager->addCSS('otherfile.css);
echo $assetsManager->renderCSS();

**public function addCSS(string|array $filename, bool $defaultPath = true) : void**
$filename Allow add css file or files
$defaultPath if false you can add css like this $assetsManager->addCSS('http://otherDomain.com/file.css')

**public function addJS(string|array $filename, bool $defaultPath = true) : void**
$filename Allow add js file or files
$defaultPath if false you can add css like this $assetsManager->addCSS('http://otherDomain.com/file.js')

**public function renderCSS() : string**
Return the css files in browser, example of output
<link rel="stylesheet" href="myfile.css" />

**public function renderJS() : string**
Return the js files in browser, example of output
<script type="text/javascript" src="myfile.js">
