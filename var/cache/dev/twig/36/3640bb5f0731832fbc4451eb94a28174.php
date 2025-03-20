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

/* profil/index.html.twig */
class __TwigTemplate_9fd1e3fb661044501ced1db0e35dc8bc extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "profil/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "profil/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "profil/index.html.twig", 1);
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

        yield "Mon Profil
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 6
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

        // line 7
        yield "\t<div class=\"container d-flex justify-content-center align-items-center min-vh-100\">
\t\t<div class=\"card shadow-lg p-4 d-flex flex-column justify-content-between\" style=\"max-width: 600px; width: 100%; min-height: 80vh;\">
\t\t\t<div class=\"card-body text-center\">
\t\t\t\t<h1 class=\"card-title\">Mon Profil</h1>
\t\t\t\t<hr>

\t\t\t\t<table class=\"table table-bordered\">
\t\t\t\t\t<tbody>
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<th class=\"bg-light\">Prénom</th>
\t\t\t\t\t\t\t<td>";
        // line 17
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 17, $this->source); })()), "firstname", [], "any", false, false, false, 17), "html", null, true);
        yield "</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<th class=\"bg-light\">Nom</th>
\t\t\t\t\t\t\t<td>";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 21, $this->source); })()), "lastname", [], "any", false, false, false, 21), "html", null, true);
        yield "</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<th class=\"bg-light\">Email</th>
\t\t\t\t\t\t\t<td>";
        // line 25
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 25, $this->source); })()), "email", [], "any", false, false, false, 25), "html", null, true);
        yield "</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t</tbody>
\t\t\t\t</table>

\t\t\t\t<h2 class=\"mt-4\">Mes Vœux</h2>
\t\t\t\t<hr>
\t\t\t\t";
        // line 32
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["voeux"]) || array_key_exists("voeux", $context) ? $context["voeux"] : (function () { throw new RuntimeError('Variable "voeux" does not exist.', 32, $this->source); })())) > 0)) {
            // line 33
            yield "\t\t\t\t\t<ul class=\"list-group\">
\t\t\t\t\t\t";
            // line 34
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["voeux"]) || array_key_exists("voeux", $context) ? $context["voeux"] : (function () { throw new RuntimeError('Variable "voeux" does not exist.', 34, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["voeu"]) {
                // line 35
                yield "\t\t\t\t\t\t\t<li class=\"list-group-item d-flex justify-content-between align-items-center\">
\t\t\t\t\t\t\t\t<span class=\"fw-bold ms-2\">";
                // line 36
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["voeu"], "projet", [], "any", false, false, false, 36), "intitule", [], "any", false, false, false, 36), "html", null, true);
                yield "</span>
\t\t\t\t\t\t\t\t<span class=\"badge bg-primary rounded-pill\">Priorité :
\t\t\t\t\t\t\t\t\t";
                // line 38
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["voeu"], "priorite", [], "any", false, false, false, 38), "html", null, true);
                yield "</span>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['voeu'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 41
            yield "\t\t\t\t\t</ul>
\t\t\t\t\t<a href=\"";
            // line 42
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_voeux_edit");
            yield "\" class=\"btn btn-primary mt-4\">Modifier mes vœux</a>
\t\t\t\t";
        } else {
            // line 44
            yield "\t\t\t\t\t<p class=\"text-muted\">Vous n'avez pas encore enregistré de vœux.</p>
\t\t\t\t\t<a href=\"";
            // line 45
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_voeux");
            yield "\" class=\"btn btn-primary mt-2\">Ajouter mes vœux</a>
\t\t\t\t";
        }
        // line 47
        yield "\t\t\t</div>
\t\t\t<div class=\"text-center mt-auto\">
\t\t\t\t<a class=\"btn btn-danger\" href=\"";
        // line 49
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
        yield "\">Déconnexion</a>
\t\t\t</div>
\t\t</div>
\t</div>
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
        return "profil/index.html.twig";
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
        return array (  183 => 49,  179 => 47,  174 => 45,  171 => 44,  166 => 42,  163 => 41,  154 => 38,  149 => 36,  146 => 35,  142 => 34,  139 => 33,  137 => 32,  127 => 25,  120 => 21,  113 => 17,  101 => 7,  88 => 6,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Mon Profil
{% endblock %}

{% block body %}
\t<div class=\"container d-flex justify-content-center align-items-center min-vh-100\">
\t\t<div class=\"card shadow-lg p-4 d-flex flex-column justify-content-between\" style=\"max-width: 600px; width: 100%; min-height: 80vh;\">
\t\t\t<div class=\"card-body text-center\">
\t\t\t\t<h1 class=\"card-title\">Mon Profil</h1>
\t\t\t\t<hr>

\t\t\t\t<table class=\"table table-bordered\">
\t\t\t\t\t<tbody>
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<th class=\"bg-light\">Prénom</th>
\t\t\t\t\t\t\t<td>{{ user.firstname }}</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<th class=\"bg-light\">Nom</th>
\t\t\t\t\t\t\t<td>{{ user.lastname }}</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t\t<tr>
\t\t\t\t\t\t\t<th class=\"bg-light\">Email</th>
\t\t\t\t\t\t\t<td>{{ user.email }}</td>
\t\t\t\t\t\t</tr>
\t\t\t\t\t</tbody>
\t\t\t\t</table>

\t\t\t\t<h2 class=\"mt-4\">Mes Vœux</h2>
\t\t\t\t<hr>
\t\t\t\t{% if voeux|length > 0 %}
\t\t\t\t\t<ul class=\"list-group\">
\t\t\t\t\t\t{% for voeu in voeux %}
\t\t\t\t\t\t\t<li class=\"list-group-item d-flex justify-content-between align-items-center\">
\t\t\t\t\t\t\t\t<span class=\"fw-bold ms-2\">{{ voeu.projet.intitule }}</span>
\t\t\t\t\t\t\t\t<span class=\"badge bg-primary rounded-pill\">Priorité :
\t\t\t\t\t\t\t\t\t{{ voeu.priorite }}</span>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t{% endfor %}
\t\t\t\t\t</ul>
\t\t\t\t\t<a href=\"{{ path('app_voeux_edit') }}\" class=\"btn btn-primary mt-4\">Modifier mes vœux</a>
\t\t\t\t{% else %}
\t\t\t\t\t<p class=\"text-muted\">Vous n'avez pas encore enregistré de vœux.</p>
\t\t\t\t\t<a href=\"{{ path('app_voeux') }}\" class=\"btn btn-primary mt-2\">Ajouter mes vœux</a>
\t\t\t\t{% endif %}
\t\t\t</div>
\t\t\t<div class=\"text-center mt-auto\">
\t\t\t\t<a class=\"btn btn-danger\" href=\"{{ path('app_logout') }}\">Déconnexion</a>
\t\t\t</div>
\t\t</div>
\t</div>
{% endblock %}
", "profil/index.html.twig", "/home/adel/dev/ProjectHub/templates/profil/index.html.twig");
    }
}
