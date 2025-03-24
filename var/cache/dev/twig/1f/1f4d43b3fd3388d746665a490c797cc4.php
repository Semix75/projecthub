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

/* group/list.html.twig */
class __TwigTemplate_096ca15938b925e41c8f231647569810 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "group/list.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "group/list.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "group/list.html.twig", 1);
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

        yield "Liste des Groupes";
        
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
    <h1 class=\"text-center mb-4\">👥 Liste des Groupes</h1>

    <!-- Boutons Actions (placés en haut) -->
    <div class=\"d-flex justify-content-center gap-3 mb-4\">
        <a href=\"";
        // line 11
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("home");
        yield "\" class=\"btn btn-outline-primary\">🏠 Retour à l'accueil</a>
        <a href=\"";
        // line 12
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_generate_groups");
        yield "\" class=\"btn btn-primary\">🔄 Mettre à jour les groupes</a>
    </div>

    <!-- Mes Groupes -->
    <div class=\"mb-5\">
        <h2 class=\"text-primary\">📌 Mes Groupes</h2>
        ";
        // line 18
        if (Twig\Extension\CoreExtension::testEmpty((isset($context["userGroups"]) || array_key_exists("userGroups", $context) ? $context["userGroups"] : (function () { throw new RuntimeError('Variable "userGroups" does not exist.', 18, $this->source); })()))) {
            // line 19
            yield "            <p class=\"text-muted\">Vous n'êtes dans aucun groupe.</p>
        ";
        } else {
            // line 21
            yield "            <div class=\"row\">
                ";
            // line 22
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["userGroups"]) || array_key_exists("userGroups", $context) ? $context["userGroups"] : (function () { throw new RuntimeError('Variable "userGroups" does not exist.', 22, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
                // line 23
                yield "                    <div class=\"col-md-6\">
                        <div class=\"card shadow-sm mb-4\">
                            <div class=\"card-body\">
                                <h3 class=\"card-title text-primary\">";
                // line 26
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["group"], "nom", [], "any", false, false, false, 26), "html", null, true);
                yield "</h3>
                                <p class=\"card-text\"><strong>📌 Projet :</strong> ";
                // line 27
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["group"], "projet", [], "any", false, false, false, 27), "intitule", [], "any", false, false, false, 27), "html", null, true);
                yield "</p>

                                <h4 class=\"h6 text-muted\">👥 Membres :</h4>
                                <ul class=\"list-group\">
                                    ";
                // line 31
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["group"], "users", [], "any", false, false, false, 31));
                foreach ($context['_seq'] as $context["_key"] => $context["member"]) {
                    // line 32
                    yield "                                        <li class=\"list-group-item d-flex align-items-center\">
                                            <i class=\"bi bi-person-circle me-2 fs-5 text-primary\"></i>
                                            <a href=\"";
                    // line 34
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_user_profile", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["member"], "id", [], "any", false, false, false, 34)]), "html", null, true);
                    yield "\" class=\"text-decoration-none\">
                                                ";
                    // line 35
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["member"], "username", [], "any", false, false, false, 35), "html", null, true);
                    yield "
                                            </a>
                                        </li>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['member'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 39
                yield "                                </ul>
                            </div>
                        </div>
                    </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['group'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 44
            yield "            </div>
        ";
        }
        // line 46
        yield "    </div>

    <!-- Tous les Groupes -->
    <div>
        <h2 class=\"text-success\">🌍 Tous les Groupes</h2>
        ";
        // line 51
        if (Twig\Extension\CoreExtension::testEmpty((isset($context["allGroups"]) || array_key_exists("allGroups", $context) ? $context["allGroups"] : (function () { throw new RuntimeError('Variable "allGroups" does not exist.', 51, $this->source); })()))) {
            // line 52
            yield "            <p class=\"text-muted\">Aucun groupe disponible.</p>
        ";
        } else {
            // line 54
            yield "            <div class=\"row\">
                ";
            // line 55
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["allGroups"]) || array_key_exists("allGroups", $context) ? $context["allGroups"] : (function () { throw new RuntimeError('Variable "allGroups" does not exist.', 55, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
                // line 56
                yield "                    <div class=\"col-md-6\">
                        <div class=\"card shadow-sm mb-4\">
                            <div class=\"card-body\">
                                <h3 class=\"card-title text-success\">";
                // line 59
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["group"], "nom", [], "any", false, false, false, 59), "html", null, true);
                yield "</h3>
                                <p class=\"card-text\"><strong>📌 Projet :</strong> ";
                // line 60
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["group"], "projet", [], "any", false, false, false, 60), "intitule", [], "any", false, false, false, 60), "html", null, true);
                yield "</p>

                                <h4 class=\"h6 text-muted\">👥 Membres :</h4>
                                <ul class=\"list-group\">
                                    ";
                // line 64
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["group"], "users", [], "any", false, false, false, 64));
                foreach ($context['_seq'] as $context["_key"] => $context["member"]) {
                    // line 65
                    yield "                                        <li class=\"list-group-item d-flex align-items-center\">
                                            <i class=\"bi bi-person-circle me-2 fs-5 text-success\"></i>
                                            <a href=\"";
                    // line 67
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_user_profile", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["member"], "id", [], "any", false, false, false, 67)]), "html", null, true);
                    yield "\" class=\"text-decoration-none\">
                                                ";
                    // line 68
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["member"], "username", [], "any", false, false, false, 68), "html", null, true);
                    yield "
                                            </a>
                                        </li>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['member'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 72
                yield "                                </ul>
                            </div>
                        </div>
                    </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['group'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 77
            yield "            </div>
        ";
        }
        // line 79
        yield "    </div>
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
        return "group/list.html.twig";
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
        return array (  257 => 79,  253 => 77,  243 => 72,  233 => 68,  229 => 67,  225 => 65,  221 => 64,  214 => 60,  210 => 59,  205 => 56,  201 => 55,  198 => 54,  194 => 52,  192 => 51,  185 => 46,  181 => 44,  171 => 39,  161 => 35,  157 => 34,  153 => 32,  149 => 31,  142 => 27,  138 => 26,  133 => 23,  129 => 22,  126 => 21,  122 => 19,  120 => 18,  111 => 12,  107 => 11,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Liste des Groupes{% endblock %}

{% block body %}
<div class=\"container mt-5\">
    <h1 class=\"text-center mb-4\">👥 Liste des Groupes</h1>

    <!-- Boutons Actions (placés en haut) -->
    <div class=\"d-flex justify-content-center gap-3 mb-4\">
        <a href=\"{{ path('home') }}\" class=\"btn btn-outline-primary\">🏠 Retour à l'accueil</a>
        <a href=\"{{ path('app_generate_groups') }}\" class=\"btn btn-primary\">🔄 Mettre à jour les groupes</a>
    </div>

    <!-- Mes Groupes -->
    <div class=\"mb-5\">
        <h2 class=\"text-primary\">📌 Mes Groupes</h2>
        {% if userGroups is empty %}
            <p class=\"text-muted\">Vous n'êtes dans aucun groupe.</p>
        {% else %}
            <div class=\"row\">
                {% for group in userGroups %}
                    <div class=\"col-md-6\">
                        <div class=\"card shadow-sm mb-4\">
                            <div class=\"card-body\">
                                <h3 class=\"card-title text-primary\">{{ group.nom }}</h3>
                                <p class=\"card-text\"><strong>📌 Projet :</strong> {{ group.projet.intitule }}</p>

                                <h4 class=\"h6 text-muted\">👥 Membres :</h4>
                                <ul class=\"list-group\">
                                    {% for member in group.users %}
                                        <li class=\"list-group-item d-flex align-items-center\">
                                            <i class=\"bi bi-person-circle me-2 fs-5 text-primary\"></i>
                                            <a href=\"{{ path('app_user_profile', {'id': member.id}) }}\" class=\"text-decoration-none\">
                                                {{ member.username }}
                                            </a>
                                        </li>
                                    {% endfor %}
                                </ul>
                            </div>
                        </div>
                    </div>
                {% endfor %}
            </div>
        {% endif %}
    </div>

    <!-- Tous les Groupes -->
    <div>
        <h2 class=\"text-success\">🌍 Tous les Groupes</h2>
        {% if allGroups is empty %}
            <p class=\"text-muted\">Aucun groupe disponible.</p>
        {% else %}
            <div class=\"row\">
                {% for group in allGroups %}
                    <div class=\"col-md-6\">
                        <div class=\"card shadow-sm mb-4\">
                            <div class=\"card-body\">
                                <h3 class=\"card-title text-success\">{{ group.nom }}</h3>
                                <p class=\"card-text\"><strong>📌 Projet :</strong> {{ group.projet.intitule }}</p>

                                <h4 class=\"h6 text-muted\">👥 Membres :</h4>
                                <ul class=\"list-group\">
                                    {% for member in group.users %}
                                        <li class=\"list-group-item d-flex align-items-center\">
                                            <i class=\"bi bi-person-circle me-2 fs-5 text-success\"></i>
                                            <a href=\"{{ path('app_user_profile', {'id': member.id}) }}\" class=\"text-decoration-none\">
                                                {{ member.username }}
                                            </a>
                                        </li>
                                    {% endfor %}
                                </ul>
                            </div>
                        </div>
                    </div>
                {% endfor %}
            </div>
        {% endif %}
    </div>
</div>
{% endblock %}
", "group/list.html.twig", "C:\\Users\\Lyesri\\Desktop\\PROJET MDI\\projecthub\\templates\\group\\list.html.twig");
    }
}
