<?php
// source: /var/www/html/nette/examples/Modules-Usage/app/FrontModule/presenters/templates/Default/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('4979763641', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb466a7e2f55_content')) { function _lb466a7e2f55_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><ul>
	<li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("addItem"), ENT_COMPAT) ?>
"><code>addItem</code></a> - link to view <code>addItem</code> in current presenter</li>
	<li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("CatalogList:"), ENT_COMPAT) ?>
"><code>CatalogList:</code></a> - link to presenter <code>CatalogList</code> in current module and view <code>default</code></li>
	<li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Export:Default:xml"), ENT_COMPAT) ?>
"><code>Export:Default:xml</code></a> - link to presenter <code>Default</code> in <code>Export</code> submodule and view <code>xml</code></li>
	<li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link(":Admin:Default:"), ENT_COMPAT) ?>
"><code>:Admin:Default:</code></a> - link to presenter <code>Default</code> in <code>Admin</code> module (view <code>default</code>)</li>
</ul>
<?php
}}

//
// end of blocks
//

// template extending

$_l->extends = empty($_g->extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $_g->extended = TRUE;

if ($_l->extends) { ob_start();}

// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 