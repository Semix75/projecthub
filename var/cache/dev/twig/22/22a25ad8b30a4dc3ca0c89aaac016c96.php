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

/* home_page/index.html.twig */
class __TwigTemplate_b5c123971863e6d193592a878180bdc0 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "home_page/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "home_page/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "home_page/index.html.twig", 1);
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

        yield "Bienvenue !
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
        yield "\t<!-- Masthead-->
\t<header class=\"masthead\">
\t\t<div class=\"container position-relative\">
\t\t\t<div class=\"row justify-content-center\">
\t\t\t\t<div class=\"col-xl-6\">
\t\t\t\t\t<div class=\"text-center text-white\">
\t\t\t\t\t\t<h1 class=\"mb-5\">Decouvrez et choisissez le projet qui vous plait !</h1>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</header>
\t<!-- Image Showcases-->
\t<section class=\"showcase\">
\t\t<div class=\"container mt-4\">
\t\t\t<h1 class=\"text-center\">Bienvenue sur notre plateforme</h1>

\t\t\t<h2 class=\"mt-4\">Derniers Projets</h2>
\t\t\t<div class=\"row\">
\t\t\t\t";
        // line 26
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["projets"]) || array_key_exists("projets", $context) ? $context["projets"] : (function () { throw new RuntimeError('Variable "projets" does not exist.', 26, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["projet"]) {
            // line 27
            yield "\t\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t\t<div class=\"card mb-4 shadow-sm\">
\t\t\t\t\t\t\t<div class=\"card-body\">
\t\t\t\t\t\t\t\t<h5 class=\"card-title\">";
            // line 30
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["projet"], "intitule", [], "any", false, false, false, 30), "html", null, true);
            yield "</h5>
\t\t\t\t\t\t\t\t<p class=\"card-text\">";
            // line 31
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["projet"], "description", [], "any", false, false, false, 31), 0, 100), "html", null, true);
            yield "...</p>
\t\t\t\t\t\t\t\t";
            // line 39
            yield "\t\t\t\t\t\t\t\t<a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projet_detail", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["projet"], "id", [], "any", false, false, false, 39)]), "html", null, true);
            yield "\" class=\"btn btn-primary\">Voir Détails</a>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t";
            $context['_iterated'] = true;
        }
        // line 43
        if (!$context['_iterated']) {
            // line 44
            yield "\t\t\t\t\t<p>Aucun projet disponible.</p>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['projet'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 46
        yield "\t\t\t</div>

\t\t\t<div class=\"text-center mt-4\">
\t\t\t\t<a href=\"";
        // line 49
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("projets_index");
        yield "\" class=\"btn btn-outline-primary\">Voir tous les projets</a>
\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- Testimonials-->
\t<section class=\"testimonials text-center bg-light\">
\t\t<div class=\"container\">
\t\t\t<h2 class=\"mb-5\">developper par</h2>
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-lg-4\">
\t\t\t\t\t<div class=\"testimonial-item mx-auto mb-5 mb-lg-0\">
\t\t\t\t\t\t<img class=\"img-fluid rounded-circle mb-3\" src=\"";
        // line 60
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/img/adel.jpeg"), "html", null, true);
        yield "\" alt=\"...\"/>
\t\t\t\t\t\t<h5>adel 3arbiPensif</h5>
\t\t\t\t\t\t<p class=\"font-weight-light mb-0\">\"This is fantastic! Thanks so much guys!\"</p>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-lg-4\">
\t\t\t\t\t<div class=\"testimonial-item mx-auto mb-5 mb-lg-0\">
\t\t\t\t\t\t<img class=\"img-fluid rounded-circle mb-3\" src=\"";
        // line 67
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/img/sem.jpg"), "html", null, true);
        yield "\" alt=\"...\"/>
\t\t\t\t\t\t<h5>Semiaouw</h5>
\t\t\t\t\t\t<p class=\"font-weight-light mb-0\">\"Bootstrap is amazing. I've been using it to create lots of super nice landing pages.\"</p>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-lg-4\">
\t\t\t\t\t<div class=\"testimonial-item mx-auto mb-5 mb-lg-0\">
\t\t\t\t\t\t<img class=\"img-fluid rounded-circle mb-3\" src=\"";
        // line 74
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/img/testimonials-3.jpg"), "html", null, true);
        yield "\" alt=\"...\"/>
\t\t\t\t\t\t<h5>Sarah W.</h5>
\t\t\t\t\t\t<p class=\"font-weight-light mb-0\">\"Thanks so much for making these free resources available to us!\"</p>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- Footer-->
\t<!-- Footer -->
\t<footer class=\"footer bg-light\">
\t\t<div class=\"container\">
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-lg-6 h-100 text-center text-lg-start my-auto\">
\t\t\t\t\t<ul class=\"list-inline mb-2\">
\t\t\t\t\t\t<li class=\"list-inline-item\">
\t\t\t\t\t\t\t<a href=\"#\">About</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"list-inline-item\">⋅</li>
\t\t\t\t\t\t<li class=\"list-inline-item\">
\t\t\t\t\t\t\t<a href=\"#\">Contact</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"list-inline-item\">⋅</li>
\t\t\t\t\t\t<li class=\"list-inline-item\">
\t\t\t\t\t\t\t<a href=\"#\">Terms of Use</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"list-inline-item\">⋅</li>
\t\t\t\t\t\t<li class=\"list-inline-item\">
\t\t\t\t\t\t\t<a href=\"#\">Privacy Policy</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t</ul>
\t\t\t\t\t<p class=\"text-muted small mb-4 mb-lg-0\">&copy; Your Website 2023. All Rights Reserved.</p>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</footer>
\t<!-- Bootstrap core JS-->
\t<script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js\"></script>
\t<!-- Core theme JS-->
\t<script src=\"";
        // line 113
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/js/scripts.js"), "html", null, true);
        yield "\"></script>
\t<!-- SB Forms JS -->
\t<script src=\"https://cdn.startbootstrap.com/sb-forms-latest.js\"></script>
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
        return "home_page/index.html.twig";
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
        return array (  240 => 113,  198 => 74,  188 => 67,  178 => 60,  164 => 49,  159 => 46,  152 => 44,  150 => 43,  140 => 39,  136 => 31,  132 => 30,  127 => 27,  122 => 26,  101 => 7,  88 => 6,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Bienvenue !
{% endblock %}

{% block body %}
\t<!-- Masthead-->
\t<header class=\"masthead\">
\t\t<div class=\"container position-relative\">
\t\t\t<div class=\"row justify-content-center\">
\t\t\t\t<div class=\"col-xl-6\">
\t\t\t\t\t<div class=\"text-center text-white\">
\t\t\t\t\t\t<h1 class=\"mb-5\">Decouvrez et choisissez le projet qui vous plait !</h1>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</header>
\t<!-- Image Showcases-->
\t<section class=\"showcase\">
\t\t<div class=\"container mt-4\">
\t\t\t<h1 class=\"text-center\">Bienvenue sur notre plateforme</h1>

\t\t\t<h2 class=\"mt-4\">Derniers Projets</h2>
\t\t\t<div class=\"row\">
\t\t\t\t{% for projet in projets %}
\t\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t\t<div class=\"card mb-4 shadow-sm\">
\t\t\t\t\t\t\t<div class=\"card-body\">
\t\t\t\t\t\t\t\t<h5 class=\"card-title\">{{ projet.intitule }}</h5>
\t\t\t\t\t\t\t\t<p class=\"card-text\">{{ projet.description[:100] }}...</p>
\t\t\t\t\t\t\t\t{# <p>
\t\t\t\t\t\t\t\t\t<strong>Places disponibles :</strong>
\t\t\t\t\t\t\t\t\t<h5 class=\"card-title\"> place minimun</h5>
\t\t\t\t\t\t\t\t\t{{ projet.nbPlaceMin }}</p>
\t\t\t\t\t\t\t\t\t<h5 class=\"card-title\"> place maximum</h5>
\t\t\t\t\t\t\t\t\t{{ projet.nbPlaceMax }}
\t\t\t\t\t\t\t\t</p> #}
\t\t\t\t\t\t\t\t<a href=\"{{ path('projet_detail', { id: projet.id }) }}\" class=\"btn btn-primary\">Voir Détails</a>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t{% else %}
\t\t\t\t\t<p>Aucun projet disponible.</p>
\t\t\t\t{% endfor %}
\t\t\t</div>

\t\t\t<div class=\"text-center mt-4\">
\t\t\t\t<a href=\"{{ path('projets_index') }}\" class=\"btn btn-outline-primary\">Voir tous les projets</a>
\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- Testimonials-->
\t<section class=\"testimonials text-center bg-light\">
\t\t<div class=\"container\">
\t\t\t<h2 class=\"mb-5\">developper par</h2>
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-lg-4\">
\t\t\t\t\t<div class=\"testimonial-item mx-auto mb-5 mb-lg-0\">
\t\t\t\t\t\t<img class=\"img-fluid rounded-circle mb-3\" src=\"{{ asset('assets/img/adel.jpeg') }}\" alt=\"...\"/>
\t\t\t\t\t\t<h5>adel 3arbiPensif</h5>
\t\t\t\t\t\t<p class=\"font-weight-light mb-0\">\"This is fantastic! Thanks so much guys!\"</p>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-lg-4\">
\t\t\t\t\t<div class=\"testimonial-item mx-auto mb-5 mb-lg-0\">
\t\t\t\t\t\t<img class=\"img-fluid rounded-circle mb-3\" src=\"{{ asset('assets/img/sem.jpg') }}\" alt=\"...\"/>
\t\t\t\t\t\t<h5>Semiaouw</h5>
\t\t\t\t\t\t<p class=\"font-weight-light mb-0\">\"Bootstrap is amazing. I've been using it to create lots of super nice landing pages.\"</p>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"col-lg-4\">
\t\t\t\t\t<div class=\"testimonial-item mx-auto mb-5 mb-lg-0\">
\t\t\t\t\t\t<img class=\"img-fluid rounded-circle mb-3\" src=\"{{ asset('assets/img/testimonials-3.jpg') }}\" alt=\"...\"/>
\t\t\t\t\t\t<h5>Sarah W.</h5>
\t\t\t\t\t\t<p class=\"font-weight-light mb-0\">\"Thanks so much for making these free resources available to us!\"</p>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</section>
\t<!-- Footer-->
\t<!-- Footer -->
\t<footer class=\"footer bg-light\">
\t\t<div class=\"container\">
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-lg-6 h-100 text-center text-lg-start my-auto\">
\t\t\t\t\t<ul class=\"list-inline mb-2\">
\t\t\t\t\t\t<li class=\"list-inline-item\">
\t\t\t\t\t\t\t<a href=\"#\">About</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"list-inline-item\">⋅</li>
\t\t\t\t\t\t<li class=\"list-inline-item\">
\t\t\t\t\t\t\t<a href=\"#\">Contact</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"list-inline-item\">⋅</li>
\t\t\t\t\t\t<li class=\"list-inline-item\">
\t\t\t\t\t\t\t<a href=\"#\">Terms of Use</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"list-inline-item\">⋅</li>
\t\t\t\t\t\t<li class=\"list-inline-item\">
\t\t\t\t\t\t\t<a href=\"#\">Privacy Policy</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t</ul>
\t\t\t\t\t<p class=\"text-muted small mb-4 mb-lg-0\">&copy; Your Website 2023. All Rights Reserved.</p>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</footer>
\t<!-- Bootstrap core JS-->
\t<script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js\"></script>
\t<!-- Core theme JS-->
\t<script src=\"{{ asset('assets/js/scripts.js') }}\"></script>
\t<!-- SB Forms JS -->
\t<script src=\"https://cdn.startbootstrap.com/sb-forms-latest.js\"></script>
{% endblock %}
", "home_page/index.html.twig", "/home/adel/dev/ProjectHub/templates/home_page/index.html.twig");
    }
}
