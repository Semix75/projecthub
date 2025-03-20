<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* voeux/index.html.twig */
class __TwigTemplate_6a3324a4281757913b7cf9c1581f342d extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "voeux/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "voeux/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "voeux/index.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Choix des projets";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        yield "<div class=\"container mt-4\">
    <h1 class=\"text-center\">Choisissez vos 5 projets préférés</h1>
    <p class=\"text-center\">
        <a href=\"";
        // line 9
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projets_index");
        yield "\">Voir la liste des projets</a>
    </p>

    ";
        // line 12
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 12, $this->source); })()), 'form_start');
        yield "

    <div class=\"row justify-content-center\">
        <div class=\"col-md-6\">
            <div class=\"card shadow-sm\">
                <div class=\"card-body\">
                    <p class=\"text-muted\">Sélectionnez vos projets préférés dans l'ordre de préférence.</p>

                    ";
        // line 20
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(range(1, 5));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 21
            yield "                        <div class=\"mb-3\">
                            ";
            // line 22
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 22, $this->source); })()), ("projet_" . $context["i"]), [], "any", false, false, false, 22), 'label');
            yield "
                            ";
            // line 23
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 23, $this->source); })()), ("projet_" . $context["i"]), [], "any", false, false, false, 23), 'widget', ["attr" => ["class" => "form-select choix-projet"]]);
            yield "
                            ";
            // line 24
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 24, $this->source); })()), ("projet_" . $context["i"]), [], "any", false, false, false, 24), 'errors');
            yield "
                        </div>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['i'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 27
        yield "
                    ";
        // line 28
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 28, $this->source); })()), "vars", [], "any", false, false, false, 28), "errors", [], "any", false, false, false, 28)) > 0)) {
            // line 29
            yield "                        <div class=\"alert alert-danger\">
                            ";
            // line 30
            yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 30, $this->source); })()), 'errors');
            yield "
                        </div>
                    ";
        }
        // line 33
        yield "
                    <div class=\"d-grid\">
                        <button type=\"submit\" class=\"btn btn-primary\">Envoyer mes choix</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    ";
        // line 42
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 42, $this->source); })()), 'form_end');
        yield "
</div>

<script>
    document.addEventListener(\"DOMContentLoaded\", function () {
        const selects = document.querySelectorAll(\".choix-projet\");

        function updateSelectOptions() {
            let selectedValues = new Set();
            selects.forEach(select => {
                if (select.value) {
                    selectedValues.add(select.value);
                }
            });

            selects.forEach(select => {
                [...select.options].forEach(option => {
                    option.disabled = selectedValues.has(option.value) && select.value !== option.value;
                });
            });
        }

        selects.forEach(select => select.addEventListener(\"change\", updateSelectOptions));
        updateSelectOptions();
    });
</script>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "voeux/index.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  171 => 42,  160 => 33,  154 => 30,  151 => 29,  149 => 28,  146 => 27,  137 => 24,  133 => 23,  129 => 22,  126 => 21,  122 => 20,  111 => 12,  105 => 9,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Choix des projets{% endblock %}

{% block body %}
<div class=\"container mt-4\">
    <h1 class=\"text-center\">Choisissez vos 5 projets préférés</h1>
    <p class=\"text-center\">
        <a href=\"{{ path('projets_index') }}\">Voir la liste des projets</a>
    </p>

    {{ form_start(form) }}

    <div class=\"row justify-content-center\">
        <div class=\"col-md-6\">
            <div class=\"card shadow-sm\">
                <div class=\"card-body\">
                    <p class=\"text-muted\">Sélectionnez vos projets préférés dans l'ordre de préférence.</p>

                    {% for i in 1..5 %}
                        <div class=\"mb-3\">
                            {{ form_label(attribute(form, 'projet_' ~ i)) }}
                            {{ form_widget(attribute(form, 'projet_' ~ i), {'attr': {'class': 'form-select choix-projet'}}) }}
                            {{ form_errors(attribute(form, 'projet_' ~ i)) }}
                        </div>
                    {% endfor %}

                    {% if form.vars.errors|length > 0 %}
                        <div class=\"alert alert-danger\">
                            {{ form_errors(form) }}
                        </div>
                    {% endif %}

                    <div class=\"d-grid\">
                        <button type=\"submit\" class=\"btn btn-primary\">Envoyer mes choix</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{ form_end(form) }}
</div>

<script>
    document.addEventListener(\"DOMContentLoaded\", function () {
        const selects = document.querySelectorAll(\".choix-projet\");

        function updateSelectOptions() {
            let selectedValues = new Set();
            selects.forEach(select => {
                if (select.value) {
                    selectedValues.add(select.value);
                }
            });

            selects.forEach(select => {
                [...select.options].forEach(option => {
                    option.disabled = selectedValues.has(option.value) && select.value !== option.value;
                });
            });
        }

        selects.forEach(select => select.addEventListener(\"change\", updateSelectOptions));
        updateSelectOptions();
    });
</script>
{% endblock %}
", "voeux/index.html.twig", "/home/adel/dev/ProjectHub/templates/voeux/index.html.twig");
    }
}
