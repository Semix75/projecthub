<?php
namespace App\Twig;

use Psr\Cache\CacheItemPoolInterface;
use RequestParseBodyException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigViteExtension extends AbstractExtension {

    final public const CACHE_KEY = 'time_assets';
    private readonly bool $isProduction;
    private ?array $paths = null;
    private bool $polyfileloaded   = false;



    public function __construct(
        private readonly string $pathDir, 
        string $env, 
        private readonly CacheItemPoolInterface $cache,
        private readonly RequestStack $requestStack
        )
    {
        $this->isProduction = 'prod' === $env;
        
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('vite_entry_link_tags', [$this, 'link'], ['is_safe' => ['html']]),
            new TwigFunction('vite_entry_script_tags', [$this, 'script'], ['is_safe' => ['html']]),
        ];  
    }

    //Retourne un tableau de fonctions Twig avec les noms et les méthodes correspondantes.
    // Les fonctions Twig sont link et script.
    // Les fonctions Twig sont sécurisées pour le HTML.




    private function getAssets(): array 
    {
        if(null === $this->paths) {
            $cached = $this->cache->getItem(self::CACHE_KEY);
            if(!$cached->isHit()) {
                $manifest = $this->pathDir . '/manifest.json'; 
               
                if(file_exists($manifest)) {
                   $paths = json_decode(
             (string) file_get_contents($manifest),
              true,
               512,
                JSON_THROW_ON_ERROR
            );


                   $this->cache->save($cached->set($paths));
                   $this->paths = $paths;
                }else{
                    $this->paths = [];
                }
            }else{
                $this->paths = $cached->get();
            }
        }
        return $this->paths;
    }


//Vérifie si les assets sont déjà en mémoire ($this->paths).
// Si non, il vérifie le cache (CACHE_KEY).
// Si le cache est vide, il charge manifest.json, le stocke en cache et dans $this->paths.
// Si le fichier manifest.json n’existe pas, retourne un tableau vide.


    public function link(string $name, array $attrs = []): string  
    {
        $uri = $this->uri($name, '.css');

        if(strpos($uri, ':5173')){
            return '';
        }

        $attributes = implode('', array_map(fn($key) 
        => " {$key}=\"{$attrs[$key]}\"", array_keys($attrs)));
        
        return sprintf(
            '<link rel="stylesheet" href="%s" %s>',
             $this->uri($name . '.css'), 
             empty($attrs) ? '' : (' ' . $attributes));
    }


    //Vérifie si l’URI contient :5173, ce qui signifie que le fichier est en développement.
    // Si c’est le cas, retourne une chaîne vide.
    // Sinon, retourne la balise <link> avec l’URI et les attributs fournis.


   
    public function script(string $name): string {

        $script = $this->preload($name . '.js') . '<script src="'
        . $this->uri($name . '.js') . '" type="module" defer></script>';
        $request = $this->requestStack->getCurrentRequest();

        if(false === $this->polyfileloaded  && $request instanceof Request){
            $userAgent = $request->headers->get('User-Agent') ?: '';
            if(
                strpos($userAgent, 'Safari') &&
                !strpos($userAgent, 'Chrome') 
            ) {
                $this->polyfileloaded = true;
            $script = <<<HTML
            <script src='//unpkg.com/document-register-element' defer></script>
            $script
            HTML;
            }
        }

        return $script;

    }

    //Précharge les fichiers importés.
    // Ajoute la balise <script> avec l’URI et les attributs fournis.
    // Vérifie si le navigateur est Safari et charge document-register-element si nécessaire.
    // Retourne le script avec ou sans document-register-element.



    private function preload(string $name): string 
    {
        if(!$this->isProduction) {
            return '';
        }

        $imports = $this->getAssets()[$name]['imports'] ?? [];
        $preloads = [];

        foreach($imports as $import) {
            $preloads[] = <<<HTML
            <link rel="modulepreload" href="{$this->uri($import)}">
            HTML;
        }

        return implode('\n', $preloads);
    }

    //Vérifie si le serveur est en production.
    // Si non, retourne une chaîne vide.
    // Récupère les imports du fichier manifest.json.
    // Crée un tableau de balises <link> avec les attributs nécessaires.
    // Retourne les balises <link> concaténées avec un saut de ligne.


    private function uri(string $name ): string 
    {
        if (!$this->isProduction) {
            $request = $this->requestStack->getCurrentRequest();

            return $request ? "http://{$request->getHost()}:5173/assets/{$name}" : "";
        }

        if(strpos($name, '.css')){
            $name = $this->getAssets()[str_replace('.css','.js', $name)]['css'][0] ?? ''; 
        }else{
            $name = $this->getAssets()[$name]['file'] ?? $this->getAssets()[$name] ?? '';
        }
        return '/assets/$name';
    }

    //Vérifie si le serveur est en production.
    // Si non, retourne l’URI de développement.
    // Si le fichier est un CSS, récupère le nom du fichier JS associé.
    // Sinon, récupère le nom du fichier dans le tableau des assets.
    // Retourne l’URI de production avec le nom du fichier.


}

// ✅ Utilise le cache pour éviter de lire manifest.json à chaque requête.
// ✅ Gère les différences entre développement (localhost:5173) et production.
// ✅ Améliore la compatibilité avec Safari.
// ✅ Facilite l'intégration de Vite.js sans configuration manuelle.