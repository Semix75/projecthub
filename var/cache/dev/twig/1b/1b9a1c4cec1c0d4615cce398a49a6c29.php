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

/* friendship/profil.html.twig */
class __TwigTemplate_0adb9e7950a17cd448fd95c3eed83159 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "friendship/profil.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "friendship/profil.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "friendship/profil.html.twig", 1);
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

        yield "Profil de ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 3, $this->source); })()), "username", [], "any", false, false, false, 3), "html", null, true);
        
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
    <div class=\"card shadow-lg\">
        <div class=\"card-body\">
            <h1 class=\"text-center mb-4\">👤 Profil de ";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 9, $this->source); })()), "username", [], "any", false, false, false, 9), "html", null, true);
        yield "</h1>

            <div class=\"text-center\">
                <img src=\"https://via.placeholder.com/120\" class=\"rounded-circle mb-3\" alt=\"Avatar\">
            </div>

            <ul class=\"list-group list-group-flush\">
                <li class=\"list-group-item\"><strong>📧 Email :</strong> ";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 16, $this->source); })()), "email", [], "any", false, false, false, 16), "html", null, true);
        yield "</li>
                <li class=\"list-group-item\"><strong>👤 Nom :</strong> ";
        // line 17
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 17, $this->source); })()), "lastname", [], "any", false, false, false, 17), "html", null, true);
        yield "</li>
                <li class=\"list-group-item\"><strong>📝 Prénom :</strong> ";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 18, $this->source); })()), "firstname", [], "any", false, false, false, 18), "html", null, true);
        yield "</li>
                <li class=\"list-group-item\"><strong>📖 Biographie :</strong> ";
        // line 19
        yield ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 19, $this->source); })()), "biographie", [], "any", false, false, false, 19)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 19, $this->source); })()), "biographie", [], "any", false, false, false, 19), "html", null, true)) : ("Aucune biographie"));
        yield "</li>
            </ul>
        </div>
    </div>

    <hr>

    ";
        // line 26
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 26, $this->source); })()), "id", [], "any", false, false, false, 26) != CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 26, $this->source); })()), "user", [], "any", false, false, false, 26), "id", [], "any", false, false, false, 26))) {
            // line 27
            yield "        <div class=\"text-center mt-4\">
            ";
            // line 28
            if ((isset($context["isFriend"]) || array_key_exists("isFriend", $context) ? $context["isFriend"] : (function () { throw new RuntimeError('Variable "isFriend" does not exist.', 28, $this->source); })())) {
                // line 29
                yield "                <h3 class=\"text-success\">✅ Vous êtes amis avec ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 29, $this->source); })()), "username", [], "any", false, false, false, 29), "html", null, true);
                yield "</h3>
                <div class=\"d-flex justify-content-center gap-2\">
                    <form action=\"";
                // line 31
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_remove_friend", ["userId" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 31, $this->source); })()), "id", [], "any", false, false, false, 31)]), "html", null, true);
                yield "\" method=\"POST\">
                        <button type=\"submit\" class=\"btn btn-warning\">❌ Supprimer l'ami</button>
                    </form>
                    <form action=\"";
                // line 34
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_block_friend", ["userId" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 34, $this->source); })()), "id", [], "any", false, false, false, 34)]), "html", null, true);
                yield "\" method=\"POST\">
                        <button type=\"submit\" class=\"btn btn-danger\">🚫 Bloquer</button>
                    </form>
                </div>
            ";
            } elseif ((            // line 38
array_key_exists("pendingRequest", $context) && (isset($context["pendingRequest"]) || array_key_exists("pendingRequest", $context) ? $context["pendingRequest"] : (function () { throw new RuntimeError('Variable "pendingRequest" does not exist.', 38, $this->source); })()))) {
                // line 39
                yield "                <h3 class=\"text-warning\">⏳ Demande en attente</h3>
                <p class=\"text-muted\">Vous avez envoyé une demande d'ami.</p>
            ";
            } elseif ((            // line 41
array_key_exists("receivedRequest", $context) && (isset($context["receivedRequest"]) || array_key_exists("receivedRequest", $context) ? $context["receivedRequest"] : (function () { throw new RuntimeError('Variable "receivedRequest" does not exist.', 41, $this->source); })()))) {
                // line 42
                yield "                <h3 class=\"text-info\">📩 Demande reçue</h3>
                <form action=\"";
                // line 43
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_accept_friend", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 43, $this->source); })()), "id", [], "any", false, false, false, 43)]), "html", null, true);
                yield "\" method=\"POST\">
                    <button type=\"submit\" class=\"btn btn-success\">✅ Accepter</button>
                </form>
            ";
            } else {
                // line 47
                yield "                <h3 class=\"text-danger\">❌ Vous n'êtes pas encore amis</h3>
                <form method=\"POST\" action=\"";
                // line 48
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_add_friend", ["userId" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["user"]) || array_key_exists("user", $context) ? $context["user"] : (function () { throw new RuntimeError('Variable "user" does not exist.', 48, $this->source); })()), "id", [], "any", false, false, false, 48)]), "html", null, true);
                yield "\">
                    <button type=\"submit\" class=\"btn btn-primary\">➕ Envoyer une demande d'ami</button>
                </form>
            ";
            }
            // line 52
            yield "        </div>
    ";
        } else {
            // line 54
            yield "        <p class=\"text-center mt-3 text-muted\">✨ Ceci est votre profil.</p>
    ";
        }
        // line 56
        yield "
    <div class=\"text-center mt-4\">
        <a href=\"";
        // line 58
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
        return "friendship/profil.html.twig";
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
        return array (  204 => 58,  200 => 56,  196 => 54,  192 => 52,  185 => 48,  182 => 47,  175 => 43,  172 => 42,  170 => 41,  166 => 39,  164 => 38,  157 => 34,  151 => 31,  145 => 29,  143 => 28,  140 => 27,  138 => 26,  128 => 19,  124 => 18,  120 => 17,  116 => 16,  106 => 9,  101 => 6,  88 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Profil de {{ user.username }}{% endblock %}

{% block body %}
<div class=\"container mt-5\">
    <div class=\"card shadow-lg\">
        <div class=\"card-body\">
            <h1 class=\"text-center mb-4\">👤 Profil de {{ user.username }}</h1>

            <div class=\"text-center\">
                <img src=\"https://via.placeholder.com/120\" class=\"rounded-circle mb-3\" alt=\"Avatar\">
            </div>

            <ul class=\"list-group list-group-flush\">
                <li class=\"list-group-item\"><strong>📧 Email :</strong> {{ user.email }}</li>
                <li class=\"list-group-item\"><strong>👤 Nom :</strong> {{ user.lastname }}</li>
                <li class=\"list-group-item\"><strong>📝 Prénom :</strong> {{ user.firstname }}</li>
                <li class=\"list-group-item\"><strong>📖 Biographie :</strong> {{ user.biographie ?: 'Aucune biographie' }}</li>
            </ul>
        </div>
    </div>

    <hr>

    {% if user.id != app.user.id %}
        <div class=\"text-center mt-4\">
            {% if isFriend %}
                <h3 class=\"text-success\">✅ Vous êtes amis avec {{ user.username }}</h3>
                <div class=\"d-flex justify-content-center gap-2\">
                    <form action=\"{{ path('app_remove_friend', {userId: user.id}) }}\" method=\"POST\">
                        <button type=\"submit\" class=\"btn btn-warning\">❌ Supprimer l'ami</button>
                    </form>
                    <form action=\"{{ path('app_block_friend', {userId: user.id}) }}\" method=\"POST\">
                        <button type=\"submit\" class=\"btn btn-danger\">🚫 Bloquer</button>
                    </form>
                </div>
            {% elseif pendingRequest is defined and pendingRequest %}
                <h3 class=\"text-warning\">⏳ Demande en attente</h3>
                <p class=\"text-muted\">Vous avez envoyé une demande d'ami.</p>
            {% elseif receivedRequest is defined and receivedRequest %}
                <h3 class=\"text-info\">📩 Demande reçue</h3>
                <form action=\"{{ path('app_accept_friend', {id: user.id}) }}\" method=\"POST\">
                    <button type=\"submit\" class=\"btn btn-success\">✅ Accepter</button>
                </form>
            {% else %}
                <h3 class=\"text-danger\">❌ Vous n'êtes pas encore amis</h3>
                <form method=\"POST\" action=\"{{ path('app_add_friend', {userId: user.id}) }}\">
                    <button type=\"submit\" class=\"btn btn-primary\">➕ Envoyer une demande d'ami</button>
                </form>
            {% endif %}
        </div>
    {% else %}
        <p class=\"text-center mt-3 text-muted\">✨ Ceci est votre profil.</p>
    {% endif %}

    <div class=\"text-center mt-4\">
        <a href=\"{{ path('app_friends_list') }}\" class=\"btn btn-outline-secondary\">🔙 Retour à la liste d'amis</a>
    </div>
</div>
{% endblock %}
", "friendship/profil.html.twig", "/home/adel/dev/ProjectHub/templates/friendship/profil.html.twig");
    }
}
