<?php
// source: /var/www/html/nette/examples/Modules-Usage/app/AdminModule/presenters/templates/@layout.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('6682869792', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Modules demo</title>
	<link rel="stylesheet" media="screen" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/site.css">
</head>

<body>
	<h1>Modules demo</h1>

	<div id="path">
		<span id="module"><?php echo Latte\Runtime\Filters::escapeHtml($moduleName, ENT_NOQUOTES) ?>
<span id="presenter"><?php echo Latte\Runtime\Filters::escapeHtml($presenterName, ENT_NOQUOTES) ?>
:<span id="view"><?php echo Latte\Runtime\Filters::escapeHtml($viewName, ENT_NOQUOTES) ?></span></span></span>
	</div>

	<fieldset>
		<legend>This is layout template <code><?php echo Latte\Runtime\Filters::escapeHtml($template->replace($template->getName(), $root), ENT_NOQUOTES) ?></code></legend>

		<fieldset>
			<legend>This is content block template <code><?php echo Latte\Runtime\Filters::escapeHtml($template->replace($presenter->template->getFile(), $root), ENT_NOQUOTES) ?></code></legend>
<?php Latte\Macros\BlockMacros::callBlock($_b, 'content', $template->getParameters()) ?>
		</fieldset>


		<h2>Absolute links</h2>
		<ul>
			<li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Front:Default:"), ENT_COMPAT) ?>
"><code>:Front:Default:</code></a> - link to presenter <code>Front:Default</code></li>
			<li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Admin:Default:"), ENT_COMPAT) ?>
"><code>:Admin:Default:</code></a> - link to presenter <code>Admin:Default</code></li>
		</ul>
	</fieldset>
</body>
</html>
