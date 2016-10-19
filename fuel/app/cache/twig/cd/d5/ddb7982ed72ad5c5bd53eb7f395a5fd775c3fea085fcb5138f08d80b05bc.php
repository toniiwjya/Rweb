<?php

/* home.twig */
class __TwigTemplate_cdd5ddb7982ed72ad5c5bd53eb7f395a5fd775c3fea085fcb5138f08d80b05bc extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("pages/views/template_frontend.twig");

        $this->blocks = array(
            'frontend_content' => array($this, 'block_frontend_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "pages/views/template_frontend.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_frontend_content($context, array $blocks = array())
    {
        // line 4
        echo "\t<div class=\"\">
\t\tasdf
\t</div>
";
    }

    public function getTemplateName()
    {
        return "home.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 4,  28 => 3,);
    }
}
