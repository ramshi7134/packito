<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use ZipArchive;

class PackageGenerator
{
    public function generate(string $moduleName, string $createQuery): string
    {
        $moduleSlug = Str::snake($moduleName);
        $moduleStudly = Str::studly($moduleName);
        $basePath = storage_path("app/packages/{$moduleSlug}");

        File::deleteDirectory($basePath);
        File::makeDirectory($basePath . '/src/Database/Migrations', 0755, true);
        File::makeDirectory($basePath . '/src/Http/Controllers', 0755, true);
        File::makeDirectory($basePath . '/src/Http/Requests', 0755, true);
        File::makeDirectory($basePath . '/src/Http/Resources', 0755, true);
        File::makeDirectory($basePath . '/src/Models', 0755, true);
        File::makeDirectory($basePath . '/src/Providers', 0755, true);
        File::makeDirectory($basePath . '/src/config', 0755, true);
        File::makeDirectory($basePath . '/src/routes', 0755, true);
        File::makeDirectory($basePath . '/src/views', 0755, true);
        File::makeDirectory($basePath . '/src/Events', 0755, true);
        File::makeDirectory($basePath . '/src/Listeners', 0755, true);
        File::makeDirectory($basePath . '/src/Policies', 0755, true);
        File::makeDirectory($basePath . '/resources/lang/en', 0755, true);
        File::makeDirectory($basePath . '/resources/lang/ar', 0755, true);

        $migrationName = now()->format('Y_m_d_His') . "_create_{$moduleSlug}_table.php";
        File::put("$basePath/src/Database/Migrations/{$migrationName}", $this->generateMigration($createQuery));

        File::put("$basePath/src/Models/{$moduleStudly}.php", $this->generateModel($moduleStudly));
        File::put("$basePath/src/Http/Controllers/{$moduleStudly}Controller.php", $this->generateController($moduleStudly));
        File::put("$basePath/src/Http/Requests/{$moduleStudly}Request.php", $this->generateRequest($moduleStudly));
        File::put("$basePath/src/Http/Resources/{$moduleStudly}Resource.php", $this->generateResource($moduleStudly));
        File::put("$basePath/src/Http/Resources/{$moduleStudly}Collection.php", $this->generateCollection($moduleStudly));
        File::put("$basePath/src/Providers/{$moduleStudly}ServiceProvider.php", $this->generateServiceProvider($moduleStudly));
        File::put("$basePath/src/routes/web.php", $this->generateRoutes($moduleSlug, $moduleStudly));
        File::put("$basePath/src/views/index.blade.php", "<h1>{$moduleStudly} Index</h1>");

        File::put("$basePath/src/Events/{$moduleStudly}Event.php", $this->generateEvent($moduleStudly));
        File::put("$basePath/src/Listeners/{$moduleStudly}Listener.php", $this->generateListener($moduleStudly));
        File::put("$basePath/src/Policies/{$moduleStudly}Policy.php", $this->generatePolicy($moduleStudly));

        File::put("$basePath/resources/lang/en/{$moduleSlug}.php", $this->generateLangStub('en'));
        File::put("$basePath/resources/lang/ar/{$moduleSlug}.php", $this->generateLangStub('ar'));

        File::put("$basePath/.gitignore", "vendor/
node_modules/
.env
.DS_Store");
        File::put("$basePath/README.md", "# {$moduleStudly} Module\n\nGenerated Package");
        File::put("$basePath/LICENSE", "MIT License");
        File::put("$basePath/composer.json", $this->generateComposerJson($moduleSlug, $moduleStudly));

        $zipPath = storage_path("app/{$moduleSlug}.zip");
        $this->zipFolder($basePath, $zipPath);

        return $zipPath;
    }

    protected function zipFolder(string $folder, string $zipPath): void
    {
        $zip = new ZipArchive;
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($folder),
                \RecursiveIteratorIterator::LEAVES_ONLY
            );
            foreach ($files as $file) {
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($folder) + 1);
                    $zip->addFile($filePath, $relativePath);
                }
            }
            $zip->close();
        }
    }

    // Stub generators below (examples)

    protected function generateMigration(string $sql): string
    {
        return "<?php\n\n// Generated Migration\n\n/*\n{$sql}\n*/";
    }

    protected function generateModel(string $class): string
    {
        return "<?php\n\nnamespace App\\Models;\n\nuse Illuminate\\Database\\Eloquent\\Model;\n\nclass {$class} extends Model\n{\n    protected \$guarded = [];\n}";
    }

    protected function generateController(string $class): string
    {
        return "<?php\n\nnamespace App\\Http\\Controllers;\n\nclass {$class}Controller extends Controller\n{\n    public function index()\n    {\n        return view('{$class}::index');\n    }\n}";
    }

    protected function generateRequest(string $class): string
    {
        return "<?php\n\nnamespace App\\Http\\Requests;\n\nuse Illuminate\\Foundation\\Http\\FormRequest;\n\nclass {$class}Request extends FormRequest\n{\n    public function rules(): array\n    {\n        return [];\n    }\n}";
    }

    protected function generateResource(string $class): string
    {
        return "<?php\n\nnamespace App\\Http\\Resources;\n\nuse Illuminate\\Http\\Resources\\Json\\JsonResource;\n\nclass {$class}Resource extends JsonResource\n{\n    public function toArray(\$request): array\n    {\n        return parent::toArray(\$request);\n    }\n}";
    }

    protected function generateCollection(string $class): string
    {
        return "<?php\n\nnamespace App\\Http\\Resources;\n\nuse Illuminate\\Http\\Resources\\Json\\ResourceCollection;\n\nclass {$class}Collection extends ResourceCollection\n{\n    public function toArray(\$request): array\n    {\n        return parent::toArray(\$request);\n    }\n}";
    }

    protected function generateServiceProvider(string $class): string
    {
        return "<?php\n\nnamespace App\\Providers;\n\nuse Illuminate\\Support\\ServiceProvider;\n\nclass {$class}ServiceProvider extends ServiceProvider\n{\n    public function register() { }\n    public function boot() { }\n}";
    }

    protected function generateRoutes(string $slug, string $studly): string
    {
        return "<?php\n\nuse Illuminate\\Support\\Facades\\Route;\n\nRoute::get('/{$slug}', [\App\\Http\\Controllers\\{$studly}Controller::class, 'index']);";
    }

    protected function generateEvent(string $class): string
    {
        return "<?php\n\nnamespace App\\Events;\n\nclass {$class}Event\n{ }";
    }

    protected function generateListener(string $class): string
    {
        return "<?php\n\nnamespace App\\Listeners;\n\nclass {$class}Listener\n{ }";
    }

    protected function generatePolicy(string $class): string
    {
        return "<?php\n\nnamespace App\\Policies;\n\nclass {$class}Policy\n{ }";
    }

    protected function generateLangStub(string $lang): string
    {
        return "<?php\n\nreturn [\n    'example' => 'This is an example message.',\n];";
    }

    protected function generateComposerJson(string $slug, string $studly): string
    {
        return json_encode([
            "name" => "generated/{$slug}",
            "description" => "Generated {$studly} package",
            "autoload" => [
                "psr-4" => [
                    "App\\" => "src/"
                ]
            ],
            "extra" => [
                "laravel" => [
                    "providers" => [
                        "App\\Providers\\{$studly}ServiceProvider"
                    ]
                ]
            ]
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}
