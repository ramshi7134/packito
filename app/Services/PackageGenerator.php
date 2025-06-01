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
        File::put("$basePath/src/Http/Resources/{$moduleStudly}Resource.php", $this->generateResource($moduleStudly,$createQuery));
        File::put("$basePath/src/Http/Resources/{$moduleStudly}Collection.php", $this->generateCollection($moduleStudly,$createQuery));
        File::put("$basePath/src/Providers/{$moduleStudly}ServiceProvider.php", $this->generateServiceProvider($moduleStudly));
        File::put("$basePath/src/routes/web.php", $this->generateRoutes($moduleSlug, $moduleStudly));
        File::put("$basePath/src/views/index.blade.php", "<h1>{$moduleStudly} Index</h1>");
        File::put("$basePath/src/config/" . Str::lower($moduleStudly) . '.php', $this->generateConfigFile($this->extractFillableFromCreateQuery($createQuery), $moduleStudly));

        File::put("$basePath/src/Events/{$moduleStudly}Event.php", $this->generateEvent($moduleStudly));
        File::put("$basePath/src/Listeners/{$moduleStudly}Listener.php", $this->generateListener($moduleStudly));
        File::put("$basePath/src/Policies/{$moduleStudly}Policy.php", $this->generatePolicy($moduleStudly));

        File::put("$basePath/resources/lang/en/{$moduleSlug}.php", $this->generateLangStub('en'));
        File::put("$basePath/resources/lang/ar/{$moduleSlug}.php", $this->generateLangStub('ar'));

        File::put(
            "$basePath/.gitignore",
            "vendor/
node_modules/
.env
.DS_Store",
        );
        File::put("$basePath/README.md", "# {$moduleStudly} Module\n\nGenerated Package");
        File::put("$basePath/LICENSE", 'MIT License');
        File::put("$basePath/composer.json", $this->generateComposerJson($moduleSlug, $moduleStudly));

        $zipPath = storage_path("app/{$moduleSlug}.zip");
        $this->zipFolder($basePath, $zipPath);

        return $zipPath;
    }

    protected function zipFolder(string $folder, string $zipPath): void
    {
        $zip = new ZipArchive();
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($folder), \RecursiveIteratorIterator::LEAVES_ONLY);
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

    protected function generateModel(string $class): string
    {
        return "<?php\n\nnamespace Webpacks\\{$class}\\Models;\n\nuse Illuminate\\Database\\Eloquent\\Model;\n\nuse Illuminate\Database\Eloquent\SoftDeletes;\n\nclass {$class} extends Model\n{\n use SoftDeletes;\n\n   protected \$guarded = [];\n}";
    }

    protected function generateController(string $class): string
    {
        $classLcPlural = strtolower($class) . 's';
    return "<?php

namespace Webpacks\\{$class}\\Http\\Controllers;

use App\\Http\\Controllers\\Controller;
use Webpacks\\{$class}\\Http\\Resources\\{$class}Collection;
use Webpacks\\{$class}\\Http\\Resources\\{$class}Resource;
use Webpacks\\{$class}\\Models\\{$class};
use Webpacks\\{$class}\\Requests\\{$class}Request;

class {$class}Controller extends Controller
{
    public function index()
    {
        \${$classLcPlural} = {$class}::paginate(10);
        return new {$class}Collection(\${$classLcPlural});
    }

    public function show(\$id)
    {
        \$item = {$class}::findOrFail(\$id);
        return new {$class}Resource(\$item);
    }

    public function store({$class}Request \$request)
    {
        \$validated = \$request->validated();
        \$item = {$class}::create(\$validated);
        return new {$class}Resource(\$item);
    }

    public function update({$class}Request \$request, \$id)
    {
        \$validated = \$request->validated();
        \$item = {$class}::findOrFail(\$id);
        \$item->update(\$validated);
        return new {$class}Resource(\$item);
    }
}
";
    }

    protected function generateRequest(string $class): string
    {
        $classLc = strtolower($class);

    return "<?php

namespace Webpacks\\{$class}\\Requests;

use Illuminate\\Foundation\\Http\\FormRequest;

class {$class}Request extends FormRequest
{
    public function authorize()
    {
        // Return true or add your authorization logic
        return true;
    }

    public function rules()
    {
        \$rules = [
            //'title' => 'required|string|max:255',
            //'content' => 'required|string',
            //'category_id' => 'required|exists:categories,id',
        ];

        if (\$this->isStore()) {
            // Additional rules for store (if any)
        }

        if (\$this->isUpdate()) {
            // Modify validation for update
            \$rules['category_id'] = 'nullable|exists:categories,id';
        }

        return \$rules;
    }

    /**
     * Check if the current request is for the 'store' action (POST)
     */
    public function isStore()
    {
        return \$this->isMethod('post') && !\$this->route('{$classLc}');
    }

    /**
     * Check if the current request is for the 'update' action (PUT)
     */
    public function isUpdate()
    {
        return \$this->isMethod('put') && \$this->route('{$classLc}');
    }

    public function messages()
    {
        return [
           // 'title.required' => 'The title is required.',
           // 'content.required' => 'The content is required.',
           // 'category_id.required' => 'The category is required.',
        ];
    }
}
";
    }

    protected function generateResource(string $class,$sql)
    {
        preg_match_all('/`(\w+)`\s+[\w()]+/', $sql, $matches);
    $columns = $matches[1] ?? [];

    $lines = array_map(function ($col) {
        if (in_array($col, ['created_at', 'updated_at'])) {
            return "            '{$col}' => \$this->{$col}?->toDateTimeString(),";
        }

        return "            '{$col}' => \$this->{$col},";
    }, $columns);

    $fields = implode("\n", $lines);

    return "<?php

namespace Webpacks\\{$class}\\Http\\Resources;

use Illuminate\\Http\\Resources\\Json\\JsonResource;

class {$class}Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\\Http\\Request  \$request
     * @return array
     */
    public function toArray(\$request)
    {
        return [
{$fields}
        ];
    }
}
";
    }

    protected function generateCollection(string $class,$createTableSql)
    {
       preg_match_all('/`(\w+)`\s+[\w()]+/', $createTableSql, $matches);
    $columns = $matches[1] ?? [];

    // Remove Laravel default timestamps if not explicitly declared
    $columns = array_unique(array_filter($columns));

    $fields = array_map(function ($col) {
        if (in_array($col, ['created_at', 'updated_at'])) {
            return "                    '{$col}' => \$item->{$col}->toDateTimeString(),";
        }
        return "                    '{$col}' => \$item->{$col},";
    }, $columns);

    $fieldsStr = implode("\n", $fields);

    return "<?php

namespace Webpacks\\{$class}\\Http\\Resources;

use Illuminate\\Http\\Resources\\Json\\ResourceCollection;

class {$class}Collection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\\Http\\Request  \$request
     * @return array
     */
    public function toArray(\$request)
    {
        return [
            'data' => \$this->collection->map(function (\$item) {
                return [
{$fieldsStr}
                ];
            }),
        ];
    }

    /**
     * Customize additional meta data for the collection.
     *
     * @param  \Illuminate\\Http\\Request  \$request
     * @return array
     */
    public function with(\$request)
    {
        return [
            'meta' => [
                'total' => \$this->total(),
                'per_page' => \$this->perPage(),
                'current_page' => \$this->currentPage(),
                'last_page' => \$this->lastPage(),
            ],
        ];
    }
}
";
    }

    protected function generateServiceProvider(string $class): string
    {
        return "<?php

namespace Webpacks\\{$class}\\Providers;

use Illuminate\\Support\\ServiceProvider;
use Webpacks\\{$class}\\Policies\\{$class}Policy;

class {$class}ServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load routes
        \$this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        // Load views
        \$this->loadViewsFrom(__DIR__ . '/../views', '" . strtolower($class) . "');

        // Load migrations
        \$this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        // Load package translations
        \$this->loadTranslationsFrom(__DIR__ . '/../resources/lang', '" . strtolower($class) . "');

        // Publish config
        \$this->publishes([
            __DIR__ . '/../config/" . strtolower($class) . ".php' => config_path('" . strtolower($class) . ".php'),
        ], 'config');

        \$this->registerPolicies();
    }

    public function register()
    {
        // Merge configuration
        \$this->mergeConfigFrom(__DIR__ . '/../config/" . strtolower($class) . ".php', '" . strtolower($class) . "');
    }

    protected function registerPolicies()
    {
        // Register a placeholder middleware (optional)
        \$this->app['router']->aliasMiddleware('can', function (\$request, \$next) {
            return \$next(\$request);
        });

        // Bind policy
        \$this->app->bind({$class}Policy::class, function (\$app) {
            return new {$class}Policy();
        });
    }
}
";

    }

    protected function generateRoutes(string $slug, string $class): string
    {
    $controller = "Webpacks\\{$class}\\Http\\Controllers\\{$class}Controller";

    return "<?php

use Illuminate\\Support\\Facades\\Route;

Route::prefix('{$slug}')->middleware('api')->group(function () {
    Route::get('/', [{$controller}::class, 'index']);
    Route::post('/', [{$controller}::class, 'store']);
    Route::get('/{id}', [{$controller}::class, 'show']);
    Route::put('/{id}', [{$controller}::class, 'update']);
    Route::delete('/{id}', [{$controller}::class, 'destroy']);
});
";
    }

    protected function generateEvent(string $class): string
    {
        return "<?php

namespace Webpacks\\{$class}\\Events;

use Illuminate\\Foundation\\Events\\Dispatchable;
use Illuminate\\Queue\\SerializesModels;

class {$class}Event
{
    use Dispatchable, SerializesModels;

    public \$data;

    public function __construct(\$data)
    {
        \$this->data = \$data;
    }
}
";
    }

    protected function generateListener(string $class): string
    {
         return "<?php

namespace Webpacks\\{$class}\\Listeners;

use Webpacks\\{$class}\\Events\\{$class}Event;

class {$class}EventListener
{
    public function handle({$class}Event \$event)
    {
        // Handle the event logic
        \Log::info('Event handled with data: ' . \$event->data);
    }
}
";
    }

    protected function generatePolicy(string $class): string
    {
         $classLower = strtolower($class);

    return "<?php

namespace Webpacks\\{$class}\\Policies;

use App\\Models\\User;
use Webpacks\\{$class}\\Models\\{$class};

class {$class}Policy
{
    /**
     * Determine if the given user can create a {$class}.
     */
    public function create(User \$user)
    {
        return \$user->is_admin; // Only admins can create
    }

    /**
     * Determine if the given user can update the {$class}.
     */
    public function update(User \$user, {$class} \${$classLower})
    {
        return \$user->id === \${$classLower}->user_id || \$user->is_admin; // Author or admin
    }

    /**
     * Determine if the given user can delete the {$class}.
     */
    public function delete(User \$user, {$class} \${$classLower})
    {
        return \$user->id === \${$classLower}->user_id || \$user->is_admin; // Author or admin
    }
}
";
    }

    protected function generateLangStub(string $lang): string
    {
        return "<?php\n\nreturn [\n    'example' => 'This is an example message.',\n];";
    }

    protected function generateComposerJson(string $slug, string $studly): string
    {
        return json_encode(
            [
                'name' => "generated/{$slug}",
                'description' => "Generated {$studly} package",
                'require' => [
                    'php' => '^8.2',
                    'laravel/framework' => '^11.0',
                ],
                'autoload' => [
                    'psr-4' => [
                        "Webpacks\\{$studly}\\" => 'src/',
                    ],
                ],
                'extra' => [
                    'laravel' => [
                        'providers' => ["Webpacks\\{$studly}\\Providers\\{$studly}ServiceProvider"],
                    ],
                ],
            ],
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES,
        );
    }
    protected function generateConfigFile(array $fillableFields, string $module): string
    {
        $fields = array_map(fn($field) => "        '$field',", $fillableFields);
        $fieldsString = implode("\n", $fields);

        return "<?php

    return [

        /*
        |--------------------------------------------------------------------------
        | Fillable Fields for Modules
        |--------------------------------------------------------------------------
        |
        | Define which attributes are mass assignable for the $module module.
        |
        */

        'fillable' => [
            {$fieldsString}
        ],

        ];
    ";
    }
    public function extractFillableFromCreateQuery(string $sql): array
    {
        // Normalize whitespace for easier regex
        $sql = preg_replace('/\s+/', ' ', $sql);

        // Extract columns inside the first parentheses block
        if (!preg_match('/\((.*)\)/s', $sql, $matches)) {
            return [];
        }

        $columnsBlock = $matches[1];

        // Split by commas, but careful with commas inside ENUM() or DECIMAL()
        // So we parse by splitting on commas that are not inside parentheses
        $columns = [];
        $buffer = '';
        $parentheses = 0;
        $chars = str_split($columnsBlock);

        foreach ($chars as $char) {
            if ($char === '(') {
                $parentheses++;
            }
            if ($char === ')') {
                $parentheses--;
            }
            if ($char === ',' && $parentheses === 0) {
                $columns[] = trim($buffer);
                $buffer = '';
            } else {
                $buffer .= $char;
            }
        }
        if (trim($buffer) !== '') {
            $columns[] = trim($buffer);
        }

        $fillable = [];

        foreach ($columns as $colDef) {
            $colDef = trim($colDef);

            // Skip constraints and indexes
            if (stripos($colDef, 'primary key') !== false || stripos($colDef, 'index') !== false || stripos($colDef, 'constraint') !== false || stripos($colDef, 'foreign key') !== false) {
                continue;
            }

            // Skip timestamps and typical non-fillable fields
            if (preg_match('/\b(created_at|updated_at|deleted_at|id)\b/i', $colDef)) {
                continue;
            }

            // Extract column name (quoted or unquoted)
            if (preg_match('/^`?(\w+)`?\s/', $colDef, $matches)) {
                $fillable[] = $matches[1];
            }
        }

        return $fillable;
    }

    function parseCreateTableQuery(string $sql): array
    {
        $sql = trim($sql);
        preg_match('/CREATE TABLE\s+`?(\w+)`?\s*\((.*)\)\s*;?$/is', $sql, $matches);

        $tableName = $matches[1] ?? null;
        $definition = $matches[2] ?? null;

        if (!$tableName || !$definition) {
            return [null, [], [], []]; // Defensive fallback
        }

        $lines = preg_split('/,(?![^\(\']*[\)\'])/', $definition);

        $columns = [];
        $foreignKeys = [];
        $indexes = [];

        foreach ($lines as $line) {
            $line = trim($line);

            // FOREIGN KEY
            if (preg_match('/FOREIGN KEY\s+\(`?(\w+)`?\)\s+REFERENCES\s+`?(\w+)`?\s*\(`?(\w+)`?\)(.*)?/i', $line, $fk)) {
                $foreignKeys[] = [
                    'column' => $fk[1],
                    'reference' => $fk[3],
                    'on' => $fk[2],
                    'onDelete' => str_contains(strtoupper($fk[4] ?? ''), 'ON DELETE') ? trim(preg_replace('/.*ON DELETE\s+/i', '', $fk[4])) : null,
                ];
                continue;
            }

            // INDEX
            if (preg_match('/INDEX\s+`?\w+`?\s*\((.+)\)/i', $line, $idx)) {
                $indexes[] = array_map('trim', explode(',', str_replace(['(', ')', '`'], '', $idx[1])));
                continue;
            }

            // Skip PRIMARY KEY or timestamps
            if (stripos($line, 'PRIMARY KEY') !== false || stripos($line, 'created_at') !== false || stripos($line, 'updated_at') !== false) {
                continue;
            }

            // COLUMN
            if (preg_match('/^`?(\w+)`?\s+(.+)/i', $line, $col)) {
                $columns[$col[1]] = trim($col[2]);
            }
        }

        return [$tableName, $columns, $foreignKeys, $indexes];
    }

    public function generateMigration(string $sql): string
    {
        [$tableName, $columns, $foreignKeys, $indexes] = $this->parseCreateTableQuery($sql);

        $fields = '';

        // Columns
        foreach ($columns as $name => $definition) {
            $fields .= '            ' . $this->mapColumn($name, $definition) . "\n";
        }

        // Foreign Keys
        foreach ($foreignKeys as $fk) {
            $onDelete = $fk['onDelete'] ? "->onDelete('" . strtolower(trim($fk['onDelete'])) . "')" : '';
            $fields .= "            \$table->foreign('{$fk['column']}')->references('{$fk['reference']}')->on('{$fk['on']}'){$onDelete};\n";
        }

        // Indexes
        foreach ($indexes as $index) {
            $columns = is_array($index) ? $index : explode(',', $index);
            $cols = implode("', '", array_map('trim', $columns));
            $fields .= "            \$table->index(['{$cols}']);\n";
        }

        // Common columns
        $fields .= "            \$table->timestamps();\n";
        $fields .= "            \$table->softDeletes();\n";

        return "<?php

use Illuminate\\Database\\Migrations\\Migration;
use Illuminate\\Database\\Schema\\Blueprint;
use Illuminate\\Support\\Facades\\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('{$tableName}', function (Blueprint \$table) {
            \$table->id();
{$fields}        });
    }

    public function down()
    {
        Schema::dropIfExists('{$tableName}');
    }
};";
    }

    public function mapColumn(string $name, string $definition): string
    {
        $definition = strtolower($definition);

        // Extract default value if exists
        $defaultString = '';
        if (preg_match("/default\s+('?[\w\.\-]+'?)/i", $definition, $defaultMatch)) {
            $defaultValue = trim($defaultMatch[1], "'");
            if (is_numeric($defaultValue)) {
                $defaultString = "->default({$defaultValue})";
            } elseif (in_array($defaultValue, ['true', 'false'])) {
                $defaultString = '->default(' . ($defaultValue === 'true' ? 'true' : 'false') . ')';
            } else {
                $defaultString = "->default('{$defaultValue}')";
            }
        }

        $nullable = str_contains($definition, 'not null') ? '' : '->nullable()';

        // Handle ENUM type
        if (str_contains($definition, 'enum')) {
            preg_match('/enum\s*\((.+)\)/i', $definition, $enumMatch);
            $enumValues = str_replace("'", '', $enumMatch[1] ?? '');
            $enumArray = implode("', '", array_map('trim', explode(',', $enumValues)));
            return "\$table->enum('{$name}', ['{$enumArray}']){$nullable}{$defaultString};";
        }

        // Match column types
        return match (true) {
            str_contains($definition, 'bigint') => (str_contains($definition, 'unsigned') ? "\$table->unsignedBigInteger('{$name}')" : "\$table->bigInteger('{$name}')") . "{$nullable}{$defaultString};",

            str_contains($definition, 'int') => (str_contains($definition, 'unsigned') ? "\$table->unsignedInteger('{$name}')" : "\$table->integer('{$name}')") . "{$nullable}{$defaultString};",

            str_contains($definition, 'varchar') => "\$table->string('{$name}', " . (preg_match('/varchar\((\d+)\)/', $definition, $m) ? $m[1] : 255) . "){$nullable}{$defaultString};",

            str_contains($definition, 'decimal') => "\$table->decimal('{$name}', 10, 2){$nullable}{$defaultString};",

            str_contains($definition, 'date') => "\$table->date('{$name}'){$nullable}{$defaultString};",

            str_contains($definition, 'timestamp') => "\$table->timestamp('{$name}'){$nullable}{$defaultString};",

            str_contains($definition, 'text') => "\$table->text('{$name}'){$nullable}{$defaultString};",

            str_contains($definition, 'boolean') => "\$table->boolean('{$name}'){$nullable}{$defaultString};",

            default => "\$table->string('{$name}'){$nullable}{$defaultString};",
        };
    }
}
