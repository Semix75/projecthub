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

/* friendship/list.html.twig */
class __TwigTemplate_50e6da4728799db2c04f147b9e5e5b3b extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "friendship/list.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "friendship/list.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "friendship/list.html.twig", 1);
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

        yield "Liste de mes amis";
        
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
        yield "<div class=\"container mt-5\">
    <h1 class=\"text-center mb-4\">👥 Mes amis</h1>

    <!-- Boutons d'actions -->
    <div class=\"d-flex justify-content-center gap-3 mb-4\">
        <a href=\"";
        // line 11
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_add_friend");
        yield "\" class=\"btn btn-primary\">
            ➕ Ajouter un ami
        </a>
        <a href=\"";
        // line 14
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_list_block_friend");
        yield "\" class=\"btn btn-danger\">
            🚫 Voir la liste des bloqués
        </a>
        <a href=\"";
        // line 17
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_friend_requests");
        yield "\" class=\"btn btn-success\">
            📩 Voir les demandes d'amis
        </a>
    </div>

    <!-- Liste des amis -->
    <div class=\"card shadow-sm\">
        <div class=\"card-body\">
            ";
        // line 25
        if (Twig\Extension\CoreExtension::testEmpty((isset($context["friends"]) || array_key_exists("friends", $context) ? $context["friends"] : (function () { throw new RuntimeError('Variable "friends" does not exist.', 25, $this->source); })()))) {
            // line 26
            yield "                <p class=\"text-center text-muted\">Vous n'avez aucun ami.</p>
            ";
        } else {
            // line 28
            yield "                <ul class=\"list-group\">
                    ";
            // line 29
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["friends"]) || array_key_exists("friends", $context) ? $context["friends"] : (function () { throw new RuntimeError('Variable "friends" does not exist.', 29, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["friendship"]) {
                // line 30
                yield "                        ";
                if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["friendship"], "requester", [], "any", false, false, false, 30), "id", [], "any", false, false, false, 30) != CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 30, $this->source); })()), "user", [], "any", false, false, false, 30), "id", [], "any", false, false, false, 30))) {
                    // line 31
                    yield "                            ";
                    $context["friend"] = CoreExtension::getAttribute($this->env, $this->source, $context["friendship"], "requester", [], "any", false, false, false, 31);
                    // line 32
                    yield "                        ";
                } else {
                    yield "    
                            ";
                    // line 33
                    $context["friend"] = CoreExtension::getAttribute($this->env, $this->source, $context["friendship"], "receiver", [], "any", false, false, false, 33);
                    // line 34
                    yield "                        ";
                }
                // line 35
                yield "                        <li class=\"list-group-item d-flex justify-content-between align-items-center\">
                            <div class=\"d-flex align-items-center\">
                                <img src=\"https://via.placeholder.com/40\" alt=\"Avatar\" class=\"rounded-circle me-2\">
                                <a href=\"";
                // line 38
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_user_profile", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["friend"]) || array_key_exists("friend", $context) ? $context["friend"] : (function () { throw new RuntimeError('Variable "friend" does not exist.', 38, $this->source); })()), "id", [], "any", false, false, false, 38)]), "html", null, true);
                yield "\" class=\"text-decoration-none\">
                                    ";
                // line 39
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["friend"]) || array_key_exists("friend", $context) ? $context["friend"] : (function () { throw new RuntimeError('Variable "friend" does not exist.', 39, $this->source); })()), "username", [], "any", false, false, false, 39), "html", null, true);
                yield "
                                </a>
                            </div>
                            <a href=\"";
                // line 42
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_user_profile", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["friend"]) || array_key_exists("friend", $context) ? $context["friend"] : (function () { throw new RuntimeError('Variable "friend" does not exist.', 42, $this->source); })()), "id", [], "any", false, false, false, 42)]), "html", null, true);
                yield "\" class=\"btn btn-outline-primary btn-sm\">
                                🔍 Voir le profil
                            </a>
                        </li>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['friendship'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 47
            yield "                </ul>
            ";
        }
        // line 49
        yield "        </div>
    </div>

    <!-- Bouton retour -->
    <div class=\"text-center mt-4\">
        <a href=\"";
        // line 54
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
        return "friendship/list.html.twig";
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
        return array (  196 => 54,  189 => 49,  185 => 47,  174 => 42,  168 => 39,  164 => 38,  159 => 35,  156 => 34,  154 => 33,  149 => 32,  146 => 31,  143 => 30,  139 => 29,  136 => 28,  132 => 26,  130 => 25,  119 => 17,  113 => 14,  107 => 11,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Liste de mes amis{% endblock %}

{% block body %}
<div class=\"container mt-5\">
    <h1 class=\"text-center mb-4\">👥 Mes amis</h1>

    <!-- Boutons d'actions -->
    <div class=\"d-flex justify-content-center gap-3 mb-4\">
        <a href=\"{{ path('app_add_friend') }}\" class=\"btn btn-primary\">
            ➕ Ajouter un ami
        </a>
        <a href=\"{{ path('app_list_block_friend') }}\" class=\"btn btn-danger\">
            🚫 Voir la liste des bloqués
        </a>
        <a href=\"{{ path('app_friend_requests') }}\" class=\"btn btn-success\">
            📩 Voir les demandes d'amis
        </a>
    </div>

    <!-- Liste des amis -->
    <div class=\"card shadow-sm\">
        <div class=\"card-body\">
            {% if friends is empty %}
                <p class=\"text-center text-muted\">Vous n'avez aucun ami.</p>
            {% else %}
                <ul class=\"list-group\">
                    {% for friendship in friends %}
                        {% if friendship.requester.id != app.user.id %}
                            {% set friend = friendship.requester %}
                        {% else %}    
                            {% set friend = friendship.receiver %}
                        {% endif %}
                        <li class=\"list-group-item d-flex justify-content-between align-items-center\">
                            <div class=\"d-flex align-items-center\">
                                <img src=\"https://via.placeholder.com/40\" alt=\"Avatar\" class=\"rounded-circle me-2\">
                                <a href=\"{{ path('app_user_profile', {'id': friend.id}) }}\" class=\"text-decoration-none\">
                                    {{ friend.username }}
                                </a>
                            </div>
                            <a href=\"{{ path('app_user_profile', {'id': friend.id}) }}\" class=\"btn btn-outline-primary btn-sm\">
                                🔍 Voir le profil
                            </a>
                        </li>
                    {% endfor %}
                </ul>
            {% endif %}
        </div>
    </div>

    <!-- Bouton retour -->
    <div class=\"text-center mt-4\">
        <a href=\"{{ path('home') }}\" class=\"btn btn-outline-primary\">🏠 Retour à l'accueil</a>
    </div>
</div>
{% endblock %}
", "friendship/list.html.twig", "/home/adel/dev/ProjectHub/templates/friendship/list.html.twig");
    }
}
