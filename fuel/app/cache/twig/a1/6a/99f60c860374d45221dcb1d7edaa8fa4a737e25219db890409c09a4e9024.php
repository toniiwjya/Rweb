<?php

/* pages/views/template_frontend.twig */
class __TwigTemplate_a16a99f60c860374d45221dcb1d7edaa8fa4a737e25219db890409c09a4e9024 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'frontend_content' => array($this, 'block_frontend_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<head>
<meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\">
    <meta charset=\"utf-8\" />
    <meta http-equiv=\"x-ua-compatible\" content=\"ie=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
    <title></title>
\t<link rel=\"stylesheet\" href=\"";
        // line 8
        echo Uri::base();
        echo "assets/foundation/css/foundation.min.css\"/>
\t<link rel=\"stylesheet\" href=\"";
        // line 9
        echo Uri::base();
        echo "assets/css/custom/style.css\" />
</head>

<body>
<div class=\"off-canvas-wrapper\">
  <div class=\"off-canvas-wrapper-inner\" data-off-canvas-wrapper>
    <!-- off-canvas title bar for 'small' screen -->
    <div class=\"title-bar\" data-responsive-toggle=\"widemenu\" data-hide-for=\"medium\">
      <div class=\"title-bar-left\">
        <a href=\"";
        // line 18
        echo (isset($context["base_url"]) ? $context["base_url"] : null);
        echo "\">
        \t<img src=\"";
        // line 19
        echo Uri::base();
        echo "/assets/css/images/R.png\" style=\"width: 100px\">
        </a>
        <span class=\"title-bar-title\">Rweb</span>

      </div>

      <div class=\"title-bar-right\">
        <button class=\"menu-icon\" type=\"button\" data-open=\"offCanvasRight\"></button>
      </div>

    </div>
    <!-- off-canvas right menu -->
    <div class=\"off-canvas position-right\" id=\"offCanvasRight\" data-off-canvas data-position=\"right\">

      <ul class=\"vertical dropdown menu\" data-dropdown-menu>

        <li><a href=\"right_item_1\">Promo</a></li>

        <li><a href=\"right_item_2\">Reward</a></li>

      </ul>

    </div>



    <!-- \"wider\" top-bar menu for 'medium' and up -->

    <div id=\"widemenu\" class=\"top-bar\">

      <div class=\"top-bar-left\">

        <ul class=\"dropdown menu\" data-dropdown-menu>

          <li class=\"menu-text\">Foundation</li>

          <li class=\"has-submenu\">

            <a href=\"#\">Item 1</a>

            <ul class=\"menu submenu vertical\" data-submenu>

              <li><a href=\"left_wide_11\">Left wide 1</a></li>

              <li><a href=\"left_wide_12\">Left wide 2</a></li>

              <li><a href=\"left_wide_13\">Left wide 3</a></li>

            </ul>

          </li>

          <li class=\"has-submenu\">

            <a href=\"#\">Item 2</a>

            <ul class=\"menu submenu vertical\" data-submenu>

              <li><a href=\"left_wide_21\">Left wide 1</a></li>

              <li><a href=\"left_wide_22\">Left wide 2</a></li>

              <li><a href=\"left_wide_23\">Left wide 3</a></li>

            </ul>

          </li>

        </ul>

      </div>

      <div class=\"top-bar-right\">

      </div>

    </div>



    <!-- original content goes in this container -->

    <div class=\"off-canvas-content\" data-off-canvas-content>

      <div class=\"row column\">

        ";
        // line 105
        $this->displayBlock('frontend_content', $context, $blocks);
        // line 106
        echo "
      </div>

    </div>

  <!-- close wrapper, no more content after this -->

  </div>

</div>

<script src=\"";
        // line 117
        echo Uri::base();
        echo "assets/foundation/js/vendor/jquery.js\"></script>
<script src=\"";
        // line 118
        echo Uri::base();
        echo "assets/foundation/js/vendor/what-input.js\"></script>
<script src=\"";
        // line 119
        echo Uri::base();
        echo "assets/foundation/js/vendor/foundation.min.js\"></script>
<script src=\"";
        // line 120
        echo Uri::base();
        echo "assets/foundation/js/app.js\"></script>
</body>
</html>
";
    }

    // line 105
    public function block_frontend_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "pages/views/template_frontend.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  173 => 105,  165 => 120,  161 => 119,  157 => 118,  153 => 117,  140 => 106,  138 => 105,  49 => 19,  45 => 18,  33 => 9,  29 => 8,  20 => 1,  31 => 4,  28 => 3,);
    }
}
