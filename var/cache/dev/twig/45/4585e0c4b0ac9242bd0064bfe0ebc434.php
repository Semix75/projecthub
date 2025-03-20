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

/* friendship/blocked.html.twig */
class __TwigTemplate_9c4d74fd191b29cb811ddc7363247da3 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "friendship/blocked.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "friendship/blocked.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "friendship/blocked.html.twig", 1);
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

        yield "Liste des utilisateurs bloqués";
        
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
    <h1 class=\"text-center text-danger\">🚫 Liste des utilisateurs bloqués</h1>

    <div class=\"row mt-4\">
        <!-- Section des utilisateurs bloqués par moi -->
        <div class=\"col-md-6\">
            <div class=\"card shadow-sm\">
                <div class=\"card-header bg-danger text-white\">
                    <h2 class=\"h5 mb-0\">🚫 Utilisateurs que j'ai bloqués</h2>
                </div>
                <div class=\"card-body\">
                    ";
        // line 17
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["blockedByMe"]) || array_key_exists("blockedByMe", $context) ? $context["blockedByMe"] : (function () { throw new RuntimeError('Variable "blockedByMe" does not exist.', 17, $this->source); })())) > 0)) {
            // line 18
            yield "                        <ul class=\"list-group\">
                            ";
            // line 19
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["blockedByMe"]) || array_key_exists("blockedByMe", $context) ? $context["blockedByMe"] : (function () { throw new RuntimeError('Variable "blockedByMe" does not exist.', 19, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["friendship"]) {
                // line 20
                yield "                                <li class=\"list-group-item d-flex justify-content-between align-items-center\">
                                    👤 ";
                // line 21
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["friendship"], "receiver", [], "any", false, false, false, 21), "username", [], "any", false, false, false, 21), "html", null, true);
                yield "
                                    <form action=\"";
                // line 22
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_unblock_friend", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["friendship"], "id", [], "any", false, false, false, 22)]), "html", null, true);
                yield "\" method=\"post\">
                                        <button type=\"submit\" class=\"btn btn-sm btn-outline-success\">Débloquer</button>
                                    </form>
                                </li>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['friendship'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 27
            yield "                        </ul>
                    ";
        } else {
            // line 29
            yield "                        <p class=\"text-muted\">Aucun utilisateur bloqué.</p>
                    ";
        }
        // line 31
        yield "                </div>
            </div>
        </div>

        <!-- Section des utilisateurs qui m'ont bloqué -->
        <div class=\"col-md-6\">
            <div class=\"card shadow-sm\">
                <div class=\"card-header bg-warning text-dark\">
                    <h2 class=\"h5 mb-0\">🚨 Utilisateurs qui m'ont bloqué</h2>
                </div>
                <div class=\"card-body\">
                    ";
        // line 42
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["blockedMe"]) || array_key_exists("blockedMe", $context) ? $context["blockedMe"] : (function () { throw new RuntimeError('Variable "blockedMe" does not exist.', 42, $this->source); })())) > 0)) {
            // line 43
            yield "                        <ul class=\"list-group\">
                            ";
            // line 44
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["blockedMe"]) || array_key_exists("blockedMe", $context) ? $context["blockedMe"] : (function () { throw new RuntimeError('Variable "blockedMe" does not exist.', 44, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["friendship"]) {
                // line 45
                yield "                                <li class=\"list-group-item\">
                                    ⛔ ";
                // line 46
                yield (((CoreExtension::getAttribute($this->env, $this->source, $context["friendship"], "blockedBy", [], "any", false, false, false, 46) == CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["friendship"], "requester", [], "any", false, false, false, 46), "id", [], "any", false, false, false, 46))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["friendship"], "requester", [], "any", false, false, false, 46), "username", [], "any", false, false, false, 46), "html", null, true)) : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["friendship"], "receiver", [], "any", false, false, false, 46), "username", [], "any", false, false, false, 46), "html", null, true)));
                yield "
                                </li>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['friendship'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 49
            yield "                        </ul>
                    ";
        } else {
            // line 51
            yield "                        <p class=\"text-muted\">Personne ne vous a bloqué.</p>
                    ";
        }
        // line 53
        yield "                </div>
            </div>
        </div>
    </div>

    <div class=\"text-center mt-4\">
        <a href=\"";
        // line 59
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_friends_list");
        yield "\" class=\"btn btn-outline-secondary\">Retour à la liste d'amis</a>
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
        return "friendship/blocked.html.twig";
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
        return array (  198 => 59,  190 => 53,  186 => 51,  182 => 49,  173 => 46,  170 => 45,  166 => 44,  163 => 43,  161 => 42,  148 => 31,  144 => 29,  140 => 27,  129 => 22,  125 => 21,  122 => 20,  118 => 19,  115 => 18,  113 => 17,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Liste des utilisateurs bloqués{% endblock %}

{% block body %}
<div class=\"container mt-5\">
    <h1 class=\"text-center text-danger\">🚫 Liste des utilisateurs bloqués</h1>

    <div class=\"row mt-4\">
        <!-- Section des utilisateurs bloqués par moi -->
        <div class=\"col-md-6\">
            <div class=\"card shadow-sm\">
                <div class=\"card-header bg-danger text-white\">
                    <h2 class=\"h5 mb-0\">🚫 Utilisateurs que j'ai bloqués</h2>
                </div>
                <div class=\"card-body\">
                    {% if blockedByMe|length > 0 %}
                        <ul class=\"list-group\">
                            {% for friendship in blockedByMe %}
                                <li class=\"list-group-item d-flex justify-content-between align-items-center\">
                                    👤 {{ friendship.receiver.username }}
                                    <form action=\"{{ path('app_unblock_friend', {id: friendship.id}) }}\" method=\"post\">
                                        <button type=\"submit\" class=\"btn btn-sm btn-outline-success\">Débloquer</button>
                                    </form>
                                </li>
                            {% endfor %}
                        </ul>
                    {% else %}
                        <p class=\"text-muted\">Aucun utilisateur bloqué.</p>
                    {% endif %}
                </div>
            </div>
        </div>

        <!-- Section des utilisateurs qui m'ont bloqué -->
        <div class=\"col-md-6\">
            <div class=\"card shadow-sm\">
                <div class=\"card-header bg-warning text-dark\">
                    <h2 class=\"h5 mb-0\">🚨 Utilisateurs qui m'ont bloqué</h2>
                </div>
                <div class=\"card-body\">
                    {% if blockedMe|length > 0 %}
                        <ul class=\"list-group\">
                            {% for friendship in blockedMe %}
                                <li class=\"list-group-item\">
                                    ⛔ {{ friendship.blockedBy == friendship.requester.id ? friendship.requester.username : friendship.receiver.username }}
                                </li>
                            {% endfor %}
                        </ul>
                    {% else %}
                        <p class=\"text-muted\">Personne ne vous a bloqué.</p>
                    {% endif %}
                </div>
            </div>
        </div>
    </div>

    <div class=\"text-center mt-4\">
        <a href=\"{{ path('app_friends_list') }}\" class=\"btn btn-outline-secondary\">Retour à la liste d'amis</a>
    </div>
</div>
{% endblock %}
", "friendship/blocked.html.twig", "/home/adel/dev/ProjectHub/templates/friendship/blocked.html.twig");
    }
}
