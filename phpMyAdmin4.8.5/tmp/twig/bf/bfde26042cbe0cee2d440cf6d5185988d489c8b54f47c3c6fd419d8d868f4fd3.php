<?php

/* display/export/options_output_compression.twig */
class __TwigTemplate_e5efb07cb37f04b215a9b3e628d78ecf9460be8b4d30a355d0c6d2e8b6f6f9ce extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        if (((isset($context["is_zip"]) ? $context["is_zip"] : null) || (isset($context["is_gzip"]) ? $context["is_gzip"] : null))) {
            // line 2
            echo "    <li>
        <label for=\"compression\" class=\"desc\">
            ";
            // line 4
            echo _gettext("Compression:");
            // line 5
            echo "        </label>
        <select id=\"compression\" name=\"compression\">
            <option value=\"none\">";
            // line 7
            echo _gettext("None");
            echo "</option>
            ";
            // line 8
            if ((isset($context["is_zip"]) ? $context["is_zip"] : null)) {
                // line 9
                echo "                <option value=\"zip\"";
                // line 10
                echo ((((isset($context["selected_compression"]) ? $context["selected_compression"] : null) == "zip")) ? (" selected") : (""));
                echo ">
                    ";
                // line 11
                echo _gettext("zipped");
                // line 12
                echo "                </option>
            ";
            }
            // line 14
            echo "            ";
            if ((isset($context["is_gzip"]) ? $context["is_gzip"] : null)) {
                // line 15
                echo "                <option value=\"gzip\"";
                // line 16
                echo ((((isset($context["selected_compression"]) ? $context["selected_compression"] : null) == "gzip")) ? (" selected") : (""));
                echo ">
                    ";
                // line 17
                echo _gettext("gzipped");
                // line 18
                echo "                </option>
            ";
            }
            // line 20
            echo "        </select>
    </li>
";
        } else {
            // line 23
            echo "    <input type=\"hidden\" name=\"compression\" value=\"";
            echo twig_escape_filter($this->env, (isset($context["selected_compression"]) ? $context["selected_compression"] : null), "html", null, true);
            echo "\">
";
        }
    }

    public function getTemplateName()
    {
        return "display/export/options_output_compression.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  69 => 23,  64 => 20,  60 => 18,  58 => 17,  54 => 16,  52 => 15,  49 => 14,  45 => 12,  43 => 11,  39 => 10,  37 => 9,  35 => 8,  31 => 7,  27 => 5,  25 => 4,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "display/export/options_output_compression.twig", "D:\\phpstudy\\phpstudy_pro\\WWW\\tanbeifeng.cn\\phpMyAdmin4.8.5\\templates\\display\\export\\options_output_compression.twig");
    }
}
