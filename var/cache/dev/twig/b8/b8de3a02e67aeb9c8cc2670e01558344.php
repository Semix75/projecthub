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

/* friendship/add.html.twig */
class __TwigTemplate_ea3c7927e480f3d4a4d6ab1eb3db13fa extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "friendship/add.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "friendship/add.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "friendship/add.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
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

        // line 4
        yield "<div class=\"container mt-5\">
    <h1 class=\"text-center mb-4\">➕ Ajouter un ami</h1>

    <div class=\"row justify-content-center\">
        <div class=\"col-md-6\">
            <div class=\"card shadow-sm\">
                <div class=\"card-body\">
                    <h2 class=\"card-title text-center mb-3\">🔗 Invitation</h2>
                    <form action=\"";
        // line 12
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_add_friend");
        yield "\" method=\"post\">
                        <div class=\"mb-3\">
                            <label for=\"friend_identifier\" class=\"form-label\">📧 Email ou pseudo :</label>
                            <input type=\"text\" id=\"friend_identifier\" name=\"friend_identifier\" class=\"form-control\" required>
                        </div>
                        <button type=\"submit\" class=\"btn btn-primary w-100\">📩 Envoyer la demande</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bouton retour -->
    <div class=\"text-center mt-4\">
        <a href=\"";
        // line 26
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_friends_list");
        yield "\" class=\"btn btn-outline-secondary\">🔙 Retour à la liste d'amis</a>
    </div>
</div>
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
        return "friendship/add.html.twig";
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
        return array (  103 => 26,  86 => 12,  76 => 4,  63 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block body %}
<div class=\"container mt-5\">
    <h1 class=\"text-center mb-4\">➕ Ajouter un ami</h1>

    <div class=\"row justify-content-center\">
        <div class=\"col-md-6\">
            <div class=\"card shadow-sm\">
                <div class=\"card-body\">
                    <h2 class=\"card-title text-center mb-3\">🔗 Invitation</h2>
                    <form action=\"{{ path('app_add_friend') }}\" method=\"post\">
                        <div class=\"mb-3\">
                            <label for=\"friend_identifier\" class=\"form-label\">📧 Email ou pseudo :</label>
                            <input type=\"text\" id=\"friend_identifier\" name=\"friend_identifier\" class=\"form-control\" required>
                        </div>
                        <button type=\"submit\" class=\"btn btn-primary w-100\">📩 Envoyer la demande</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bouton retour -->
    <div class=\"text-center mt-4\">
        <a href=\"{{ path('app_friends_list') }}\" class=\"btn btn-outline-secondary\">🔙 Retour à la liste d'amis</a>
    </div>
</div>
{% endblock %}
", "friendship/add.html.twig", "/home/adel/dev/ProjectHub/templates/friendship/add.html.twig");
    }
}
