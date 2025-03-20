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

/* friendship/requests.html.twig */
class __TwigTemplate_ae375f37063198141d058022d7eda6a8 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "friendship/requests.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "friendship/requests.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "friendship/requests.html.twig", 1);
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
    ";
        // line 5
        if ($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("IS_AUTHENTICATED_FULLY")) {
            // line 6
            yield "        <h1 class=\"text-center mb-4\">📩 Demandes d'amis</h1>

        ";
            // line 8
            if (Twig\Extension\CoreExtension::testEmpty((isset($context["requests"]) || array_key_exists("requests", $context) ? $context["requests"] : (function () { throw new RuntimeError('Variable "requests" does not exist.', 8, $this->source); })()))) {
                // line 9
                yield "            <p class=\"text-muted text-center\">Aucune demande d'ami reçue.</p>
        ";
            } else {
                // line 11
                yield "            <div class=\"card shadow-lg\">
                <div class=\"card-body\">
                    <ul class=\"list-group\">
                        ";
                // line 14
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable((isset($context["requests"]) || array_key_exists("requests", $context) ? $context["requests"] : (function () { throw new RuntimeError('Variable "requests" does not exist.', 14, $this->source); })()));
                foreach ($context['_seq'] as $context["_key"] => $context["request"]) {
                    // line 15
                    yield "                            <li class=\"list-group-item d-flex justify-content-between align-items-center\">
                                <div class=\"d-flex align-items-center\">
                                    <img src=\"https://via.placeholder.com/40\" class=\"rounded-circle me-2\" alt=\"Avatar\">
                                    <span>";
                    // line 18
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["request"], "requester", [], "any", false, false, false, 18), "email", [], "any", false, false, false, 18), "html", null, true);
                    yield "</span>
                                </div>
                                <div>
                                    <a href=\"";
                    // line 21
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_accept_friend", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["request"], "id", [], "any", false, false, false, 21)]), "html", null, true);
                    yield "\" class=\"btn btn-success btn-sm\">✅ Accepter</a>
                                    <a href=\"";
                    // line 22
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_decline_friend", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["request"], "id", [], "any", false, false, false, 22)]), "html", null, true);
                    yield "\" 
                                       onclick=\"return confirm('Voulez-vous vraiment refuser cette demande ?')\"
                                       class=\"btn btn-danger btn-sm\">❌ Refuser</a>
                                </div>
                            </li>
                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['request'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 28
                yield "                    </ul>
                </div>
            </div>
        ";
            }
            // line 32
            yield "
    ";
        } else {
            // line 34
            yield "        <p class=\"text-center text-danger\">⚠️ Vous devez être connecté pour voir cette page.</p>
    ";
        }
        // line 36
        yield "
    <!-- Bouton retour -->
    <div class=\"text-center mt-4\">
        <a href=\"";
        // line 39
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("home");
        yield "\" class=\"btn btn-outline-primary\">🏠 Retour à l'accueil</a>
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
        return "friendship/requests.html.twig";
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
        return array (  146 => 39,  141 => 36,  137 => 34,  133 => 32,  127 => 28,  115 => 22,  111 => 21,  105 => 18,  100 => 15,  96 => 14,  91 => 11,  87 => 9,  85 => 8,  81 => 6,  79 => 5,  76 => 4,  63 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block body %}
<div class=\"container mt-5\">
    {% if is_granted('IS_AUTHENTICATED_FULLY') %}
        <h1 class=\"text-center mb-4\">📩 Demandes d'amis</h1>

        {% if requests is empty %}
            <p class=\"text-muted text-center\">Aucune demande d'ami reçue.</p>
        {% else %}
            <div class=\"card shadow-lg\">
                <div class=\"card-body\">
                    <ul class=\"list-group\">
                        {% for request in requests %}
                            <li class=\"list-group-item d-flex justify-content-between align-items-center\">
                                <div class=\"d-flex align-items-center\">
                                    <img src=\"https://via.placeholder.com/40\" class=\"rounded-circle me-2\" alt=\"Avatar\">
                                    <span>{{ request.requester.email }}</span>
                                </div>
                                <div>
                                    <a href=\"{{ path('app_accept_friend', { id: request.id }) }}\" class=\"btn btn-success btn-sm\">✅ Accepter</a>
                                    <a href=\"{{ path('app_decline_friend', { id: request.id }) }}\" 
                                       onclick=\"return confirm('Voulez-vous vraiment refuser cette demande ?')\"
                                       class=\"btn btn-danger btn-sm\">❌ Refuser</a>
                                </div>
                            </li>
                        {% endfor %}
                    </ul>
                </div>
            </div>
        {% endif %}

    {% else %}
        <p class=\"text-center text-danger\">⚠️ Vous devez être connecté pour voir cette page.</p>
    {% endif %}

    <!-- Bouton retour -->
    <div class=\"text-center mt-4\">
        <a href=\"{{ path('home') }}\" class=\"btn btn-outline-primary\">🏠 Retour à l'accueil</a>
    </div>
</div>
{% endblock %}
", "friendship/requests.html.twig", "/home/adel/dev/ProjectHub/templates/friendship/requests.html.twig");
    }
}
